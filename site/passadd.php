<?php
session_start();
if(empty($_SESSION['username']) || $_SESSION['type']!=-1 ) header('Location: log.php');
?>
<html>
<head>
  <meta charset="utf-8">
  <title>MadinaTech - Changer mot de pass</title>
  <link rel="stylesheet" href="css.css" media="screen" type="text/css" />
  <link rel="stylesheet" href="announcecss.css" media="screen" type="text/css" />
  <style>
  input[type=password],input[type=text] {
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
    <li><a class="active" href="passadd.php">Changer le mot de pass</a></li>
    <li><a href="emailadd.php">Changer l'email</a></li>
    <li><a href="phoneadd.php">Changer le numero de téléphone</a></li>
    <li><a href="addressadd.php">Changer l'address</a></li>
  </ul>
  <div style="margin-left:15%;padding:1px 16px;height:1000px;">
  <h2>Changer le mot de pass</h2>
  <form action="manage.php" method="POST" onsubmit="return checkForm();">
<div class="container">
    <div class="row">
      <div class="col-25">
      <label for="country">Mot de pass courant : </label>
    </div>
    <div class="col-75">
      <input type="password" name="cp" id="cp" placeholder="Mot de pass courant" required>
      <input type="checkbox" onclick="myFunctioncp()">Show
    </div>
  </div>
  <div class="row">
    <div class="col-25">
    <label for="np">Nouveau mot de pass : </label>
  </div>
  <div class="col-75">
    <input type="password" name="np" id="np" placeholder="Nouveau mot de pass" required>
    <input type="checkbox" onclick="myFunctionnp()">Show
  </div>
</div>
<div class="row">
  <div class="col-25">
  <label for="country">Confirmer nouveau mot de pass: </label>
</div>
<div class="col-75">
  <input type="password" name="cnp" id ="cnp" placeholder="Confirmer nouveau mot de pass" required>
  <input type="checkbox" onclick="myFunctioncnp()">Show
</div>
</div>
  <div class="row">
    <input type="submit" name="pass"  value="Changer">
  </div>
  </form>
<script>
  function myFunctioncp() {
    var x = document.getElementById("cp");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }
  function myFunctionnp() {
    var x = document.getElementById("np");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }
  function myFunctioncnp() {
    var x = document.getElementById("cnp");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }
  function checkForm(){
    var np = document.getElementById("np");
    var cnp = document.getElementById("cnp");
    if(np.value != cnp.value){
    alert("Please confirm password again.");
    return false;
  }
  return true;
}
  </script>
</div>
</div>
</body>
</html>
