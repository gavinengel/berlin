<?php


function connectDB(){

  try {
    $dbh = new PDO('mysql:host=localhost;port=3306;dbname=inventory', 'root', '', array( PDO::ATTR_PERSISTENT => true));
  } catch (PDOException $e) {
    echo "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
  return($dbh);
} 





// ************************************** GET ALL *******************************
$method = $_SERVER['REQUEST_METHOD'];

if ($method=="GET"){
  connectDB();

    $json = [];

    $sql = "select item_id from items order by item_id";
    foreach ($dbh->query($sql) as $results){
               $json[$results["item_id"]] = 'http://localhost/items/'.$results["item_id"];
              
      }
      echo (json_encode($json));
      //html_entity_decode

  }


  //end GET ALL ***************************************

      
        
// ********************CREATE NEw (POST)  ******************** 


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
              $dbh = connectDB();
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
  }     // ************END CREATE (POST)  

// UPDATE (PUT) ****************************************************************
if ($method = "PUT"){
  parse_str(file_get_contents("php://input"), $put_vars);
  //echo("data:". $put_vars["itemid"]);

  $dbh = connectDB();

  $sql = "UPDATE items set item_name='".$put_vars["name"]."', item_desc='".$put_vars["description"]."' where item_id=".$put_vars["itemid"];
  $stmt = $dbh->prepare($sql);
  $stmt -> execute();

  $sql = "UPDATE item_properties set quantity=".$put_vars["quantity"].", price=".$put_vars["price"]." where fk_item_id = ".$put_vars["itemid"];
  //echo($sql);
  $stmt = $dbh->prepare($sql);
  $stmt -> execute();


/*

//read values
  
  if (isset($put_vars['itemid'])) {  
    $item_id=$put_vars['itemid'];
    
    }


  if (isset($put_vars['name'])) {  
    $name=$put_vars['name'];
    }

  if (isset($put_vars['description']))  { 
    $description =  $put_vars['description'];      
  }

  if (isset($put_vars['quantity'])) {
    $quantity =  $put_vars['quantity'];  
    }


  if (isset($put_vars['price'])){
    $price =  $put_vars['price'];  
   }     


  $dbh = connectDB();
 // prepare and insert item
  $sqlinserti = "UPDATE items set item_name='".$name."', item_desc='".$description."' where item_id='".$item_id."'";
  $stmt = $dbh->prepare($sqlinserti);
   $stmt->execute();

  // prepare and insert item properties
  $sqlinsertip = "UPDATE item_properties set quantity='".$quantity."', price=".$price." where fk_item_id="+$item_id;
  $stmt = $dbh->prepare($sqlinsertip);
  $stmt->execute();

  echo ("{item".$item_id.":'href=http://localhost/jsphp/items/".$item_id."'}");

*/
}  // end PUT/UPDATE


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