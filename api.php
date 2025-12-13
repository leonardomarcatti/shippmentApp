<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('URL', 'https://developers.baselinker.com/recruitment/api'); 
define('KEY', 'EB76ykK1ws1fSE8nNTBt');

$sender_company = filter_input(INPUT_POST, 'sender_company', FILTER_SANITIZE_ENCODED);
$sender_fullname = filter_input(INPUT_POST, 'sender_fullname', FILTER_SANITIZE_ENCODED);
$sender_email = filter_input(INPUT_POST, 'sender_email', FILTER_SANITIZE_EMAIL);
$sender_phone = filter_input(INPUT_POST, 'sender_phone', FILTER_SANITIZE_ENCODED);
$sender_addressLine = filter_input(INPUT_POST, 'sender_address', FILTER_SANITIZE_ENCODED);
$sender_city = filter_input(INPUT_POST, 'sender_city', FILTER_SANITIZE_ENCODED);
$sender_zip = filter_input(INPUT_POST, 'sender_postalcode', FILTER_SANITIZE_ENCODED);
$sender_country = filter_input(INPUT_POST, 'sender_country', FILTER_SANITIZE_ENCODED);

$delivery_company = filter_input(INPUT_POST, 'delivery_company', FILTER_SANITIZE_ENCODED);
$delivery_fullname = filter_input(INPUT_POST, 'delivery_fullname', FILTER_SANITIZE_ENCODED);
$delivery_email = filter_input(INPUT_POST, 'delivery_email', FILTER_SANITIZE_ENCODED);
$delivery_phone = filter_input(INPUT_POST, 'delivery_phone', FILTER_SANITIZE_ENCODED);
$delivery_address = filter_input(INPUT_POST, 'delivery_address', FILTER_SANITIZE_ENCODED);
$delivery_city = filter_input(INPUT_POST, 'delivery_city', FILTER_SANITIZE_ENCODED);
$delivery_country = filter_input(INPUT_POST, 'delivery_country', FILTER_SANITIZE_ENCODED);
$delivery_postalcode = filter_input(INPUT_POST, 'delivery_postalcode', FILTER_SANITIZE_ENCODED);

$data = [
   'Apikey' => KEY,
   'Command' => 'OrderShipment',
   'Shipment' => [
      'Service' => 'PPTT',
      'ShipperReference' => 'REF1234567890',
      'Weight' => 1.0,
      'Value' => 1,
      'Currency' => 'USD',
      'ConsignorAddress' => [
         'FullName' => $fullname,
         'Company' => $company,
         'AddressLine1' => $addressLine,
         'City' => $city,
         'Zip' => $zip,
         'Country' => $country,
         'Phone' => $phone,
         'Email' => $email,
      ],
      'ConsigneeAddress' => [
         'Name' => $delivery_fullname,
         'Company' => $delivery_company,
         'AddressLine1' => $delivery_address,
         'City' => $delivery_city,
         'Zip' => $delivery_postalcode,
         'Country' => $delivery_country,
         'Phone' => $delivery_phone,
         'Email' => $delivery_email,
      ],
      'Products' => [
         [
            'Description' => 'Shipment',
            'Quantity' => 1,
            'Weight' => 1.0,
            'Value' => 10.0,            
            'HsCode' => '8471.30.00',
         ]
         
      ],
      'LabelFormat' => 'PDF',
   ]
];


$json = json_encode($data);

$connection = curl_init(URL);

curl_setopt_array($connection, [
   CURLOPT_POST => true,
   CURLOPT_POSTFIELDS => $json,
   CURLOPT_RETURNTRANSFER => true,
   CURLOPT_HTTPHEADER => [
      'Content-Type: application/json',
      'Accept: application/json',
   ],
]);

$response = curl_exec($connection);

if ($response === false) {
   die('Erro cURL: ' . curl_error($connection));
}

curl_close($connection);

$response_data = json_decode($response, true);

var_dump($response_data);