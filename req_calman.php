<html>
  <head>
    <meta charset="utf-8">

    <title>Calendar Event Processor</title>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"> 
  
  </head>
  <body>

<script>
var req = new XMLHttpRequest();
req.open('POST', document.location, false);
req.send(null);
var headers = req.getAllResponseHeaders().toLowerCase();
console.log(headers);
</script>

<?php
  
   $postdata = file_get_contents("php://input");
   echo('<h1>postdata</h1><p>'.$postdata.'</p>');
   print_r($_SERVER);
   echo("First name: " . $_POST['eventname'] . "<br />\n");
   echo("Last name: " . $_POST['eventdesc'] . "<br />\n");
   echo("Event date: " . $_POST['eventdate'] . "<br />\n");
?>



  </body>
</html>