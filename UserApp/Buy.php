<?php

include("Datalabels.php");
include("db.php");

 $name = $_SESSION['username'];
 $co = mysqli_connect("localhost","root","","kaukocoin");

    
    if(isset($_POST['pirkti'])){
        $buy = $_POST["Buy"];
        if(!is_numeric($buy)){
            echo"<h3>Turi buti ivestas skaicius</h3>";
          
        }
        if($buy <= 0){
            echo"<h3>Turi buti ivestas skaicius didesnis uz 0</h3>";
        }
        if(($Price * $buy) > $usd){
            echo"<h3>Per mazai pinigu saskaitoje</h3>";

        }
        else{

        $usd = $usd - ($Price * $buy);
        $btc+=$buy;
        $Tarpinis = $Price * $buy;
        $Price= $Price +($Price * RAND(-5,5)/100);

        
        
     $sql ="Insert INTO log (Username, Operacion, KCE, USD) Values('asdf', 'Pirkimas', '$buy', '$Price * $buy')";
        mysqli_query($co, $sql) ;
        $sql ="Insert INTO btcstory1(Timestamp, Price, Amount) Values(CURRENT_TIMESTAMP(), '$Price', '$buy')";
        mysqli_query($co, $sql) ;
        $sql="Update users SET Usd='$usd', Bitcoin = '$btc' WHERE Username='$name'";
        if($co->query($sql)=== TRUE)
        {
            echo "<center> Nusipirkote $buy uz $Tarpinis  Usd</center>";
        }
        else{
            echo "Klaida";
           
        }
    }
}






?>