<?php

final class Courier 
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

   public function getData()
   {
       return ($this->shippmentData['delivery_eori']);
   }

   private function createShippment()
   {
      $payload = [
         'Apikey' => $this->key,
         'Command' => 'OrderShipment',
         'Shipment' => [
            'Service' => 'PPTT',
            'ShipperReference' => 'REF1234567890',
            'Weight' => 2,
            'Value' => 32.44,
            'Currency' => 'USD',
            'EuEori' => $this->shippmentData['delivery_eori'],
            'ConsignorAddress' => [
               'FullName' => $this->shippmentData['sender_fullname'],
               'Company' => $this->shippmentData['sender_company'],
               'AddressLine1 ' => $this->shippmentData['sender_addressLine'],
               'City' => $this->shippmentData['sender_city'],
               'Zip ' => $this->shippmentData['sender_zip'],
               'Country' => $this->shippmentData['sender_country'],
               'Phone ' => $this->shippmentData['sender_phone'],
               'Email' => $this->shippmentData['sender_email'],
               'State' => $this->shippmentData['sender_state'],
               'EuEori' => $this->shippmentData['sender_eori'],
               'Vat' => $this->shippmentData['sender_vat'],
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
               'State' => $this->shippmentData['delivery_state'],
               'Vat' => $this->shippmentData['delivery_vat'],
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

      return $payload;
   }

   public function send(): array
   {
      $connection = curl_init($this->url);
      $payload = $this->createShippment();
      $json = json_encode($payload);

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

      return $response_data;
   }

}
