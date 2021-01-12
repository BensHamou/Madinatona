<?php
// connexion à la base de données
if(!isset($_SESSION)) {
  session_start();
}
$report = $_SESSION['treat'];
$type = $_SESSION['type'];
$db_username = 'root';
$db_password = '';
$db_name     = 'base';
$db_host     = 'localhost';
$db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
or die('could not connect to database');
if(isset($_POST['share'])) {
  $filename = $_FILES['uploadfile']['name'];
  $datetod = date('Y-m-d-h-i-sa');
  $filename = $datetod. $filename;
  $filetmpname = $_FILES['uploadfile']['tmp_name'];
  $comment = $_POST['comment'];
  $folder = 'imagecomment/';
  $path = "http://192.168.1.6/site/imagecomment/".$filename;
  move_uploaded_file($filetmpname, $folder.$filename);
  $sql2 = "UPDATE signalement SET	rapport = '".$comment."' where signalement.id = '".$report."'";
  $sql3 = "UPDATE signalement SET imagerapport =  '".$path."' where signalement.id = '".$report."' " ;
  $qry2 = mysqli_query($db, $sql2);
  $qry3 = mysqli_query($db, $sql3);
  $_POST['treat'] = $report;
  $message = "Rapport ajouté";
  echo "<script type='text/javascript'>alert('$message');</script>";
  print("<script type=\"text/javascript\">location.href=\"auth.php\"</script>");
  }
  if(isset($_POST['delete'])) {
    $sql2 = "UPDATE signalement SET	rapport = NULL where signalement.id = '".$report."'";
    $sql3 = "UPDATE signalement SET imagerapport =  NULL where signalement.id = '".$report."' " ;
    $qry2 = mysqli_query($db, $sql2);
    $qry3 = mysqli_query($db, $sql3);
    $_POST['treat'] = $report;
    $message = "Rapport supprimé";
    echo "<script type='text/javascript'>alert('$message');</script>";
    print("<script type=\"text/javascript\">location.href=\"auth.php\"</script>");
    }
  if(isset($_POST['announce'])) {
    $filename = $_FILES['uploadfile']['name'];
    $datetod = date('Y-m-d-h-i-sa');
    $filename = $datetod. $filename;
    $filetmpname = $_FILES['uploadfile']['tmp_name'];
    $title = $_POST['title'];
    $body = $_POST['body'];
    $date = date('Y-m-d');
    $dateD = date('Y-m-d', strtotime($_POST['dateD']));
    $dateF = date('Y-m-d', strtotime($_POST['dateF']));
    $folder = 'announce/';
    $path = "http://192.168.1.6/site/announce/".$filename;
    move_uploaded_file($filetmpname, $folder.$filename);
    $sql = "INSERT INTO announce (title,date,dateD,dateF,body,image,authority,visible) values('".$title."','".$date."','".$dateD."','".$dateF."','".$body."','".$path."','".$type."',-1)";
    //$sql = "INSERT INTO announce (body,image,authority) values('".$body."','".$filename."','".$type."')";
    $qry = mysqli_query($db, $sql);
    $_POST['treat'] = $report;
    if($qry){
      $message = "Annonce publié";
      echo "<script type='text/javascript'>alert('$message');</script>";
      print("<script type=\"text/javascript\">location.href=\"auth.php\"</script>");
    }
    else{
      $message = "Error.. please try again";
      echo "<script type='text/javascript'>alert('$message');</script>";
      print("<script type=\"text/javascript\">location.href=\"auth.php\"</script>");
    }
    }
  ?>
