<?php

require_once __DIR__ . '/classes/email-template.php';
require_once __DIR__ . '/classes/user.php';

$db = Db::instance();

// Hard-code current user
$user_id = 1;
$user = User::GetByID($user_id);


// Hard-code email template
$email_template = EmailTemplate::GetAllForUserID($user_id)[0];


$email_tags = Db::instance()->rawQuery("select tag, group_concat(email SEPARATOR ', ') as emails from email_tags where user_id = ? group by tag",[
    $user_id
]);





?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Broadcaster</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body class="p-3">
    <form action="broadcast.php" class="d-flex flex-column" method="post">

        <!--<div class="bordered">


            <h6>User configuration</h6>

            <label for="MAILER_METHOD_SENDGRID">Sendgrid</label>
            <input type="radio" id="MAILER_METHOD_SENDGRID" name="MAILER_METHOD_SENDGRID" value="sendgrid"/>

            <label for="SENDGRID_API_KEY">Sendgrid API Key</label>
            <input type="text" id="SENDGRID_API_KEY" name="SENDGRID_API_KEY" value="<?/*=$user['SENDGRID_API_KEY']*/?>"/>

            <label for="SMTP_WEBHOOK_URL">Webhook for SMTP</label>
            <input type="text" id="SMTP_WEBHOOK_URL" name="SMTP_WEBHOOK_URL" value="<?/*=$user['SMTP_WEBHOOK_URL']*/?>"/>




            <label for="MAILER_METHOD_SMTP">SMTP</label>
            <input type="radio" id="MAILER_METHOD_SMTP" name="MAILER_METHOD_SMTP" value="smtp"/>
        </div>-->

        <input type="hidden" name="email_template_id" value="<?=$email_template['id']?>">
        <label for="email-template-html">Selected email template: <?=$email_template['name']?></label>
        <textarea id="email-template-html" name="email-template-html" placeholder="Put your html email here"><?=$email_template['html']?></textarea>
        <input type="hidden" name="user_id" value="<?=$user_id?>">
        <label for="email-tags-container">Email tags</label>
        <div id="email-tags-container" class="d-flex flex-column">
            <?php foreach($email_tags as $item):
                $email_tag = $item['tag'];
                $emails = $item['emails'];

                ?>
                <div class="d-inline">
                    <input id="email-tag-<?=$email_tag?>" type="checkbox" name="tags[]" value="<?=$email_tag?>"/>
                    <label for="email-tag-<?=$email_tag?>"><?=$email_tag.' ('.$emails.')'?></label>
                </div>
            <?php endforeach;?>
        </div>
        <button type="submit" class="btn btn-primary">Send</button>

    </form>
</body>
</html>
