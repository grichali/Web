<?php

$pdo = new pdo("mysql:host=localhost;dbname=dbtravel","root","");
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $stm = $pdo->prepare("SELECT * FROM personne WHERE username = :username and password = :password");
    $stm->bindParam(":username" , $username);
    $stm->bindParam(":password" , $password);
    $stm->execute();
    if($stm->rowCount() > 0){
        $user = $stm->fetch(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION["username"] = $user["username"];
        $_SESSION["nom"] = $user["nom"];
        $_SESSION["prenom"] = $user["prenom"];
        header("location: test2.php");
    }
    if($stm->rowCount() <= 0){
        header("location:login.php");
    }

}

?>