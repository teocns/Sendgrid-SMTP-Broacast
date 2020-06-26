<?php





require_once __DIR__.'/../libraries/sendgrid-php/sendgrid-php.php';
require_once __DIR__.'/../constants.php';



CONST SENDGRID_API_KEY = 'YOUR_API_KEY';

class Mailer{



    public static function SendMail($recipients,$subject,$body,$FROM_EMAIL,$FROM_NAME){
        $email = new \SendGrid\Mail\Mail();
        try{
            $email->setFrom($FROM_EMAIL, $FROM_NAME);
        }
        catch(\SendGrid\Mail\TypeException $e){
            return false;
        }






        $email->setSubject($subject);
        $personalization = new \SendGrid\Mail\Personalization();
        foreach($recipients as $recipient){
            $personalization->addTo($recipient);
        }

        $email->addPersonalization($personalization);
        /*$email->addContent("text/plain", "and easy to do anywhere, even with PHP");*/
        $email->addContent(
            "text/html", $body
        );


        $sendgrid = new \SendGrid(SENDGRID_API_KEY);
        try {

            $response = $sendgrid->send($email);

            if ($response->statusCode() === 202){
                return true;
            }

        } catch (Exception $e) {

            return false;
        }
        return false;
    }





}