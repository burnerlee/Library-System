<?php
include('credentials.php');
$dbname="library";
$conn=new mysqli($servername, $username, $password,$dbname);
$finalid=$_POST['checkoutId'];
$response=$_POST['response'];
$res=$conn->query("SELECT * FROM pendingCheckout WHERE id=$finalid");
$result=$res->fetch_assoc();
$requestid=$result['requestid'];
$quantityNeeded=$result['quantity'];
$bookid=$result['bookid'];
$conn->query("DELETE FROM pendingCheckout WHERE id=$finalid");

if($response==0){
    $conn->query("UPDATE clientDataCheckout SET stat='declined' WHERE id=$requestid");
}
else if($response==1){
    $res=$conn->query("SELECT * FROM bookData WHERE id=$bookid");
    $result=$res->fetch_assoc();
    $bookName=$result['bookName'];
    $authorName=$result['authorName'];
    $originalQuantity=$result['quantity'];
    if($quantityNeeded<=$originalQuantity){
    $conn->query("UPDATE clientDataCheckout SET stat='accepted' WHERE id=$requestid");
   
    $conn->query("UPDATE bookData SET quantity=$originalQuantity-$quantityNeeded WHERE id=$bookid;");
    if($result=$conn->query("SELECT * FROM currentCheckout WHERE bookid=$bookid")->num_rows>0){
        $res=$conn->query("SELECT * FROM currentCheckout WHERE bookid=$bookid");
        $result=$res->fetch_assoc();
        $originalQuantity=$result['quantity'];
        $conn->query("UPDATE currentCheckout SET quantity=$originalQuantity+$quantityNeeded WHERE bookid=$bookid");
        echo "Checked Out";
    }
    else{

    $stmt = $conn->prepare("INSERT INTO currentCheckout (bookid,bookName,authorName,quantity) VALUES (?,?, ?, ?)");
    $stmt->bind_param("issi",$bookid, $bookName , $authorName, $quantityNeeded);
    $stmt->execute();
    echo "Checked Out";

    }


    }
    else{
        echo "not enough books";
    }

}
else
{
    echo "error";
}
?>