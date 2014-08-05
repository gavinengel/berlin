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
     
     td { 
          padding: 3px;

         }

        table { 
          border-spacing: 10px;
          border-collapse: separate;
          background-color: #eeeeee;
          }
     
     .formtable{
      width=50%;
      
      }
     


    </style>
  </head>
  <body>
    <div id="main">
      <div >
        <h1 class="calign">Inventory Admin</h1>
        <div> <input type=button id=showinventory onclick="getItems();" value="Show Items"> &nbsp; 
        <input type=button id=hidinventory onclick="javascript:document.getElementById('showcase').innerHTML = '';" value="Hide Items">
      </div>
        <div id=showcase>inventory will appear here</div> 
         
        <h2>Add Item</h2>
        
        <!-- add item -->
        <table class="formtable table" id="additem" width="400px;">
          <thead>
            <tr>
              <th scope="col">Name</th>
              <th scope="col">Value</th>
            </tr>
          </thead>
            

          <tbody>
            <tr>
              <td>Item Name:  </td>
              <td> <input id="addname" name="addname" placeholder="Item Name"></td>
            </tr>
            <tr>
              <td>Description: </td>
              <td> <input id="adddescription" name="adddescription" placeholder="Description"></td>
            </tr>
            <tr>
              <td>Quantity: </td>
              <td> <input id="addquantity" name="addquantity" placeholder="Quantity"></td>
            </tr>
            <tr>
              <td>Price: </td>
              <td> <input id="addprice" name="addprice" placeholder="Price"></td>
            </tr>                        
            <tr>
              <td colspan=2><input type="submit" value="Add Item" onClick="javascript:addItem();"></td>
            </tr>
            <tr>
              <td colspan=2 id=addstatus></td>
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

<hr>
    <!--  ***************************************DELETE ITEM ****************************** -->
    <div class="formadd">
     <h2>Delete Item</h2>

       <div id="formdelete">

        <table class="table" id="deleteitem">


          <thead>
            <tr>
              <th scope="col">Name</th>
              <th scope="col">Value</th>
            </tr>
          </thead>
            


          <tbody>
            <tr>
              <td>Item ID:  </td>
              <td> <input id="del_itemid" name="del_itemid" placeholder="Item ID"></td>
            </tr>
            <tr>
              <td>Item Name:  </td>
              <td> <input id="del_name" name="del_name" placeholder="Item Name" readonly></td>
            </tr>
            <tr>
              <td>Description: </td>
              <td> <input id="del_description" name="del_description" placeholder="Description" readonly></td>
            </tr>
            <tr>
              <td>Quantity: </td>
              <td> <input id="del_quantity" name="del_quantity" placeholder="Quantity" readonly></td>
            </tr>
            <tr>
              <td>Price: </td>
              <td> <input id="del_price" name="del_price" placeholder="Price" readonly></td>
            </tr>                        
            <tr>
              <td colspan=2><input name="deleteitem" type="button" value="Delete" onClick="deleteItem(); return false;" > </td>
            </tr>
              <tr>
                <td colspan=2 id="del_status">asdf</td>
          </tbody>
        </table>
      </div>

      


    </div> <!-- end main -->
  </body>
</html>