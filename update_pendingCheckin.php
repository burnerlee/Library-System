<?php
include('credentials.php');
$dbname="library";
$conn=new mysqli($servername, $username, $password,$dbname);
$conn->query("DELETE FROM pendingCheckin");
$res=$conn->query("SELECT * FROM clientDataCheckin WHERE stat='pending'");
while($result=$res->fetch_assoc()){
    $requestid=$result['id'];
    $bookName=$result['bookName'];
    $authorName=$result['authorName'];
    $bookid=$result['bookid'];
    $quantity=$result['quantity'];
    $stmt = $conn->prepare("INSERT INTO pendingCheckin (requestid,bookid,bookName,authorName,quantity) VALUES (?,?,?,? ,?)");
    $stmt->bind_param("iissi",$requestid,$bookid, $bookName , $authorName, $quantity);
    $stmt->execute();
}

?>