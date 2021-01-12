<?php
session_start();
if(empty($_SESSION['username']) || $_SESSION['type']!=0 ) header('Location: log.php');
?>
<html>
<head>
  <title>MadinaTech - Carte</title>
  <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>MadinaTech - Carte</title>
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

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
  <link rel="stylesheet" href="css.css" media="screen" type="text/css" />
  <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
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
                         <li><a class="nav-link active" style="background-color:LightBlue" href="newmap.php">Carte</a></li>
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
      <div class="container" style="margin-top:1%">
        <div class="row">
          <div class="col-md-3">
            <div>
              <img src="red.png" alt="#" /> <h> Signalement pas encore traité </h>
            </div>
          </div>
          <div class="col-md-3">
            <div>
              <div ><img src="electricitee.png" alt="#" /> <h>Probléme d'éléctricité </h></div>
            </div>
          </div>
          <div class="col-md-3">
            <div ><img src="route.png" alt="#" /> <h>Probléme de voirie</h></div>
          </div>
            </div>
            <div class="row" style="margin-top:2%">
              <div class="col-md-3">
                <div>
                  <img src="orange.png" alt="#" /> <h> Signalement prise en charge </h>
                </div>
              </div>
              <div class="col-md-3">
                <div>
                  <img src="gas.jpg" alt="#" /> <h>Probléme de gas<h>
                </div>
              </div>
              <div class="col-md-3">
                <div ><img src="fire.png" alt="#" /> <h>Probléme de feu</h></div>
              </div>
              <div class="col-md-3">
                <div ><img src="others.png" alt="#" /> <h>Autre problèmes</h></div>
              </div>
                </div>
                <div class="row" style="margin-top:1.5%">
            <div class="col-md-3">
              <img src="green.png" alt="#" /> <h> Signalement prise en charge </h>
            </div>
            <div class="col-md-3">
            <div ><img src="water.png" alt="#" /> <h>Probléme d'eau</h></div>
          </div>
          <div class="col-md-3">
            <div ><img src="imeublee.png" alt="#" /> <h>Imeuble défectueux</h></div>
          </div>
            </div>
            </div>
            <div class="row" style="display: table;margin: 0 auto;margin-top: 3vh;">
              <button style="margin-bottom: 1.5vh;margin-left: 18vh;background-color: rgb(201,255,229);" onclick="Hide()" id="but">Hide</button>                
              <div id="search">
                <form action="newmap.php" method="POST" enctype="multipart/form-data">
                  <select name="type[]" multiple>
                    <?php
                    $db_username = 'root';
                    $db_password = '';
                    $db_name     = 'base';
                    $db_host     = 'localhost';
                    $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
                    or die('could not connect to database');
                    $result = mysqli_query($db,"SELECT * FROM type");
                    while ($row = mysqli_fetch_array($result)){
                        echo '<option  value="'.$row['idtype'].'" selected>'.$row['nametype'].'</option>';
                      }
                      ?>
                    </select>
                    <select name="etat[]" multiple>
                      <option value="1" style="color: red" selected>Déclarés</option>
                      <option  value="2" style="color: orange" selected>Prise en charge</option>
                      <option  value="3" style="color: green" selected>Cloturés</option>
                    </select>
                    <br>
                    <button style="margin-top: 3vh;margin-left: 17vh;background-color: rgb(201,255,229);" type="submit" name="search" >search</button>
                </form>
              </div>
            </div>
            
      <div class="container">
        <div class="row ">
          <div class="col-md-12 col-lg-12 col-xs-12">
            <div id='mapid'  class="mx-auto" style="margin:1%;padding:1px 16px;height:600px;">
            </div>
          </div>
         </div>
       </div>
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
var firegreen = L.icon({
    iconUrl: 'firegreen.png'

});
var fireorange= L.icon({
    iconUrl: 'fireorange.png'

});
var firered = L.icon({
    iconUrl: 'firered.png'

});
var imeublegreen = L.icon({
    iconUrl: 'imeublegreen.png'

});
var imeubleorange= L.icon({
    iconUrl: 'imeubleorange.png'

});
var imeublered = L.icon({
    iconUrl: 'imeublered.png'

});
var defaultgreen = L.icon({
    iconUrl: 'defaultgreen.png'

});
var defaultorange= L.icon({
    iconUrl: 'defaultorange.png'

});
var defaultred = L.icon({
    iconUrl: 'defaultred.png'

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
if(!isset($_POST['search'])){
$req="SELECT * FROM signalement where visible=2";
$query = mysqli_query($db,$req)or die(mysql_error());
while($row = mysqli_fetch_array($query))
{
  $name = $row['title'];
  $lat = $row['locx'];
  $lon = $row['locy'];
  $desc = $row['description'];
  $type = $row['type'];
  $etat = $row['etat'];
  echo "<script type='text/javascript'>
  if($type==1){  if($etat==1){
      var marker = L.marker([$lat, $lon],{icon: waterred}).addTo(mymap);}
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
else if($type==5){
  if($etat==1){var marker = L.marker([$lat, $lon],{icon: firered}).addTo(mymap);}
  else if($etat==2){var marker = L.marker([$lat, $lon],{icon: fireorange}).addTo(mymap);}
  else if($etat==3){var marker = L.marker([$lat, $lon],{icon: firegreen}).addTo(mymap);}
}
else if($type==6){
  if($etat==1){var marker = L.marker([$lat, $lon],{icon: imeublered}).addTo(mymap);}
  else if($etat==2){var marker = L.marker([$lat, $lon],{icon: imeubleorange}).addTo(mymap);}
  else if($etat==3){var marker = L.marker([$lat, $lon],{icon: imeublegreen}).addTo(mymap);}
}
 else{
  if($etat==1){var marker = L.marker([$lat, $lon],{icon: defaultred}).addTo(mymap);}
  else if($etat==2){var marker = L.marker([$lat, $lon],{icon: defaultorange}).addTo(mymap);}
  else if($etat==3){var marker = L.marker([$lat, $lon],{icon: defaultgreen}).addTo(mymap);}
}
 </script>";
}
} else {
  $type = $_POST['type'];
  foreach ($type as $b){
  $etat = $_POST['etat'];
  foreach ($etat as $a){
    $req="SELECT * FROM signalement where visible=2 and etat= '".$a."' and type = '".$b."'";
$query = mysqli_query($db,$req)or die(mysql_error());
while($row = mysqli_fetch_array($query))
{
  $name = $row['title'];
  $lat = $row['locx'];
  $lon = $row['locy'];
  $desc = $row['description'];
  $type = $row['type'];
  $etat = $row['etat'];
  echo "<script type='text/javascript'>
  if($type==1){  if($etat==1){
      var marker = L.marker([$lat, $lon],{icon: waterred}).addTo(mymap);}
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
else if($type==5){
  if($etat==1){var marker = L.marker([$lat, $lon],{icon: firered}).addTo(mymap);}
  else if($etat==2){var marker = L.marker([$lat, $lon],{icon: fireorange}).addTo(mymap);}
  else if($etat==3){var marker = L.marker([$lat, $lon],{icon: firegreen}).addTo(mymap);}
}
else if($type==6){
  if($etat==1){var marker = L.marker([$lat, $lon],{icon: imeublered}).addTo(mymap);}
  else if($etat==2){var marker = L.marker([$lat, $lon],{icon: imeubleorange}).addTo(mymap);}
  else if($etat==3){var marker = L.marker([$lat, $lon],{icon: imeublegreen}).addTo(mymap);}
}
 else{
  if($etat==1){var marker = L.marker([$lat, $lon],{icon: defaultred}).addTo(mymap);}
  else if($etat==2){var marker = L.marker([$lat, $lon],{icon: defaultorange}).addTo(mymap);}
  else if($etat==3){var marker = L.marker([$lat, $lon],{icon: defaultgreen}).addTo(mymap);}
}
 </script>";
}}}}
?>
<script>
  function Hide() {
    var b = document.getElementById("but");
    if (b.innerHTML ==="Hide"){
      b.style.margin = "auto";
      b.style.marginBottom = "1.5vh";
      b.innerHTML  = "Search";
    } 
    else {
      b.style.marginLeft = "18vh";
      b.style.marginBottom = "1.5vh";
      b.innerHTML  = "Hide";
      }
    var x = document.getElementById("search");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }

  }
  </script>
  <!-- end footer -->
      <!--=========== js section ===========-->
      <!-- jQuery (necessary for Bootstrap's JavaScript) -->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <!-- wow animation -->
      <script src="js/wow.js"></script>
      <!-- custom js -->
      <script src="js/custom.js"></script>

      <!-- end google map js -->
</body>
</html>
