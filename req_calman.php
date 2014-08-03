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
  
  
   echo('<h1>postdata</h1><p>');
   //print_r($_SERVER);
    if (isset($_POST['eventname']))   
      echo("event name: " . $_POST['eventname'] . "<br />\n");
    if (isset($_POST['eventdesc']))   
      echo("event date: " . $_POST['eventdesc'] . "<br />\n");
    if (isset($_POST['eventdate']))   
      echo("Event date: " . $_POST['eventdate'] . "<br />\n");
    if (isset($_POST['firstname']))   
      echo("last name: " . $_POST['lastname'] . "<br />\n");
   


    try {
        $dbh = new PDO('mysql:host=localhost;port=3306;dbname=inventory', 'root', '', array( PDO::ATTR_PERSISTENT => false));

        $stmt = $dbh->prepare("CALL getname()");

        // call the stored procedure
        $stmt->execute();

        echo "<B>outputting...</B><BR>";
        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
            echo "output: ".$rs->name."<BR>";
        }
        echo "<BR><B>".date("r")."</B>";
    
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }



?>



  </body>
</html>