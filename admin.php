<?php

include('credentials.php');
include_once('createDatabase.php');
include_once('createTable.php');
include_once('createPendingCheckin.php');
include('update_pendingCheckin.php');
include_once('createPendingCheckout.php');
include('update_pendingCheckout.php');
include_once('createRespondedCheckin.php');
include_once('createRespondedCheckout.php');
include_once('createCurrentCheckout.php');
include_once('updateCurrentCheckout.php');

include_once('createClientTableCheckin.php');
include_once('createClientTableCheckout.php');

$conn=new mysqli($servername, $username, $password,$dbname);

?>

<html><head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel='stylesheet' href='stylesAdmin.css'>
</head>
    <body><h2>
        All Available Books</h2>
<br>
        
    <div id='bookAddInput'>
    <form id='myForm' action='./addData.php' method='post'>
    <input type='text' name='bookName' placeholder='Enter Book Name*'required='true'></input>
    <input type='text' name='authorName' placeholder='Enter Author Name'></input>
    <input type='number' name='bookQuantity' placeholder='Enter Book Quantity*' required='true' min=0></input>
    <button id='bookAddSubmit' type='submit'>Submit</button>
    </form>
    
    </div>
    
    <table id="dataTable"><thead>
        <tr><td>Checkboxes</td><td>S.No.</td><td>Book Name</td><td>Author Name</td><td>Quantity Available</td><td>Quantity required</td></tr></thead>
    <?php
    $result=$conn->query("SELECT id,bookName,authorName,quantity FROM bookData");
    if($result->num_rows>0){
        $row_number=0;
        while($row=$result->fetch_assoc()){
            $max_value=$row['quantity'];
            if($max_value>0){
            $row_id=$row['id'];
            $row_number++;
            $class="checkbox";
            
            echo "<tr><td><input type='checkbox' class='$class' name='$row_id'></td><td>$row_number</td><td>$row[bookName]</td><td>$row[authorName]</td><td>$row[quantity]</td><td><input class='enterQuantity' type='number' min=1 max='$max_value' name='$row_id' value=1></input</td></tr>";
        }
    else{
        $bookid=$row['id'];
        $conn->query("DELETE FROM bookName WHERE id=$bookid");
    }}
    }
    ?>
    </table> <br>
    <button id='addBook'>Add Book</button>
    <button id='deleteRequest'>Delete Items</button>
    <button id='delete' type='submit'>Delete Selected Items</button>
    <br><br>
    <h2>
    Pending Checkin Requests <br>
</h2>
    <table id="pendingCheckinTable"><thead>
    <tr><td>S.No.</td><td>Book Name</td><td>Author Name</td><td>Quantity</td></tr></thead>
    <?php
    $result=$conn->query("SELECT id,bookid,bookName,authorName,quantity FROM pendingCheckin");
    if($result->num_rows>0){
        $row_number=0;
        while($row=$result->fetch_assoc()){
            $row_id=$row['id'];
            $row_number++;
            $class="checkbox";
            echo "<tr id=$row_id><td>$row_number</td><td>$row[bookName]</td><td>$row[authorName]</td><td>$row[quantity]</td><td><button class='checkinAccept' id='acceptCheckin.$row_id'>Accept</button></td><td><button class='checkinDecline' id='declineCheckin.$row_id'>Decline</td></tr>";
        }
    }
    ?>
    </table> <br><br><h2>
    Pending Checkout Requests </h2><br><br>
    <table id="pendingCheckoutTable"><thead>
    <tr><td>S.No.</td><td>Book Name</td><td>Author Name</td><td>Quantity</td></tr></thead>
    <?php
    $result=$conn->query("SELECT id,bookid,bookName,authorName,quantity FROM pendingCheckout");
    if($result->num_rows>0){
        $row_number=0;
        while($row=$result->fetch_assoc()){
            $row_id=$row['id'];
            $row_number++;
            $class="checkbox";
            echo "<tr id=$row_id><td>$row_number</td><td>$row[bookName]</td><td>$row[authorName]</td><td>$row[quantity]</td><td><button class='checkoutAccept' id='acceptCheckout.$row_id'>Accept</button></td><td><button class='checkoutDecline' id='declineCheckout.$row_id'>Decline</td></tr>";
        }
    }
    ?>
    </table> <br><br><h2>
    Responded Checkout Requests </h2><br><br>
    <table id="respondedCheckoutTable"><thead>
    <tr><td>S.No.</td><td>Book Name</td><td>Author Name</td><td>Quantity</td><td>Decision Taken</td></tr></thead>
    <?php
    $result=$conn->query("SELECT id,bookid,bookName,authorName,quantity,stat FROM respondedCheckout");
    if($result->num_rows>0){
        $row_number=0;
        while($row=$result->fetch_assoc()){
            $row_id=$row['id'];
            $row_number++;
            $class="checkbox";
            echo "<tr><td>$row_number</td><td>$row[bookName]</td><td>$row[authorName]</td><td>$row[quantity]</td><td>$row[stat]</td></tr>";
        }
    }
    ?>
    </table>
    <br><Br><h2>
    Responded Checkin Requests</h2>
   <br><br>
    <table id="respondedCheckinTable"><thead>
    <tr><td>S.No.</td><td>Book Name</td><td>Author Name</td><td>Quantity</td><td>Decision Taken</td></b></tr></thead>
    <?php
    $result=$conn->query("SELECT id,bookid,bookName,authorName,quantity,stat FROM respondedCheckin");
    if($result->num_rows>0){
        $row_number=0;
        while($row=$result->fetch_assoc()){
            $stat=$row['stat'];
            $row_number++;
            $class="checkbox";
            echo "<tr><td>$row_number</td><td>$row[bookName]</td><td>$row[authorName]</td><td>$row[quantity]</td><td>$row[stat]</td></tr>";
        }
    }
    ?>
    </table>
    </body>
    <script src='scriptAdmin.js'></script>
</html>

