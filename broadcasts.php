<?php


require_once __DIR__ . '/db/db.php';


// hard-code
$user_id = 1;

$all_broadcasts = Db::instance()->rawQuery(
    'select b.* from broadcasts b where b.user_id = ?',
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
            <?php foreach ($all_broadcasts as $broadcast): if (!$broadcast || !$broadcast['id']) continue;

                $statuses = Db::instance()->rawQuery('select event_type, count(*) total from broadcast_events where BROADCAST_GUID = ? group by event_type',[
                        $broadcast['GUID']
                ]);
                $other_data = Db::instance()->rawQueryOne('select group_concat(distinct email_tags.tag SEPARATOR \',\') as tag, group_concat(distinct email_tags.email SEPARATOR \'<br>\') as emails from broadcasts_email_tags
                    left join email_tags on broadcasts_email_tags.email_tags_id = email_tags.id 
                    where broadcasts_email_tags.broadcast_id = ? limit 1',[$broadcast['id']]);
            ?>
                <tr>
                    <td><?=$broadcast['id']?></td>
                    <td><?php
                        $dt = new DateTime();
                        $dt->setTimestamp($broadcast['creation_timestamp']);
                        echo $dt->format('d-m-y H:i');
                        ?></td>
                    <td><?=$other_data['tag']?></td>
                    <td><?=$other_data['emails']?></td>
                    <td class="text-nowrap">
                        <?php foreach($statuses as $status): ?>
                            <?=$status['event_type']?>: <?=$status['total']?><br>
                        <?php endforeach;?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
