<?php

use App\Events\OrderPusherEvent;
use App\Models\Order;

function sendNewSMS($mobilenumbers, $message)
{
    $user = 'webcom';
    $password = 'e3cb9f645bXX';
    $senderid = 'WEBCOM';

    $url = 'http://t.instaclicksms.in/sendsms.jsp';
    $message = urlencode($message);

    $m = '91' . $mobilenumbers;
    $mobileno = $m;
    $ch = curl_init($url . "?user=$user&password=$password&mobiles=$m&sms=" . $message . "&senderid=".$senderid);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $ch = curl_exec($ch);

}

function getCount($model,$id){
    return $model::where('customer_id',$id)->count();
}

function getCountDashboardGraph($model,$year,$month){
    return $model::whereYear('created_at',$year)->whereMonth('created_at',$month)->count();
}

function getTotalUsers($model){
    return $model::where('status',1)->count();
}

function getTotal($model){
    return $model::count();
}
