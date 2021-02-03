<?php

$servername = "localhost";
$username = "root";
$password = "";
$databaseName = "kaukocoin";
$conn = mysqli_connect($servername, $username, $password,$databaseName);

if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}
$begin = "2013-05-05";
$end= "2014-01-01";
 if(isset($_POST['submit']))
{
  $begin = textboxValue("begin");
  $end =textboxValue("end");
}
 $sql = "
 SELECT Price, 
 UNIX_TIMESTAMP(CONCAT_WS(' ', Timestamp)) AS datetime 
 FROM btcstory1
 WHERE Timestamp BETWEEN '$begin' AND '$end'
 
 ";
 $result = mysqli_query($conn, $sql);
$i=0;
  while($row = mysqli_fetch_assoc($result)){
    $i++;
}
        if($i <= 100000)
        {
            $jsonTable = json_encode(Filter($sql="
            SELECT Price, 
            UNIX_TIMESTAMP(CONCAT_WS(' ', Timestamp)) AS datetime 
            FROM btcstory1
            WHERE Timestamp BETWEEN '$begin' AND '$end'"));
        }
         if($i > 100000){
            $jsonTable = json_encode(Filter($sql="SELECT AVG(Price) As Price, 
            UNIX_TIMESTAMP(CONCAT_WS(' ', DATE(Timestamp))) AS datetime 
            FROM btcstory1
            WHERE Timestamp BETWEEN '$begin' AND '$end'
            group by Date(btcstory1.Timestamp) 
            "));
        }

        Function Filter($sql){

            $result = mysqli_query($GLOBALS['conn'], $sql);
            $rows = array();
            $table = array();
            $table['cols'] = array(
                array(
                 'label' => 'Date Time', 
                 'type' => 'datetime'
                ),
                array(
                 'label' => 'Price', 
                 'type' => 'number'
                ) 
               );     
            while($row = mysqli_fetch_assoc($result) )
            {   
                $sub_array = array();    
                $datetime = explode(".",$row["datetime"]);
                $sub_array[] =  array(
                     "v" => 'Date(' . $datetime[0] . '000)'
                    );
               $sub_array[] =  array(
                    "v" => $row["Price"]
                   );
               $rows[] =  array(
                   "c" => $sub_array
                  );
            }
            $table['rows'] = $rows;
            return $table;
        }
        function textboxValue($value){

            $textbox = mysqli_real_escape_string($GLOBALS['conn'], trim($_POST[$value]));
            if(empty($textbox))
            {
                return false;
            }
                
            else{
                return $textbox;
            }    
        }

?>