<?php

define('URL', 'https://developers.baselinker.com/recruitment/api');
define('KEY', 'EB76ykK1ws1fSE8nNTBt');

final class courier 
{
   private array $shippmentData;
   private string $url;
   private string $key;

   public function __construct(array $data, string $url, string $key)
   {
      $this->shippmentData = $data;
      $this->url = $url;
      $this->key = $key;

   }

   public  function createShippment()
   {
      $payload = [
         'Apikey' => KEY,
         'Command' => 'OrderShipment',
         'Shipment' => [
            'Service' => 'PPTT',
            'ShipperReference' => 'REF1234567890',
            'Weight' => $this->shippmentData['weight'],
            'Value' => $this->shippmentData['value'],
            'Currency' => 'USD',
            'ConsignorAddress' => [
               'FullName' => $this->shippmentData['sender_fullname'],
               'Company' => $this->shippmentData['sender_company'],
               'AddressLine1 ' => $this->shippmentData['sender_addressLine'],
               'City' => $this->shippmentData['sender_city'],
               'Zip ' => $this->shippmentData['sender_zip'],
               'Country' => $this->shippmentData['sender_country'],
               'Phone ' => $this->shippmentData['sender_phone'],
               'Email' => $this->shippmentData['sender_email'],
            ],
            'ConsigneeAddress' => [
               'Name' => $this->shippmentData['delivery_fullname'],
               'Company' => $this->shippmentData['delivery_company'],
               'AddressLine1' => $this->shippmentData['delivery_address'],
               'City' => $this->shippmentData['delivery_city'],
               'Zip' => $this->shippmentData['delivery_postalcode'],
               'Country' => $this->shippmentData['delivery_country'],
               'Phone' => $this->shippmentData['delivery_phone'],
               'Email' => $this->shippmentData['delivery_email'],
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
   }

   
}
