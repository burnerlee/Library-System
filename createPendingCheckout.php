<?php
include('credentials.php');
$dbname="library";
$conn=new mysqli($servername, $username, $password,$dbname);
if($conn->query("CREATE TABLE IF NOT EXISTS pendingCheckout(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    requestid INT,
    bookid INT,
    bookName VARCHAR(30) ,
    authorName VARCHAR(30),
    quantity INT
    

)")==true){


}
else {
    echo "Error creating table: " . $conn->error;
}
?>