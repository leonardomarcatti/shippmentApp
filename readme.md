
<h1>Introduction</h1>
<p>This application represents a test for a mid PHP developer job at Base.com</p>
<p>It consists of a app that aims to create a shipment of goods by providing data to a courier broker and the use of a external API.</p>
<p>Here you will find both front end and back end parts and some files. Those files are: index.html, styles.css, script.js, api.php, courier.php. Those files are responsible for making the app run correctly. The index.html file is the entrance door for the aplication and responsable for displaying the app for the user. The styles.css file is for styling proporses and script.js file provides some functionalities.</p>
<p>On the back end courier.php and api.php files are responsable for retrieving data from the front end - the user - and the use of the API.</p>

<h2>The Front End</h2>
<p>On the front end script.js is responsible for getting data from the user through a form and send that data to back end as well as get back the response and transform it into a downloadable PDF by the usa of a third-party script.</p>
<p>The use of a front end script is relevant for providing  good usability for the user. In this case modals are used here.</p>

<h2>The Back end</h2>
<p>On the back end there are 2 files: api.php and courier.php </p>
<p>The courier.php file is responsible for a class the builds the packge that will be sent as well as the use of the API. Here you will find the createPayload method that is reponsible for creating the payload that will be used by the API and newPackage method that get this payload and delivery it tho the API.</p>