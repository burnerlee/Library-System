<?php
include('credentials.php');
$dbname="library";
$conn=new mysqli($servername, $username, $password,$dbname);
if(isset($_POST)){
    $bookName=$_POST['bookName'];
    $authorName=$_POST['authorName'];
    $quantity=$_POST['bookQuantity'];
    $stmt = $conn->prepare("INSERT INTO bookData (id,bookName,authorName,quantity) VALUES (?,?, ?, ?)");
    $stmt->bind_param("issi",$id, $bookName , $authorName, $quantity);
    $stmt->execute();
    header("Location: admin.php");
  }
?>
