<?php





require_once __DIR__.'/sendgrid-php/sendgrid-php.php';




CONST SENDGRID_API_KEY = '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';



class Mailer{



    public static function SendMail($recipients,$subject,$body,$FROM_EMAIL,$FROM_NAME,$GUID){
        $email = new \SendGrid\Mail\Mail();
        try{
            $email->setFrom($FROM_EMAIL, $FROM_NAME);
        }
        catch(\SendGrid\Mail\TypeException $e){
            return false;
        }






        $email->setSubject($subject);





        foreach($recipients as $recipient){
            $email->addTo($recipient);
        }

        /*$email->addContent("text/plain", "and easy to do anywhere, even with PHP");*/
        $email->addContent(
            "text/html", $body
        );
        $email->addCustomArgs([
            "BROADCAST_GUID"=>$GUID
        ]);

        $sendgrid = new \SendGrid(SENDGRID_API_KEY);
        try {

            $response = $sendgrid->send($email);

            print_r($response->headers());




            if ($response->statusCode() === 202){
                return true;
            }

        } catch (Exception $e) {

            return false;
        }
        return false;
    }
}


