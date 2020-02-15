<?php
include('credentials.php');
$dbname="library";
$conn=new mysqli($servername, $username, $password,$dbname);
if(isset($_POST)){
  
    $id=$_POST['id'];
    $quantityhere=$_POST['quantity'];
   
    $res=$conn->query("SELECT bookName,authorName,quantity FROM bookData WHERE id=$id");
  $stat="pending";
    $result=$res->fetch_assoc();
    $bookName=$result['bookName'];
    $authorName=$result['authorName'];
    
    $stmt = $conn->prepare("INSERT INTO clientDataCheckout (bookid,bookName,authorName,quantity,stat) VALUES (?,?, ?, ?,?)");
    $stmt->bind_param("issis",$id, $bookName , $authorName, $quantityhere,$stat);
    $stmt->execute();

    







    header("Location: admin.php");
  }
?>