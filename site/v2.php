<?php
session_start();
if(isset($_POST['guest'])){
  $message = "You're in guest mode";
  echo "<script type='text/javascript'>alert('$message');</script>";
  $_SESSION['username'] = "guest";
  $_SESSION['type'] = 0;
  $_SESSION['guest'] = 1;
  print("<script type=\"text/javascript\">location.href=\"home.php\"</script>");
}
else if(isset($_POST['username']) && isset($_POST['password'])){
  $_SESSION['guest'] = 0;
    $db_username = 'root';
    $db_password = '';
    $db_name     = 'base';
    $db_host     = 'localhost';
    $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
           or die('could not connect to database');
    $username = mysqli_real_escape_string($db,htmlspecialchars($_POST['username']));
    $password = sha1(mysqli_real_escape_string($db,htmlspecialchars($_POST['password'])));

    if($username !== "" && $password !== "")
    {
        $requete = "SELECT count(*) FROM user where username = '".$username."' and password = '".$password."' and visible = 1 ";
        $requete2 = "SELECT type FROM user where username = '".$username."' and password = '".$password."' ";
        $exec_requete = mysqli_query($db,$requete);
        $exec_requete2 = mysqli_query($db,$requete2);
        $reponse      = mysqli_fetch_array($exec_requete);
        $reponse2     = mysqli_fetch_array($exec_requete2);
        $count = $reponse['count(*)'];
        $count2 = $reponse2['type'];

        if($count!=0) // nom d'utilisateur et mot de passe correctes
        {
          $_SESSION['testing']=time();
         $_SESSION['db'] = $db;
         if($count2==0){
           $_SESSION['username'] = $username;
           $_SESSION['type'] = $count2;
           header('Location: home.php');
		 }
     else if($count2==-1){
			$_SESSION['username'] = $username;
      $_SESSION['type'] = $count2;
			header('Location: http://192.168.43.143/others/admin.php');
		}
    else if($count2==-2){
     $_SESSION['username'] = $username;
     $_SESSION['type'] = $count2;
     header('Location: http://192.168.43.143/others/resp.php');
   }
		else{
      $_SESSION['username'] = $username;
			$_SESSION['type'] = $count2;
            header('Location: http://192.168.43.143/service/auth.php');
		}
        }
        else
        {
           header('Location: log.php?erreur=1'); // utilisateur ou mot de passe incorrect
        }
    }
    else
    {
       header('Location: log.php?erreur=2'); // utilisateur ou mot de passe vide
    }
}
else
{
   header('Location: log.php');
}
mysqli_close($db); // fermer la connexion
?>
