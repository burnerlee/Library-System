<?php
include('credentials.php');
include_once('createDatabase.php');
include_once('createClientTableCheckin.php');
include_once('createClientTableCheckout.php');
include_once('createCurrentCheckout.php');
include_once('updateCurrentCheckout.php');
include_once('createPendingCheckin.php');
include('update_pendingCheckin.php');
include_once('createPendingCheckout.php');
include('update_pendingCheckout.php');
$conn=new mysqli($servername, $username, $password,$dbname);
?>

<html><head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel='stylesheet' href='stylesClient.css'>
</head>
    <body><h2>
Available Books to checkout:</h2>
<table id="dataAvailableTable">
<tr><td>Checkboxes</td><td>S.No.</td><td>Book Name</td><td>Author Name</td><td>Quantity Available</td><td>Quantity required</td></tr>
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
        }}
    }
    ?>
    </table>
    <br>
    <button id="checkout">checkout books</button>
    <button id="cancelCheckout">Cancel</button>
<br><br><br><h2>
Check in a book</h2>
<br><Br>
<select id="checkin" >
  <?php  
  $result=$conn->query("SELECT bookid,bookName,authorName FROM currentCheckout");

    if($result->num_rows>0){
      
        while($row=$result->fetch_assoc()){
            $row_id=$row['bookid'];       
            
            echo "<option value='$row_id'>".$row['bookName']." by ".$row['authorName']."</option>";
        }
    }
    $result=$conn->query("SELECT quantity,bookid FROM currentCheckout");
    $res=$result->fetch_assoc();
    $max_value=$res['quantity'];
    $bookid=$res['bookid'];
    $result=$conn->query("SELECT quantity FROM pendingCheckin WHERE bookid=$bookid");
    $pendingValue=0;
    if($result->num_rows>0){
      
        while($row=$result->fetch_assoc()){
            $pendingValue=$row['quantity']+$pendingValue;       
            
            
        }
    }
    $max_value=$max_value-$pendingValue;

  echo "
  
</select>


<input type='number' id='checkinNo' name='checkinBookQuantity' placeholder='Enter Book Quantity*' required='true' value=0 min=0 max='$max_value'></input>
<button type='submit' id='checkinSubmit'>Submit</button>

<br><br>";
?>
<br><br><br><br>
<h2>
<h2>
Currrent Loan</h2>
<table id="currentCheckoutTable">
<tr><td>S.No.</td><td>Book Name</td><td>Author Name</td><td>Quantity Taken</td></tr>
    <?php
    $result=$conn->query("SELECT bookName,authorName,quantity FROM currentCheckout");
    if($result->num_rows>0){
        $row_number=0;
        while($row=$result->fetch_assoc()){
            
            $row_number++;
            $class="checkbox";
            echo "<tr><td>$row_number</td><td>$row[bookName]</td><td>$row[authorName]</td><td>$row[quantity]</td>   </tr>";
        }
    }
    ?>
    </table>
    <br><br><h2>
All Checkout Requests</h2>
<table id="checkoutDataTable">
    <tr><td>S.No.</td><td>Book Name</td><td>Author Name</td><td>Quantity Checked out</td><td>Status</td></tr>

    <?php
    $result=$conn->query("SELECT bookName,authorName,quantity,stat FROM clientDataCheckout");
    if($result->num_rows>0){
        $row_number=0;
        while($row=$result->fetch_assoc()){
            
            $row_number++;
            $class="checkbox";
            echo "<tr><td>$row_number</td><td>$row[bookName]</td><td>$row[authorName]</td><td>$row[quantity]</td><td>$row[stat]</td></tr>";
        }
    }
    ?>
    </table>
    <br><br><h2>
All Checkin Requests</h2>
<table id="checkinDataTable">
<tr><td>S.No.</td><td>Book Name</td><td>Author Name</td><td>Quantity Checked in</td><td>Status</td></tr>
    <?php
    $result=$conn->query("SELECT bookName,authorName,quantity,stat FROM clientDataCheckin");
    if($result->num_rows>0){
        $row_number=0;
        while($row=$result->fetch_assoc()){
            
            $row_number++;
            $class="checkbox";
            echo "<tr><td>$row_number</td><td>$row[bookName]</td><td>$row[authorName]</td><td>$row[quantity]</td><td>$row[stat]</td></tr>";
        }
    }
    ?>
    </table>
    <br><br>
    
    </body>
    <script src='scriptClient.js'></script>
</html>