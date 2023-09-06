<?php
$host="localhost";
$bd="studenthud";
$user="root";
$password="";

try {
        $conn=new PDO("mysql:host=$host;dbname=$bd",$user,$password);
        if ($conn){ echo"Conectado... a sistema ";}

} catch ( Exeption $ex) {
    
    echo $ex->getMessage();
}
?>