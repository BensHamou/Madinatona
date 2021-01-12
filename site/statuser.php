<?php
session_start();
if(empty($_SESSION['username']) || $_SESSION['type']!=0 ) header('Location: log.php');

$connect = mysqli_connect("localhost", "root", "", "base");
if($_SESSION['username'] !== ""){
  $user = $_SESSION['username'];
}
$sql = "SELECT count(etat) as non from signalement where etat=1 and visible=2 and username= '".$user."'";
$sql2 = "SELECT count(etat) as en from signalement where etat=2 and visible=2 and username= '".$user."'";
$sql3 = "SELECT count(etat) as oui from signalement where etat=3 and visible=2 and username= '".$user."'";
$result = mysqli_query($connect, $sql);
$result2 = mysqli_query($connect, $sql2);
$result3 = mysqli_query($connect, $sql3);
$data=mysqli_fetch_assoc($result);
$data2=mysqli_fetch_assoc($result2);
$data3=mysqli_fetch_assoc($result3);
$nonreparer=$data['non'];
$encour=$data2['en'];
$reparer=$data3['oui'];
$total = "SELECT count(id) as total from signalement where username= '".$user."'";
$sql = "SELECT count(id) as eau from signalement where type=1 and visible=2 and username= '".$user."'";
$sql2 = "SELECT count(id) as voiri from signalement where type=2 and visible=2 and username= '".$user."'";
$sql3 = "SELECT count(id) as elec from signalement where type=3 and visible=2 and username= '".$user."'";
$sql4 = "SELECT count(id) as gas from signalement where type=4 and visible=2 and username= '".$user."'";
$totalresult = mysqli_query($connect, $total);
$result = mysqli_query($connect, $sql);
$result2 = mysqli_query($connect, $sql2);
$result3 = mysqli_query($connect, $sql3);
$result4 = mysqli_query($connect, $sql4);
$totaldata=mysqli_fetch_assoc($totalresult);
$data=mysqli_fetch_assoc($result);
$data2=mysqli_fetch_assoc($result2);
$data3=mysqli_fetch_assoc($result3);
$data4=mysqli_fetch_assoc($result4);
$total=$totaldata['total'];
$eau=$data['eau'];
$voiri=$data2['voiri'];
$elec=$data3['elec'];
$gas=$data4['gas'];
?>
<html lang="en">
   <head>
     <style>
     .shape {
         width: 200px;
         height: 70px;
         background: 	#93FBE8;
         margin-left: 400px;
         position: relative;
     }
     li a.active {
       background-color: brown;
       color: white;
     }
     .shape:before {
         display: block;
         content: "";
         height: 0;
         width: 0;
         border: 50px solid #93FBE8;
         border-bottom:50px solid transparent;
         border-left: 50px solid transparent;
         border-left: 50px solid transparent;
         position: absolute;
         top: 20px;
     }
     </style>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>MadinaTech - Statiques</title>
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
                       <li><a class="nav-link active" style="background-color:LightBlue" href="statuser.php">Statistiques</a></li>
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
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script type="text/javascript">
      var nonreparer = <?php echo $nonreparer; ?>;
      var encour =<?php echo $encour; ?>;
      var reparer = <?php echo $reparer; ?>;
         google.charts.load('current', {'packages':['corechart']});
         google.charts.setOnLoadCallback(drawChart);
         function drawChart() {
           var data = new google.visualization.DataTable();
           data.addColumn('string', 'Topping');
           data.addColumn('number', 'Slices');
           data.addRows([['Déclarés', nonreparer ],['Prise en charge', encour ],['Cloturés', reparer]]);
           var options = {'title':'Etat de tous les signalements','width':400,'height':300,'colors': ['#e0440e', '#FFFF33', '#32CD32']};
           var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
           chart.draw(data, options);
         }
           var eau = <?php echo $eau; ?>;
           var voiri = <?php echo $voiri; ?>;
           var elec = <?php echo $elec; ?>;
           var gas = <?php echo $gas; ?>;
             google.charts.load("current", {packages:['corechart']});
             google.charts.setOnLoadCallback(drawChar);
             function drawChar() {
               var data = google.visualization.arrayToDataTable([
                 ["Element", "Density", { role: "style" } ],
                 ["Problèm d'eau", eau, "#00FFFF"],
                 ["Voirie", voiri, "silver"],
                 ["Electricite", elec, "gold"],
                 ["Gas", gas, "color: #e5e4e2"]
               ]);

               var view = new google.visualization.DataView(data);
               view.setColumns([0, 1,
                                { calc: "stringify",
                                  sourceColumn: 1,
                                  type: "string",
                                  role: "annotation" },
                                2]);

               var options = {
                 title: "Total des signalements",
                 width: 600,
                 height: 400,
                 bar: {groupWidth: "95%"},
                 legend: { position: "none" },
               };
               var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
               chart.draw(view, options);
           }
           </script>
      <div class="shape"><p><span>&#129332;</span>Vous avez <?php echo $total; ?> signalements</p></div>
      <table  >
            <tr>
             <div id="chart_div" class="charo" style="border: 1px solid #ccc;width:400px;margin-left:auto;margin-right:auto;"></div></tr>
              <tr><div id="columnchart_values" style="border: 1px solid #ccc;width:600px;margin-left:auto;margin-right:auto;"></div></tr>
          </table>
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
