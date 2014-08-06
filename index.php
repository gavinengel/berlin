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
          font-weight: bold;

         }

        table { 
          border-spacing: 10px;
          border-collapse: separate;
          background-color: #b3e5fc;
          color: #000;
          border-radius: 8px;
          border: 3px;
          }
     
     .formtable{
      width=50%;
      
      }
    html
    {
      font-family: source-sans-pro, helvetica, arial, sans-serif;
      -webkit-font-smoothing: antialiased;
    }

      body
      {
        line-height: 1.231;
        text-rendering: optimizeLegibility;
        font-size: 100%;
        -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
      }

        body {
        background: #03a9f4;
        color: #fff;

      }



/**
 * Set individual heading styles
 */
h1, h2, h3, h4, h5, h6
{
    font-weight: 600;
    margin-top: 0.5em;
    margin-bottom: 0.8em;
    line-height: 1.2em;
}

h1
{
  font-size: 225%;
}

h2
{
  font-size: 200%;
}

h3
{
  font-size: 175%;
}

h4
{
  font-size: 110%;
    margin-top: 25px;
}

h5
{
  font-size: 125%;
}

h6
{
  font-size: 100%;
}



.button-green{
  background: #259b24;
  color: #fff;
  font-weight: 500em;
  padding: .75em;
  border-radius: 8px;
  border: 3px;

}

.button-orange{
  background: #3f51b5;
  color: #fff;
  font-weight: 500em;
  padding: .75em;
  border-radius: 8px;
  border: 3px;
}

.button-brown{
  background: #ff5722;
  color: #fff;
  font-weight: 500em;
  padding: .75em;
  border-radius: 8px;
  border: 3px;
}
  .title{
    font-size: 4em;
    color: #e1f5fe;
  }

  .button-gray{
      background: #607d8b;
    color: #fff;
    font-weight: 500em;
    padding: .75em;
    border-radius: 8px;
    border: 3px;

  }

  #additem{
    display:none;
  }

#showcase{
  width: 400px;
  color: #000;
  background: #e7e9fd;
  padding: 0px;
  border-radius: 8px;
  border:3px;
}
    </style>
  </head>
  <body>
    <div id="main">

      <script>
      function showCreate(noneblock){
        
        document.getElementById("additem").style.display="block";
      
      if (noneblock == "none") {
        document.getElementById("additem").style.display="none";
      }

      }
      </script>
        <div class=title>inventory</div>
        <br /><div> 
          <input type=button class="button-gray" id="createinventory" onclick="showCreate();" value="Create">
          <input type=button class="button-gray" id="showinventory" onclick="getItems();" value="Show"> 
          <input type=button class="button-gray"  onclick="javascript:document.getElementById('showcase').innerHTML = '';" value="Search"></div>
      
        <div id="getJSON"></div>
        <div id="showcase"></div> 
         
        <br>
        <!-- add item -->
        <table class="formtable table" id="additem" width="400px;">
         
            

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
              <td colspan=2><input type="submit" class="button-green" value="Add Item" onClick="javascript:addItem();">
                <input type="submit" class="button-brown" value="Cancel" onClick="showCreate("none")></td>
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

        <table class="table" id="updateitem" width="400px;">


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