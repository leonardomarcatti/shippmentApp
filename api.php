<?php

require_once 'courier.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('URL', 'https://developers.baselinker.com/recruitment/api'); 
define('KEY', 'EB76ykK1ws1fSE8nNTBt');

$sender_company = filter_input(INPUT_POST, 'sender_company', FILTER_UNSAFE_RAW);
$sender_fullname = filter_input(INPUT_POST, 'sender_fullname', FILTER_UNSAFE_RAW);
$sender_email = filter_input(INPUT_POST, 'sender_email', FILTER_SANITIZE_EMAIL);
$sender_phone = filter_input(INPUT_POST, 'sender_phone', FILTER_UNSAFE_RAW);
$sender_addressLine = filter_input(INPUT_POST, 'sender_address', FILTER_UNSAFE_RAW);
$sender_city = filter_input(INPUT_POST, 'sender_city', FILTER_UNSAFE_RAW);
$sender_zip = filter_input(INPUT_POST, 'sender_postalcode', FILTER_UNSAFE_RAW);
$sender_country = filter_input(INPUT_POST, 'sender_country', FILTER_UNSAFE_RAW);
$sender_state = filter_input(INPUT_POST, 'sender_state', FILTER_UNSAFE_RAW);
$sender_vat = filter_input(INPUT_POST, 'sender_vat', FILTER_UNSAFE_RAW);
$sender_eori = filter_input(INPUT_POST, 'sender_eori', FILTER_UNSAFE_RAW);

$delivery_company = filter_input(INPUT_POST, 'delivery_company', FILTER_UNSAFE_RAW);
$delivery_fullname = filter_input(INPUT_POST, 'delivery_fullname', FILTER_UNSAFE_RAW);
$delivery_email = filter_input(INPUT_POST, 'delivery_email', FILTER_UNSAFE_RAW);
$delivery_phone = filter_input(INPUT_POST, 'delivery_phone', FILTER_UNSAFE_RAW);
$delivery_address = filter_input(INPUT_POST, 'delivery_address', FILTER_UNSAFE_RAW);
$delivery_city = filter_input(INPUT_POST, 'delivery_city', FILTER_UNSAFE_RAW);
$delivery_country = filter_input(INPUT_POST, 'delivery_country', FILTER_UNSAFE_RAW);
$delivery_postalcode = filter_input(INPUT_POST, 'delivery_postalcode', FILTER_UNSAFE_RAW);
$delivery_state = filter_input(INPUT_POST, 'delivery_state', FILTER_UNSAFE_RAW);
$delivery_vat = filter_input(INPUT_POST, 'delivery_vat', FILTER_UNSAFE_RAW);
$delivery_eori = filter_input(INPUT_POST, 'delivery_eori', FILTER_UNSAFE_RAW);

$shippmentData = [
   'sender_company' => $sender_company,
   'sender_fullname' => $sender_fullname,
   'sender_email' => $sender_email,
   'sender_phone' => $sender_phone,
   'sender_addressLine' => $sender_addressLine,
   'sender_city' => $sender_city,
   'sender_zip' => $sender_zip,
   'sender_country' => $sender_country,
   'sender_state' => $sender_state,
   'sender_eori' => $sender_eori,
   'sender_vat' => $sender_vat,

   'delivery_company' => $delivery_company,
   'delivery_fullname' => $delivery_fullname,
   'delivery_email' => $delivery_email,
   'delivery_phone' => $delivery_phone,
   'delivery_address' => $delivery_address,
   'delivery_city' => $delivery_city,
   'delivery_country' => $delivery_country,
   'delivery_state' => $delivery_state,
   'delivery_eori' => $delivery_eori,
   'delivery_vat' => $delivery_vat,
   'delivery_postalcode' => $delivery_postalcode
   ];

$shipment = new Courier($shippmentData, URL, KEY);
$response_data = $shipment->send();

var_dump($response_data);