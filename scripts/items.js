


// *********************** AJAX GET/POST/PUT/DELETE FUNCTIONS ****************************


// ***************** GET ALL ********************************

function getItems(){

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
      //console.log(JSON.stringify(r));

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
      console.log('about to log inventory' + inventory);
      document.getElementById("parsedinventory").innerHTML = inventory + "</div>";
       // document.getElementById("showcase").style.display="block";      
    //document.getElementById("jsoncell").innerHTML = hr.responseText;
    //return hr.responseText;
    }
  }    
  
  hr.send();
  //document.getElementById("status").innerHTML="waiting ...";
} 



function myItems( param1, param2, callbackFunction ) {  
 var r = callbackFunction()
 alert( 'Started eating my dinner. \n\n It has: ' + param1 + ', ' + param2);  
    console.log(r);  
}

function addItem(){
  //console.log('inaddItem()');
  
  var itemlink = '';  
  //create the request
  var hr = new XMLHttpRequest();
  var url = 'items/'
  var addname = document.getElementById("addname").value;
  console.log('addname: ' +addname);
  if (addname == ''){document.getElementById("statuscell").innerHTML="<span class='error'><em>Name</em> must be completed.</span>";return;}
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
      console.log(hr.responseText);
      var r = JSON.parse(hr.responseText);
      for (o in r){
        itemlink += "<a href='http://"+r[o].url+"'>http://"+r[o].url+"</a>";
          document.getElementById("statuscell").innerHTML='<span class="success">Successfully Added.'+itemlink+'</span>';
         
           document.getElementById("addname").value = null;
        adddescription = document.getElementById("adddescription").value = null;
        addprice = document.getElementById("addprice").value = null;
        addquantity = document.getElementById("addquantity").value = null;
        //myItems('bread', 'cheese', function(){getItems()});
        location.reload();

        
      }
     
         
     
    }

  }    

  hr.send(vars);

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
        document.location = "#update";
        document.getElementById("statuscell").innerHTML= '';
      };

  }
  }    
  
  hr.send();

  }

  var inventory = "<div class='content float-left'>";
 function makeInventory(myname, myhref, id, item_desc, quantity, price, ts){
  inventory += "<div class='card'><div class='cardtitle'>"+myname+"</div><div class='cardbody'>Description: "+item_desc+"<br>quantity: "+quantity+"<br>Price: $"+price+"<br><small>updated:<i>"+ts+"</i></small><br> <a href='http://"+myhref+"'>http://"+myhref+"</a><br><br><input type='button' value='Update'class='button-gray' value='update' onClick='makeUpdate("+id+");'>&nbsp;<input type='button' value='Delete' class='button-gray' onclick='deleteItem("+id+");return false;'></div></div>";
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
    if (name == ''){document.getElementById("statuscell").innerHTML="<span class='error'><em>Name</em> must be completed.</span>";return;}
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
 
      document.getElementById("itemid").value = null;
      document.getElementById("name").value = null;
      document.getElementById("description").value =null;
      document.getElementById("price").value=null;
      document.getElementById("quantity").value=null; 
      document.getElementById("update").style.display="none";
      document.getElementById("statuscell").innerHTML="<span class='success'>Successfully Updated item id: "+itemid+"<br>&nbsp;";
         getItems();
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
      getItems();
      document.getElementById("jsoncell").innerHTML = return_data;
      document.getElementById("statuscell").innerHTML = "<span class='success'>Successfully Deleted item: " + id + "</span>";

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
