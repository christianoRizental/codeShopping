<?php
//header - payload - signature

//header
$header = [
    'alg' => 'HS256', //HMAC com SHA 256
    'typ' => 'JWT'
];

$header_json = json_encode($header);
$header_base64 = base64_encode($header_json);

echo "Cabeçalho JSON: $header_json";
echo "\n";
echo "Cabeçalho JWT: $header_base64";

//Payload - carga de dados
$payload = [
    'first_name' => 'Christiano',
    'last_name' => 'Rizental',
    'email' => 'rizental@gmail.com'
];

$payload_json = json_encode($payload);
$payload_base64 = base64_encode($payload_json);
echo "\n\n";
echo "Payload JSON: $payload_json";
echo "\n";
echo "Payload JWT: $payload_base64";

$key = '8347923749283ksdjflksdjfadlkjf';

$signature = hash_hmac('sha256',"$header_base64.$payload_base64", $key, true);
$signature_base64 = base64_encode($signature);
echo "\n\n";
echo "Signature: $signature";
echo "\n";
echo "Signature JWT: $signature_base64";

$token = "$header_base64.$payload_base64.$signature_base64";
echo "\n\n";
echo "TOKEN: $token";
