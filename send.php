<?php 

$imageurl = readline("Enter the image url: ");
$message = readline("Enter the message: ");
$list = readline("Enter phone number lists file: (ex: phone.txt) ");
$listx = explode("\n", file_get_contents($list));
foreach ($listx as $value) {

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://localhost:8000/send-media',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => array('number' => $value,'caption' => $message,'file' => $imageurl),
    ));

    $response = json_decode(curl_exec($curl), true);

    curl_close($curl);
    if($response['status']){
        echo "Message sent to ".$value."\n";
    }

    sleep(10);
}



?>