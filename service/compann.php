<?php
session_start();
if(empty($_SESSION['username']) || $_SESSION['type']<1 ) header('Location: log.php');
$db_username = 'root';
$db_password = '';
$db_name     = 'base';
$db_host     = 'localhost';
$db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
or die('could not connect to database');
  if(isset($_POST['edit'])) {
  $id = $_POST['edit'];
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

<title>SB Admin 2 - Dashboard</title>

<!-- Custom fonts for this template-->
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

<!-- Custom styles for this template-->
<link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>
<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
      </div>
      <div class="sidebar-brand-text mx-3"> Admin <sup>-_-</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item ">
    <a class="nav-link" href="auth.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>annuler</span></a>
    </li>  <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
    <a class="nav-link" href="auth.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>home</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
    <a class="nav-link" href="announce.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>ecrire annonce</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">


   <!-- Nav Item - Pages Collapse Menu -->
  

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="viewann.php" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-wrench"></i>
        <span>voire annonce</span>
      </a>
      <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">voir annonce</h6>
          <a class="collapse-item " href="viewann.php">nouvelle</a>
          <a class="collapse-item " href="annrej.php">refuser</a>
         
        </div>
      </div>
    </li>

     

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
  

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-folder"></i>
        <span>voir signalement</span>
      </a>
      <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Login Screens:</h6>
          <a class="collapse-item" href="declared.php">nouveau signalement</a>
          <a class="collapse-item" href="encours.php">signalement en cours</a>
          <a class="collapse-item" href="finished.php">signalement cloturer</a>
        
          
      </div>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
      <a class="nav-link" href="statauth.php">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>voir statistic</span></a>
    </li>


    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#manage" aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-wrench"></i>
        <span>modifier compte</span>
      </a>
      <div id="manage" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="passau.php">Modifier mot de passe</a>
          <a class="collapse-item" href="phoneau.php">Modifier téléphone</a>
          <a class="collapse-item" href="emailau.php">Modifier email</a>
          <a class="collapse-item" href="addressau.php">Modifier adrress</a>
          <div class="dropdown-divider"></div>
          <a class="collapse-item" href="log.php">Se déconnecter</a>
        </div>
      </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  </ul>
  <!-- End of Sidebar -->

  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

      <!-- Topbar -->
      <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
          <i class="fa fa-bars"></i>
        </button>

     

         

      
        

      </nav>
      <!-- Begin Page Content -->
      <div class="container-fluid">
      <h2>Modifier l\'annonce</h2>
      <form action="editannonce.php" method="POST" enctype="multipart/form-data">
  <div class="form-row">
    <div class="form-group col-md-6">
    
    <label for="country">Titre : </label>
    <input type="text" name="title"class="form-control" value= "'.$row['title'].'" placeholder="Titre" required>
   
    </div>
    
  </div>
  <div class="form-group">
  <label for="subject">Sujet : </label>
  <textarea id="subject" name="body" class="form-control" placeholder="Ecrire votre annonce.." style="height:200px" required>'.$row['body'].' </textarea>
  </div>
  
  <div class="form-row">
  <div class="form-group col-md-6">
    <label for="country">Date début : </label>
    <input type="date" class="form-control" value="dateD" value= "'.$row['dateD'].'" name="dateD" id="dateD" required>
    </div>
    <div class="form-group col-md-6">
    <label for="country">Date fin : </label>
    <input type="date"  class="form-control"value="dateF" name="dateF" min="" id="dateF" onblur="compare();" required>
    </div>
    </div>
    <div class="form-row">
    <div class="form-group col-md-4">
    <label for="country">Date : </label>
    <p id="demo">'.$row['date'].'</p>
    </div>
    <div class="form-group col-md-4">
    <input type="file" class="form-control" name="uploadfile"  onchange="readURL(this);" multiple class="choose">
    <img id="blah" src="'.$row['image'].'" width="200" height="200"  alt="" />
    
    </div>
  </div>
  <div class="form-group">
  <div class="row justify-content-md-center">
    <div class="form-check">
    <input type="submit" name="update" class="btn btn-primary" value="Modifier">
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
