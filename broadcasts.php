<?php


require_once __DIR__ . '/db/db.php';


// hard-code
$user_id = 1;

$all_broadcasts = Db::instance()->rawQuery(
    'select b.*, group_concat(distinct et.tag SEPARATOR \', \') as tags, group_concat(distinct et.email SEPARATOR \'<br>\') as emails from broadcasts b left join broadcasts_email_tags bet on b.id = bet.broadcast_id left join email_tags et on bet.email_tags_id = et.id
     where b.user_id = ?',
    [
        $user_id
    ]
);




?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
    <table class="table">
        <thead>
            <tr>
                <td>Broadcast ID</td>
                <td>Creation Time</td>
                <td>Tags</td>
                <td>Emails</td>
                <td>Status</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($all_broadcasts as $broadcast): ?>
                <tr>
                    <td><?=$broadcast['id']?></td>
                    <td><?php
                        $dt = new DateTime();
                        $dt->setTimestamp($broadcast['creation_timestamp']);
                        echo $dt->format('d-m-y H:i');
                        ?></td>
                    <td><?=$broadcast['tags']?></td>
                    <td><?=$broadcast['emails']?></td>
                    <td>
                        Deliveries:<br>
                        Unsent: <br>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
