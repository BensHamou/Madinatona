<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">

</head>
<body>
<?php   
           $connect = mysqli_connect("localhost", "root", "", "base");  
		   $sql = "SELECT count(etat) as non from report where etat=1";  
		   $sql2 = "SELECT count(etat) as en from report where etat=2"; 
		   $sql3 = "SELECT count(etat) as oui from report where etat=3"; 
		   $result = mysqli_query($connect, $sql); 
		   $result2 = mysqli_query($connect, $sql2);
		   $result3 = mysqli_query($connect, $sql3); 
           
		$data=mysqli_fetch_assoc($result);
		$data2=mysqli_fetch_assoc($result2);
		$data3=mysqli_fetch_assoc($result3);
		
$nonreparer=$data['non'];
$encour=$data2['en'];
$reparer=$data3['oui'];

           ?>
<div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
<script src="../../canvasjs.min.js"></script>
<script type="text/javascript">

var nonreparer = "<?php echo $nonreparer; ?>";
var encour = "<?php echo $encour; ?>";
var reparer = "<?php echo $reparer; ?>";
window.onload = function() {

var chart = new CanvasJS.Chart("chartContainer", {
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	exportEnabled: true,
	animationEnabled: true,
	title: {
		text: "etat des rapport"
	},
	data: [{
		type: "pie",
		startAngle: 25,
		toolTipContent: "<b>{label}</b>: {y}%",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} - {y}",
		dataPoints: [
			{ y: nonreparer, label: "pas reparer" },
			{ y: encour, label: "en cours" },
			{ y: reparer, label: "reparer" }
			
		]
	}]
});
chart.render();

}
</script>
</body>
</html>