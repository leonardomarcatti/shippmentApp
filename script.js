const sender_vat = document.querySelector('#sender_vat')
const sender_state = document.querySelector('#sender_state')
const sender_country = document.querySelector('#sender_country')
const sender_eori = document.querySelector('#sender_eori')

const delivery_vat = document.querySelector('#delivery_vat')
const delivery_state = document.querySelector('#delivery_state')
const delivery_country = document.querySelector('#delivery_country')
const delivery_eori = document.querySelector('#delivery_eori')

sender_country.addEventListener('change', event => {
   const country = event.target.value   
   const senderFieldset = document.getElementById('sender_field');
   const visibleElement = senderFieldset.querySelector('.show')
   senderFieldset.querySelectorAll('.hidden').forEach(el => el.children[1].removeAttribute('required'))

   visibleElement?.classList.add('hidden')
   visibleElement?.classList.remove('show')

   if (country == 'BR') {
      sender_vat.classList.add('show')
      sender_vat.classList.remove('hidden')
      sender_vat.setAttribute('required', '')
   }

   if (country == 'AU' || country == 'CA' || country == 'US') {
      sender_state.classList.add('show')
      sender_state.classList.remove('hidden')
      sender_state.setAttribute('required', '')
   }
   
   if (country == 'GB') {
      sender_eori.classList.add('show')
      sender_eori.classList.remove('hidden')
      sender_eori.setAttribute('required', '')
   }
})

delivery_country.addEventListener('change', event => {
   const country = event.target.value
   const deliveryFieldset = document.getElementById('delivery_field');
   const visibleElement = deliveryFieldset.querySelector('.show')
   deliveryFieldset.querySelectorAll('.hidden').forEach(el => el.children[1].removeAttribute('required'))

   visibleElement?.classList.add('hidden')
   visibleElement?.classList.remove('show')

   if (country == 'BR') {
      delivery_vat.classList.add('show')
      delivery_vat.classList.remove('hidden')
      delivery_vat.setAttribute('required', '')
   }

   if (country == 'AU' || country == 'CA' || country == 'US') {
      delivery_state.classList.add('show')
      delivery_state.classList.remove('hidden')
      delivery_state.setAttribute('required', '')
   }

   if (country == 'GB') {
      delivery_eori.classList.add('show')
      delivery_eori.classList.remove('hidden')
      delivery_eori.setAttribute('required', '')
   }
})

document.querySelector('#form').addEventListener('submit', event => {
   event.preventDefault()
   const data = new FormData(event.target)
   const shippmentData = Object.fromEntries(data.entries())
   newPackage(shippmentData)
})

const generatePDF = (data) => {

   if (data?.ErrorLevel !== 0) {
      document.querySelector('#errorText').innerHTML = data.Error
      document.querySelector('#data_sent_error_btn').click()
      return
   }

   const jsonData = [
      { TrackingNumber: data.Shipment.TrackingNumber, ShipperReference: data.Shipment.ShipperReference, Service: data.Shipment.Service, Carrier: data.Shipment.Carrier }
   ]

   // jsPDF vem do UMD
   const { jsPDF } = window.jspdf
   const doc = new jsPDF()

   const columns = Object.keys(jsonData[0])
   const rows = jsonData.map(item => Object.values(item))

   doc.text("User Data Report", 10, 10)

   doc.autoTable({
      head: [columns],
      body: rows,
      startY: 20
   })

   doc.save("jsonData.pdf")
}


const newPackage = async (shipmentData) => {   
   const response = await fetch('api.php', {
      method: 'POST',
      headers: {
         "Content-Type": "application/json",
      },
      body: JSON.stringify(shipmentData)
   });

   const json = await response.json()   
   document.querySelector('#data_sent_btn').click()

   generatePDF(json)
   
}
