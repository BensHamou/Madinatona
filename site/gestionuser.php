<?php
session_start();
if(empty($_SESSION['username']) || $_SESSION['type']!=-1 ) header('Location: log.php');
?>
<html>
<head>
  <meta charset="utf-8">
  <title>MadinaTech - Créer un utilisateur</title>
  <link rel="stylesheet" href="gestionusercss.css" media="screen" type="text/css" />
  <link rel="stylesheet" href="css.css" media="screen" type="text/css" />
  <link rel="stylesheet" href="drop.css" media="screen" type="text/css" />
<style>
  li a.active {
  background-color: brown;
  color: white;
  }
  #p1:hover {background-color:yellow;}
  #p3:hover{background-color:red;}
  </style>
</head>
<ul>
  <li><a href="demandedajout.php">Demandes d'inscription</a></li>
  <li><a class="active" href="gestionuser.php">Creer un utilisateur</a></li>
  <li><a href="type.php">Gestion catégorie</a></li>
  <li><a href="admin.php">Page d'accueil</a></li>
  <div class="dropdown">
    <li><a>List</a></li>
    <div class="dropdown-content">
      <a id="p1" href="signaledusers.php">Signalés</a>
      <a id="p3" href="activate.php">Désactivés </a>
    </div>
  </div>
  <li><a href="consultationuser.php">Désactiver un profile</a></li>
  <li><a href="manageaccadd.php">Paramètres de compte</a></li>
  <li><a href="log.php">Se déconnecter</a></li>
</ul>
<body id='grad1'>
  <?php
    $db_username = 'root';
    $db_password = '';
    $db_name     = 'base';
    $db_host     = 'localhost';
    $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
    or die('could not connect to database');
    ?>
<div class="form-style-6">
<h1>Creer un profile</h1>
 <form action="gestionuser.php" method="POST">
   <label><b>Nom : </b></label>
   <input type="text" placeholder="Nom" name="nom" required>
   <label><b>Prenom : </b></label>
   <input type="text" placeholder="Prenom" name="prenom"required >
   <label><b>Date de naissance :</b></label>
   <input type="date" placeholder="Date naissance" name="daten">
   <label><b>Address : </b></label>
   <input type="text" placeholder="Adress" name="adress" >
   <label><b>Phone : </b></label>
   <input type="number" placeholder="Phone"  min="0" max="9999999999" onkeyup="if(parseInt(this.value)>999999999){ this.value =9999999999; return false; }" name="phone"required >
   <label><b>Email : </b></label>
   <input type="email" placeholder="Email" name="email"required >
   <label><b>Nom d'utilisateur : </b></label>
   <input type="text" placeholder="Nom d'utilisateur" name="newuser"required >
   <label><b>Mot de pass :</b></label>
   <input type="password" id="cp" placeholder="Mot de pass" name="password"required >
   <input type="checkbox" onclick="myFunctioncp()">Show
   <script>
     function myFunctioncp() {
       var x = document.getElementById("cp");
       if (x.type === "password") {
         x.type = "text";
       } else {
         x.type = "password";
       }
     }
  </script>
   <label><b></b></label>
   <select name="type">
     <option value="-2">Résponsable</option>';
     <option value="-1">Admin</option>';
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
   <input type="submit" id='submit' value='Creer' name='ajouter' >
 </form>
</div>
<?php
 if(isset($_POST['ajouter'])){
   $nom = mysqli_real_escape_string($db,htmlspecialchars($_POST['nom']));
   $prenom = mysqli_real_escape_string($db,htmlspecialchars($_POST['prenom']));
   $daten = mysqli_real_escape_string($db,htmlspecialchars($_POST['daten']));
   $adress = mysqli_real_escape_string($db,htmlspecialchars($_POST['adress']));
   $phone = mysqli_real_escape_string($db,htmlspecialchars($_POST['phone']));
   $email = mysqli_real_escape_string($db,htmlspecialchars($_POST['email']));
   $nusername = mysqli_real_escape_string($db,htmlspecialchars($_POST['newuser']));
   $password = sha1(mysqli_real_escape_string($db,htmlspecialchars($_POST['password'])));
   $type = mysqli_real_escape_string($db,htmlspecialchars($_POST['type']));
   $requete = "INSERT into user(nom, prenom, dateN, adress, phone, email, username, password, type, visible, signaled) values
   ('".$nom."','".$prenom."','".$daten."','".$adress."', '".$phone."',  '".$email."','".$nusername."','".$password."','".$type."',1,0)";
   $exec_requete = mysqli_query($db,$requete);
   if($exec_requete){
     $message = "Profile creer";
     echo "<script type='text/javascript'>alert('$message');</script>";
     print("<script type=\"text/javascript\">location.href=\"admin.php\"</script>");
   }
   else{
     $message = "Error.. please try again";
     echo "<script type='text/javascript'>alert('$message');</script>";
     print("<script type=\"text/javascript\">location.href=\"admin.php\"</script>");
   }
   }
?>
</body>
</html>
