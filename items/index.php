<?php




function connectDB(){

  if ($_SERVER['HTTP_HOST'] == 'localhost') {
    $dsn="mysql:host=localhost;dbname=inventory;port=3306;";
    $dbuser="root";
    $dbpass="";
  }else{
      $dsn="mysql:host=127.4.142.130;port=3306;dbname=inventory";
      $dbuser="adminAVtM3nG";
      $dbpass="ARqlnjYKVh3B";
  }

  try {
    $dbh = new PDO(''.$dsn.'',''.$dbuser.'', ''.$dbpass.'', array( PDO::ATTR_PERSISTENT => true));
  } catch (PDOException $e) {
    echo "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
  return($dbh);
} 



  function getAllItems()
    {
        $dbh = connectDB();
        $stmt = $dbh->prepare('
            SELECT item_id, item_name from items
        ');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    function getItemByID($id){
      $dbh = connectDB();
      $stmt = $dbh->prepare('
        select i.item_id, i.item_name, i.item_desc,
        p.quantity, p.price
        FROM items i
        LEFT JOIN item_properties p ON i.item_id = p.fk_item_id
        WHERE i.item_id = :end; 
        ');
       
      $stmt -> bindParam(':end', $id);
      $stmt->execute();    
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$actual_host = '';
$method = $_SERVER['REQUEST_METHOD'];


// ************************************** GET/UPDATE *******************************


if ($method=="GET"){
  $json_data = "{";
  $array = array(); 
  $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  $pathFragments = explode('/items/', $path);
  $end = end($pathFragments);
  $end= preg_replace('#[^0-9]#', '', $end);
  //var_dump($end);
  
  //Get ALl
  if ($end == '') {  
    $data = getAllItems();  

    foreach ($data as $row){
      $currentid = $row["item_id"];
      $currentname = $row["item_name"];
      //$currenturl = "$row->url";
      //$currentimage = "$row->image";
      $array[$currentid] = array('item_id'=>$currentid,'item_name'=>$currentname, 'url'=> $_SERVER['HTTP_HOST']."/items/".$currentid."/");
    }

    echo json_encode($array);
  } elseif (ctype_digit($end)){
    $array = '';
    $data = getItemByID($end); 
    foreach ($data as $row){
      $currentid = $row["item_id"];
      $currentname = $row["item_name"];
      $item_desc = $row["item_desc"];
      $quantity = $row["quantity"];
      $price = $row["price"];
      $array[$currentid] = array('item_id'=>$currentid,'item_name'=>$currentname, 'item_desc'=> 
        $item_desc, 'price'=> $price, 'quantity'=> $quantity);
    }

    echo json_encode($array);


    }


/*
{
$currentid = "$row->id";
$currentname = "$row->name";
$currenturl = "$row->url";
$currentimage = "$row->image";
$array = array('id'=>$currentid,'url'=>$currenturl, 'name'=>$currentname,'image'=>$currentimage);

 echo json_encode($array);


       while($row = mysql_fetch_object($result))
        {
            $currentid = "$row->id";
            $currentname = "$row->name";
            $currenturl = "$row->url";
            $currentimage = "$row->image";
            $array[]= array('id'=>$currentid,'url'=>$currenturl, 'name'=>$currentname,'image'=>$currentimage);
        }
        echo json_encode($array);
    }else{
        echo json_encode(Array("error": "No POST values"));
    }


}




  echo json_encode($data);




/*
  function getItemProperties($end)
  
    if ($end != '') {  
      $sql = "select item_id, item_name from items where item_id=".$end;
      //create prepared stmt
      $stmt = $dbh->prepare ('
        select item_id, item_name from items where item_id=:end
      ');
      //bind the query value to the sql 
      $stmt -> bindParam(':end', $end);
      $stmt->execute();

    } else {
      $sql = "select item_id, item_name from items";
      $stmt = $conn->prepare ('
      select item_id, item_name from items where item_id=:end
    ');

    }

    return $stmt->fetch();
  }



/* -- * /


$stmt = $conn->prepare ('
    select item_id, item_name from items where item_id=:end
');
 
$stmt -> bindParam(':end', $end);
$stmt -> bindParam(':surname', 'Smith');
 
$stmt -> execute();

/* -- */
  


/*
  $rows = array();
  
  $sql = "select item_id, item_name from items";
  if ($end != '') {  
  $sql = "select item_id, item_name from items where item_id=".$end;
  }



foreach ($dbh->query($sql) as $results){     
  $json_data .= "'".
  $results["item_id"]."': {'item_name': '". $results["item_name"]."','item_id':'".$results["item_id"]."', 'url':'".$_SERVER['HTTP_HOST']."/jsphp/items/".$results["item_id"]."/'},";
    
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
        

*/       

      
    //$data .= "'". $results["item_id"]."': {'itemid':'".$results["item_id"]."', 'url': 'href://localhost/jsphp/items/".$results["item_id"]."/'},";
    //echo $data;
    //$json[$results["item_id"]] = 'http://localhost/items/'.$results["item_id"];
    //html_entity_decode



    }

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


