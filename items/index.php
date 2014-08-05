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

$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$method = $_SERVER['REQUEST_METHOD'];


// ************************************** GET *******************************


if ($method=="GET"){
  $json_data = "{";
 
  $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  $pathFragments = explode('/items/', $path);
  $end = end($pathFragments);
  

  $dbh = connectDB();
  $rows = array();
  
  $sql = "select item_id from items";
  foreach ($dbh->query($sql) as $results){
    $rows[$results["item_id"]]= $results;
    }
    header("Content-Type: application/json");
   echo json_encode($rows);

   //echo $json_data;  
        

       

      }
    
    //$data .= "'". $results["item_id"]."': {'itemid':'".$results["item_id"]."', 'url': 'href://localhost/jsphp/items/".$results["item_id"]."/'},";
    //echo $data;
    //$json[$results["item_id"]] = 'http://localhost/items/'.$results["item_id"];
    //html_entity_decode




  //end GET ALL ***************************************

      
        
// ********************CREATE NEw (POST)  ******************** 


       // IF METHOD IS POST ADD ITEM TO DB
       if ($method == "POST") {


        //get values
        if (isset($_POST['name'])) {  
         $name=$_POST['name'];
        }

        if (isset($_POST['description']))  { 
          $description =  $_POST['description'];      
        }

        if (isset($_POST['quantity'])) {
          $quantity =  $_POST['quantity'];            echo("quantity: " . $quantity . "<br />\n");  
        }

        if (isset($_POST['price'])){
          $price =  $_POST['price'];  
        }
     
        //create db connection to localhost/items
              $dbh = connectDB();
              // prepare and insert item
              $sqlinserti = "INSERT into items (item_name, item_desc) values('".$name."','".$description."')";
              $stmt = $dbh->prepare($sqlinserti);
              $stmt->execute();


              // prepare and insert item properties
              $sqlinsertip ="INSERT into item_properties (fk_item_id, quantity, price) values ((select max(item_id) from items), '".$quantity."',".$price.")";
              $stmt = $dbh->prepare($sqlinsertip);
              $stmt->execute();

              
              
              //insert into items (item_name, item_desc) values ('novel', 'the sun also rises');

              echo "{id: 80, href: 'http://localhost/jsphp/items/80'}";
            /* while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                  echo "output: ".$rs->name."<BR>";
              }
              echo "<BR><B>".date("r")."</B>";
          */
  }     // ************END CREATE (POST)  

// UPDATE (PUT) ****************************************************************
if ($method == "PUT"){
  echo ($method);
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

  echo ("put get by id return here");

}  // end PUT/UPDATE


/* ******************** DELETE *********************/
if ($method == "DELETE"){
  echo $method;
  parse_str(file_get_contents("php://input"), $put_vars);
  //echo("data:". $put_vars["itemid"]);
  echo("id " .$put_vars["del_itemid"]);
  $dbh = connectDB();

  $sql = "DELETE from items where item_id=".$put_vars["del_itemid"]; //  set item_name='".$put_vars["name"]."', item_desc='".$put_vars["description"]."' where item_id=".$put_vars["itemid"];
  echo ($sql);
  $stmt = $dbh->prepare($sql);
  $stmt -> execute();

} // END DELETE
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



    ?>


