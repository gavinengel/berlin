<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
?>
<html>
  <head>
    <meta charset="utf-8">

    <title>Item Processor</title>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"> 
  
  </head>
  <body>

    <h1>Item Processor</h1>

      <?php
       
       //get request method
      $method = $_SERVER['REQUEST_METHOD'];
      echo ('<p>method: '. $method.'</p>');

      // IF METHOD IS GET SHOW ALL ITEMS
      if ($method=="GET"){
        echo("get all items");


        //connect to items db
         try {
              $dbh = new PDO('mysql:host=localhost;port=3306;dbname=inventory', 'root', '', array( PDO::ATTR_PERSISTENT => false));
          } catch (PDOException $e) {
              print "Error!: " . $e->getMessage() . "<br/>";
              die();
          }    
        
          $sql = "select i.item_name, i.item_desc from items i, item_properties ip where i.item_id = ip.fk_item_id";
          foreach ($dbh->query($sql) as $results){
                     echo $results["item_name"];
            }

        }//end GET
/*
          // prepare and insert item
          $sqlget = "select i.item_name, i.item_desc from items i, item_properties ip where i.item_id = ip.fk_item_id";
          echo $sqlget;
          $stmt = $dbh->prepare($sqlget);
          $stmt->execute();
            echo "<B>retrieving...</B><BR>";
             while ($rs = $stmt->fetch($sqlget)) {
                  echo "output: ".$rs->i.item_name."<BR>";
              }
              echo "<BR><B>".date("r")."</B>";


          while ($rs = mysql_fetch_array($result, MYSQL_NUM)) {
          printf("ID: %s  Name: %s", $row[0], $row[1]);  
          }
      }

  */   

        


       // IF METHOD IS POST ADD ITEM TO DB
       if ($method == "POST") {
        echo('seup the insert');


        //get values
        if (isset($_POST['name'])) {  
         $name=$_POST['name'];
          echo("name: " . $name . "<br />\n");
        }

        if (isset($_POST['description']))  { 
          $description =  $_POST['description'];      
          echo("description: " . $description . "<br />\n");
        }

        if (isset($_POST['quantity'])) {
          $quantity =  $_POST['quantity'];  
          echo("quantity: " . $quantity . "<br />\n");  
        }

        if (isset($_POST['price'])){
          $price =  $_POST['price'];  
          echo("price: " . $price . "<br />\n");  
        }
     
        //create db connection to localhost/items

          try {
              $dbh = new PDO('mysql:host=localhost;port=3306;dbname=inventory', 'root', '', array( PDO::ATTR_PERSISTENT => false));

              
              // prepare and insert item
              $sqlinserti = "INSERT into items (item_name, item_desc) values('".$name."','".$description."')";
              echo $sqlinserti;
              $stmt = $dbh->prepare($sqlinserti);
              $stmt->execute();


              // prepare and insert item properties
              $sqlinsertip ="INSERT into item_properties (fk_item_id, quantity, price) values ((select max(item_id) from items), '".$quantity."',".$price.")";
              echo $sqlinsertip;
              $stmt = $dbh->prepare($sqlinsertip);
              $stmt->execute();

              
              
              //insert into items (item_name, item_desc) values ('novel', 'the sun also rises');

              echo "<B>inserting...</B><BR>";
            /* while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                  echo "output: ".$rs->name."<BR>";
              }
              echo "<BR><B>".date("r")."</B>";
          */
          } catch (PDOException $e) {
              print "Error!: " . $e->getMessage() . "<br/>";
              die();
          }

        } // end POST

    ?>


 <script>
var req = new XMLHttpRequest();
req.open('POST', document.location, false);
req.send(null);
var headers = req.getAllResponseHeaders().toLowerCase();
console.log(headers);
</script> 

</body>

</html>