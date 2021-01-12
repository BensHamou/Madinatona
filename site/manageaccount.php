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
    <title>MadinaTech - Mes signalements</title>

      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
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
                        <a class="nav-link active dropdown-toggle" style="background-color:LightBlue" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"  href="#">Modifier profile</a>
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
      <div class="container">
      <div class="row">
        <div id="content-wrapper" class="d-flex flex-column">
          <div id="content">
        <?php
        $db_username = 'root';
        $db_password = '';
        $db_name     = 'base';
        $db_host     = 'localhost';
        $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
               or die('could not connect to database');
        if($_SESSION['username'] !== ""){
          $user = $_SESSION['username'];
          $result = mysqli_query($db,"SELECT * FROM user where username = '".$user."'");
          while($row = mysqli_fetch_array($result)){
            echo'
          <div class="container" style="margin-left:20%;margin-top:5%">
            <h2>Modifier profile</h2>
          	<form action="manage.php" method="POST">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Address:</label>
                <input class="form-control" type="text" name="address" value= "'.$row['adress'].'" placeholder="Nouveau address" required>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Email:</label>
                <input class="form-control" type="email" name="email" value= "'.$row['email'].'" placeholder="Nouveau email" required>
              </div>
              </div>
              <div class="form-row">
              <div class="form-group col-md-6">
                <label>Telephone:</label>
                <input class="form-control" type="tel" name="phone" value= "'.$row['phone'].'" placeholder="Nouveau numéro" pattern="[0-9]{10}" required>
                </div>
                </div>
              <div class="form-group" style="margin-left:20%;margin-top:5%">
                <button type="submit" class="btn btn-primary" name="manage">Changer</button>
              </div>
          	</form>';

                      }
                    }
                    ?>
          </div>
        </div>
      </div>
    </body>

</body>
</html>
