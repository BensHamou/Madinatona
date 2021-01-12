<?php
session_start();
if(empty($_SESSION['username']) || ($_SESSION['type']<1)) header('Location: log.php');
?>
<html>
<head>
    <meta charset="utf-8">
    <title>MadinaTech - Traiter le signalement</title>
    <link rel="stylesheet" href="css.css" media="screen" type="text/css" />
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
<ul>
  <li><a href="auth.php">Retourner</a></li>
</ul>
<body id='grad1'>
    <?php
    if(isset($_POST['treat'])){
      $report = $_POST['treat'];
      $_SESSION['treat'] = $report;
      if($_SESSION['type'] !== ""){
        $type = $_SESSION['type'];
      }
      // connexion à la base de données
      $db_username = 'root';
      $db_password = '';
      $db_name     = 'base';
      $db_host     = 'localhost';
      $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
      or die('could not connect to database');
      $result = mysqli_query($db,"SELECT * FROM signalement where signalement.id = '".$report."'");
      while($row = mysqli_fetch_array($result)){
        echo '<div class="card" >';
        echo  "<h1> Titre: ". $row['title'] . "</h1>";
        echo  '<img src="'.$row['image'].'" alt  = "No photo for this report." style="width:100%">';
        echo  '<p class="date">à: ' . $row['date1'] . '</p>';
        echo  "<h1>" . $row['description'] . "</h1>";
        echo  '<p class="adress">Lieu: ' . $row['adress'] . '</p>';
        echo  '<p class="username">par: '. $row['username'] . '</p>';
        if(!empty($row['rapport'])){
          $empty = 1;
          echo  "<h1> Rapport: " . $row['rapport'] . "</h1>";
        }
        else{
          $empty = 0;
        }
        if(!empty( $row['imagerapport'])){
          echo  '<img src="'.$row['imagerapport'].'" alt  = "No rapport photo for this report." style="width:100%">';
        }
          $id = $row['id'];
          $requete = "SELECT count(*) FROM signalement where attached = '".$id."'";
          $exec_requete = mysqli_query($db,$requete);
          $reponse = mysqli_fetch_array($exec_requete);
          $count = $reponse['count(*)'];
          if($count>1){
            echo '<form  action="attach.php" method="POST">';
            echo '<button type="submit" name="list" class="button">Voir list</button>';
            echo '<input type="hidden"  value="' . $row['id']  . '" name="id">';
            echo '</form>';
          }
          if($row['etat'] == 1 && $count==1 ){
            echo '<form  action="attach.php" method="POST">';
            echo '<button type="submit" name="attach" class="button">Attacher à</button>';
            echo '<input type="hidden"  value="' . $row['locx']  . '" name="x">';
            echo '<input type="hidden"  value="' . $row['locy']  . '" name="y">';
            echo '<input type="hidden"  value="' . $row['id']  . '" name="id">';
            echo '<input type="hidden"  value="' . $row['type']  . '" name="type">';
            echo '</form>';
          }
          if($row['etat'] == 1){
            echo '<form  action="auth.php" method="POST">';
            echo  '<button type="submit" name="almost" class="button">Lencer</button>';
            echo '</form>';
          }
          if(!empty( $row['rapport'])){
        echo '<form  action="auth.php" method="POST">';
        echo  '<button type="submit" name="done" class="button">Cloturer</button>';
        echo '</form>';
        echo '<form  action="addcommentann.php" method="POST">';
        echo  '<button type="submit" name="delete" class="button">Supprimer rapport</button>';
        echo '</form>';
      }
      else{
          echo  '<p class="username">Il faut ajouter un rapport d\'abbord</p>';
      }
        echo '</div>';
        }
    }
    ?>
  <form  action="addcommentann.php" method="POST" enctype="multipart/form-data" class="form-container">
    <?php
    if($empty==1){
      echo '<button class="open-button" onclick="openForm()">Modifier rapport</button>';
    }
    else echo '    <button class="open-button" onclick="openForm()">Ajouter un rapport</button>';
    ?>
    <div class="form-popup" id="rapportsection">
      <label><b>Description :</b></label>
      <textarea rows="10" placeholder="write comment" name="comment" required></textarea>
      <input type="file" name="uploadfile" value="Add image" required/>
      <button type="submit" class="btn" name="share">Publier le rapport</button>
      <button type="button" class="btn cancel" onclick="closeForm()">Annuler</button>
    </form>
  </div>
  <script>
  function openForm() {
    document.getElementById("rapportsection").style.display = "block";
  }
  function closeForm() {
    document.getElementById("rapportsection").style.display = "none";
  }
</script>
</body>
</html>
