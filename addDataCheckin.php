<?php
include('credentials.php');
$dbname="library";
$conn=new mysqli($servername, $username, $password,$dbname);
if(isset($_POST)){
    $bookName=$_POST['bookName'];
    $authorName=$_POST['authorName'];
    $quantity=$_POST['bookQuantity'];
    $stat="pending";
    $history="new";
    $stmt = $conn->prepare("INSERT INTO clientDataCheckin (bookName,authorName,quantity,stat,history) VALUES (?,?,? ,?, ?)");
    $stmt->bind_param("ssiss", $bookName , $authorName, $quantity,$stat,$history);
    $stmt->execute();
    header("Location:client.php");
  }
?>
