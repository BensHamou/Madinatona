<?php
if(!isset($_SESSION)) {
  session_start();
}
$db_username = 'root';
$db_password = '';
$db_name     = 'base';
$db_host     = 'localhost';
$db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
or die('could not connect to database');
if(isset($_POST['pass'])) {
  $current = sha1($_POST['cp']);
  $new = sha1($_POST['np']);
  $username = $_SESSION['username'];
  $requete = "SELECT count(*) FROM user where username = '".$username."' and password = '".$current."' ";
  $exec_requete = mysqli_query($db,$requete);
  $reponse = mysqli_fetch_array($exec_requete);
  $count = $reponse['count(*)'];
  if($count!=0){
    $sql = "UPDATE user SET password = '".$new."'  where username = '".$username."' ";
    $qry = mysqli_query($db, $sql);
    if($qry){
      $message = "Mot de pass modifié";
      echo "<script type='text/javascript'>alert('$message');</script>";
      if( $_SESSION['type']==0 ){print("<script type=\"text/javascript\">location.href=\"principale.php\"</script>");}
      else if( $_SESSION['type']==-1 ){print("<script type=\"text/javascript\">location.href=\"admin.php\"</script>");}
      else if( $_SESSION['type']==-2 ){print("<script type=\"text/javascript\">location.href=\"resp.php\"</script>");}
      else if( $_SESSION['type']>0 ){print("<script type=\"text/javascript\">location.href=\"auth.php\"</script>");}
    }
    else{
      $message = "Error.. please try again";
      echo "<script type='text/javascript'>alert('$message');</script>";
      if( $_SESSION['type']==0 ){print("<script type=\"text/javascript\">location.href=\"pass.php\"</script>");}
      else if( $_SESSION['type']==-1 ){print("<script type=\"text/javascript\">location.href=\"passadd.php\"</script>");}
      else if( $_SESSION['type']==-2 ){print("<script type=\"text/javascript\">location.href=\"passresp.php\"</script>");}
      else if( $_SESSION['type']>0 ){print("<script type=\"text/javascript\">location.href=\"passau.php\"</script>");}
    }
    }
    else {
      $message = "Mot de pass inccorect.";
      echo "<script type='text/javascript'>alert('$message');</script>";
      if( $_SESSION['type']==0 ){print("<script type=\"text/javascript\">location.href=\"pass.php\"</script>");}
      else if( $_SESSION['type']==-1 ){print("<script type=\"text/javascript\">location.href=\"passadd.php\"</script>");}
      else if( $_SESSION['type']==-2 ){print("<script type=\"text/javascript\">location.href=\"passresp.php\"</script>");}
      else if( $_SESSION['type']>0 ){print("<script type=\"text/javascript\">location.href=\"passau.php\"</script>");}
    }
  }
  if(isset($_POST['manage'])) {
    $newe = $_POST['email'];
    $newp = $_POST['phone'];
    $newa = $_POST['address'];
    $username = $_SESSION['username'];
    $sql = "UPDATE user SET adress = '".$newa."', phone = '".$newp."', email = '".$newe."' where username = '".$username."'";
    $qry = mysqli_query($db, $sql);
    if($qry){
      $message = "Profile modifié";
      echo "<script type='text/javascript'>alert('$message');</script>";
      if( $_SESSION['type']==0 ){print("<script type=\"text/javascript\">location.href=\"principale.php\"</script>");}
      else if( $_SESSION['type']==-1 ){print("<script type=\"text/javascript\">location.href=\"admin.php\"</script>");}
      else if( $_SESSION['type']==-2 ){print("<script type=\"text/javascript\">location.href=\"resp.php\"</script>");}
      else if( $_SESSION['type']>0 ){print("<script type=\"text/javascript\">location.href=\"auth.php\"</script>");}    }
    else{
      $message = "Error.. please try again";
      echo "<script type='text/javascript'>alert('$message');</script>";
     if( $_SESSION['type']==0 ){print("<script type=\"text/javascript\">location.href=\"phone.php\"</script>");}
     else if( $_SESSION['type']==-1 ){print("<script type=\"text/javascript\">location.href=\"phoneadd.php\"</script>");}
     else if( $_SESSION['type']==-2 ){print("<script type=\"text/javascript\">location.href=\"phoneresp.php\"</script>");}
     else if( $_SESSION['type']>0 ){print("<script type=\"text/javascript\">location.href=\"phoneau.php\"</script>");}
   }
  }
  if(isset($_POST['delete'])) {
    $current = sha1($_POST['cp']);
    $username = $_SESSION['username'];
    $requete = "SELECT count(*) FROM user where username = '".$username."' and password = '".$current."' ";
    $exec_requete = mysqli_query($db,$requete);
    $reponse = mysqli_fetch_array($exec_requete);
    $count = $reponse['count(*)'];
    if($count!=0){
      $sql = "UPDATE user SET visible = 0 where username = '".$username."' ";
      $qry = mysqli_query($db, $sql);
      if($qry){
        $message = "Compte désactivé";
        echo "<script type='text/javascript'>alert('$message');</script>";
        print("<script type=\"text/javascript\">location.href=\"log.php\"</script>");
      }
      else{
        $message = "Error.. please try again";
        echo "<script type='text/javascript'>alert('$message');</script>";
        print("<script type=\"text/javascript\">location.href=\"log.php\"</script>");
      }
      }
      else {
        $message = "Mot de pass inccorect.";
        echo "<script type='text/javascript'>alert('$message');</script>";
        if( $_SESSION['type']==0 ){print("<script type=\"text/javascript\">location.href=\"principale.php\"</script>");}
      }
    }
  ?>
