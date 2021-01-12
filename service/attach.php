<?php
$inactive = 1200;
ini_set('session.gc_maxlifetime', $inactive); // set the session max lifetime to 2 hours
session_start();
if (isset($_SESSION['testing']) && (time() - $_SESSION['testing'] > $inactive)) {
    session_unset();     // unset $_SESSION variable for this page
    session_destroy();   // destroy session data
}
$_SESSION['testing'] = time();
if(empty($_SESSION['username']) || $_SESSION['type']<1 ) header('Location: log.php');
?>
<html>
<head>
    <meta charset="utf-8">
    <title>MadinaTech - Signalement Attachés</title>
    <style>
    .card button {
      border: none;
      outline: 0;
      margin: 5px;
      padding: 12px;
      color: white;
      background-color : red;
      text-align: center;
      cursor: pointer;
      font-size: 18px;
    }
    </style>
</head>
<body id="page-top">
<div id="wrapper">
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="background: linear-gradient( #008BFF,#219AFF,#4FAFFF, #6EBDFF);">
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
  <div class="sidebar-brand-icon rotate-n-15"><i class="fas"></i></div><div class="sidebar-brand-text mx-3"><?php $user = $_SESSION['username'];echo "$user";?></div></a>
  <hr class="sidebar-divider my-0"><li class="nav-item "><a class="nav-link" href="declared.php">
    <i class="fas fa-fw fa-tachometer-alt"></i><span>Annuler</span></a></li><div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button></div>
    </ul>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
  <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
      <i class="fa fa-bars"></i>
    </button>
  </nav>
    <?php
    // connexion à la base de données
    $db_username = 'root';
    $db_password = '';
    $db_name     = 'base';
    $db_host     = 'localhost';
    $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
    or die('could not connect to database');
    if(isset($_POST['list'])){
      $id = $_POST['id'];
      $result = mysqli_query($db,"SELECT * FROM signalement WHERE attached = '".$id."' ");
      while($row = mysqli_fetch_array($result)){
        echo '<div class="col-md-4" style="margin-left:32%;">';
        echo '<form action="attach.php"  method="post">
        <div class="card border-info" style="margin-top:5%;">';
        echo '<div class="card-header"><h1 class="card-title" style="margin-left:20%;"><ins> Titre</ins>: '. $row['title'] . '</h1></div>';
        echo '<img class="rounded" src="'.$row['image'].'" alt  = "No photo for this report." style="margin-top:3%;margin-left:auto;margin-right:auto;width:50%;height:30%;" >';
        echo '<div class="card-body">';
        echo  '<p5 class="username" style="color:black"><ins>Signalé par</ins>: '. $row['username'] . '</p>';
        echo '<p5 class="card-text" style="color:black"><ins>Le</ins>: ' . $row['date1'] . '</p>';
        if($row['etat'] == 2)
        echo '<p5 class="card-text" style="color:black"><ins>Mise en prise le</ins>: ' . $row['date2'] . '</p>';
        if($row['etat'] == 3){
          if(empty($row['date2']))
          echo '<p5 class="card-text" style="color:black"><ins>Mise en prise et cloturé le</ins>: ' . $row['date3'] . '</p>';
          else{
            echo '<p5 class="card-text" style="color:black"><ins>Mise en prise le</ins>: ' . $row['date2'] . '</p>';
            echo '<p5 class="card-text" style="color:black"><ins>Cloturé le</ins>: ' . $row['date3'] . '</p>';
          }
        }
        echo  '<p5 class="adress" style="color:black"><ins>À</ins>: ' . $row['adress'] . '</p>';
        echo "<div class=\"card-header\"><p1> <ins>Description</ins>: <br>" . $row['description'] . "</p1></div>";
        if(!empty( $row['rapport'])){
          echo  "<div class=\"card-header\"><p1><ins>Rapport d'autorité</ins>: <br>". $row['rapport'] . "</p1></div>";
          }
          if(!empty( $row['imagerapport'])){
            echo '<br><img class="rounded" src="'.$row['imagerapport'].'" alt  = "No photo for this report." style="margin-left:25%;width:50%;" >';
          }
          if($row['id'] != $id ){
            echo '<form  action="attach.php" method="POST">';
            echo '<input type="hidden"  value="' . $row['id']  . '" name="id">';
            echo '<input type="hidden"  value="'.$id.'" name="idfrom">';
            echo  '<button type="submit" name="desattach" style="margin-top:10%;margin-left:35%;" class="btn btn-primary">Détacher</button>';
            echo '</form>';
          }
          echo '</div>';
          echo '</div>';
          echo '</div>';
        }
    }
    if(isset($_POST['almost'])){
    $report = $_SESSION['treat'];
    $requete = "UPDATE signalement SET etat = 2  where id = '".$report."' ";
    $requete2 = "UPDATE signalement SET date2 = NOW()  where id = '".$report."' ";
    $exec_requete = mysqli_query($db,$requete);
    $exec_requete = mysqli_query($db,$requete2);
    $message = "Signalement lencé";
    echo "<script type='text/javascript'>alert('$message');</script>";
    print("<script type=\"text/javascript\">location.href=\"encours.php\"</script>");
    }
    if(isset($_POST['done'])){
    $report = $_SESSION['treat'];
    $requete = "UPDATE signalement SET etat = 3  where id = '".$report."' ";
    $requete2 = "UPDATE signalement SET date3 = NOW()  where id = '".$report."' ";
    $exec_requete = mysqli_query($db,$requete);
    $exec_requete = mysqli_query($db,$requete2);
    $message = "Signalement cloturé";
    echo "<script type='text/javascript'>alert('$message');</script>";
    print("<script type=\"text/javascript\">location.href=\"finished.php\"</script>");
    }
    if(isset($_POST['attach'])){
      $id = $_POST['id'];
      $x =  $_POST['x'];
      $y =  $_POST['y'];
      $type =  $_POST['type'];
      $result = mysqli_query($db,"SELECT * FROM signalement WHERE locx BETWEEN '".$x."' - 0.001 and '".$x."' + 0.001
        AND locy BETWEEN '".$y."' - 0.001 and '".$y."' + 0.001
        AND etat = 1 AND type = '".$type."' AND id != '".$id."' ");
      while($row = mysqli_fetch_array($result)){
        echo '<div class="col-md-4" style="margin-left:32%;">';
        echo '<form action="attach.php"  method="post">
        <div class="card border-info" style="margin-top:5%;">';
        echo '<div class="card-header"><h1 class="card-title" style="margin-left:20%;"><ins> Titre</ins>: '. $row['title'] . '</h1></div>';
        echo '<img class="rounded" src="'.$row['image'].'" alt  = "No photo for this report." style="margin-top:3%;margin-left:auto;margin-right:auto;width:50%;height:30%;" >';
        echo '<div class="card-body">';
        echo  '<p5 class="username" style="color:black"><ins>Signalé par</ins>: '. $row['username'] . '</p>';
        echo '<p5 class="card-text" style="color:black"><ins>Le</ins>: ' . $row['date1'] . '</p>';
        if($row['etat'] == 2)
        echo '<p5 class="card-text" style="color:black"><ins>Mise en prise le</ins>: ' . $row['date2'] . '</p>';
        if($row['etat'] == 3){
          if(empty($row['date2']))
          echo '<p5 class="card-text" style="color:black"><ins>Mise en prise et cloturé le</ins>: ' . $row['date3'] . '</p>';
          else{
            echo '<p5 class="card-text" style="color:black"><ins>Mise en prise le</ins>: ' . $row['date2'] . '</p>';
            echo '<p5 class="card-text" style="color:black"><ins>Cloturé le</ins>: ' . $row['date3'] . '</p>';
          }
        }
        echo  '<p5 class="adress" style="color:black"><ins>À</ins>: ' . $row['adress'] . '</p>';
        echo "<div class=\"card-header\"><p1> <ins>Description</ins>: <br>" . $row['description'] . "</p1></div>";
        if(!empty( $row['rapport'])){
          echo  "<div class=\"card-header\"><p1><ins>Rapport d'autorité</ins>: <br>". $row['rapport'] . "</p1></div>";
          }
          if(!empty( $row['imagerapport'])){
            echo '<br><img class="rounded" src="'.$row['imagerapport'].'" alt  = "No photo for this report." style="margin-left:25%;width:50%;" >';
          }
          if($row['etat'] == 1 ){
            echo '<form  action="attach.php" method="POST">';
            echo '<input type="hidden"  value="' . $row['id']  . '" name="idto">';
            echo '<input type="hidden"  value="'.$id.'" name="id">';
            echo  '<button type="submit" style="margin-top:10%;margin-left:35%;" name="attachto" class="btn btn-primary">Attacher à</button>';
            echo '</form>';
          }
          echo '</div>';
          echo '</div>';
          echo '</div>';
        }
    }
    if(isset($_POST['attachto'])){
      $id = $_POST['id'];
      $idto = $_POST['idto'];
      $sql = "UPDATE signalement set attached = '".$idto."', visible = 0 where id = '".$id."'";
      $sql2 = "UPDATE signalement set priority = priority + 1 where id = '".$idto."'";
      //$sql = "INSERT INTO announce (body,image,authority) values('".$body."','".$filename."','".$type."')";
      $qry = mysqli_query($db, $sql);
      $qry2 = mysqli_query($db, $sql2);
      if($qry){
        $message = "Signalement attaché";
        echo "<script type='text/javascript'>alert('$message');</script>";
        print("<script type=\"text/javascript\">location.href=\"declared.php\"</script>");
      }
      else{
        $message = "Error.. please try again";
        echo "<script type='text/javascript'>alert('$message');</script>";
        print("<script type=\"text/javascript\">location.href=\"declared.php\"</script>");
      }
    }
    if(isset($_POST['delete'])) {
      $report = $_SESSION['treat'];
      $sql2 = "UPDATE signalement SET	rapport = NULL where signalement.id = '".$report."'";
      $sql3 = "UPDATE signalement SET imagerapport =  NULL where signalement.id = '".$report."' " ;
      $qry2 = mysqli_query($db, $sql2);
      $qry3 = mysqli_query($db, $sql3);
      $_POST['id'] = $report;
      $result = mysqli_query($db,"SELECT * FROM signalement where id =\"$report\"");
      $row = mysqli_fetch_array($result);
      if($qry2){
        $message = "Rapport supprimé";
        echo "<script type='text/javascript'>alert('$message');</script>";
        if($row['etat']==1){
          print("<script type=\"text/javascript\">location.href=\"declared.php\"</script>");
        }
        else{
          print("<script type=\"text/javascript\">location.href=\"encours.php\"</script>");
        }
      }
      else{
        $message = "Error.. please try again";
        echo "<script type='text/javascript'>alert('$message');</script>";
        if($row['etat']==1){
          print("<script type=\"text/javascript\">location.href=\"declared.php\"</script>");
        }
        else{
          print("<script type=\"text/javascript\">location.href=\"encours.php\"</script>");
        }
      }
    }
    if(isset($_POST['desattach'])){
      $id = $_POST['id'];
      $idfrom = $_POST['idfrom'];
      $sql = "UPDATE signalement set attached = '".$id."', visible = 2 where id = '".$id."'";
      $sql2 = "UPDATE signalement set priority = priority - 1 where id = '".$idfrom."'";
      //$sql = "INSERT INTO announce (body,image,authority) values('".$body."','".$filename."','".$type."')";
      $qry = mysqli_query($db, $sql);
      $qry2 = mysqli_query($db, $sql2);
      $result = mysqli_query($db,"SELECT * FROM signalement where id =\"$id\"");
      $row = mysqli_fetch_array($result);
      if($qry2){
        $message = "Signalement détaché";
        echo "<script type='text/javascript'>alert('$message');</script>";
        if($row['etat']==1){
          print("<script type=\"text/javascript\">location.href=\"declared.php\"</script>");
        }
        else{
          print("<script type=\"text/javascript\">location.href=\"encours.php\"</script>");
        }
      }
      else{
        $message = "Error.. please try again";
        echo "<script type='text/javascript'>alert('$message');</script>";
        if($row['etat']==1){
          print("<script type=\"text/javascript\">location.href=\"declared.php\"</script>");
        }
        else{
          print("<script type=\"text/javascript\">location.href=\"encours.php\"</script>");
        }
      }
    }
    ?>
</body>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title>SB Admin 2 - Dashboard</title>
<link rel="stylesheet" href="popup.css" media="screen" type="text/css" />

<!-- Custom fonts for this template-->
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

<!-- Custom styles for this template-->
<link href="css/sb-admin-2.min.css" rel="stylesheet">
</html>
