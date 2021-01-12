<?php
session_start();
if(empty($_SESSION['username']) || $_SESSION['type']!=-2 ) header('Location: log.php');
?>
<html>
<head>
  <title>MadinaTech - Map</title>
  <link rel="stylesheet" href="drop.css" media="screen" type="text/css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
  <link rel="stylesheet" href="css.css" media="screen" type="text/css" />
  <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
  <style>
  li a.active {
    background-color: Wheat;
    color: white;
  }
        html, body {
            height: 100%;
            margin: 0;
        }
        #mapid {
            width: 1200px;
            height: 800px;
        }  li a.active {
            background-color: LightSeaGreen;
            color: white;
          }
          #p1:hover {background-color:red;}
          #p3:hover{background-color:green;}
          </style>
</head>
<body>
<ul>
  <li><a href="gestionreport.php">Nouveaux signalements</a></li>
  <li><a href="nouvannounce.php">Nouvelles annonces</a></li>
  <li><a href="column.php">Statistiques</a></li>
  <li><a href="resp.php">Page d'accueil</a></li>
  <div class="dropdown">
    <li><a class="active">Map (Validés)</a></li>
    <div class="dropdown-content">
      <a id="p1" href="mapres1.php">Nouveaux</a>
      <a id="p3" href="mapres2.php">Validés </a>
    </div>
  </div>
  <li><a href="manageaccresp.php">Paramètres de compte</a></li>
  <li><a href="log.php">Se déconnecter</a></li>
</ul>
<body>
<div id='mapid' style="margin-left:20%;padding:1px 16px;height:1000px;"></div>
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
$query = mysqli_query($db,"SELECT * FROM signalement where visible=2")or die(mysql_error());
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
if($type==2){
  if($etat==1){var marker = L.marker([$lat, $lon],{icon: roadred}).addTo(mymap);}
  else if($etat==2){var marker = L.marker([$lat, $lon],{icon: roadorange}).addTo(mymap);}
  else if($etat==3){var marker = L.marker([$lat, $lon],{icon: roadgreen}).addTo(mymap);}
}
 if($type==3){
   if($etat==1){var marker = L.marker([$lat, $lon],{icon: elecred}).addTo(mymap);}
   else if($etat==2){var marker = L.marker([$lat, $lon],{icon: elecorange}).addTo(mymap);}
   else if($etat==3){var marker = L.marker([$lat, $lon],{icon: elecgreen}).addTo(mymap);}
 }
 if($type==4){
   if($etat==1){var marker = L.marker([$lat, $lon],{icon: gasred}).addTo(mymap);}
   else if($etat==2){var marker = L.marker([$lat, $lon],{icon: gasorange}).addTo(mymap);}
   else if($etat==3){var marker = L.marker([$lat, $lon],{icon: gasgreen}).addTo(mymap);}
 }
 </script>";
}
?>
</body>
</html>
