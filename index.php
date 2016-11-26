<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://hack.kurio.co.id/v1/explore");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$headers = [
    'Accept:application/json',
	'X-Kurio-Client-ID:99',
	'X-Kurio-Client-Secret:S3VyaW9IYWNrYXRvbjIw',
	'X-OS:windows',
	'X-App-Version:1.0',
	'Content-Type:application/json',
	'Authorization:Bearer M1G6qRcD372I8aMfKzi2TLaBqNex6onKTXi6jIfM'
];

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$server_output = curl_exec ($ch);

curl_close ($ch);

print  $server_output ;
?>