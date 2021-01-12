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
    <title>MadinaTech - Ecrire un signalement</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
<body id="default_theme" class="services"style="background-color: C9FFE5;">
      <!-- header -->
      <header class="header header_style1" style="background-color: C9FFE5;">
        <div class="container">
           <div class="row">
              <div class="col-md-9 col-lg-10">
                <div class="logo" data-toggle="tooltip" title="Allez à la page d'accueil!" style="width:20px"><a href="home.php"><img src="images/logo.png" style="width:120px;height:80px" alt="#" /></a></div>
                 <div class="main_menu float-right">
                    <div class="menu" style="background-color: C9FFE5;">
                      <ul class="clearfix nav nav-tabs">
                        <li><a class="nav-link active" style="background-color:LightBlue" href="wreport.php">Signaler</a></li>
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
                           <a class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#">Mon compte</a>
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
        <form action="sharerep.php" method="POST" enctype="multipart/form-data">
        <div style="margin:0.5%;margin-top:3%">
        <h2>Ecrire un signalement</h2>
        <div style="padding:5%;background-repeat: no-repeat; background-image: url('images/slide1.png');">
          <div class="form-group">
            <label style="color:black">Titre</label>
            <input type="text" name="title"  class="form-control" placeholder="Ecrire le titre" required>
          </div>
          <div class="form-group">
            <label style="color:black">Description</label>
            <textarea class="form-control" name="descreption" rows="6" placeholder=". . ." required></textarea>
          </div>
          <div class="form-group">
            <input type="hidden" id="lat" name="lat">
            <input type="hidden" id="long" name="long">
            <input type="hidden" id="add" name="add">
            <label style="color:black">Choisir le type</label>
            <select class="form-control" name="type" >
              <?php
              $db_username = 'root';
              $db_password = '';
              $db_name     = 'base';
              $db_host     = 'localhost';
              $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
              or die('could not connect to database');
              $result = mysqli_query($db,"SELECT * FROM type");
              while ($row = mysqli_fetch_array($result)){
                  echo '<option  value="'.$row['idtype'].'">'.$row['nametype'].'</option>';
                }
                ?>
              </select>
          </div>
        <div class="form-group">
          <div>
          <p id="x" style="color:black"></p>
          <p id="y" style="color:black"></p>
          <button form="fakeForm" onclick="getLocation()" style="padding:0.5%">Localiser</button>
          <script>
          var x = document.getElementById("x");
          var y = document.getElementById("y");
          function getLocation() {
            if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(showPosition);
            } else {
              x.innerHTML = "Geolocation is not supported by this browser.";
            }
          }
          function showPosition(position) {
            var lat = position.coords.latitude;
            var long = position.coords.longitude;
            var geocodeService = L.esri.Geocoding.geocodeService();
            geocodeService.reverse().latlng([lat,long]).run(
              function(error, result) {
              document.getElementById("add").value = result.address.Match_addr;
              x.innerHTML = "Address: " + result.address.Match_addr;
              return result.address.Match_addr;
            });
            document.getElementById("lat").value = lat;
            document.getElementById("long").value = long
          }
          function readURL(input) {
             if (input.files && input.files[0]) {
                 var reader = new FileReader();

                 reader.onload = function (e) {
                     $('#blah')
                         .attr('src', e.target.result)
                         .width(200)
                         .height(200);
                 };
                 reader.readAsDataURL(input.files[0]);
             }
         }
        </script>
        </div>
        </div>
        <div class="form-group">
          <label style="color:black">Date</label>
            <p id="demo" style="color:black"></p>
          <script>
          var dt = new Date();
          document.getElementById('demo').innerHTML =dt.toLocaleString();
        </script>
        </div>
        <div class="custom-file">
          <input type="file" class="custom-file-input" name="uploadfile" id="validatedCustomFile" multiple class="choose" onchange="readURL(this);" required>
          <label class="custom-file-label" for="validatedCustomFile">Choisir une photo</label>
        </div>
        <img id="blah" src="" style="margin-top:3%;margin-left:41%" alt="" />
        <div class="form-group">
        <div class="g-recaptcha" data-sitekey="6Lf_SccZAAAAAIry5vyb6hspMCF_EHZ5V0c3zYNP" style="float:right"></div>
          <button type="submit" style="background-color:red" name="post" class="btn btn-primary">Publier</button>
        </div>
        </div>
        </form>
<!--=========== js section ===========-->
      <!-- jQuery (necessary for Bootstrap's JavaScript) -->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <!-- wow animation -->
      <script src="js/wow.js"></script>
      <!-- custom js -->
      <script src="js/custom.js"></script>
      <!-- google map js -->
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8eaHt9Dh5H57Zh0xVTqxVdBFCvFMqFjQ&callback=initMap"></script>
      <!-- end google map js -->
</body>
</html>
