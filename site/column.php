<?php
session_start();
if(empty($_SESSION['username']) || $_SESSION['type']!=-2 ) header('Location: log.php');
?>
<html>
  <title>MadinaTech - Statistics Admin</title>
  <link rel="stylesheet" href="css.css" media="screen" type="text/css" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="drop.css" media="screen" type="text/css" />
  <style>
  li a.active {
    background-color: Tomato;
    color: white;
  }
  #p1:hover {background-color:red;}
  #p3:hover{background-color:green;}
  </style>
</head>
<body>
<ul>
  <li><a href="gestionreport.php">Nouveaux signalements</a></li>
  <li><a href="nouvannounce.php">Nouvelles annonces</a></li>
  <li><a class="active" href="column.php">Statiques</a></li>
  <li><a href="resp.php">Page d'accueil</a></li>
  <div class="dropdown">
    <li><a>Map</a></li>
    <div class="dropdown-content">
      <a id="p1" href="mapres1.php">Nouveaux</a>
      <a id="p3" href="mapres2.php">Validés </a>
    </div>
  </div>
  <li><a href="manageaccresp.php">Paramètres de compte</a></li>
  <li><a href="log.php">Se déconnecter</a></li>
</ul>

  <body>

    <?php
           $connect = mysqli_connect("localhost", "root", "", "base");

           $sql = "SELECT count(etat) as non from signalement where etat=1";
           $sql2 = "SELECT count(etat) as en from signalement where etat=2";
           $sql3 = "SELECT count(etat) as oui from signalement where etat=3";
           $result = mysqli_query($connect, $sql);
           $result2 = mysqli_query($connect, $sql2);
           $result3 = mysqli_query($connect, $sql3);

        $data=mysqli_fetch_assoc($result);
        $data2=mysqli_fetch_assoc($result2);
        $data3=mysqli_fetch_assoc($result3);

    $nonreparer=$data['non'];
    $encour=$data2['en'];
    $reparer=$data3['oui'];
		   $sql = "SELECT count(id) as eau from signalement where type=1";
		   $sql2 = "SELECT count(id) as voiri from signalement where type=2";
       $sql3 = "SELECT count(id) as elec from signalement where type=3";
       $sql4 = "SELECT count(id) as gas from signalement where type=4";
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
          ['Non réparés', nonreparer ],
          ['En cour', encour ],
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
        ["Voiri", voiri, "silver"],
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
  </body>
</html>
