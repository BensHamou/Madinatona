<?php
session_start();
if(empty($_SESSION['username']) || $_SESSION['type']!=0 ) header('Location: log.php');
?>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>MadinaTech - Page d'accueil</title>
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
      <section id="banner_parallax"  style="background-color: #DFFAF5;" >
      <div class="container">
        <div class="row">
          <div class="col-md-12" style="margin-top:3%;">
            <embed class="fadeInRight"  src="https://corporatedispatch.com/category/news/algeria/" style="width: 100%; height: 800px;">
          </div>
        </div>
      </div>
    </section>
<section class="layout_padding"  style="background-color: #DFFAF5;">
         <div class="container"style="margin-top:3%;">
            <div class="row">
               <div class="col-md-4">
                  <div class="information_blogs">
                     <div class="imf_icon"><img src="images/icon1.png" alt="#" /></div>
                     <div class="imf_head">
                        <h3>Fonctionement</h3>
                     </div>
                     <div class="imf_cont">
                        <p>Signalez les problèmes dans votre region, les autorités s'occuperont du rest</p>
                     </div>
                     <div class="imf_read"><a href="wreport.php">Signaler maintenant!</a></div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="information_blogs">
                     <div class="imf_icon"><img src="images/icon2.png" alt="#" /></div>
                     <div class="imf_head">
                        <h3>Design</h3>
                     </div>
                     <div class="imf_cont">
                        <p>Notre design est simple et efficace</p>
                     </div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="information_blogs">
                     <div class="imf_icon"><img src="images/icon3.png" alt="#" /></div>
                     <div class="imf_head">
                        <h3>Contactez nous 24h/24</h3>
                     </div>
                     <div class="imf_cont">
                        <p>Par téléphone au: 0542333952</p>
                        <div class="dropdown-divider"></div>
                          <p><br>Par email au: responsablemadinatech@gmail.com</p>
                          <div class="dropdown-divider"></div>
                          <p><br>Pour contacter l'admin: amadinatec@gmail.com</p>
                     </div>
                     <div class="imf_read"><a href="https://mail.google.com/mail/u/0/?view=cm&fs=1&tf=1&source=mailto&to=responsablemadinatech@gmail.com">Contactez</a></div>
                  </div>
               </div>
            </div>
         </div>
      </section>


      <!-- end header -->
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
