<?php
session_start();
function li($c,$s):bool{
    $p=new pdo("mysql:host=localhost;dbname=dbtravel","root","");
    $stm=$p->prepare("select * from favorites where username=? and nom_ville=?");
    $stm->execute([$c,$s]);
    $row=$stm->fetch();
    if($row){ 
        return true;
    }
    else{ return false;}
}
function getNewCountfav($user){
    $p=new pdo("mysql:host=localhost;dbname=dbtravel","root","");
    $stm=$p->prepare("SELECT count(*) as c FROM favorites WHERE username = ?");
    $stm->execute([$user]);
    $row = $stm->fetch(PDO::FETCH_ASSOC);
    if($row){
        return $row['c'];
    }
    return 0;

}
$ar = ['state' => "pas ajoutee aux favoris",'ajoute'=>3,'count'=>0];
header("Content-Type: application/json");
if(isset($_SESSION['username'])){
    if(li($_SESSION["username"],$_POST["dest"])){ 
        $k=new pdo("mysql:host=localhost;dbname=dbtravel","root","");
        $st=$k->prepare("delete from favorites where username=? and nom_ville=?");
        $st->execute([$_SESSION["username"],$_POST["dest"]]);
        $ar = ['state' => "supprimee avec succes de favoris","ajoute"=>0,'count'=>getNewCountfav($_SESSION["username"])];
    }
    else{
        $p=new pdo("mysql:host=localhost;dbname=dbtravel","root","");
        $stm=$p->prepare("insert ignore favorites(username,nom_ville) values(?,?)");
        $c=$stm->execute([$_SESSION["username"],$_POST["dest"]]);
        $ar = ['state' => "ajoutee avec succes aux favoris","ajoute"=>1,'count'=>getNewCountfav($_SESSION["username"])];
    

}

echo json_encode($ar);



}

?>