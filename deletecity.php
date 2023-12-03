<html>

<head>

</head>

<body>
    <form action="" method="post">
        <p>Veuillez choisir la catégorie : </p>
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
        <input type="text" name="city" placeholder="Ville">
        <button type="submit" name="delete">Supprimer la ville</button>
    </form>
</body>

</html>

<?php
if (isset($_POST["city"]) && isset($_POST["country"]) && isset($_POST["delete"])) {
    $city = $_POST["city"];
    $country = $_POST["country"];
    $pdo = new PDO("mysql:host=localhost;dbname=dbtravel", "root", "");
    $stm = $pdo->prepare("DELETE FROM ville WHERE nom_ville = :nom AND nom_pay = :count");
    $stm->bindValue(":nom", $city);
    $stm->bindValue(":count", $country);
    $stm->execute();
    if ($stm->rowCount() > 0) {
        echo $city . ' a été supprimée de la catégorie ' . $country;
    } else {
        echo 'La ville ' . $city . ' n\'existe pas dans la catégorie ' . $country;
    }
}
?>
