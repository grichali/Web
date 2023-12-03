<?php
session_start();
function getNewCount($id_feedback){
    $p=new pdo("mysql:host=localhost;dbname=dbtravel","root","");
    $stm=$p->prepare("SELECT count(*) as c FROM likes WHERE Id_feedback = ?");
    $stm->execute([$id_feedback]);
    $row = $stm->fetch(PDO::FETCH_ASSOC);
    if($row){
        return $row['c'];
    }
    return 0;

}

function li($c,$s):bool{
    $p=new pdo("mysql:host=localhost;dbname=dbtravel","root","");
    $stm=$p->prepare("select * from likes where Id_feedback=? and username=?");
    $stm->execute([$c,$s]);
    $row=$stm->fetch();
    if($row){ 
        return true;
    }
    else{ return false;}
}
$array = ['is_success' => false, 'count' => 0 ,'type'=>''];
header("Content-Type: application/json");
if(isset($_SESSION['username'])){
    if(li($_POST["id"],$_SESSION["username"])){ 
        $k=new pdo("mysql:host=localhost;dbname=dbtravel","root","");
        $st=$k->prepare("delete from likes where Id_feedback=? and username=?");
        $st->execute([$_POST["id"],$_SESSION["username"]]);
        $array = ['is_success' => true, 'count' => getNewCount($_POST['id']),'type'=>'like'];
    }
    else{
    $p=new pdo("mysql:host=localhost;dbname=dbtravel","root","");
    $stm=$p->prepare("insert ignore likes(id_feedback,username) values(?,?)");
    $c=$stm->execute([$_POST["id"],$_SESSION["username"]]);
    $array = ['is_success' => $c, 'count' => getNewCount($_POST['id']),'type'=>'unlike'];}


}
echo json_encode($array);