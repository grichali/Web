<?php

class addfeedback{
private $pdo;
private $stm;
public function add($comment , $nomdestination , $username){
    $this->pdo = new pdo("mysql:host=localhost;dbname=dbtravel","root","");
    $this->stm = $this->pdo->prepare("INSERT INTO feedback VALUES(NULL,3,:nomdes,:user,:comme)");
    $this->stm->bindValue(":nomdes" , $nomdestination );
    $this->stm->bindValue(":user" , $username );
    $this->stm->bindValue(":comme" , $comment );
    $this->stm->execute();
}

}


?>