<?php
$inactive = 1200;
ini_set('session.gc_maxlifetime', $inactive); // set the session max lifetime to 2 hours
session_start();
if (isset($_SESSION['testing']) && (time() - $_SESSION['testing'] > $inactive)) {
    session_unset();     // unset $_SESSION variable for this page
    session_destroy();   // destroy session data
}
$_SESSION['testing'] = time();
if(empty($_SESSION['username']) || ($_SESSION['type']<1)) header('Location: log.php');
?>
<html>

   <head>
     <style>
     .shape {
         width: 200px;
         height: 70px;
         background: 	#93FBE8;
         margin-left: 300px;
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
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="">
   <meta name="author" content="">

   <title>MadinaTech - Statiques</title>

   <!-- Custom fonts for this template-->
   <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
   <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

   <!-- Custom styles for this template-->
   <link href="css/sb-admin-2.min.css" rel="stylesheet">

   </head>
   <body id="page-top">
     <div id="wrapper">
       <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="background: linear-gradient( #008BFF,#219AFF,#4FAFFF, #6EBDFF);">
         <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
           <div class="sidebar-brand-icon rotate-n-15"><i class="fas"></i></div><div class="sidebar-brand-text mx-3"><?php $user = $_SESSION['username'];echo "$user";?></div></a>
         <hr class="sidebar-divider my-0">
         <li class="nav-item "><a class="nav-link" href="auth.php"><i class="fas fa-home"></i><span>&#160;Page d'accueil</span></a></li>
      <li class="nav-item"><a class="nav-link" href="announce.php"><i class="fas fa-file-signature"></i><span>&#160;Ecrire une annonce</span></a></li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="viewann.php" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-bullhorn"></i>
          <span>&#160;Voir annonce</span></a>
          <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item  fas fa-bullhorn" href="viewann.php">&#160;Nouvelle</a>
            <a class="collapse-item  fas fa-bullhorn" href="annrej.php">&#160;Réfusées</a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-paste"></i>
          <span>Voir signalement</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item fas fa-paste" href="declared.php">&#160;Nouveaux signalements</a>
            <a class="collapse-item fas fa-paste" href="encours.php">&#160;Signalements en cours</a>
            <a class="collapse-item fas fa-paste" href="finished.php">&#160;Signalement cloturés</a>
        </div>
      </li>
      <li class="nav-item active"><a class="nav-link" href="statauth.php"><i class="fas fa-fw fa-chart-area"></i><span>Statistiques</span></a></li>
      <hr class="sidebar-divider my-0">
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#manage" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-cog"></i>
          <span>Mon compte</span></a>
             <div id="manage" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
               <div class="bg-white py-2 collapse-inner rounded">
                 <a class="collapse-item fas fa-cogs " href="passau.php"> &#160; Modifier mot de passe</a>
                 <a class="collapse-item fas fa-user" href="manageaccount.php"> &#160; Modifier compte</a>
                 <div class="dropdown-divider"></div>
                 <a class="collapse-item fas fa-sign-out-alt" href="http://127.0.0.1/site/log.php"> &#160; Se déconnecter</a>
               </div>
             </div>
         </li>
         <div class="text-center d-none d-md-inline">
           <button class="rounded-circle border-0" id="sidebarToggle"></button>
         </div>
       </ul>
       <div id="content-wrapper" class="d-flex flex-column">
         <div id="content">
           <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
             <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
               <i class="fa fa-bars"></i>
             </button>
           </nav>
         <div class="container-fluid">

<body>

    <?php
           $connect = mysqli_connect("localhost", "root", "", "base");
           if($_SESSION['type'] !== ""){
             $type = $_SESSION['type'];
           }
           $sql = "SELECT count(etat) as non from signalement where etat=1 and visible=2 and type= '".$type."'";
           $sql2 = "SELECT count(etat) as en from signalement where etat=2 and visible=2 and type= '".$type."'";
           $sql3 = "SELECT count(etat) as oui from signalement where etat=3 and visible=2 and type= '".$type."'";
           $result = mysqli_query($connect, $sql);
           $result2 = mysqli_query($connect, $sql2);
           $result3 = mysqli_query($connect, $sql3);

        $data=mysqli_fetch_assoc($result);
        $data2=mysqli_fetch_assoc($result2);
        $data3=mysqli_fetch_assoc($result3);

    $nonreparer=$data['non'];
    $encour=$data2['en'];
    $reparer=$data3['oui'];
    $total = "SELECT count(id) as total from signalement where type= '".$type."' and visible=2";
    $totalreparer = "SELECT count(id) as totalreparer from signalement   where type= '".$type."' and etat=2 and visible=2";
    $totalresult = mysqli_query($connect, $total);
       $totaldata=mysqli_fetch_assoc($totalresult);
       $totalreparer = mysqli_query($connect, $totalreparer);
       $totalreparer=mysqli_fetch_assoc($totalreparer);

   $total=$totaldata['total'];

   $totalreparer=$totalreparer['totalreparer'];
   $pours=($totalreparer/$total)*100;


              ?>



    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
  var nonreparer = <?php echo $nonreparer; ?>;
var encour =<?php echo $encour; ?>;
var reparer = <?php echo $reparer; ?>;
var pours = <?php echo $pours; ?>;


      google.charts.load('current', {'packages':['corechart']});


      google.charts.setOnLoadCallback(drawChart);


      function drawChart() {


        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Déclarés', nonreparer ],
          ['Prise en charge', encour ],
          ['Cloturés', reparer]
        ]);


        var options = {'title':'Etat de tous les signalements',
                       'width':400,
                       'height':300,
                       'colors': ['#e0440e', '#FFFF33', '#32CD32']};


        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
      google.charts.load('current', {'packages':['gauge']});
      google.charts.setOnLoadCallback(drawChart2);

function drawChart2() {

  var data = google.visualization.arrayToDataTable([
    ['Label', 'Value'],
    ['reussite %', pours]
  ]);

  var options = {
    width: 410, height: 210,
    redFrom: 80, redTo: 100,
    yellowFrom:40, yellowTo: 80,
    greenFrom:0,greenTo:40,
    minorTicks: 5
  };

  var chart = new google.visualization.Gauge(document.getElementById('chart_div2'));

  chart.draw(data, options);

  setInterval(function() {

    chart.draw(data, options);
  }, 13000);

}

  </script>
<!--Table and divs that hold the pie charts-->
<div class="shape"><p><span>&#128110;</span> Vous avez <?php echo $total; ?> signales</p></div>
<table  >
      <tr>
        <div id="chart_div" class="charo" style="border: 1px solid #ccc;width:400px;margin-left:auto;margin-right:auto;"></div></tr>
       <div id="chart_div2" style="width:250px;margin-left:auto;margin-right:auto;"></div></tr>


    </table>
    <!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>


  </body>
</html>
