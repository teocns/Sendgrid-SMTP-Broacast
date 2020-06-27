<?php


require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/base-class.php';
require_once __DIR__ . '/email-template.php';

class Broadcast extends baseClass {
    public $id;
    public $user_id;
    public $tags_ids; // an array containing just the tags ids to the email sent
    public $creation_timestamp;
    public $email_template_id;
    public $is_executed;
    public $is_planned_cron;

    public $GUID;

    public function Insert(){
        // Create GUID
        $this->GUID = $this->GUIDv4();
        $db = Db::instance();
        // Start transaction because we're doing two queries
        $db->startTransaction();
        $insertArray = get_object_vars($this);
        unset($insertArray['id']);
        unset($insertArray['tags_ids']);
        $this->id = $db->insert('broadcasts',
            $insertArray
        );

        if ($db->getLastError()){
            die($db->getLastError());
        }
        if ($this->id){
            // Broadcast recorded in the database. Insert into broadcast_email_tags the tags used
            foreach($this->tags_ids as $tag_id){
                $inserted_tag_id = $db->insert('broadcasts_email_tags',[
                    "broadcast_id"=>$this->id,
                    "email_tags_id"=>$tag_id
                ]);
            }
            $db->commit();
            return true;
        }
        $db->rollback();
        return false;
    }

    public function Start(){

        // Get the recipients based on $tags_ids
        $db = Db::instance();
        $db->where('id',$this->tags_ids[0]);
        if (count($this->tags_ids) > 1){
            for ($i=1;$i<count($this->tags_ids);$i++){
                $db->orWhere('id',$this->tags_ids[$i]);
            }
        }
        require_once __DIR__.'/../mailer.php';

        $recipients =  $db->getValue('email_tags','distinct email',null);

        if ($recipients && count($recipients) > 0){
            // Get template

            $email_template = EmailTemplate::GetByID($this->email_template_id);



            Mailer::SendMail($recipients,$email_template->name,$email_template->html,'lopaklaw@gmail.com','lopaklaw@gmail.com',$this->GUID);

        }




    }

    private function GUIDv4 ($trim = true)
    {
        // Windows
        if (function_exists('com_create_guid') === true) {
            if ($trim === true)
                return trim(com_create_guid(), '{}');
            else
                return com_create_guid();
        }

        // OSX/Linux
        if (function_exists('openssl_random_pseudo_bytes') === true) {
            $data = openssl_random_pseudo_bytes(16);
            $data[6] = chr(ord($data[6]) & 0x0f | 0x40);    // set version to 0100
            $data[8] = chr(ord($data[8]) & 0x3f | 0x80);    // set bits 6-7 to 10
            return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
        }

        // Fallback (PHP 4.2+)
        mt_srand((double)microtime() * 10000);
        $charid = strtolower(md5(uniqid(rand(), true)));
        $hyphen = chr(45);                  // "-"
        $lbrace = $trim ? "" : chr(123);    // "{"
        $rbrace = $trim ? "" : chr(125);    // "}"
        $guidv4 = $lbrace.
            substr($charid,  0,  8).$hyphen.
            substr($charid,  8,  4).$hyphen.
            substr($charid, 12,  4).$hyphen.
            substr($charid, 16,  4).$hyphen.
            substr($charid, 20, 12).
            $rbrace;
        return $guidv4;
    }


    public static function GetByID($broadcast_id){
        $rawObj = Db::instance()->rawQuery('select * from broadcasts where id = ? limit 1',[
            $broadcast_id
        ]);
        if ($rawObj){
            return new Broadcast($rawObj);
        }
        return NULL;

    }
}