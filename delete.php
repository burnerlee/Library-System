<?php
include('credentials.php');
$dbname="library";
$conn=new mysqli($servername, $username, $password,$dbname);
$obj=$_POST['data'];
$id=$obj['id'];
$deleteQuantity=$obj['deleteQuantity'];


    if($obj > 0){
        
          $res=$conn->query("SELECT * FROM bookData WHERE id=$id");
        $result=$res->fetch_assoc();
        $originalQuantity=$result['quantity'];
          $query = "UPDATE bookData SET quantity=$originalQuantity  -$deleteQuantity WHERE id=$id";
          mysqli_query($conn,$query);
          
         
        
      }
  

?>