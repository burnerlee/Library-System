<?php
include('credentials.php');
$dbname="library";
$conn=new mysqli($servername, $username, $password,$dbname);
$finalid=$_POST['checkinId'];
$response=$_POST['response'];
$res=$conn->query("SELECT * FROM pendingCheckin WHERE id=$finalid");
$result=$res->fetch_assoc();
$requestid=$result['requestid'];
$quantityinsert=$result['quantity'];
$bookid=$result['bookid'];
$bookName=$result['bookName'];
$authorName=$result['authorName'];
$conn->query("DELETE FROM pendingCheckin WHERE id=$finalid");
if($response==0){
    $conn->query("UPDATE clientDataCheckin SET stat='declined' WHERE id=$requestid");
}
if($response==1){
    $conn->query("UPDATE clientDataCheckin SET stat='accepted' WHERE id=$requestid");
    if($bookid==null){
    
    $stmt = $conn->prepare("INSERT INTO bookData (id,bookName,authorName,quantity) VALUES (?,?, ?, ?)");
    $stmt->bind_param("issi",$id, $bookName , $authorName, $quantityinsert);
    $stmt->execute();
    } 
    else{
        $res=$conn->query("SELECT * FROM bookData WHERE id=$bookid");
        $result=$res->fetch_assoc();
        $originalQuantity=$result['quantity'];
        $conn->query("UPDATE bookData SET quantity=$originalQuantity+$quantityinsert WHERE id=$bookid");
        $res=$conn->query("SELECT * FROM currentCheckout WHERE bookid=$bookid");
        $result=$res->fetch_assoc();
        $originalQuantity=$result['quantity'];
        $res=$conn->query("UPDATE currentCheckout SET quantity=$originalQuantity-$quantityinsert WHERE bookid=$bookid");

    }
}

?>