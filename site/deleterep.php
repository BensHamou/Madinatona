<?php
// connexion à la base de données
$db_username = 'root';
$db_password = '';
$db_name     = 'base';
$db_host     = 'localhost';
$db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
or die('could not connect to database');
if(isset($_POST['delete'])) {
  $id = $_POST['delete'];
  $sql = "UPDATE signalement SET visible = 0  where id = '".$id."' ";
  $qry = mysqli_query($db, $sql);
  if($qry){
    $message = "Signalement supprimé";
    echo "<script type='text/javascript'>alert('$message');</script>";
    print("<script type=\"text/javascript\">location.href=\"myrep.php\"</script>");
  }
  else{
    $message = "Error.. please try again";
    echo "<script type='text/javascript'>alert('$message');</script>";
    print("<script type=\"text/javascript\">location.href=\"myrep.php\"</script>");
  }
  }
  ?>
