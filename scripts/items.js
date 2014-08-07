

function addItem(){
  console.log('inupdateItem()');
  
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
      var r = JSON.parse(hr.responseText);
      for (o in r){
        itemlink += r[o].item_id + ": <a href='http://"+r[o].url+"'>http://"+r[o].url+"</a><br />";
      }
      document.getElementById("addstatus").innerHTML = hr.responseText;
      document.getElementById("addstatus").innerHTML += itemlink;
    }
  }    

  hr.send(vars);
  document.getElementById("addstatus").innerHTML="";
}


  var inventory = "<table class=table>";
 function makeInventory(myname, myhref){
  inventory += "<tr><td>"+myname+":</td><td> <a href='http://"+myhref+"'>http://"+myhref+"</a><br><a href='#deleteitem'>Delete</a>&nbsp;<a href='#updateitem'>Update</a></td></tr>";
 console.log(inventory);
 }


function getItems(){
  console.log('in getItems()');
  //create the request
  var hr = new XMLHttpRequest();
  var url = 'items/';
  console.log("url " + url);
  //var vars = "itemid="+itemid;
  hr.open("GET", url, true);
  hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  hr.onreadystatechange = function(){
    if (hr.readyState == 4 && hr.status == 200){
      console.log(hr.responseText);
      document.getElementById("getJSON").innerHTML = "<pre>"+hr.responseText.substr(0, 100) +"...</pre>";
      var r = JSON.parse(hr.responseText);
       for (o in r){
        makeInventory(r[o].item_name, r[o].url);
        //document.getElementById("showcase").innerHTML += r[o].item_name + r[o].item_id +"<br>";     
       }
      document.getElementById("showcase").innerHTML = inventory + "</table>";
        document.getElementById("showcase").style.display="block";      
    //document.getElementById("showcase").innerHTML = r; // hr.responseText;
    }
  }    

  hr.send();
  document.getElementById("status").innerHTML="waiting ...";
} 




function updateItem(){
  console.log('inupdateItem()');
    
  //create the request
  var hr = new XMLHttpRequest();
  var url = 'items/'
  var itemid = document.getElementById("itemid").value;
  var name = document.getElementById("name").value;
  var description = document.getElementById("description").value;
  var price = document.getElementById("price").value;
  var quantity = document.getElementById("quantity").value;
  var vars = "itemid="+itemid+"&name="+name+"&description="+description+"&quantity="+quantity+"&price="+price;  

  hr.open("PUT", url, true);
  hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  hr.onreadystatechange = function(){
    if (hr.readyState == 4 && hr.status == 200){
      var return_data = hr.responseText + '';
      document.getElementById("status").innerHTML = return_data;
    }
  }    

  hr.send(vars);
  document.getElementById("status").innerHTML="waiting ...";
}


function deleteItem(){

    console.log("in deleteItem");
  //create the request
  var hr = new XMLHttpRequest();
  var url = 'items/'
  var del_itemid = document.getElementById("del_itemid").value;
  //var name = document.getElementById("name").value;
  //var description = document.getElementById("description").value;
  //var price = document.getElementById("price").value;
  //var quantity = document.getElementById("quantity").value;
  var vars = "del_itemid="+del_itemid; //+"&name="+name+"&description="+description+"&quantity="+quantity+"&price="+price;  

  hr.open("DELETE", url, false);
  hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  hr.onreadystatechange = function(){
    if (hr.readyState == 4 && hr.status == 200){
      var return_data = hr.responseText + '';
      document.getElementById("del_status").innerHTML = return_data;
    }
  }    

  hr.send(vars);
  document.getElementById("status").innerHTML="waiting ...";
}
