<?php


require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/base-class.php';

class Broadcast extends baseClass {
    public $id;
    public $user_id;
    public $tags_ids; // an array containing just the tags ids to the email sent
    public $creation_timestamp;
    public $email_template_id;


    public function Insert(){
        $db = Db::instance();
        // Start transaction because we're doing two queries
        $db->startTransaction();
        $insertArray = get_object_vars($this);
        unset($insertArray['id']);
        unset($insertArray['tags_ids']);
        $this->id = $db->insert('broadcasts',
            $insertArray
        );
        echo"Inserted ID: $this->id";
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
        return $db->getValue('email_tags','distinct email',null);




    }
}