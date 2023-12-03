<?php
session_start();?>
<html>
<head>
<title>Favoris</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="shipping.png" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Architects+Daughter&display=swap" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet" /><style>
.login{
    text-decoration:none;

}
.cr{
    background-color:rgb(0, 191, 255);
}
.mytm{
    border: bg-transparent;
    border-radius: 5px;
}
</style>
</head>
<body style="font-family:'Architects Daughter', cursive;">

<?php include "Navbar.php";?>
<div class="container">
<ul class="list-group cr mt-2" >
<?php try{
$p=new pdo("mysql:host=localhost;dbname=dbtravel","root","");
$a=$p->prepare("select f.nom_ville,v.nom_pay from favorites as f INNER JOIN ville as v  ON f.nom_ville=v.nom_ville where username=?");
$a->execute([$_SESSION["username"]]);
$fav=$a->fetchAll(PDO::FETCH_ASSOC);

foreach($fav as $f){

echo'<a  class="list-group-item list-group-item-action mb-2 " aria-current="true">
<div class="d-flex w-100 justify-content-between">

    <h5 >'.ucfirst($f['nom_ville']).'<p>dans le pays '.ucfirst($f['nom_pay']).'</p>
    
    </h5><img class="mytm" src="images/'.$f['nom_pay'].'/'.$f['nom_ville'].'/img1.jpg" style="height:150; width:300">
    
    
</div>

<p class="mb-1"></p>
<small>
  favoris
</small>


</a>';} }catch(PDOException $e){echo $e->getMessage();}?>
</ul>
</div>


</body>