<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Shop Homepage - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
<?php include "Navbar.php" ;?> 
<div class="jami">
        <h1 class="text-center mt-5" style="overflow:hidden;">Sign Up</h1>
        <div class="row justify-content-center">
            <div class="col-md-6" >
                <form action="register.php" method="post">
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Username" name="username">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="First Name" name="firstname">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Last Name" name="lastname">
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
                <?php
                    session_start();
                    $host = "localhost";
                    $user = "root";
                    $pass = "";
                    $bd = "dbtravel";
                    $pdo = new PDO("mysql:host=$host;dbname=$bd",$user,"");
                    $stm = $pdo->prepare("INSERT INTO personne (nom, prenom , username , password) 
                    VALUES (:nom, :prenom, :username, :password)") ;
                    if ($_SERVER["REQUEST_METHOD"] == "POST"){
                        $stm->bindValue(':nom', $_POST['lastname']);
                        $stm->bindValue(':prenom', $_POST['firstname']);
                        $stm->bindValue(':username', $_POST['username']);
                        $stm->bindValue(':password', $_POST['password']);
                        $stm->execute();
                        $_SESSION['username'] = $_POST['username'];
                        header("location:test2.php");
                    }
                ?>
            </div>
        </div>
    </div>



</body>
<?php include "Footer.php" ;?>
</html>