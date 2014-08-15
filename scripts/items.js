


// *********************** AJAX GET/POST/PUT/DELETE FUNCTIONS ****************************


// ***************** GET ALL ********************************

function getItems(){
  inventory = '<table>';


  var hr = new XMLHttpRequest();
  var url = 'items/';
  hr.open("GET", url, true);
 

  hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  hr.onreadystatechange = function(){
    if (hr.readyState == 4 && hr.status == 200){
      //console.log(hr.responseText);
      document.getElementById("jsoncell").innerHTML = "<pre>"+hr.responseText.substr(0, 50) +"...</pre>";
     //console.log(hr.responseText);

     //console.log("rT:" + hr.responseText);
      var r = JSON.parse(hr.responseText);


      var keys = [];
      var i;
      var len;
      var k;



      for (k in r)
      {
          if (r.hasOwnProperty(k))
          {
              keys.push(k);
          }
      }

      keys.sort();
      keys.reverse();

      len = keys.length;

      for (i = 0; i < len; i++)
        {
          k = keys[i];
         makeInventory(r[k].item_name, r[k].url, r[k].item_id, r[k].item_desc, r[k].quantity, r[k].price, r[k].ts, i);
        }

/*"item_id":"275","item_name":"wafer","quantity":"77","price":"86","item_desc":"choco","ts":"2014-08-13 09:47:47" */




       //for (o in r){
        //makeInventory(r[o].item_name, r[o].url, r[o].item_id);
        //document.getElementById("showcase").innerHTML += r[o].item_name + r[o].item_id +"<br>";     
       //}
      document.getElementById("parsedinventory").innerHTML = inventory + "</table>";
       // document.getElementById("showcase").style.display="block";      
    //document.getElementById("jsoncell").innerHTML = hr.responseText;
    return hr.responseText;
    }
  }    
  
  hr.send();
  //document.getElementById("status").innerHTML="waiting ...";
} 





function addItem(){
  console.log('inaddItem()');
  
  var itemlink = '';  
  //create the request
  var hr = new XMLHttpRequest();
  var url = 'items/'
  var addname = document.getElementById("addname").value;
  var adddescription = document.getElementById("adddescription").value;
  var addprice = document.getElementById("addprice").value;
  var addquantity = document.getElementById("addquantity").value;
  var vars = "name="+addname+"&description="+adddescription+"&quantity="+addquantity+"&price="+addprice;  
  console.log('vars: ' + vars);
  hr.open("POST", url, true);

  hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  hr.onreadystatechange = function(){
    if (hr.readyState == 4 && hr.status == 200){
      document.getElementById("jsoncell").innerHTML = hr.responseText.substr(0, 50);
      var r = JSON.parse(hr.responseText);
      for (o in r){
        itemlink += "<a href='http://"+r[o].url+"'>http://"+r[o].url+"</a>";
      }

    }
  }    

  hr.send(vars);
  document.getElementById("addstatus").innerHTML="";
}



function makeUpdate (id) {
  document.getElementById("update").style.display = "table-row";

   console.log('in makeUpdate, id = ' +id);
   
  var hr = new XMLHttpRequest();
  var url = 'items/'+id;
  hr.open("GET", url, true);
  hr.onreadystatechange = function(){
    if (hr.readyState == 4 && hr.status == 200){
      console.log("response text:" + hr.responseText)
      document.getElementById('jsoncell').innerHTML=hr.responseText.substr(0, 50);
      var r = JSON.parse(hr.responseText);
       for (o in r){
        document.getElementById("itemid").value = r[o].item_id;
        document.getElementById("name").value = r[o].item_name;
        document.getElementById("description").value = r[o].item_desc;
        document.getElementById("price").value = r[o].price;
        document.getElementById("quantity").value = r[o].quantity;
      };

  }
  }    
  
  hr.send();

  }

  
  var inventory = "<table>";
 function makeInventory(myname, myhref, id, item_desc, quantity, price, ts, count){
  if ((count + 1) % 2 == 0){var row = "<tr>";}else{row = "";}
  inventory += "<td class='itemcard'><span class='itemcard'><span class='itemname'>"+myname+"</span><br />Description: "+item_desc+"<br>quantity: "+quantity+"<br>Price: $"+price+"<br><small>updated:<i>"+ts+"</i><br> <a href='http://"+myhref+"'>http://"+myhref+"</a><br><br><input type='button' value='Update'class='button-gray' value='update' onClick='makeUpdate("+id+");'>&nbsp;<input type='button' value='Delete' class='button-gray' onclick='deleteItem("+id+");return false;'><br></td>"+row;
 //console.log(inventory);
 }

function updateItem(){
  console.log('inupdateItem');
    console.log('still in updateItem');
  //create the request
  var hr = new XMLHttpRequest();
  var url = 'items/'
  var itemid = document.getElementById("itemid").value;
  console.log("itemid"+itemid);
  var name = document.getElementById("name").value;
  var description = document.getElementById("description").value;
  var price = document.getElementById("price").value;
  var quantity = document.getElementById("quantity").value;
  var vars = "itemid="+itemid+"&name="+name+"&description="+description+"&quantity="+quantity+"&price="+price;  
  console.log(vars);
  
  hr.open("PUT", url, true);
  hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  hr.onreadystatechange = function(){
    if (hr.readyState == 4 && hr.status == 200){
      console.log(hr.responseText);
       

      document.getElementById("jsoncell").innerHTML = hr.responseText;
    }
  }    

  hr.send(vars);
  document.getElementById("jsoncell").innerHTML="waiting ...";
}


function deleteItem(id){

    console.log("in deleteItem");
  //create the request
  var hr = new XMLHttpRequest();
  var url = 'items/'
  //var del_itemid = document.getElementById("del_itemid").value;
  //var name = document.getElementById("name").value;
  //var description = document.getElementById("description").value;
  //var price = document.getElementById("price").value;
  //var quantity = document.getElementById("quantity").value;
  var vars = "del_itemid="+id; //+"&name="+name+"&description="+description+"&quantity="+quantity+"&price="+price;  

  hr.open("DELETE", url, false);

  hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  hr.onreadystatechange = function(){
    if (hr.readyState == 4 && hr.status == 200){
      var return_data = hr.responseText + '';
      
      //getItems();
      document.getElementById("jsoncell").innerHTML = return_data;
    }
  }    

  hr.send(vars);
  //document.getElementById("status").innerHTML=";


  }



function showCreate(noneblock){
  
  document.getElementById("additem").style.display="block";
  document.getElementById("showcase").style.display="none";        

if (noneblock == "none") {
  document.getElementById("additem").style.display="none";
}

}
