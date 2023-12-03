

<html>

<head>

</head>

<body>
    <form action="" method="post">

    <input type="text" name="country" placeholder="Country name">
    <select id="continent" name="continent">
      <option value="Afrique">Afrique</option>
      <option value="Amérique">Amérique</option>
      <option value="Asie">Asie</option>
      <option value="Europe">Europe</option>
      <option value="Océanie">Océanie</option>
    </select>
    <button>Add</button>


    </form>
</body>


</html>




<?php 
if(isset($_POST["country"]) && isset($_POST["continent"])){
    $country = $_POST["country"];
    $continent = $_POST["continent"];
    $pdo = new pdo("mysql:host=localhost;dbname=dbtravel","root","");
    $stm = $pdo->prepare("INSERT INTO PAYS VALUES (NULL,:nom,:continent)");
    $stm->bindValue(":nom",$country);
    $stm->bindValue(":continent",$continent);
    $stm->execute();
    echo $country.' A ete bien ajouter .';


}



?>