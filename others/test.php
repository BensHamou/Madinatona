<?php
session_start();
if(empty($_SESSION['username']) || $_SESSION['type']!=-2 ) header('Location: log.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>MadinaTech - Page d'accueil</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
  <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
  <style>
  html, body {
      height: 100%;
      margin: 0;
  }
  #mapid {
      width: 100%;
      height: 1000px;
  }
  </style>
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>
<body id="page-top">
  <div id="wrapper">
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div><div class="sidebar-brand-text mx-3"> Responsable </div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item"><a class="nav-link" href="resp.php"><i class="fas fa-fw fa-tachometer-alt"></i><span>Page d'accueil</span></a></li>
      <li class="nav-item active"><a class="nav-link" href="gestionreport.php"><i class="fas fa-fw fa-tachometer-alt"></i><span>Nouveaux signalements</span></a></li>
      <li class="nav-item"><a class="nav-link" href="resp.php"><i class="fas fa-fw fa-tachometer-alt"></i><span>Nouveaux annonces</span></a></li>
      <li class="nav-item"><a class="nav-link" href="resp.php"><i class="fas fa-fw fa-tachometer-alt"></i><span>Statiques</span></a></li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Carte </span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="mapnew.php">Nouveaux</a>
            <a class="collapse-item" href="mapexist.php">Exsiter</a>
          </div>
        </div>
      </li>
      <hr class="sidebar-divider my-0">
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#manage" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Mon compte</span>
        </a>
        <div id="manage" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="dropdown-item" href="passres.php">Modifier mot de passe</a>
            <a class="collapse-item" href="phoneres.php">Modifier téléphone</a>
            <a class="collapse-item" href="emailres.php">Modifier email</a>
            <a class="collapse-item" href="addressres.php">Modifier adrress</a>
            <div class="dropdown-divider"></div>
            <a class="collapse-item" href="log.php">Se déconnecter</a>
          </div>
        </div>
      </li>
      <hr class="sidebar-divider d-none d-md-block">
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
        <div class="container-fluid">
          <div id='mapid' ></div>
          <script src="points.js" type="text/javascript"></script>
          <script>
              var mymap = L.map('mapid').setView([35.2157, -0.625634], 11);
              L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            subdomains: ['a','b','c']
          }).addTo(mymap);

          var gasgreen = L.icon({
              iconUrl: 'gasgreen.png'

          });
          var defaultgreen = L.icon({
              iconUrl: 'defaultgreen.png'
          });
          var defaultred = L.icon({
              iconUrl: 'defaultred.png'
          });
          var defaultorange = L.icon({
              iconUrl: 'defaultorange.png'
          });
          var elecgreen = L.icon({
              iconUrl: 'elecgreen.png'

          });
          var watergreen = L.icon({
              iconUrl: 'watergreen.png'

          });
          var roadgreen = L.icon({
              iconUrl: 'roadgreen.png'

          });
          var waterorange = L.icon({
              iconUrl: 'waterorange.png'

          });
          var waterred = L.icon({
              iconUrl: 'waterred.png'

          });
          var roadred = L.icon({
              iconUrl: 'roadred.png'

          });
          var roadorange = L.icon({
              iconUrl: 'roadorange.png'

          });
          var elecorange = L.icon({
              iconUrl: 'elecorange.png'

          });
          var elecred = L.icon({
              iconUrl: 'elecred.png'

          });

          var gasred = L.icon({
              iconUrl: 'gasred.png'

          });
          var gasorange = L.icon({
              iconUrl: 'gasorange.png'

          });

          </script>
          <?php
           $db_username = 'root';
           $db_password = '';
           $db_name     = 'base';
           $db_host     = 'localhost';
           $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
                  or die('could not connect to database');
          ?>
          <?php
          $query = mysqli_query($db,"SELECT * FROM signalement where visible=1")or die(mysql_error());
          while($row = mysqli_fetch_array($query))
          {
            $name = $row['title'];
            $lat = $row['locx'];
            $lon = $row['locy'];
            $desc = $row['description'];
            $type = $row['type'];
            $etat = $row['etat'];
            echo "<script type='text/javascript'>
            if($type==1){
              if($etat==1){var marker = L.marker([$lat, $lon],{icon: waterred}).addTo(mymap);}
              else if($etat==2){var marker = L.marker([$lat, $lon],{icon: waterorange}).addTo(mymap);}
              else if($etat==3){var marker = L.marker([$lat, $lon],{icon: watergreen}).addTo(mymap);}
            }
            else if($type==2){
              if($etat==1){var marker = L.marker([$lat, $lon],{icon: roadred}).addTo(mymap);}
              else if($etat==2){var marker = L.marker([$lat, $lon],{icon: roadorange}).addTo(mymap);}
              else if($etat==3){var marker = L.marker([$lat, $lon],{icon: roadgreen}).addTo(mymap);}
            }
            else if($type==3){
              if($etat==1){var marker = L.marker([$lat, $lon],{icon: elecred}).addTo(mymap);}
              else if($etat==2){var marker = L.marker([$lat, $lon],{icon: elecorange}).addTo(mymap);}
              else if($etat==3){var marker = L.marker([$lat, $lon],{icon: elecgreen}).addTo(mymap);}
            }
            else if($type==4){
              if($etat==1){var marker = L.marker([$lat, $lon],{icon: gasred}).addTo(mymap);}
              else if($etat==2){var marker = L.marker([$lat, $lon],{icon: gasorange}).addTo(mymap);}
              else if($etat==3){var marker = L.marker([$lat, $lon],{icon: gasgreen}).addTo(mymap);}
            }
            else{
              if($etat==1){var marker = L.marker([$lat, $lon],{icon: defaultred}).addTo(mymap);}
              else if($etat==2){var marker = L.marker([$lat, $lon],{icon: defaultorange}).addTo(mymap);}
              else if($etat==3){var marker = L.marker([$lat, $lon],{icon: defaultgreen}).addTo(mymap);}
            }
           </script>";
          }
          ?>
        </div>
<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

</body>
</html>
