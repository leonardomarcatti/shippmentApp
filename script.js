// const form = document.querySelector('#form')
const url = 'https://developers.baselinker.com/recruitment/api'
const key = 'EB76ykK1ws1fSE8nNTBt'

const sendData = async (data) => {
   const response = await fetch(url, {
      method: 'POST',
      headers: {
         "Apikey": "EB76ykK1ws1fSE8nNTBt",
         "Command": "GetServices"
      },
      body: {
         "Shipment": {
            "Service": "PPTT",
            "ShipperReference": "REF1234567890",
            "Weight": 1.0,
            "ConsignorAddress": {
               "FullName": "John Smith",
               "Company": "BaseLinker",
               "AddressLine1": "Kopernika 10",
               "City": "Gdansk",
               "Zip": "80208",
               "Country": "PL",
               "Phone": "666666666",
               "Email": "test@example.com"
            },
            "ConsigneeAddress": {
               "Name": "Maud Driant",
               "Company": "Spring GDS",
               "AddressLine1": "Strada Foisorului, Nr. 16",
               "City": "Bucuresti",
               "Zip": "031179",
               "Country": "RO",
               "Phone": "555555555",
               "Email": "test@example.com"
            },
            "Products": [
               {
                  "Description": "Shipment",
                  "Quantity": 1,
                  "Weight": 1.0,
                  "Value": 10.0,
                  "HsCode": "8471.30.00"
               }
            ],
            "LabelFormat": "PDF"
         }
      }
   })
   const json  = await response.json()
   console.log(json);
   
}

// form.addEventListener('submit', event => {
//    event.preventDefault()

//    const formData = new FormData(form)
//    const data = Object.fromEntries(formData)
//    sendData()
// })