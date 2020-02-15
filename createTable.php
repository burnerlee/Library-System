<?php
$dbname="library";
$conn=new mysqli($servername, $username, $password,$dbname);
if($conn->query("CREATE TABLE IF NOT EXISTS bookData(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    bookName VARCHAR(30) ,
    authorName VARCHAR(30),
    quantity INT
   

)")==true){


}
else {
    echo "Error creating table: " . $conn->error;
}
?>