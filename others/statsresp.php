<?php
$inactive = 1200;
ini_set('session.gc_maxlifetime', $inactive); // set the session max lifetime to 2 hours
session_start();
if (isset($_SESSION['testing']) && (time() - $_SESSION['testing'] > $inactive)) {
    session_unset();     // unset $_SESSION variable for this page
    session_destroy();   // destroy session data
}
$_SESSION['testing'] = time();
if(empty($_SESSION['username']) || $_SESSION['type']!=-2 ) header('Location: log.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

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
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item"><a class="nav-link" href="resp.php"><i class="fas fa-home"></i><span>&#160;Page d'accueil</span></a></li>
      <li class="nav-item"><a class="nav-link" href="gestionreport.php"><i class="fas fa-paste"></i><span>&#160;Gestion de signalements</span></a></li>
      <li class="nav-item"><a class="nav-link" href="gestionannonce.php"><i class="fas fa-bullhorn"></i><span>&#160;Gestion d'annonces</span></a></li>
      <li class="nav-item active"><a class="nav-link" href="statsresp.php"><i class="fas fa-fw fa-chart-area"></i><span>&#160;Statistiques</span></a></li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-map-marked-alt"></i>
          <span>&#160;Explorez carte</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item fas fa-map-marked-alt" href="mapnew.php">&#160;Nouveaux signalements</a>
            <a class="collapse-item fas fa-map-marked-alt" href="mapexist.php">&#160;Signalements actifs</a>
          </div>
        </div>
      </li>
      <hr class="sidebar-divider my-0">
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#manage" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-cog"></i>
          <span>Mon compte</span>
        </a>
        <div id="manage" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item fas fa-cogs" href="passres.php"> &#160; Modifier mot de passe</a>
            <a class="collapse-item fas fa-user" href="manageaccountres.php"> &#160; Modifier compte</a>
            <div class="dropdown-divider"></div>
            <a class="collapse-item fas fa-sign-out-alt" href="http://127.0.0.1/site/log.php"> &#160; Se déconnecter</a>
          </div>
        </div>
      </li>
      <hr class="sidebar-divider d-none d-md-block">
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
          <?php
                 $connect = mysqli_connect("localhost", "root", "", "base");

                 $sql = "SELECT count(etat) as non from signalement where etat=1 and visible=2";
                 $sql2 = "SELECT count(etat) as en from signalement where etat=2 and visible=2";
                 $sql3 = "SELECT count(etat) as oui from signalement where etat=3 and visible=2";
                 $result = mysqli_query($connect, $sql);
                 $result2 = mysqli_query($connect, $sql2);
                 $result3 = mysqli_query($connect, $sql3);

              $data=mysqli_fetch_assoc($result);
              $data2=mysqli_fetch_assoc($result2);
              $data3=mysqli_fetch_assoc($result3);

          $nonreparer=$data['non'];
          $encour=$data2['en'];
          $reparer=$data3['oui'];
      		   $sql = "SELECT count(id) as eau from signalement where type=1 and visible=2";
      		   $sql2 = "SELECT count(id) as voiri from signalement where type=2 and visible=2";
             $sql3 = "SELECT count(id) as elec from signalement where type=3 and visible=2";
             $sql4 = "SELECT count(id) as gas from signalement where type=4 and visible=2";
      		   $result = mysqli_query($connect, $sql);
      		   $result2 = mysqli_query($connect, $sql2);
             $result3 = mysqli_query($connect, $sql3);
             $result4 = mysqli_query($connect, $sql4);

             $data=mysqli_fetch_assoc($result);
             $data2=mysqli_fetch_assoc($result2);
             $data3=mysqli_fetch_assoc($result3);
             $data4=mysqli_fetch_assoc($result4);

         $eau=$data['eau'];
         $voiri=$data2['voiri'];
         $elec=$data3['elec'];
         $gas=$data4['gas'];

                    ?>



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
              data.addRows([
                ['Déclarés', nonreparer ],
                ['Mise en prise', encour ],
                ['Réparés ', reparer]
              ]);


              var options = {'title':'Etat de tous les signalements',
                             'width':400,
                             'height':300,
                             'colors': ['#e0440e', '#FFFF33', '#32CD32']};


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
              ["Problem d'eau", eau, "#00FFFF"],
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
      <!--Table and divs that hold the pie charts-->
      <table  >
            <tr>
             <div id="chart_div" class="charo" style="border: 1px solid #ccc;width:400px;margin-left:auto;margin-right:auto;"></div></tr>
              <tr><div id="columnchart_values" style="border: 1px solid #ccc;width:600px;margin-left:auto;margin-right:auto;"></div></tr>

          </table>
        </div>
<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

</body>
</html>
