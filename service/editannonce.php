<?php
// connexion à la base de données
if(!isset($_SESSION)) {
  session_start();
}
$db_username = 'root';
$db_password = '';
$db_name     = 'base';
$db_host     = 'localhost';
$db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
or die('could not connect to database');
if(isset($_POST['delete'])) {
  $id = $_POST['delete'];
  $sql = "UPDATE announce SET visible = 0  where id = '".$id."' ";
  $qry = mysqli_query($db, $sql);
  if($qry){
    $message = "Annonce supprimé";
    echo "<script type='text/javascript'>alert('$message');</script>";
    print("<script type=\"text/javascript\">location.href=\"viewann.php\"</script>");
  }
  else{
    $message = "Error.. please try again";
    echo "<script type='text/javascript'>alert('$message');</script>";
    print("<script type=\"text/javascript\">location.href=\"viewann.php\"</script>");
  }
  }
  if(isset($_POST['update'])) {
    $secretKey="6Lf_SccZAAAAAG95B1ABAH2xhFS9sKuF50Tu75oS";
    $responseKey=$_POST['g-recaptcha-response'];
    $url="https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey";
    $response=file_get_contents($url);
    $response=json_decode($response);
    if($response->success){
  $title = $_POST['title'];
  $body = $_POST['body'];
  $id = $_POST['id'];
  $date = date('Y-m-d');
  $dateD = date('Y-m-d', strtotime($_POST['dateD']));
  $dateF = date('Y-m-d', strtotime($_POST['dateF']));
  if(!$_FILES['uploadfile']['name'] == ""){
    $filename = $_FILES['uploadfile']['name'];
    $datetod = date('Y-m-d-h-i-sa');
    $filename = $datetod. $filename;
    $filetmpname = $_FILES['uploadfile']['tmp_name'];
    $folder = 'announce/';
    $path = "http://192.168.43.143/service/announce/".$filename;
    move_uploaded_file($filetmpname, $folder.$filename);
    $sql = "UPDATE announce SET title = '".$title."', visible = -1, date = '".$date."',dateD = '".$dateD."',dateF = '".$dateF."',body = '".$body."',image ='".$path."' where id = '".$id."'";
}
else{
  $sql = "UPDATE announce SET title = '".$title."', visible = -1, date = '".$date."',dateD = '".$dateD."',dateF = '".$dateF."',body = '".$body."' where id = '".$id."'";
}
$qry = mysqli_query($db, $sql);
  if($qry){
    $message = "Annonce modifié";
    echo "<script type='text/javascript'>alert('$message');</script>";
    print("<script type=\"text/javascript\">location.href=\"viewann.php\"</script>");
  }
  else{
    $message = "Error.. please try again";
    echo "<script type='text/javascript'>alert('$message');</script>";
    print("<script type=\"text/javascript\">location.href=\"viewann.php\"</script>");
  }}else{
    $message = "Captcha failed";
    echo "<script type='text/javascript'>alert('$message');</script>";
    print("<script type=\"text/javascript\">location.href=\"viewann.php\"</script>");
  }
  }
  if(isset($_POST['comp'])) {
    $secretKey="6Lf_SccZAAAAAG95B1ABAH2xhFS9sKuF50Tu75oS";
    $responseKey=$_POST['g-recaptcha-response'];
    $url="https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey";
    $response=file_get_contents($url);
    $response=json_decode($response);
    if($response->success){
  $title = $_POST['title'];
  $body = $_POST['body'];
  $id = $_POST['id'];
  $date = date('Y-m-d');
  $dateD = date('Y-m-d', strtotime($_POST['dateD']));
  $dateF = date('Y-m-d', strtotime($_POST['dateF']));
  if(!$_FILES['uploadfile']['name'] == ""){
    $filename = $_FILES['uploadfile']['name'];
    $datetod = date('Y-m-d-h-i-sa');
    $filename = $datetod. $filename;
    $filetmpname = $_FILES['uploadfile']['tmp_name'];
    $folder = 'announce/';
    $path = "http://192.168.43.143/service/announce/".$filename;
    move_uploaded_file($filetmpname, $folder.$filename);
    $sql = "UPDATE announce SET title = '".$title."', visible = -1, date = '".$date."',dateD = '".$dateD."',dateF = '".$dateF."',body = '".$body."',image ='".$path."' where id = '".$id."'";
}
else{
  $sql = "UPDATE announce SET title = '".$title."',visible = -1, date = '".$date."',dateD = '".$dateD."',dateF = '".$dateF."',body = '".$body."' where id = '".$id."'";
}
$qry = mysqli_query($db, $sql);
  if($qry){
    $message = "Complément ajouté";
    echo "<script type='text/javascript'>alert('$message');</script>";
    print("<script type=\"text/javascript\">location.href=\"annrej.php\"</script>");
  }
  else{
    $message = "Error.. please try again";
    echo "<script type='text/javascript'>alert('$message');</script>";
    print("<script type=\"text/javascript\">location.href=\"annrej.php\"</script>");
  }}else{
    $message = "Captcha failed";
    echo "<script type='text/javascript'>alert('$message');</script>";
    print("<script type=\"text/javascript\">location.href=\"annrej.php\"</script>");
  }
  }
  ?>
