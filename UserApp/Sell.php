<?php

include("Datalabels.php");
include("db.php");

 $name = $_SESSION['username'];
 $co = mysqli_connect("localhost","root","","kaukocoin");

    
    if(isset($_POST['parduoti'])){
        $sell = $_POST["Sell"];
        if(!is_numeric($sell)){
            echo"<h3>Turi buti ivestas skaicius</h3>";
          
        }
        if($sell <= 0){
            echo"<h3>Turi buti ivestas skaicius didesnis uz 0</h3>";
        }
        if(($sell * $Price) > $btc){
            echo"<h3>Neturite tiek KKc</h3>";

        }
        else{

        $usd = $usd + ($Price * $sell);
        $btc-=$sell;
        $Tarpinis = $Price * $sell;
        $Price= $Price +($Price * RAND(-5,5)/100);

        
        
     $sql ="Insert INTO log (Username, Operacion, KCE, USD) Values('asdf', 'Pardavimas', '$sell', '$Tarpinis')";
        mysqli_query($co, $sql) ;
        $sql ="Insert INTO btcstory1(Timestamp, Price, Amount) Values(CURRENT_TIMESTAMP(), '$Price', '$sell')";
        mysqli_query($co, $sql) ;
        $sql="Update users SET Usd='$usd', Bitcoin = '$btc' WHERE Username='$name'";
        if($co->query($sql)=== TRUE)
        {
            echo "<center> Pardavete $sell uz $Tarpinis Usd</center>";
        }
        else{
            echo "Klaida";
           
        }
    }
}






?>