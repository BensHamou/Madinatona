<?php
session_start();
if(empty($_SESSION['username']) || $_SESSION['type']<1 ) header('Location: log.php');
?>
<html>
<head>
  <title>MadinaTech - Ecrire une annonce</title>
  <link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
  <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css.css" media="screen" type="text/css" />
  <link rel="stylesheet" href="announcecss.css" media="screen" type="text/css" />
  <link rel="stylesheet" href="drop.css" media="screen" type="text/css" />
  <style>
  li a.active {
    background-color: grey;
    color: white;
  }
  #checkOut:invalid {
  color: red;
}
  article, aside, figure, footer, header, hgroup, menu, nav, section { display: block; }
  #p1:hover {background-color:green;}
  #p2:hover {background-color:red;}
  </style>
</head>
<ul>
  <li><a class="active" href="announce.php">Ecrire une annonce</a></li>
  <div class="dropdown">
    <li><a>Consulter les annonces</a></li>
    <div class="dropdown-content">
      <a id="p1" href="viewann.php">Nouveaux </a>
      <a id="p2" href="annrej.php">Rejetées </a>
    </div>
  </div>
  <li><a href="statauth.php">Statiques</a></li>
  <li><a href="auth.php">Page d'accueil</a></li>
  <li><a href="declared.php">Consulter les nouveaux signalements</a></li>
  <li><a href="encours.php">Consulter les signalements en cours</a></li>
  <li><a href="finished.php">Consulter les signalements terminé</a></li>
  <li><a href="manageaccau.php">Paramètres de compte</a></li>
  <li><a href="log.php">Se déconnecter</a></li>
</ul>

  <div style="margin-left:15%;padding:1px 16px;height:1000px;">
  <h2>Ecrire une annonce</h2>
<div class="container">
  <form action="addcommentann.php" method="POST" enctype="multipart/form-data">
    <div class="row">
      <div class="col-25">
      <label for="country">Titre : </label>
    </div>
    <div class="col-75">
      <input type="text" name="title" placeholder="Titre" required>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="subject">Sujet : </label>
    </div>
    <div class="col-75">
      <textarea id="subject" name="body" placeholder="Ecrire votre annonce.." style="height:200px" required></textarea>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="country">Date début : </label>
    </div>
    <div class="col-75">
      <input type="date" value="dateD" name="dateD" id="dateD" required>
    </div>
    <div class="col-25">
      <label for="country">Date fin : </label>
    </div>
    <div class="col-75">
      <input type="date" value="dateF" name="dateF" min="" id="dateF" onblur="compare();" required>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="country">Date : </label>
    </div>
    <div class="col-75">
      <p id="demo"></p>
    </div>
  </div>
  <div class="row">
    <input type="file" name="uploadfile" onchange="readURL(this);" multiple class="choose">
    <img id="blah" src="" alt="" />
  </div>
  <div class="row">
    <input type="submit" name="announce" value="Publier">
  </div>
  </form>
</div>
</div>
<script>
var dateD = document.getElementById('dateD');
var dateF = document.getElementById('dateF');

dateD.addEventListener('change', updatedate);
function updatedate() {
    var firstdate = document.getElementById("dateD").value;
    document.getElementById("dateF").value = "";
    document.getElementById("dateF").setAttribute("min",firstdate);
}
  var dt = new Date();
  document.getElementById('demo').innerHTML =dt.toLocaleString();
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
</body>
</html>
