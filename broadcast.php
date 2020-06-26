<?php

require_once __DIR__.'/classes/broadcast.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $broadcast_data = $_POST;

    $broadcast_data['creation_timestamp'] = time();

    // Get tags ids by names

    $db = Db::instance();
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

        echo "<pre>";
        print_r($data);
        die ("</pre>");
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
