<?php
function li($c,$s):bool{
    $p=new pdo("mysql:host=localhost;dbname=dbtravel","root","");
    $stm=$p->prepare("select * from likes where Id_feedback=? and username=?");
    $stm->execute([$c,$s]);
    $row=$stm->fetch();
    if($row){ 
        return true;
    }
    else{ return false;}}
function getNewCount($id_feedback){
    $p = new PDO("mysql:host=localhost;dbname=dbtravel", "root", "");
    $stm = $p->prepare("SELECT count(*) as c FROM likes WHERE Id_feedback = ?");
    $stm->execute([$id_feedback]);
    $row = $stm->fetch(PDO::FETCH_ASSOC);
    if($row){
        return $row['c'];
    }
    return 0;
}

class AddComments {
    private $pdo;
    private $stm;
    private $work = true;

    public function addAllComments($nomdestination) {
        if ($this->work) {
            $this->pdo = new PDO("mysql:host=localhost;dbname=dbtravel", "root", "");
            $this->stm = $this->pdo->prepare("SELECT commentaire, username, id_feedback FROM feedback WHERE nom_pay = :dest");
            $this->stm->bindValue(":dest", $nomdestination);
            $this->stm->execute();
            $users = $this->stm->fetchAll(PDO::FETCH_ASSOC);

            foreach ($users as $user) {
                $str=li($user["id_feedback"],$user["username"]);
                $btn="";
                if($str){
                    $btn='<i class="bi bi-hand-thumbs-down"></i>'.getNewCount($user["id_feedback"]);
                }
                else{
                    $btn='<i class="bi bi-hand-thumbs-up"></i>'.getNewCount($user["id_feedback"]);
                }
                echo '<div class="comment-box" style="padding: 10px; margin-bottom: 20px;">
                    <div class="comment">
                        <i class="bi bi-person" style="font-size: 4rem;"></i>
                        <label>' . $user["username"] . '</label>
                    </div>
                    <div class="comment">' . $user["commentaire"] . '</div>
                </div>
                <button class="likebutton" value="' . $user["id_feedback"] . '" type="button">'.$btn.'</button>';
            }
            $this->work = false;
        }
    }

    public function addoneComment($comment, $username) {

        echo '<div id="kl" class="comment-box" style="padding: 10px; margin-bottom: 20px;">
            <div class="comment">
                <i class="bi bi-person" style="font-size: 4rem;"></i>
                <label>' . $username . '</label>
            </div>
            <div class="comment">' . $comment . '</div>
        </div>';
}
}
?>