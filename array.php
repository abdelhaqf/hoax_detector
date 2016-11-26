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

$json_string = curl_exec ($ch);

$array = json_decode($json_string,true);

	foreach($array['featured'] as $values)
	{
		foreach($values as $value)
		{
			echo $value['type']." ".
			 	 $value['name']." ".
			     $value['id']." ".
			 	 $value['image']['url']." ".
			 	 $value['image']['width']." ".
			 	 $value['image']['height']." ".
			 	 $value['image']['mime']."<br>" ;
			
		}
	}


?>