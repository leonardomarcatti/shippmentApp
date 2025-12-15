<?php

final class Courier 
{
   private function createPayload(array $order, string $key)
   {
      $payload = [
         'Apikey' => $key,
         'Command' => 'OrderShipment',
         'Shipment' => [
            'Service' => 'PPTT',
            'ShipperReference' => 'REF1234567890',
            'Weight' => 2,
            'Value' => 32.44,
            'Currency' => 'USD',
            'EuEori' => $order['delivery_eori'],
            'ConsignorAddress' => [
               'FullName' => $order['sender_fullname'],
               'Company' => $order['sender_company'],
               'AddressLine1 ' => $order['sender_addressLine'],
               'City' => $order['sender_city'],
               'Zip ' => $order['sender_zip'],
               'Country' => $order['sender_country'],
               'Phone ' => $order['sender_phone'],
               'Email' => $order['sender_email'],
               'State' => $order['sender_state'],
               'EuEori' => $order['sender_eori'],
               'Vat' => $order['sender_vat'],
            ],
            'ConsigneeAddress' => [
               'Name' => $order['delivery_fullname'],
               'Company' => $order['delivery_company'],
               'AddressLine1' => $order['delivery_address'],
               'City' => $order['delivery_city'],
               'Zip' => $order['delivery_postalcode'],
               'Country' => $order['delivery_country'],
               'Phone' => $order['delivery_phone'],
               'Email' => $order['delivery_email'],
               'State' => $order['delivery_state'],
               'Vat' => $order['delivery_vat'],
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

   public function newPackage(array $order, array $params)
   {
      $connection = curl_init($params['url']);
      $payload = $this->createPayload($order, $params['key']);
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

      return json_decode($response);
      
   }

}
