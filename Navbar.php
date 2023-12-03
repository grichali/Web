<?php function getNewCountfav($user){
    $p=new pdo("mysql:host=localhost;dbname=dbtravel","root","");
    $stm=$p->prepare("SELECT count(*) as c FROM favorites WHERE username = ?");
    $stm->execute([$user]);
    $row = $stm->fetch(PDO::FETCH_ASSOC);
    if($row){
        return $row['c'];
    }
return 0;
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin : 0px ; height : 80px ; width: 100%">
        <div class="container" style="padding : 0px ; height: 80px;">
            <a class="navbar-brand" href="test2.php"> <img src="images/logo.png" style="height : 120px ; " ></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="test2.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="ContactUs.php">Contact Us</a></li>
                </ul>
        <form class="d-flex">
                <button class="btn btn-outline-dark" type="submit">
                <?php if(isset($_SESSION["username"])){?>
                    <a href="affichefav.php"><i class="bi bi-heart-fill"></i>
                    Favoris<span id="nbrfav" class="badge bg-dark text-white ms-1 rounded-pill"><?php  echo getNewCountfav($_SESSION["username"]);?></span></a><?php }
                    else{?>
                     <a id="login" href="login.php"><i class="bi bi-person-circle mr-2"></i> Log in</a>
                     <?php }?>

                        
                </button>
        </form>
            </div>
        </div>
</nav>