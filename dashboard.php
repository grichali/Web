<?php
session_start();
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
?><!DOCTYPE html>
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

    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Architects+Daughter&display=swap" rel="stylesheet">
    <script src="//code.jquery.com/jquery-latest.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script></head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<body>

<style>
.fro{
  border: 0 solid transparent;
  border-radius: 16px 4px 10px 4px;
  border-top-width: 4px;
  border-left-width: 4px;
  border-image-source: url(transparent-image.png);
  border-image-slice: 4 fill;
  border-image-width: 4px;
}
</style>
   
<div class="d-flex mb-4 border-b border-gray-200 dark:border-gray-700" style="height:70px;">
    <div class="fro" ><img src="images/logo.png" style="height:100px; width:100px; position: relative;"></div>
    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
        <li class="mr-2" role="presentation">
            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false"><i class="bi bi-person-fill"></i> Profile</button>
        </li>
        <li class="mr-2" role="presentation">
            <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false"><i class="bi bi-pie-chart-fill"></i> Dashboard</button>
        </li>
        <li class="mr-2" role="presentation">
            <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="settings-tab" data-tabs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false"><i class="bi bi-sliders"></i>  Settings</button>
        </li>
        <li role="presentation">
            <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="contacts-tab" data-tabs-target="#contacts" type="button" role="tab" aria-controls="contacts" aria-selected="false"><i class="bi bi-person-vcard-fill"></i> Contacts</button>
        </li>
    </ul>
</div>
<div id="myTabContent">
    <div class="hidden p-4 rounded-lg " id="profile" role="tabpanel" >
        <p>Profile</p>
    </div>
    <div class="hidden p-4 rounded-lg " id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
    <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Utilisateurs inscrits</h5>
            <canvas id="usersChart"></canvas>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Favoris</h5>
            <canvas id="favoritesChart"></canvas>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Commentaires</h5>
            <canvas id="commentsChart"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
    </div>
    <div class="hidden p-4 rounded-lg " id="settings" role="tabpanel" aria-labelledby="settings-tab"><?php if(isset($_GET["tableau"])){
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=dbtravel", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             $table = $_GET["tableau"];
        
            $stmt = $pdo->query("SELECT * FROM $table");
            $columns = array();
        
            for ($i = 0; $i < $stmt->columnCount(); $i++) {
                $colMeta = $stmt->getColumnMeta($i);
                $columns[] = $colMeta['name'];
            }
        
            echo' <table class="table">
            <thead>
              <tr>';          
            foreach ($columns as $column) {
                echo'<th scope="col">'.$column.'</th>';
            } ?><th>Suprimer</th></tr></thead><tbody><tr><?php
            $stmt = $pdo->query("SELECT * FROM $table");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $row) {
        foreach ($row as $value) {
            echo '<td>'.trim($value) .'</td>';
        }echo'</tr></tbody>';
    }
        } catch (PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
            exit();
        }}
        else {
            $host = "localhost";
            $dbname = "dbtravel";
            $username = "root";
            $password = "";
            
            try {
                $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
                $stmt = $pdo->query("SHOW TABLES");
                $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
            
                
                ?>
            
    <ul class="list-group">
<?php foreach ($tables as $table) {
       

echo'<li class="list-group-item">'.$table.'  tableau de base de donnees<div style="float:right;">
<button type="button" class="btn btn-success">Voir Tableau</button>
</div></li>';}
echo'</ul></div>';

}
catch (PDOException $e) {
echo "Erreur : " . $e->getMessage();
}}?>
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
        <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Contacts tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
    </div>
</div>


<script>




    const tabElements = [
    {
        id: 'profile',
        triggerEl: document.querySelector('#profile-tab-example'),
        targetEl: document.querySelector('#profile-example')
    },
    {
        id: 'dashboard',
        triggerEl: document.querySelector('#dashboard-tab-example'),
        targetEl: document.querySelector('#dashboard-example')
    },
    {
        id: 'settings',
        triggerEl: document.querySelector('#settings-tab-example'),
        targetEl: document.querySelector('#settings-example')
    },
    {
        id: 'contacts',
        triggerEl: document.querySelector('#contacts-tab-example'),
        targetEl: document.querySelector('#contacts-example')
    }
];

// options with default values
const options = {
    defaultTabId: 'settings',
    activeClasses: 'text-blue-600 hover:text-blue-600 dark:text-blue-500 dark:hover:text-blue-400 border-blue-600 dark:border-blue-500',
    inactiveClasses: 'text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300',
    onShow: () => {
    }
};
var usersData = {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
      datasets: [{
        label: 'Utilisateurs inscrits',
        data: [100, 150, 120, 180, 200],
        backgroundColor: 'rgba(54, 162, 235, 0.5)',
        borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 1
      }]
    };

    var favoritesData = {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
      datasets: [{
        label: 'Favoris',
        data: [50, 80, 70, 90, 100],
        backgroundColor: 'rgba(255, 99, 132, 0.5)',
        borderColor: 'rgba(255, 99, 132, 1)',
        borderWidth: 1
      }]
    };

    var commentsData = {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
      datasets: [{
        label: 'Commentaires',
        data: [30, 40, 50, 45, 60],
        backgroundColor: 'rgba(75, 192, 192, 0.5)',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1
      }]
    };

    // Création des graphiques
    var usersChart = new Chart(document.getElementById('usersChart'), {
      type: 'bar',
      data: usersData
    });

    var favoritesChart = new Chart(document.getElementById('favoritesChart'), {
      type: 'bar',
      data: favoritesData
    });

    var commentsChart = new Chart(document.getElementById('commentsChart'), {
      type: 'bar',
      data: commentsData
    });




</script>
</body>