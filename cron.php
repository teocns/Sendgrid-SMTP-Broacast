<?php


require_once __DIR__.'/db/db.php';
require_once __DIR__.'/classes/broadcast.php';
require_once __DIR__.'/constants.php';
require_once __DIR__.'/mailer.php';

// Fetches all broadcasts with is_planned_cron =1 and executes email sends one by one


$broadcast_id = Db::instance()->rawQueryValue('select id from broadcasts where is_planned_cron = 1 and is_completed = 0 limit 1');

// Get the actual broadcast

$broadcast = Broadcast::GetByID($broadcast_id);

// Get emails that need to be sent
$planned_emails = Db::instance()->rawQuery('select * from broadcast_planned_emails where broadcast_id = ? and is_executed = 0',[
    $broadcast_id
]);

if (!$planned_emails || !is_array($planned_emails)){
    // There are no more planned emails for this broadcast. Update the broadcast and set to is_completed = 1
    Db::instance()->rawQuery('update broadcasts set is_completed = 1 where id = ?',[
        $broadcast_id
    ]);
}


// Get user configuration

// Send out each email one by one, within the delay limits
foreach ($planned_emails as $email){
    sleep(CRON_DELIVERY_DELAY);

}

