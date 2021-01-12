<?php
// connexion à la base de données
if(!isset($_SESSION)) {
  session_start();
}
//        alert(document.getElementById("add").value);
$db_username = 'root';
$db_password = '';
$db_name     = 'base';
$db_host     = 'localhost';
$db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
or die('could not connect to database');
$db->set_charset("utf8");
header('Content-Type: text/html; charset=utf-8');
  if(isset($_POST['post'])) {
    $secretKey="6Lf_SccZAAAAAG95B1ABAH2xhFS9sKuF50Tu75oS";
    $responseKey=$_POST['g-recaptcha-response'];
    $url="https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey";
    $response=file_get_contents($url);
    $response=json_decode($response);
    if($response->success){
    $filename = $_FILES['uploadfile']['name'];
    $datetod = date('Y-m-d-h-i-sa');
    $filename = $datetod. $filename;
    $filetmpname = $_FILES['uploadfile']['tmp_name'];
    $username = $_SESSION['username'];
    $title = $_POST['title'];
    $descreption = $_POST['descreption'];
    $type = $_POST['type'];
    $add = $_POST['add'];
    $long = doubleval($_POST['long']);
    $lat = doubleval($_POST['lat']);
    $etat = 1;
    $visible = 1;
    $date = date('Y-m-d h:i:s');
    $folder = 'upload/';
    $path = "http://192.168.43.143/site/upload/".$filename;
    move_uploaded_file($filetmpname, $folder.$filename);
    $sql = "INSERT INTO signalement(username,title,description,locx,locy,adress,type,image,etat,date1,attached,visible)
    values('".$username."','".$title."','".$descreption."','".$lat."','".$long."','".$add."','".$type."','".$path."','".$etat."','".$date."',
      (SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME='signalement' and TABLE_SCHEMA=DATABASE()),'".$visible."')";
    $qry = mysqli_query($db, $sql);
    if($qry){
      $message = "Signalement publié";
      echo "<script type='text/javascript'>alert('$message');</script>";
      print("<script type=\"text/javascript\">location.href=\"homecit.php\"</script>");
    }
    else{
      $message = "Error.. please try again";
      echo "<script type='text/javascript'>alert('$message');</script>";
      print("<script type=\"text/javascript\">location.href=\"homecit.php\"</script>");
    }
  }else{
    $message = "Captcha failed";
    echo "<script type='text/javascript'>alert('$message');</script>";
    print("<script type=\"text/javascript\">location.href=\"wreport.php\"</script>");
  }
}
?>
