
document.getElementById("checkout").addEventListener("click",checkout);

document.getElementById("cancelCheckout").addEventListener("click",cancelCheckout);
function cancelCheckout(){
    document.getElementById("checkout").innerText="Checkout";
    for( i=0;i<document.getElementsByClassName("checkbox").length;i++){
        document.getElementsByClassName("checkbox")[i].style.visibility="hidden";
    }
    document.getElementById("cancelCheckout").style.visibility="hidden";
    
}
function checkout(){
    if(document.getElementById("checkout").innerText=="Submit"){
console.log("submit");
window.location.reload();
var submission=[];
for(q=0;q<document.getElementsByClassName("checkbox").length;q++){
    if(document.getElementsByClassName("checkbox")[q].checked){
        var data={id:document.getElementsByClassName("checkbox")[q].name,quantity:document.getElementsByClassName("enterQuantity")[q].value};
        submission.push(data);
    }
};
for(u=0;u<submission.length;u++){
    $.post('createCheckout.php',{id:submission[u].id,quantity:submission[u].quantity});
window.location.reload();
}














    }
else{
    for( i=0;i<document.getElementsByClassName("checkbox").length;i++){
        document.getElementsByClassName("checkbox")[i].style.visibility="visible";
    }
    document.getElementById("checkout").innerText="Submit";
    document.getElementById("cancelCheckout").style.visibility="visible";
}}
for(t=0;t<document.getElementsByClassName("checkbox").length;t++){
document.getElementsByClassName("checkbox")[t].addEventListener('change',checked,event)
}
function checked(){
    if(event.target.checked){
    for(y=0;y<document.getElementsByClassName("enterQuantity").length;y++){

      if(document.getElementsByClassName("enterQuantity")[y].name==event.target.name){
      document.getElementsByClassName("enterQuantity")[y].style.visibility="visible";
       }
    
    }}
    if(!event.target.checked){
        for(y=0;y<document.getElementsByClassName("enterQuantity").length;y++){
    
          if(document.getElementsByClassName("enterQuantity")[y].name==event.target.name){
          document.getElementsByClassName("enterQuantity")[y].style.visibility="hidden";
           }
        
        }}
}
document.getElementById("checkin").addEventListener('change',addShow);
function addShow(){
       
    document.getElementById("checkinNo").value=0;
      
    
        $.ajax({
            type: "POST",
            data: {bookid:document.getElementById("checkin").value},
            url: "maxValue.php",
            success: function(response){
              var max_value=parseInt(response);
             
              $.ajax({
                  type: "POST",
                  data: {bookid:document.getElementById("checkin").value},
                  url: "pendingValue.php",
                  success: function(response){
                    var  pendingValue=parseInt(response);
                    
        max_value-=pendingValue;
        console.log(max_value);
        document.getElementById("checkinNo").max=max_value;
                      }
                  });
                }
            });
       
        
       
    
}
document.getElementById("checkinSubmit").addEventListener('click',addExisiting);
function addExisiting(){

    $.post('createCheckin.php',{id:document.getElementById("checkin").value,quantity:document.getElementById("checkinNo").value});
    window.location.reload();
}