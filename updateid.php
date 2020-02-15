<?php
include('credentials.php');
$dbname="library";
$conn=new mysqli($servername, $username, $password,$dbname);
$result=$conn->query("SELECT id FROM bookData");
<table id="dataTable">
    <?php
    $result=$conn->query("SELECT id from ");
    if($result->num_rows>0){
        $row_number=0;
        while($row=$result->fetch_assoc()){
            $row_number++;
            $class="checkbox";
            echo "<tr id='$row_number'><td><input type='checkbox' class='$class ' name='$row_number'></td><td>".$row_number."</td><td>".$row['bookName']."</td><td>".$row['authorName']."</td><td>".$row['quantity']."</td></tr>";
        }
    }
    ?>
    </table>




      exit;
}
?>