<?php
ob_start();
session_start();
require"addfeedback.php";
require"addcomments.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Let's Travel</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="shipping.png" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Architects+Daughter&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>

<body style="font-family: 'Architects Daughter', cursive;">
<!-- Navigation-->

<div id="mymodl" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="titmodl" class="modal-title"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div id="bodymodl" class="modal-body">
        <p></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
<style> 
#login{
    text-decoration:none;

}
</style>
<!-- Navigation-->

<?php include "Navbar.php";?>
<?php
// if(!isset($_GET['subject'])){
//     header("Location: test2.php");
//     exit();
// }
if (isset($_GET['subject'])){
$dest = $_GET['subject'];
$_SESSION["nomdestination"] = $dest ;
$pdo = new PDO("mysql:host=localhost;dbname=dbtravel","root","");
$stm = $pdo->prepare("SELECT * FROM ville WHERE nom_ville = :dest");
$stm->bindValue(":dest" , $dest);
$stm->execute();
$u = $stm->fetch(PDO::FETCH_ASSOC);
$pay = $u['nom_pay'];

if(!$u){
    header("Location: test2.php");
    exit();

}



?>

<div class="des" style="overflow-y:scroll; overflow-x: hidden; ">
    <?php

    echo'<div class="igm"><a href="description.php"><img id="imagebox" style=" width:480px;
  height:300px;" src="images/'.$u["nom_pay"].'/'.$_SESSION["nomdestination"].'/img1.jpg" onclick="show(this)"></a><button type="button" id="bntlmskina" class="btn-outline-light"
  style="border-radius: 50%; "><i class="bi bi-heart-fill" style="color: rgb(23, 148, 250);"></i></button>';?>
        <div class="slider">
            <div class="tr"><?php echo'<img class="slideri" src="images/'.$u["nom_pay"].'/'.$_SESSION["nomdestination"].'/img1.jpg"
                                 onclick="show(this)" alt="Image 1"></div>';?>
             <div class="tr"><?php echo'<img class="slideri" src="images/'.$u["nom_pay"].'/'.$_SESSION["nomdestination"].'/img2.jpg"
                                 onclick="show(this)" alt="Image 1"></div>';?>
             <div class="tr"><?php echo'<img class="slideri" src="images/'.$u["nom_pay"].'/'.$_SESSION["nomdestination"].'/img3.jpg"
                                 onclick="show(this)" alt="Image 1"></div>';?>
              <div class="tr"><?php echo'<img class="slideri" src="images/'.$u["nom_pay"].'/'.$_SESSION["nomdestination"].'/img4.jpg"
                                 onclick="show(this)" alt="Image 1"></div>';?>
        </div>
    </div>



<section class="after">
    <ul>
        <li type="I">
            <h4 id="tit">Description</h4>
        </li>
    </ul>
    <p id="par">
        <?php echo$u["description"]; } ?>
    </p>
</section>
</div>
 <?php
    $pdo = new pdo("mysql:host=localhost;dbname=dbtravel","root","");
    $stm = $pdo->prepare("SELECT nom_ville FROM ville where nom_pay = :addr");
    $stm->bindParam(":addr" , $u["nom_pay"] );
    $stm->execute();
    $products = $stm->fetchAll(PDO::FETCH_ASSOC);
    
 ?><div class="container"><h1 class="mt">Recommandée</h1>
        <div class="row  row-cols-md-3 row-cols-xl-4 justify-content-center ms-4 mt-5" >
            <?php foreach($products as $product) { ?>
        
    
            <div class="col mb-5 ml-3">
            <div class="card h-100">
                <!-- Product image-->
                <img class="card-img-top" src="images/<?php echo $u["nom_pay"] ?>/<?php echo $product["nom_ville"]?>/img1.jpg"  style="height : 250px;" alt="..." />
                <!-- Product details-->
                <div class="card-body p-4">
                    <div class="text-center">
                        <h5 class="fw-bolder"><?php echo $product["nom_ville"] ?></h5>
                    </div>
                </div>
                <!-- Product actions-->
                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="description.php?subject=<?php echo $product["nom_ville"] ?>">Details</a></div>
                </div>
            </div>
            </div>
            <?php } ?>
            </div>
            </div>
<div class="comments form-group">
    <form method="post" action="">
        <label for="comment">Comment</label>
        <textarea class="form-control" name="comment" placeholder="add comment" rows="3" cols="100"></textarea><br>
        <input class="btn btn-primary" type="submit" name="submitInfo" value="Envoyer">
    </form>

    <?php

    $obj2 = new addcomments();
    $obj2->addallcomments($_SESSION["nomdestination"]);
    if(isset($_POST["comment"])){?>

        <?php
        if(isset($_SESSION["username"])){
            $obj1 = new addfeedback();
            $obj1->add($_POST["comment"], $_SESSION["nomdestination"], $_SESSION["username"]);
        }
        else{
            ?>
            <!DOCTYPE html>
            <html>
            <head>
                <script>
                    alert("You need to be logged in to perform this action.");
                    window.location.href = "login.php";
                </script>
            </head>
            <body>
            <!-- Your HTML content here -->
            </body>
            </html>
            <?php
            exit();
        }
        ?>
<?php }?>
<div style="height : 10px;">

</div>

</div>

<footer class="py-4 bg-dark" style="height: 300px;">
    <div class="container" style="height: 270px;">
        <div class="row">
            <div class="col-md-4">
                <h5>Contact Us</h5>
                <p class="text-white">
                    123 Travel Street<br>
                    City, Country<br>
                    info@example.com<br>
                    +123 456 7890
                </p>
            </div>
            <div class="col-md-4">
                <h5>Explore</h5>
                <ul>
                    <li><a href="#">Destinations</a></li>
                    <li><a href="#">Travel Guides</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Follow Us</h5>
                <ul class="social-media">
                    <li><a href="#"><i class="bi bi-facebook"></i></a></li>
                    <li><a href="#"><i class="bi bi-twitter"></i></a></li>
                    <li><a href="#"><i class="bi bi-instagram"></i></a></li>
                    <li><a href="#"><i class="bi bi-pinterest"></i></a></li>
                </ul>
            </div>
        </div>
        <hr>
        <p class="m-0 text-center text-white">© 2023 Your Website. All rights reserved.</p>
    </div>
</footer>
<script>
    function show(smallimg) {
        var fullimg = document.getElementById("imagebox");
        fullimg.src = smallimg.src;
    }


            let ar=document.getElementsByClassName("likebutton");
            for(let i=0;i<ar.length;i++){
                ar[i].addEventListener("click",function like(){
                    $.ajax(
                        {
                        method: "POST",
                        url: "likes.php",
                        data: { id: ar[i].value },
                        success: function(data){
                            if(data['is_success'] === true){
                                if(data['type']=="like"){
                                    str='<i class="bi bi-hand-thumbs-up"></i>'
                                }
                                else if(data['type']=="unlike"){
                                    str='<i class="bi bi-hand-thumbs-down"></i>'
                                }
                                ar[i].innerHTML = str + data['count'];
                            }
                        }
                    })
                })
                
            }
            const subject = window.location.search;
            const urlParams = new URLSearchParams(subject);
            const nom_destination=urlParams.get("subject");
            let title= document.getElementById("titmodl");
            let nbr=document.getElementById("nbrfav");
           let body=document.getElementById("bodymodl");

            let a=document.getElementById("bntlmskina");
                a.addEventListener("click",function push(){
                    $.ajax({
                        method: "POST",
                        url: "favorites.php",
                        data: {dest:nom_destination},
                        success:function(data){
                                str=data['state'];
                                const myModa = new bootstrap.Modal('#mymodl');
                                if(data['ajoute']==1){
                                    a.innerHTML = '<i class="bi bi-heart-fill"></i>';
                                }
                                else if(data['ajoute']==0){
                                    a.innerHTML='<i class="bi bi-heart"></i>';
                                }
                                title.innerHTML="Notification";
                                body.innerHTML=str;
                                nbr.innerHTML=data['count'];
                                myModa.show();
                                setTimeout(function(){
                                    myModa.hide();
                                },8000)


                        }

                    })

                })
                

</script>
</body>

<?php ob_flush(); ?>