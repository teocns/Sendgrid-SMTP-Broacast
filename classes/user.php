<?php



require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/base-class.php';


class User extends baseClass {
    public $id;
    public $SENDGRID_API_KEY;

    public $SMTP_WEBHOOK_URL;



    public function GetByID($user_id){
        $rawObj =  Db::instance()->rawQuery('select * from users where id = ?',[
            $user_id
        ]);

        if ($rawObj){
            return new User($rawObj);
        }
        return NULL;

    }



    public function SaveMailerConfiguration(){
        Db::instance()->update('users',[
             'SENDGRID_API_KEY'=>$this->SENDGRID_API_KEY,
             'SMTP_WEBHOOK_URL'=>$this->SMTP_WEBHOOK_URL
        ]);
    }


}