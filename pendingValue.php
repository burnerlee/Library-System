<?php
include('credentials.php');
$dbname="library";
$conn=new mysqli($servername, $username, $password,$dbname);
$bookid=$_POST['bookid'];
$result=$conn->query("SELECT quantity FROM pendingCheckin WHERE bookid=$bookid");
    $pendingValue=0;
    if($result->num_rows>0){
      
        while($row=$result->fetch_assoc()){
            $pendingValue=$row['quantity']+$pendingValue;       
           
            
        }
    }
echo $pendingValue;
?>