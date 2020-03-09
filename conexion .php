<?php 
 
    $dbn = "excursion";
    $host = "mysql:host=localhost;dbname=".$dbn;
    $user = "root";
    $password = "";
    $attr = [PDO::ATTR_PERSISTENT => true];
    try{
        $conex = new PDO($host,$user,$password,$attr);
        $conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo "Error::".$e->getMessage();                
    }
?>
