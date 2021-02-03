<?php
include("db.php");



$name = $_SESSION['username'];

 $sql = "Select Bitcoin, Usd from users WHERE Username = '$name'";
 if ($result = mysqli_query($con, $sql)) {
     while($row = mysqli_fetch_assoc($result) )
     {
         $btc = $row['Bitcoin'];
         $usd = $row['Usd'];   
         
     }

 }

$lastID = mysqli_insert_id($con);
$sql = "Select Price from btcstory1 order by id desc limit 1";

if ($result = mysqli_query($con, $sql) or die("Price querry error")) {
    while($row = mysqli_fetch_assoc($result) )
    {
        $Price = $row['Price'];
    }
}
?>
