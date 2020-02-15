<?php
include('credentials.php');
$dbname="library";
$conn=new mysqli($servername, $username, $password,$dbname);
$bookid=$_POST['bookid'];
$res=$conn->query("SELECT * FROM currentCheckout WHERE bookid=$bookid");
$result=$res->fetch_assoc();
echo $result['quantity'];



?>