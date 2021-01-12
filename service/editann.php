<?php
$inactive = 1200;
ini_set('session.gc_maxlifetime', $inactive); // set the session max lifetime to 2 hours
session_start();
if (isset($_SESSION['testing']) && (time() - $_SESSION['testing'] > $inactive)) {
    session_unset();     // unset $_SESSION variable for this page
    session_destroy();   // destroy session data
}
$_SESSION['testing'] = time();
if(empty($_SESSION['username']) || $_SESSION['type']<1 ) header('Location: log.php');
$db_username = 'root';
$db_password = '';
$db_name     = 'base';
$db_host     = 'localhost';
$db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
or die('could not connect to database');
if(isset($_POST['supprimer'])){
  $idi=mysqli_real_escape_string($db,htmlspecialchars($_POST['hid']));
  $result = mysqli_query($db,"SELECT * FROM announce where id =\"$idi\"");
  $row = mysqli_fetch_array($result);
  $requete = "UPDATE announce SET visible= 0 where id =\"$idi\"";
  $exec_requete = mysqli_query($db,$requete);
  if($row['visible']==-2)
  print("<script type=\"text/javascript\">location.href=\"annrej.php\"</script>");
  else
  print("<script type=\"text/javascript\">location.href=\"viewann.php\"</script>");
}
  else if(isset($_POST['edit'])) {
  $id = $_POST['hid'];
  $result = mysqli_query($db,"SELECT * FROM announce where id = '".$id."'");
  while($row = mysqli_fetch_array($result)){
    echo '
    <html>

<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title>MadinaTech - Annonce</title>

<!-- Custom fonts for this template-->
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

<!-- Custom styles for this template-->
<link href="css/sb-admin-2.min.css" rel="stylesheet">
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

</head>
<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="background: linear-gradient( #008BFF,#219AFF,#4FAFFF, #6EBDFF);">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
    <div class="sidebar-brand-icon rotate-n-15"><i class="fas"></i></div><div class="sidebar-brand-text mx-3">'; $user = $_SESSION['username'];echo "$user";echo '</div></a>


    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item ">';
    $id = $_POST['hid'];
    $result = mysqli_query($db,"SELECT * FROM announce where id =\"$id\"");
    $row = mysqli_fetch_array($result);
    if($row['visible']==-2)
    echo '<a class="nav-link" href="annrej.php">';
    else
    echo '<a class="nav-link" href="viewann.php">';
    echo '
        <i class="fas fa-window-close"></i>
        <span>Annuler</span></a>
    </li>
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  </ul>
  <div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
      <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
          <i class="fa fa-bars"></i>
        </button>
      </nav>

      <div class="container-fluid" style="padding:5%;background-repeat: no-repeat; background-image: url(\'img/slide1.png\');">
      <h2 style="color:black">Modifier l\'annonce</h2>
      <form action="editannonce.php" method="POST" enctype="multipart/form-data">
  <div class="form-row">
    <div class="form-group col-md-6">
    <label style="color:black">Titre : </label>
    <input type="text" name="title" style="color:black" class="form-control" value= "'.$row['title'].'" placeholder="Titre" required>
    </div>
  </div>
  <div class="form-group">
  <label style="color:black">Sujet : </label>
  <textarea id="subject" style="color:black" name="body" class="form-control" placeholder="Ecrire votre annonce.." rows="6" required>'.$row['body'].' </textarea>
  </div>

  <div class="form-row">
  <div class="form-group col-md-6">
    <label style="color:black">Date début : </label>
    <input type="date" style="color:black" class="form-control" value="dateD" value= "'.$row['dateD'].'" name="dateD" id="dateD" required>
    </div>
    <div class="form-group col-md-6">
    <label style="color:black">Date fin : </label>
    <input type="date"  class="form-control" min= '.$row['dateD'].' style="color:black" value="dateF" name="dateF" min="" id="dateF" onblur="compare();" required>
    </div>
    </div>
    <div class="form-row">
    <div class="form-group col-md-4">
    <label style="color:black" >Date : </label>
    <p id="demo" style="color:black">'.$row['date'].'</p>
    </div>
    <div class="form-group col-md-4">
    <input type="file" class="form-control" style="color:black" name="uploadfile"  onchange="readURL(this);" multiple class="choose">
    <img id="blah" src="'.$row['image'].'" width="200" height="200"  alt="" />

    </div>
  </div>
  <div class="form-group">
  <div class="g-recaptcha" data-sitekey="6Lf_SccZAAAAAIry5vyb6hspMCF_EHZ5V0c3zYNP" style="float:right"></div>
  <div class="row justify-content-md-center">
    <div class="form-check">';
    if($row['visible']==-2)
      echo '<input type="submit" name="comp" class="btn btn-primary" value="Completer">';
    else
    echo '<input type="submit" name="update" class="btn btn-primary" value="Modifier">';
    echo '
    <input type="hidden" value="'.$row['id'].'" name="id">
    </div>
    </div>
  </div>
</form>

    <script>
    document.getElementById("dateD").value = "'.$row['dateD'].'";
    document.getElementById("dateF").value = "'.$row['dateF'].'";
    var dateD = document.getElementById(\'dateD\');
    var dateF = document.getElementById(\'dateF\');
    dateD.addEventListener(\'change\', updatedate);
    function updatedate() {
        var firstdate = document.getElementById("dateD").value;
        document.getElementById("dateF").value = "";
        document.getElementById("dateF").setAttribute("min",firstdate);
    }
    function readURL(input) {
       if (input.files && input.files[0]) {
           var reader = new FileReader();

           reader.onload = function (e) {
               $(\'#blah\')
                   .attr(\'src\', e.target.result)
                   .width(200)
                   .height(200);
           };

           reader.readAsDataURL(input.files[0]);
       }
    }
    </script>
    <!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

    </body>';
  }
  }
  ?>
