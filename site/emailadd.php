<?php
session_start();
if(empty($_SESSION['username']) || $_SESSION['type']!=-1 ) header('Location: log.php');
?>
<html>
<head>
  <meta charset="utf-8">
  <title>MadinaTech - Changer numero de téléphone</title>
  <link rel="stylesheet" href="css.css" media="screen" type="text/css" />
  <link rel="stylesheet" href="announcecss.css" media="screen" type="text/css" />
  <style>
  input[type=email]{
    width: 60%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-top: 6px;
    margin-bottom: 16px;
  }
  input[type=submit] {
    background-color: #4CAF50;
    color: white;
  }
  .container {
    background-color: #f1f1f1;
    padding: 20px;
  }
  li a.active {
    background-color: black;
    color: white;
  }
</style>
</head>
<body>
<ul>
  <li><a href="admin.php">Retourner </a></li>
  <li><a href="passadd.php">Changer le mot de pass</a></li>
  <li><a class="active" href="emailadd.php">Changer l'email</a></li>
  <li><a href="phoneadd.php">Changer le numero de téléphone</a></li>
  <li><a href="addressadd.php">Changer l'address</a></li>
</ul>
  <div style="margin-left:15%;padding:1px 16px;height:1000px;">
  <h2>Change email</h2>
  <form action="manage.php" method="POST">
  <div class="container">
  <div class="row">
  <div class="col-25">
  <label>Nouveau email : </label>
  </div>
  <div class="col-75">
  <input type="email" placeholder="Nouveau email" name="new" required ></div>
  </div>
  <div class="row">
    <input type="submit" name="email"  value="Changer">
  </div>
</div>
</form>
</div>
</div>
</body>
</html>
