<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Inventory Admin</title>


     <script src="scripts/items.js"></script>

<style>
 #main{
  padding: 3em;
 }
 #additem{
  width=50%;
  background-color: #eeeeee;
 }
 
 .calign{
  text-align: center;
 }

 .formadd{
  width: 50%;
 }


 </style>
  </head>
  <body>
    <div id="main">

    <div class="formadd">
    <h1 class="calign">Inventory Admin</h1>

      <h2>Add Item</h2>
      <form action="items/" method="post">

        <table class="table" id="additem" width="400px;">


          <thead>
            <tr>
              <th scope="col">Name</th>
              <th scope="col">Value</th>
            </tr>
          </thead>
            


          <tbody>
            <tr>
              <td>Item Name:  </td>
              <td> <input type="text" name="name" placeholder="Item Name"></td>
            </tr>
            <tr>
              <td>Description: </td>
              <td> <input type="text" name="description" placeholder="Description"></td>
            </tr>
            <tr>
              <td>Quantity: </td>
              <td> <input type="text" name="quantity" placeholder="Quantity"></td>
            </tr>
            <tr>
              <td>Price: </td>
              <td> <input type="text" name="price" placeholder="Price"></td>
            </tr>                        
            <tr>
              <td colspan=2 class="calign"><button type="submit">Add</span> 
</button> </td>
              </tr>
          </tbody>
        </table>
      </form>
    
    </div> <!-- end formadd -->


    <!--  ***************************************UPDATE ITEM ****************************** -->
    <div class="formadd">
     <h2>Update Item</h2>

       <div id="formupdate">

        <table class="table" id="additem" width="400px;">


          <thead>
            <tr>
              <th scope="col">Name</th>
              <th scope="col">Value</th>
            </tr>
          </thead>
            


          <tbody>
            <tr>
              <td>Item ID:  </td>
              <td> <input id="itemid" name="itemid" placeholder="Item ID"></td>
            </tr>
            <tr>
              <td>Item Name:  </td>
              <td> <input id="name" name="name" placeholder="Item Name"></td>
            </tr>
            <tr>
              <td>Description: </td>
              <td> <input id="description" name="description" placeholder="Description"></td>
            </tr>
            <tr>
              <td>Quantity: </td>
              <td> <input id="quantity" name="quantity" placeholder="Quantity"></td>
            </tr>
            <tr>
              <td>Price: </td>
              <td> <input id="price" name="price" placeholder="Price"></td>
            </tr>                        
            <tr>
              <td colspan=2><input name="updateitem" type="submit" value="Update" onClick="updateItem();"> </td>
            </tr>
              <tr>
                <td colspan=2 id="status">asdf</td>
          </tbody>
        </table>
      </div>

      <?php
       
       // ************************************** GET *******************************
      $method = $_SERVER['REQUEST_METHOD'];


      // IF METHOD IS GET SHOW ALL ITEMS
      if ($method=="GET"){



        //connect to items db
         try {
              $dbh = new PDO('mysql:host=localhost;port=3306;dbname=inventory', 'root', '', array( PDO::ATTR_PERSISTENT => false));
          } catch (PDOException $e) {
              print "Error!: " . $e->getMessage() . "<br/>";
              die();
          }    
        
          $json = [];

          $sql = "select item_id from items order by item_id";
          foreach ($dbh->query($sql) as $results){
                     $json[$results["item_id"]] = 'http://localhost/items/'.$results["item_id"];
                    
            }
            echo (json_encode($json));
     
        }


      //end GET ***************************************


        ?>



    </div> <!-- end main -->
  </body>
</html>