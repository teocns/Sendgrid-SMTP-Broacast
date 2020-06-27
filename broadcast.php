<?php

require_once __DIR__.'/classes/broadcast.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){





    $broadcast_data = $_POST;

    // Update Template's HTML by ID
    $db = Db::instance();
    $db->where('id',$broadcast_data['email_template_id']);
    $db->update('email_templates',[
        'html'=>$broadcast_data['email-template-html']
    ]);

    // Update User CONFIGURATION - Notice there is no validation on user authentication and this should be implemented
    $db->where('user_id',$broadcast_data['user_id']);
    $db->update('user',[
       "SENDGRID_API_KEY"=>$broadcast_data['SENDGRID_API_KEY'],
       "SMTP_WEBHOOK_URL"=>$broadcast_data['SMTP_WEBHOOK_URL'],
    ]);








    unset($broadcast_data['email-template-html']);
    $broadcast_data['creation_timestamp'] = time();

    // Get tags ids by names


    if (count($broadcast_data['tags']) < 1){
        die('You need to select at least one tag');
    }
    $db->where('tag',$broadcast_data['tags'][0]);
    if (count($broadcast_data['tags']) > 1){
        for($i=1;$i<count($broadcast_data['tags']);$i++){
            $db->orWhere('tag',$broadcast_data['tags'][$i]);
        }
    }
    $broadcast_data['tags_ids'] = $db->getValue('email_tags','id',null);

    // Data validation goes here (tags and email_template must match with the user_id and so on
    $broadcast = new Broadcast($broadcast_data);
    // Save broadcast to database
    if ($broadcast->Insert()){
        $data = $broadcast->Start();
        header('location: broadcasts');
    }
}
else{
    header('Location: index.php');

    die;
}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

</body>
</html>
