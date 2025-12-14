<?php


require_once 'courier.php';

$params = ['url' => 'https://developers.baselinker.com/recruitment/api', 'key' => 'EB76ykK1ws1fSE8nNTBt'];

$inputs = json_decode(file_get_contents('php://input'), true);

$sender_company   = trim($inputs['sender_company'] ?? '');
$sender_fullname = trim($inputs['sender_fullname'] ?? '');
$sender_email    = filter_var($inputs['sender_email'] ?? '', FILTER_VALIDATE_EMAIL);
$sender_phone    = trim($inputs['sender_phone'] ?? '');
$sender_addressLine = trim($inputs['sender_address'] ?? '');
$sender_city     = trim($inputs['sender_city'] ?? '');
$sender_zip      = trim($inputs['sender_postalcode'] ?? '');
$sender_country  = trim($inputs['sender_country'] ?? '');
$sender_state    = trim($inputs['sender_state'] ?? '');
$sender_vat      = trim($inputs['sender_vat'] ?? '');
$sender_eori     = trim($inputs['sender_eori'] ?? '');

$delivery_company   = trim($inputs['delivery_company'] ?? '');
$delivery_fullname = trim($inputs['delivery_fullname'] ?? '');
$delivery_email    = filter_var($inputs['delivery_email'] ?? '', FILTER_VALIDATE_EMAIL);
$delivery_phone    = trim($inputs['delivery_phone'] ?? '');
$delivery_address  = trim($inputs['delivery_address'] ?? '');
$delivery_city     = trim($inputs['delivery_city'] ?? '');
$delivery_country  = trim($inputs['delivery_country'] ?? '');
$delivery_postalcode = trim($inputs['delivery_postalcode'] ?? '');
$delivery_state    = trim($inputs['delivery_state'] ?? '');
$delivery_vat      = trim($inputs['delivery_vat'] ?? '');
$delivery_eori     = trim($inputs['delivery_eori'] ?? '');

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

$shipment = new Courier();
$response_data = $shipment->newPackage($shippmentData, $params);

header('Content-Type: application/json');
echo json_encode($response_data);