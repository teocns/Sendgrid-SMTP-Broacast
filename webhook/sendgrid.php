<?php


CONST SECRET_SIGNATURE = 'MFkwEwYHKoZIzj0CAQYIKoZIzj0DAQcDQgAEiIH6/O76bz/4rOixZJ2occWwQmL0hbjUp2KUhxI+qUN+TPOxjYcxAhVqO+83t4eav6a7gCDOVNscXY4vGxFwxw==';


file_put_contents('post.txt', file_get_contents('php://input'));
// Verify Signature

/*function verifySignature($raw_input)
{
    function getRequestHeaders()
    {
        $headers = array();
        foreach ($_SERVER as $key => $value) {
            if (substr($key, 0, 5) <> 'HTTP_') {
                continue;
            }
            $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
            $headers[$header] = $value;
        }
        return $headers;
    }


    $headers = getRequestHeaders();

    $requestSignature = @$headers['X-Twilio-Email-Event-Webhook-Signature'] or die;

    $computedSignature = hash_hmac('sha256', $raw_input, SECRET_SIGNATURE);

    if ($computedSignature !== $requestSignature)
        die('Unauthorized');
}*/


//verifySignature(trim(file_get_contents('php://input'))); TODO - Signature validation


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'),true);


    require_once __DIR__ . '/../db/db.php';
    // Get last broadcast generated within past 30 seconds - this delay should not be longer


    // Start uploading events

    if (is_array($data)) {

        foreach ($data as $event_item) {
            $data = [
                "BROADCAST_GUID" => $event_item['BROADCAST_GUID'],
                "email" => $event_item['email'],
                "event_type" => $event_item['event'],
                "sg_event_id" => $event_item['sg_event_id'],
                "sg_message_id" => $event_item['sg_message_id'],
                "event_timestamp" => $event_item['timestamp']
            ];
            Db::instance()->insert('broadcast_events', $data);
        }

    }

}
