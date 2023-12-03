

<html>

<head>

</head>

<body>
    <form action="" method="post">
    <p>Veuillez choisir la categorie : </p>
    <select id="country" name="country">
      <?php
        $pdo = new PDO("mysql:host=localhost;dbname=dbtravel", "root", "");

        $query = "SELECT nom_pays FROM pays";
        $stmt = $pdo->prepare($query);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo '<option value="' . $row['nom_pays'] . '">' . $row['nom_pays'] . '</option>';
        }
      ?>
    </select>
    <input type="text" name="city" placeholder="city">
    <textarea name="description" id="" cols="30" rows="10"></textarea>
    <button>Add City</button>


    </form>
</body>


</html>




<?php 
if(isset($_POST["city"]) && isset($_POST["country"]) && isset($_POST["description"])){
    $city = $_POST["city"];
    $country = $_POST["country"];
    $desc = $_POST["description"];
    $pdo = new pdo("mysql:host=localhost;dbname=dbtravel","root","");
    $stm = $pdo->prepare("SELECT * FROM ville WHERE nom_ville = :nom ");
    $stm->bindValue(":nom",$city);
    $stm->execute();
    if($stm->rowCount() > 0 ){
        echo ' Cette ville est deja ajouter ';
        exit ;
    }
    else{
    $stm = $pdo->prepare("INSERT INTO ville VALUES(NULL,:nom, :count , :descr ) ");
    $stm->bindValue(":nom",$city);
    $stm->bindValue(":count",$country);
    $stm->bindValue(":descr",$desc);
    $stm->execute();
    echo $city.' a ete bien ajouter dans la pay'.$country;
    }

}



?>