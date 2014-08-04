<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Inventory Admin</title>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"> 


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
              <td colspan=2 class="calign"><button type="submit" class="btn btn-success btn-lg">Add</span> 
</button> </td>
              </tr>
          </tbody>
        </table>
      </form>
       </div> 
    </div>
  </body>
</html>