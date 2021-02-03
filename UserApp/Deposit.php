<?php

include("Datalabels.php");
include("db.php");

 $name = $_SESSION['username'];
 $co = mysqli_connect("localhost","root","","kaukocoin");

    
    if(isset($_POST['pildyti'])){
        $dep = $_POST["Deposit"];
        if(!is_numeric($dep)){
            echo"<h3>Turi buti ivestas skaicius</h3>";
          
        }
        if($dep <= 0){
            echo"<h3>Turi buti ivestas skaicius didesnis uz 0</h3>";
        }

        else{
        $usd+=$dep;

     $sql ="Insert INTO log (Username, Operacion, KCE, USD) Values('$name', 'Pinigu pildymas', 'Null', '$dep')";
        mysqli_query($co, $sql) ;
        $sql="Update users SET Usd='$usd', Bitcoin = '$btc' WHERE Username='$name'";
        if($co->query($sql)=== TRUE)
        {
            echo "<center> Papildete saskaita $dep usd</center>";
        }
        else{
            echo "Klaida";
           
        }
    }
}






?>