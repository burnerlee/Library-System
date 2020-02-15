
document.getElementById("addBook").addEventListener("click", addBookFunc);
function addBookFunc() {

    document.getElementById("bookAddInput").style.display = "block";

}
document.getElementById("delete").addEventListener("click", deleteRows);
function deleteRows() {
    for (o = 0; o < document.getElementsByClassName("checkbox").length; o++) {
        document.getElementsByClassName("checkbox")[o].style.visibility="hidden";
    
    
    }
    document.getElementById("deleteRequest").innerText = "Delete Items";
    document.getElementById("delete").style.display = "none";
    var tobeDeleted = [];
    var allCheckBoxes = document.getElementsByClassName("checkbox");
    var allQuantity=document.getElementsByClassName("enterQuantity");
    for (i = 0; i < allCheckBoxes.length; i++) {
        if (allCheckBoxes[i].checked) {
            var obj={id:allCheckBoxes[i].name,deleteQuantity:allQuantity[i].value}
            tobeDeleted.push(obj);
        }
    }
    tobeDeleted.forEach(element => {
        $.ajax({ type: 'post', url: 'delete.php', data: { data: element }, success: function (response) { 
           console.log(response); } });
window.location.reload();
       
    });




}
document.getElementById("deleteRequest").addEventListener("click", showDelete);

function showDelete() {
    for (o = 0; o < document.getElementsByClassName("checkbox").length; o++) {
        document.getElementsByClassName("checkbox")[o].style.visibility="visible";
    
    
    }

    if (document.getElementById("deleteRequest").innerText == "Cancel") {
        document.getElementById("deleteRequest").innerText = "Delete Items";
        for (o = 0; o < document.getElementsByClassName("checkbox").length; o++) {
            document.getElementsByClassName("checkbox")[o].style.visibility="hidden";
        
        
        }
        document.getElementById("delete").style.display = "none";
    }
    else {
        document.getElementById("delete").style.display = "block";
        document.getElementById("deleteRequest").innerText = "Cancel";
    }
}
for (o = 0; o < document.getElementsByClassName("checkinAccept").length; o++) {
    document.getElementsByClassName("checkinAccept")[o].addEventListener("click", acceptRequestCheckin, event);


}
function acceptRequestCheckin() {
    var totalId = (event.target.id);
    var finalId = totalId.substring(14);
    console.log(finalId);
    $.post('response_pendingCheckin.php', { response: 1, checkinId: finalId });
    window.location.reload();
}
for (o2 = 0; o2 < document.getElementsByClassName("checkinDecline").length; o2++) {
    document.getElementsByClassName("checkinDecline")[o2].addEventListener("click", declineRequestCheckin, event)


}

function declineRequestCheckin() {
    var totalId = (event.target.id);
    var finalId = totalId.substring(15);
    console.log(finalId);
    $.post('response_pendingCheckin.php', { response: 0, checkinId: finalId });
    window.location.reload();
}

for (m = 0; m < document.getElementsByClassName("checkoutAccept").length; m++) {
    document.getElementsByClassName("checkoutAccept")[m].addEventListener("click", acceptRequestCheckout, event);


}
function acceptRequestCheckout() {
    var totalId = (event.target.id);
    var finalId = totalId.substring(15);
    console.log(finalId);
    $.ajax({ type: 'post', url: 'response_pendingCheckout.php', data: { response: 1, checkoutId: finalId}, success: function (response) { alert(response) }});
    window.location.reload();

}
for (m2 = 0; m2 < document.getElementsByClassName("checkoutDecline").length; m2++) {
    document.getElementsByClassName("checkoutDecline")[m2].addEventListener("click", declineRequestCheckout, event)


}

function declineRequestCheckout() {
    var totalId = (event.target.id);
    var finalId = totalId.substring(16);
    console.log(finalId);
    $.post('response_pendingCheckout.php', { response: 0, checkoutId: finalId });
    window.location.reload();
}

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