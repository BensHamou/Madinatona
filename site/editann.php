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
      <title>MadinaTech - Modifier annonce</title>
      <link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
      <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
      <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
      <meta charset="utf-8">
      <link rel="stylesheet" href="css.css" media="screen" type="text/css" />
      <link rel="stylesheet" href="announcecss.css" media="screen" type="text/css" />
      <style>
      li a.active {
        background-color: grey;
        color: white;
      }
      #checkOut:invalid {
      color: red;
    }
      article, aside, figure, footer, header, hgroup, menu, nav, section { display: block; }
    </style>
    </head>
    <body>
      <ul>
        <li><a href="viewann.php">Annuler</a></li>
      </ul>
      <div style="margin-left:15%;padding:1px 16px;height:1000px;">
      <h2>Modifier l\'annonce</h2>
    <div class="container">
      <form action="editannonce.php" method="POST" enctype="multipart/form-data">
        <div class="row">
          <div class="col-25">
          <label for="country">Titre : </label>
        </div>
        <div class="col-75">
          <input type="text" name="title" value= "'.$row['title'].'" placeholder="Titre" required>
        </div>
      </div>
      <div class="row">
        <div class="col-25">
          <label for="subject">Sujet : </label>
        </div>
        <div class="col-75">
          <textarea id="subject" name="body" placeholder="Ecrire votre annonce.." style="height:200px" required>'.$row['body'].' </textarea>
        </div>
      </div>
      <div class="row">
        <div class="col-25">
          <label for="country">Date début : </label>
        </div>
        <div class="col-75">
          <input type="date" value="dateD" value= "'.$row['dateD'].'" name="dateD" id="dateD" required>
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
          <p id="demo">'.$row['date'].'</p>
        </div>
      </div>
      <div class="row">
        <input type="file" name="uploadfile" onchange="readURL(this);" multiple class="choose">
        <img id="blah" src="'.$row['image'].'" width="200" height="200"  alt="" />
      </div>
      <div class="row">
        <input type="submit" name="update" value="Modifier">
        <input type="hidden" value="'.$row['id'].'" name="id">
      </div>
      </form>
    </div>
    </div>
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
    </body>';
  }
  }
  ?>
