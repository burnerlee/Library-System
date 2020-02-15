<?php
include('credentials.php');
$dbname="library";
$conn=new mysqli($servername, $username, $password,$dbname);
if($conn->query("CREATE TABLE IF NOT EXISTS respondedCheckin(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    requestid INT,
    bookid INT,
    bookName VARCHAR(30) ,
    authorName VARCHAR(30),
    quantity INT,
    stat VARCHAR(30)
    

)")==true){


}
else {
    echo "Error creating table: " . $conn->error;
}
$conn->query("DELETE FROM respondedCheckin");
$res=$conn->query("SELECT * FROM clientDataCheckin WHERE stat!='pending'");
while($result=$res->fetch_assoc()){
    $requestid=$result['id'];
    $bookName=$result['bookName'];
    $authorName=$result['authorName'];
    $bookid=$result['bookid'];
    $quantity=$result['quantity'];
    $stat=$result['stat'];
    $stmt = $conn->prepare("INSERT INTO respondedCheckin (requestid,bookid,bookName,authorName,quantity,stat) VALUES (?,?,?,? ,?,?)");
    $stmt->bind_param("iissis",$requestid,$bookid, $bookName , $authorName, $quantity,$stat);
    $stmt->execute();
}






?>