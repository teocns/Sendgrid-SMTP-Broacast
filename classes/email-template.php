<?php





require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/base-class.php';



class EmailTemplate extends baseClass{
    public $id;
    public $html;
    public $name;
    public $user_id;
    public static function GetByID($id){
        $rawObj = Db::instance()->rawQuery('select * from email_templates where id = ? limit 1',[
            $id
        ]);

        return $rawObj ? new EmailTemplate($rawObj) : null;
    }

    public static function GetAllForUserID($user_id){
        return Db::instance()->rawQuery('select * from email_templates where user_id = ?',[
            $user_id
        ]);
    }


    public function Update(){
        $db = Db::instance();

        $db->where('id',$this->id);
        return $db->update('email_templates',[
           "name"=>$this->name,
           "html"=>$this->html
        ]);
    }
    // TODO: FINISH all CRUD functions
}