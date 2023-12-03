<?php session_start(); ?>
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
    <link rel="stylesheet" href="css/swiper-bundle.min.css" />

    <script src="swiper-bundle.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Architects+Daughter&display=swap" rel="stylesheet">
    <script src="//code.jquery.com/jquery-latest.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>
<body style="overflow-x:hidden;font-family: 'Architects Daughter', cursive;">
<!-- Navigation-->
<?php include "Navbar.php" ;?>
<!-- Header-->
    <div id="mok" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active c-div">
                <img class="d-block w-100 c-img carousel-image" src="images\Maroc\al hoceima\img1.jpg" alt="lwla" style="opacity: 0.7;">
                <div class="carousel-caption d-none d-md-block mt-4">
                </div>
            </div>
            <div class="carousel-item c-div">
                <img class="d-block w-100 c-img carousel-image" src="images\Maroc\marrakech\img1.jpg" alt="tanya" style="opacity: 0.7;">
                <div class="carousel-caption d-none d-md-block mt-4">
                </div>
            </div>
            <div class="carousel-item c-div">
                <img class="d-block w-100 c-img carousel-image" src="images\Norvège\bergen\img1.jpg" alt="talta" style="opacity: 0.7;">
                <div class="carousel-caption d-none d-md-block mt-4">
                </div>
            </div>
            <div class="carousel-item c-div">
                <img class="d-block w-100 c-img carousel-image" src="images\Pérou\cusco\img1.jpg" alt="talta" style="opacity: 0.7;">
                <div class="carousel-caption d-none d-md-block mt-4">
                </div>
            </div>
        </div>
    </div>


<!-- Section-->
<section class="py-5 container-fluid">



    <?php
        if(isset($_GET['subject'])){
            $_SESSION["adresse"] = $_GET['subject'] ;
            $pdo = new pdo("mysql:host=localhost;dbname=dbtravel","root","");
            $stm = $pdo->prepare("SELECT nom_ville FROM ville where nom_pay = :addr");
            $stm->bindParam(":addr" , $_GET['subject'] );
            $stm->execute();
            $products = $stm->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <div class="row  row-cols-md-3 row-cols-xl-4 justify-content-center ms-4" >
            <?php foreach($products as $product) { ?>
        
    
            <div class="col mb-5 ml-3">
            <div class="card h-100">
                <!-- Product image-->
                <img class="card-img-top" src="images/<?php echo $_GET['subject']?>/<?php echo $product["nom_ville"]?>/img1.jpg"  style="height : 250px;" alt="..." />
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
            <?php }else { 
            $pdo = new pdo("mysql:host=localhost;dbname=dbtravel","root","");
            $stm = $pdo->prepare("SELECT  nom_pays FROM pays ");
            $stm->execute();
            $products = $stm->fetchAll(PDO::FETCH_ASSOC); 
            ?>
            <div class="row row-cols-md-3 row-cols-xl-4 ms-4">
    <div id="madara" class="swiper-container" ">
      <div class="swiper-wrapper">
        <?php foreach ($products as $product) : ?>
          <div class="swiper-slide">
            <div class="card h-100">
              <img class="card-img-top" src="images/<?php echo $product['nom_pays']; ?>/img1.jpg"  style="height : 250px;"alt="..." />
              <div class="card-body">
                <div class="text-center">
                  <h5 class="fw-bolder"><?php echo $product['nom_pays']; ?></h5>
                </div>
              </div>
              <div class="card-footer text-center">
                <a class="btn btn-outline-dark" href="test2.php?subject=<?php echo $product['nom_pays']; ?>">Details</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
        <div class="col-auto">
            <div class="swiper-button-next" style="margin-top: 285px"></div>
        </div>
        <div class="col-auto">
            <div class="swiper-button-prev" style="margin-top: 285px"></div>
        </div></div>
    </div>
  </div>
  <?php } ?>
</section>
<!-- Footer-->
<?php include "Footer.php" ;?>

<script>
    window.onload = function(){

        const elementCarousel = $('.carousel');
        const carousel = new bootstrap.Carousel(elementCarousel, {autohide : false, interval: 2000})
        var swiper = new Swiper('#madara', {
            slidesPerView: 1,
            spaceBetween: 10,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    }


</script>
</body>
</html>
