<?php
include('credentials.php');
$dbname="library";
$conn=new mysqli($servername, $username, $password,$dbname);
if(isset($_POST)){
    $bookid=$_POST['id'];
    $quantity=$_POST['quantity'];
    $stat="pending";
    $history="old";
    $res=$conn->query("SELECT bookName,authorName FROM bookData WHERE id=$bookid");
    $result=$res->fetch_assoc();
    $bookName=$result['bookName'];
    $authorName=$result['authorName'];
    $stmt = $conn->prepare("INSERT INTO clientDataCheckin (bookid,bookName,authorName,quantity,stat,history) VALUES (?,?,?,? ,?, ?)");
    $stmt->bind_param("ississ",$bookid, $bookName , $authorName, $quantity,$stat,$history);
    $stmt->execute();
   
  }
?>