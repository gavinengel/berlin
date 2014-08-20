inventory-api
=============

api blue
A groundwork one page REST app, using raw javascript/json/ajax exchanges with a thin LAMP stack on OpenShift.

#Summary

Inventory is intended  as a groundwork for a simple, one page REST application.  It relies primarily on client side JavaScript to send HTTP GET, POST, PUT, DELETE requests to a PHP/MySQL backend.  

Client to server communications are sent through AJAX via x-www-form-urlencoded requests which are returned with PHP-generated JSON representing items in the database.  JSON.parse handles the responses.

On the server side, PHP reads the request parameters and performs the requested operation on MySQL using prepared PDO statments and uses json_encode to format the response data.

##Design Considerations

 - The code is intentially raw. No librarys such as jQuery are employed.  A one page version with all JS and CSS is included as inventory.html and can be used as a stand-alone "inventory manager" with header pre-flights. 
 
 - Decision was made to use PUT and DELETE methods as references for future implementations.
 
 - The cards interface was used in the style of Google Keep -- the boxes are designed to easily include thumbnail images or other properties for whatever kinds of objects might be stored.
 
 #Examples
 
 ## AJAX Request
 
 
 
