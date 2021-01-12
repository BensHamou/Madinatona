<?php
session_start();
if(empty($_SESSION['username']) || $_SESSION['type']!=0 ) header('Location: log.php');
?>
<html>
<head>
    <meta charset="utf-8">
    <title>MadinaTech - Paramètres</title>

      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>MadinaTech - Voir Actualités</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" href="css/bootstrap.min.css" />
      <!-- site css -->
      <link rel="stylesheet" href="css/style.css" />
      <!-- responsive css -->
      <link rel="stylesheet" href="css/responsive.css" />
      <!-- colors css -->
      <link rel="stylesheet" href="css/colors.css" />
      <!-- wow animation css -->
      <link rel="stylesheet" href="css/animate.css" />
      <link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
      <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
      <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js" integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg==" crossorigin=""></script>
      <script src="https://unpkg.com/esri-leaflet@2.2.3/dist/esri-leaflet.js" integrity="sha512-YZ6b5bXRVwipfqul5krehD9qlbJzc6KOGXYsDjU9HHXW2gK57xmWl2gU6nAegiErAqFXhygKIsWPKbjLPXVb2g==" crossorigin=""></script>
      <script src="https://unpkg.com/esri-leaflet-geocoder@2.2.13/dist/esri-leaflet-geocoder.js" integrity="sha512-zdT4Pc2tIrc6uoYly2Wp8jh6EPEWaveqqD3sT0lf5yei19BC1WulGuh5CesB0ldBKZieKGD7Qyf/G0jdSe016A==" crossorigin=""></script>
      <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
      <style>
      body{
        padding:100px 0;
        background-color:#efefef
      }
      a, a:hover{
        color:#333
      }
      </style>
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
</head>
<body id="default_theme" class="services">
      <!-- header -->
      <header class="header header_style1"></header>
         <div class="container">
            <div class="row">
               <div class="col-md-9 col-lg-10">
                  <div class="logo"><a href="homecit.php"><img src="images/logo2.png" alt="#" /></a></div>
                  <div class="main_menu float-right">
                     <div class="menu">
                       <ul class="clearfix nav nav-tabs">
                         <li><a class="nav-link" href="wreport.php">Ecrire</a></li>
                          <li><a class="nav-link" href="homecit.php">Announces</a></li>
                          <li><a class="nav-link" href="viewacc.php">Actualités</a></li>
                          <li><a class="nav-link" href="newmap.php">Carte</a></li>
                          <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="myrep.php">Ma Liste</a>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="myrep.php">Tous</a>
                            <a class="dropdown-item" href="odeclared.php">Déclarés seulement</a>
                            <a class="dropdown-item" href="oonprogress.php">En cours seulement</a>
                            <a class="dropdown-item" href="ofinished.php">Cloturés seulement</a>
                          </div>
                        </li>
                          <li><a class="nav-link" href="statuser.php">Statiques</a></li>
                          <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#">Address</a>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="pass.php">Modifier mot de passe</a>
                            <a class="dropdown-item" href="phone.php">Modifier téléphone</a>
                            <a class="dropdown-item" href="email.php">Modifier email</a>
                            <a class="dropdown-item" href="address.php">Modifier adrress</a>
                            <a class="dropdown-item" href="deleteacc.php">Désactiver compte</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="log.php">Se déconnecter</a>
                          </div>
                        </li>
                      </ul>
                     </div>
                  </div>
               </div>
               <div class="col-md-3 col-lg-2">
                 <div class="right_bt"><a class="bt_main" href="obtenirapp.php">Obtenir l'App</a> </div>
               </div>
            </div>
         </div>
      </header>
      <body>
      <div class="container">
        <h2>Changer l'address</h2>
      	<form action="manage.php" method="POST">
          <div class="form-group">
            <label>Address:</label>
            <input class="form-control" type="text" name="new" placeholder="Nouveau address" required>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary" name="address">Changer</button>
          </div>
      	</form>
      </div>
      </body>
<!--=========== js section ===========-->
      <!-- jQuery (necessary for Bootstrap's JavaScript) -->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <!-- wow animation -->
      <script src="js/wow.js"></script>
      <!-- custom js -->
      <script src="js/custom.js"></script>
      <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-show-password/1.0.3/bootstrap-show-password.min.js"></script>

      <!-- google map js -->
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8eaHt9Dh5H57Zh0xVTqxVdBFCvFMqFjQ&callback=initMap"></script>
      <!-- end google map js -->
</body>
</html>
