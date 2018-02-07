<?php

/*
  $title - title of the message
  $message - the actual message
  $token - web or mobile registration token
  $firebase_server_key - your firebase server key, you can find it in your firebase console
 */

function send_notification($title, $message, $token)
{
    $data = [
        "notification" => [
             "title"    => $title,
             "sound"    => "default",
             "body"     => $message,
             "icon"     => "http://blewe.com/assets/images/Blewe-Avatar01.jpg",
        ],
        "to" => $token,
    ];

    $data_string = json_encode($data);

    $headers = [
       'Content-Type: application/json',
       'Authorization: key='.$firebase_server_key
    ];

    $ch = curl_init();

    curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
    curl_setopt( $ch,CURLOPT_POST, true );
    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch,CURLOPT_POSTFIELDS, $data_string);

    $result = curl_exec($ch);

    curl_close ($ch);

    die(print_r($result));
}
