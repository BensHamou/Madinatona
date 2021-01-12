<?php
session_start();
if(empty($_SESSION['username']) || ($_SESSION['type']<1)) header('Location: log.php');
?>
<html>
  <head>
    <meta charset="utf-8">
    <title>MadinaTech - Statiques</title>
    <link rel="stylesheet" href="css.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="drop.css" media="screen" type="text/css" />
  <style>
  li a.active {
    background-color: CadetBlue;
    color: white;
  }
.shape {
    width: 200px;
    height: 70px;
    background: 	#93FBE8;
    margin-left: 400px;
    position: relative;
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
 #p1:hover {background-color:green;}
 #p2:hover {background-color:red;}
 </style>
</head>
<ul>
  <li><a href="announce.php">Ecrire une annonce</a></li>
  <div class="dropdown">
    <li><a>Consulter les annonces</a></li>
    <div class="dropdown-content">
      <a id="p1" href="viewann.php">Nouveaux </a>
      <a id="p2" href="annrej.php">Rejetées </a>
    </div>
  </div>
  <li><a class="active" href="statauth.php">Statiques</a></li>
  <li><a href="auth.php">Page d'accueil</a></li>
  <li><a href="declared.php">Consulter les nouveaux signalements</a></li>
  <li><a href="encours.php">Consulter les signalements en cours</a></li>
  <li><a href="finished.php">Consulter les signalements terminé</a></li>
  <li><a href="manageaccau.php">Paramètres de compte</a></li>
  <li><a href="log.php">Se déconnecter</a></li>
</ul>

<body>

    <?php
           $connect = mysqli_connect("localhost", "root", "", "base");
           if($_SESSION['type'] !== ""){
             $type = $_SESSION['type'];
           }
           $sql = "SELECT count(etat) as non from signalement where etat=1 and type= '".$type."'";
           $sql2 = "SELECT count(etat) as en from signalement where etat=2 and type= '".$type."'";
           $sql3 = "SELECT count(etat) as oui from signalement where etat=3 and type= '".$type."'";
           $result = mysqli_query($connect, $sql);
           $result2 = mysqli_query($connect, $sql2);
           $result3 = mysqli_query($connect, $sql3);

        $data=mysqli_fetch_assoc($result);
        $data2=mysqli_fetch_assoc($result2);
        $data3=mysqli_fetch_assoc($result3);

    $nonreparer=$data['non'];
    $encour=$data2['en'];
    $reparer=$data3['oui'];
    $total = "SELECT count(id) as total from signalement where type= '".$type."'";
    $totalreparer = "SELECT count(id) as totalreparer from signalement   where type= '".$type."' and etat=2";
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
          ['Non réparé', nonreparer ],
          ['En cours de réparation', encour ],
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
       <div id="chart_div2" style="border: 1px solid #ccc;width:250px;margin-left:auto;margin-right:auto;"></div></tr>


    </table>
  </body>
</html>
