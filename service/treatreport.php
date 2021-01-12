<?php
session_start();
// connexion à la base de données
$db_username = 'root';
$db_password = '';
$db_name     = 'base';
$db_host     = 'localhost';
$db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
or die('could not connect to database');
if(empty($_SESSION['username']) || ($_SESSION['type']<1)) header('Location: log.php');
?>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title>MadinaTech - Traitement de signalement</title>
<link rel="stylesheet" href="popup.css" media="screen" type="text/css" />
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link href="css/sb-admin-2.min.css" rel="stylesheet">
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

</head>
<body id="page-top">
<div id="wrapper">
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
  <div class="sidebar-brand-icon rotate-n-15"><i class="fas"></i></div><div class="sidebar-brand-text mx-3"><?php $user = $_SESSION['username'];echo "$user";?></div></a>
  <hr class="sidebar-divider my-0">
  <li class="nav-item "><a class="nav-link" href="declared.php"><i class="fas fa-window-close"></i><span>Annuler</span></a></li>
  <div class="text-center d-none d-md-inline"><button class="rounded-circle border-0" id="sidebarToggle"></button></div>
</ul>
<div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
  <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
      <i class="fa fa-bars"></i>
    </button>
  </nav>
  <div class="container-fluid">
    <div class="row">
    <?php
    if(isset($_POST['treat'])){
      $report = $_POST['treat'];
      $_SESSION['treat'] = $report;
      if($_SESSION['type'] !== ""){
        $type = $_SESSION['type'];
      }
      $result = mysqli_query($db,"SELECT * FROM signalement where signalement.id = '".$report."'");
      while($row = mysqli_fetch_array($result)){
        echo '<div class="col-md-6" style="margin-top:5%;margin-left:15%;">';
        echo '<form action="attach.php"  method="post">
        <div class="card border-info" style="margin-top:5%;">';
        echo '<div class="card-header"><h1 class="card-title" style="margin-left:20%;"><ins> Titre</ins>: '. $row['title'] . '</h1></div>';
        echo '<img class="rounded" src="'.$row['image'].'" alt  = "No photo for this report." style="margin-top:3%;margin-left:auto;margin-right:auto;width:50%;height:30%;" >';
        echo '<div class="card-body">';
        echo  '<p5 class="username" style="color:black"><ins>Signalé par</ins>: '. $row['username'] . '</p>';
        echo '<p5 class="card-text" style="color:black"><ins>Le</ins>: ' . $row['date1'] . '</p>';
        if($row['etat'] == 2 && !empty($row['date2']))
        echo '<p5 class="card-text" style="color:black"><ins>Prise en charge le</ins>: ' . $row['date2'] . '</p>';
        echo  '<p5 class="adress" style="color:black"><ins>À</ins>: ' . $row['adress'] . '</p>';
        echo "<div class=\"card-header\"><p1> <ins>Description</ins>: <br>" . $row['description'] . "</p1></div>";
        if(!empty( $row['rapport'])){
          echo  "<div class=\"card-header\"><p1><ins>Rapport d'autorité</ins>: <br>". $row['rapport'] . "</p1></div>";
         $empty = 0;
         $rapport = $row['rapport'];
        }
        else {
          $empty = 1;
          unset($rapport);
        }
        if(!empty( $row['imagerapport'])){
            echo '<br><img class="rounded" src="'.$row['imagerapport'].'" alt  = "No photo for this report." style="margin-left:25%;width:50%;" >';
            $image = $row['imagerapport'];
          }
          else {
            unset($image);
          }
          echo '<div style="margin-left:3%;">';
          $id = $row['id'];
          $requete = "SELECT count(*) FROM signalement where attached = '".$id."'";
          $exec_requete = mysqli_query($db,$requete);
          $reponse = mysqli_fetch_array($exec_requete);
          $count = $reponse['count(*)'];
          echo '<input type="hidden"  value="' . $row['id']  . '" name="id">';
          if($count>1){
            echo '<input class="btn btn-info" type="submit" style="margin-top:10%;" value="Voir list" name="list">';
          }
          if($row['etat'] == 1 && $count==1){
        echo '<input class="btn btn-primary" style="margin-top:10%;" type="submit" value="Attacher à" name="attach">';
        echo '<input type="hidden"  value="' . $row['locx']  . '" name="x">';
        echo '<input type="hidden"  value="' . $row['locy']  . '" name="y">';
        echo '<input type="hidden"  value="' . $row['id']  . '" name="id">';
        echo '<input type="hidden"  value="' . $row['type']  . '" name="type">';
      }
      if($row['etat'] == 1){
        echo '<input class="btn btn-warning" style="margin-top:10%;" type="submit" value="Lencer" name="almost">';
      }
      if(!empty( $row['rapport'])){
        echo '<input class="btn btn-success" style="margin-top:10%;" type="submit" value="Cloturer" name="done">';
        echo '<input class="btn btn-danger" style="margin-top:10%;"  type="submit" value="Supprimer le rapport" name="delete">';
      }
      else{
        echo '</div>';
        echo '<p5 style="margin-left:25%;margin-top:10%;color:red">Il faut ajouter un rapport d\'abbord</p>';
      }
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo "<hr class=\"sidebar-divider my-0\">";
        echo '    <div class="row align-items-center h-100">';
          echo '</div>';
        }
    }
    ?>
  </form>
    <button class="open-button" onclick="openForm()">
      <?php
      if($empty==0){
        echo 'Modifier le rapport';
      }
      else {
        echo 'Ajouter un rapport';
      }
       ?>
     </button>
    <div class="chat-popup" id="myForm">
      <form  action="addcommentann.php" method="POST" enctype="multipart/form-data" class="form-container">
        <?php
        if($empty==0){
          echo '<h1>Modifier le rapport</h1>' ;
        }
        else {
          echo '<h1>Ecrire le rapport</h1>';
        }
         ?>
        <textarea name="comment" class="form-control" value="<?php echo (isset($rapport))?$rapport:'';?>" style="height:50px;color:black;" placeholder="Ecrire votre rapport.." rows="6" required><?php echo (isset($rapport))?$rapport:'';?></textarea>
        <input type="file" name="uploadfile" onchange="readURL(this);" multiple class="choose">
        <img id="blah" src="<?php echo (isset($image))?$image:'';?>" width="200" height="200" style="margin-top:3%;margin-left:50%" alt="" />
        <input class="btn btn-primary" style="margin-top:3%" type="submit" value="Publier" name="share">
        <div class="g-recaptcha" data-sitekey="6Lf_SccZAAAAAIry5vyb6hspMCF_EHZ5V0c3zYNP" style="float:right"></div>
        <button type="button" class="btn btn-danger" style="background-color:red" onclick="closeForm()">Annuler</button>
      </form>
    </div>
<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {$('#blah').attr('src', e.target.result).width(200).height(200);};
    reader.readAsDataURL(input.files[0]);}
  }
function closeForm() {document.getElementById("myForm").style.display = "none";}
</script>
</div>

<script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/sb-admin-2.min.js"></script>
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>
</body>

</html>
