<?php
session_start();
if($_SESSION['guest']==1) {
  echo '<script type=\'text/javascript\'>
  if (confirm(\'Tu peux pas faire cet action on mode visiteur, tu veux connecter?\')) {
    window.location.href = "log.php";
  }
  else {
    javascript:history.go(-1);
  }</script>';
}
else if(empty($_SESSION['username']) || $_SESSION['type']!=0 ) header('Location: log.php');
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

      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      <link rel="stylesheet" href="tool.css" />
</head>
<body id="default_theme" class="services">
      <!-- header -->
      <header class="header header_style1" style="background-color: C9FFE5;">
        <div class="container">
           <div class="row">
              <div class="col-md-9 col-lg-10">
                <div class="logo" data-toggle="tooltip" title="Allez à la page d'accueil!" style="width:20px"><a href="home.php"><img src="images/logo.png" style="width:120px;height:80px" alt="#" /></a></div>
                 <div class="main_menu float-right">
                    <div class="menu" style="background-color: C9FFE5;">
                      <ul class="clearfix nav nav-tabs">
                     <li><a class="nav-link" href="wreport.php">Signaler</a></li>
                     <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="myrep.php">Mes signalements</a>
                     <div class="dropdown-menu">
                       <a class="dropdown-item" href="myrep.php">Tous</a>
                       <a class="dropdown-item" href="odeclared.php">Déclarés</a>
                       <a class="dropdown-item" href="oonprogress.php">Prise en charge</a>
                       <a class="dropdown-item" href="ofinished.php">Cloturés</a>
                     </div>
                   </li>
                      <li><a class="nav-link" href="viewacc.php">Actualités</a></li>
                      <li><a class="nav-link" href="homecit.php">Announces</a></li>
                      <li><a class="nav-link" href="newmap.php">Carte</a></li>
                      <li><a class="nav-link" href="statuser.php">Statistiques</a></li>
                      <li class="nav-item dropdown">
                        <a class="nav-link active dropdown-toggle" style="background-color:LightBlue" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#">Mot de passe</a>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="pass.php">Modifier mot de passe</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="manageaccount.php">Modifier profile</a>
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
             <div class="right_bt" data-toggle="tooltip" title="Obtenir l'application et signaler &#10; depuis votre téléphone!"><a class="bt_main" href="obtenirapp.php">Obtenir l'App</a> </div>
           </div>
        </div>
     </div>
      </header>
      <body>
        <div class="container" style="margin-top:10%;margin-left:20%">
        <h2>Changer le mot de pass</h2>
      	<form action="manage.php" method="POST" onsubmit="return checkForm();">
          <div class="form-row">
      		<div class="form-group col-md-8">
      			<label>Mot de passe courant:</label>
      			<input type="password" id="password" name="cp" placeholder="Mot de pass courant" class="form-control" data-toggle="password" required>
          </div>
        </div>
          <div class="form-row">
          <div class="form-group col-md-8">
            <label>Nouveau mot de passe:</label>
            <input type="password" id="passwordnew" name="np" placeholder="Nouveau mot de pass" class="form-control" data-toggle="password" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-8">
            <label>Confirmer nouveau mot de passe:</label>
            <input type="password" id="passwordnewconf" placeholder="Confirmer nouveau mot de pass" name="cnp" class="form-control" data-toggle="password" required>
          </div>
        </div>
      		<div class="form-group">
      			<button type="submit" class="btn btn-primary" name="pass">Changer</button>
      		</div>
      	</form>
      </div>
      <script type="text/javascript">
      function checkForm(){
        var np = document.getElementById("passwordnew");
        var cnp = document.getElementById("passwordnewconf");
        if(np.value != cnp.value){
        alert("Veuillez resaisir votre mot de passe de confirmation.");
        return false;
      }
      return true;
    }
      $("#password").password('toggle');
      $("#passwordnew").password('toggle');
      $("#passwordnewconf").password('toggle');
      </script>
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
