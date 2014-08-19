
// ***************** Get All ********************************

function getItems(){

  var hr = new XMLHttpRequest();
  var url = 'items/';
  hr.open("GET", url, true);
  hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  hr.onreadystatechange = function(){
    if (hr.readyState == 4 && hr.status == 200){
      
      var r = JSON.parse(hr.responseText);

      //create array to sort return values
      var keys = [], 
      i,
      len,
      k;

      for (k in r){
        if (r.hasOwnProperty(k)){
        keys.push(k);}
      }

      keys.sort();
      keys.reverse();
      len = keys.length;

      for (i = 0; i < len; i++){
        k = keys[i];
        makeInventory(r[k].item_name, r[k].url, keys[i], r[k].item_desc, r[k].quantity, r[k].price, r[k].ts, i);
        }
      
      document.getElementById("parsedinventory").innerHTML = inventory + "</div>";
      document.getElementById("jsoncell").innerHTML = "<pre>"+hr.responseText.substr(0, 50) +"...</pre>";
    }
  }    
  
  hr.send();
  document.getElementById("parsedinventory").innerHTML="processing data ...";
} 

//**************************** Add Item ******************************
function addItem(){
  var create = document.getElementById("create"),
  name = create.addname,
   description= create.adddescription, 
   price=create.addprice, 
   quantity = create.addquantity,
   status =  document.getElementById("statuscell"),
   vars, hr, url, itemlink;
  
  //get inputs and perform any validations
  //name = document.getElementById("addname").value;
  if (name.value == ''){
    status.innerHTML="<span class='error'>Name must be completed.</span>";
    return;} 
  if (quantity.value == ''){
   status.innerHTML="<span class='error'>Quantity must be completed.</span>";
   return;}
  
  vars = "name="+name.value+"&description="+description.value+"&quantity="+quantity.value+"&price="+price.value;  
  
  //create request
  hr = new XMLHttpRequest();
  url = 'items/'
  hr.open("POST", url, true);

  hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  hr.onreadystatechange = function(){
    if (hr.readyState == 4 && hr.status == 200){
      var r = JSON.parse(hr.responseText);
      for (o in r){
        itemlink += "<a href='http://"+r[o].url+"'>http://"+r[o].url+"</a>";         
      }     
    status.innerHTML='<span class=success>Successfully Added.'+itemlink+'</span>';
    
    if (inventory != '') { inventory = "<div id=content name=content>";} 
    getItems();
    document.getElementById("jsoncell").innerHTML = hr.responseText.substr(0, 50);
    create.reset();        
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
        document.getElementById("statuscell").innerHTML= '';
      };

  }
  }    
  
  hr.send();

  }
  
  var bob = "chicken";
  var thisname = "";
  var inventory = "<div class='content float-left'>";
 function makeInventory(myname, myhref, id, item_desc, quantity, price, ts){


    inventory += "<div class='card'><div class='cardtitle'>"+myname+"</div><div class='cardbody'>description: "+item_desc.substr(0, 75)+"<br>Quantity: "+quantity+"<br>Price: $"+price+"<br><small><i>updated:"+ts+"</i></small></div><div class=cardfooter'><input type='button' value='Update'class='button-blued' value='update' onClick='makeUpdate("+id+");'>&nbsp;&nbsp;<input type='button' value='Delete' class='button-red' onclick='deleteItem("+id+");return false;'></div></div>";

    //console.log(thisinventory);

    


  // console.log(inventory);
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
    if (name == ''){document.getElementById("statuscell").innerHTML="<span class='error'>Name must be completed.</span>";return;}
  var description = document.getElementById("description").value;
  var price = document.getElementById("price").value;
  var quantity = document.getElementById("quantity").value;
      if (quantity == ''){document.getElementById("statuscell").innerHTML="<span class='error'>Quantity must be completed.</span>";return;}
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
      if (inventory != '') { inventory = "<div class='content float-left'>";}
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
      //getItems();
      document.getElementById("jsoncell").innerHTML = return_data;
      document.getElementById("statuscell").innerHTML = "<span class='success'>Successfully Deleted item: " + id + "</span>";
      if (inventory != '') {inventory = "<div class='content float-left'>";;}
      getItems();
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
