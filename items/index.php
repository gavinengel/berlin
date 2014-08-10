<?php


define('DB_HOST', getenv('OPENSHIFT_MYSQL_DB_HOST'));
define('DB_PORT',getenv('OPENSHIFT_MYSQL_DB_PORT')); 
define('DB_USER',getenv('OPENSHIFT_MYSQL_DB_USERNAME'));
define('DB_PASS',getenv('OPENSHIFT_MYSQL_DB_PASSWORD'));
define('DB_NAME',getenv('OPENSHIFT_GEAR_NAME'));




function connectDB(){

  try {
    $dbh = new PDO('mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME.', '.DB_USER.', '', array( PDO::ATTR_PERSISTENT => true));
  } catch (PDOException $e) {
    echo "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
  return($dbh);
} 


$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$actual_host = '';
$method = $_SERVER['REQUEST_METHOD'];


// ************************************** GET/UPDATE *******************************


if ($method=="GET"){
  $json_data = "{";
 
  $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  $pathFragments = explode('/items/', $path);
  $end = end($pathFragments);
  $end= preg_replace('#[^0-9]#', '', $end);
  //var_dump($end);
  
  

  $dbh = connectDB();
  $rows = array();
  $sql = "select item_id, item_name from items";
  if ($end != '') {  
  $sql = "select item_id, item_name from items where item_id=".$end;
  }


foreach ($dbh->query($sql) as $results){     $json_data .= "'".
$results["item_id"]."': {'item_name': '". $results["item_name"]."',
'item_id':'".$results["item_id"]."', 'url':
'".$_SERVER['HTTP_HOST']."/jsphp/items/".$results["item_id"]."/'},";
    
    //$rows[$results["item_id"]]= $results;
    }
    $json_data = chop($json_data, ",");
    $json_data = str_replace("'",'"',$json_data);
    $json_data = html_entity_decode($json_data);
    $json_data .= "}";

    header("Content-Type: application/json");
   
   echo $json_data;

   //echo json_encode($rows);

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
          $quantity =  $_POST['quantity'];            

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
              $last_id = $dbh->lastInsertId("item_id");

              // prepare and insert item properties
              $sqlinsertip ="INSERT into item_properties (fk_item_id, quantity, price) values ((select max(item_id) from items), '".$quantity."',".$price.")";
              $stmt = $dbh->prepare($sqlinsertip);
              $stmt->execute();

              
              
              echo '{"'.$last_id.'":{"item_id":"'.$last_id.'", "url": "' .$_SERVER['HTTP_HOST'].'/jsphp/items/'.$last_id.'/"}}';
               //'http://localhost/jsphp/items/80'}";
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

  parse_str(file_get_contents("php://input"), $put_vars);
  //echo("data:". $put_vars["itemid"]);
  //echo("id " .$put_vars["del_itemid"]);
  $dbh = connectDB();

  $sql = "DELETE from items where item_id=".$put_vars["del_itemid"]; //  set item_name='".$put_vars["name"]."', item_desc='".$put_vars["description"]."' where item_id=".$put_vars["itemid"];

  $stmt = $dbh->prepare($sql);
  $delresp = $stmt -> execute();
  echo '{"msg":{"response":"'.$delresp.'"}"';
  
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


