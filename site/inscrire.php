
   <?php


// connexion à la base de données
$db_username = 'root';
$db_password = '';
$db_name     = 'base';
$db_host     = 'localhost';
$db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
       or die('could not connect to database');
        ?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>MadinaTech - Inscrire</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary" style="background: linear-gradient(#9EB9D4, #FFFDE4);">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block"><img src="inscrire.png" alt="#"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <form class="user" action="inscrire.php" method=post
      oninput='cpassword.setCustomValidity(cpassword.value != password.value ? "Passwords do not match." : "")'>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text"class="form-control form-control-user" placeholder="Nom" name="nom" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="text"class="form-control form-control-user" placeholder="Prenom" name="prenom"required >
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input placeholder="Date de naissance" type="text" onfocus="(this.type='date')" class="form-control form-control-user datepicker"  max= <?php $d=mktime(11, 14, 54, 1, 1, 2001); echo date("Y-m-d h:i:sa", $d);?> placeholder="date naissance" name="daten"required >
                  </div>
                  <div class="col-sm-6">
                  <input type="email" class="form-control form-control-user"placeholder="Email" name="email"required >

                  </div>
                </div>
                <div class="form-group">
                  <input type="text"class="form-control form-control-user" placeholder="Adress : 12 Rue .." name="adress"required >
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="number"class="form-control form-control-user" placeholder="Numero de téléphone" pattern="[0-9]{10}" name="phone"required >
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" placeholder="Nom d'utilisateur" name="newuser"required >
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-6 mb-sm-0">
                    <input type="password" id="pass"class="form-control form-control-user" placeholder="Mot de passe" name="password"required >
                  </div>
                  <div class="col-sm-6 mb-6 mb-sm-0">
                    <input type="password" id="cpass"class="form-control form-control-user" placeholder="Confirm mot de passe" name="cpassword"required >
                  </div>

                </div>
                <input type="submit"class="btn btn-google btn-user btn-block" id='submit' value='Inscrire' name='submit' >

                </a>
                <hr>


                </a>
              </form>

              <div class="text-center">
                <?php
               if(isset($_POST['submit'])){

              $nom = mysqli_real_escape_string($db,htmlspecialchars($_POST['nom']));
              $prenom = mysqli_real_escape_string($db,htmlspecialchars($_POST['prenom']));
              $daten = mysqli_real_escape_string($db,htmlspecialchars($_POST['daten']));
              $adress = mysqli_real_escape_string($db,htmlspecialchars($_POST['adress']));
              $phone = mysqli_real_escape_string($db,htmlspecialchars($_POST['phone']));
              $email = mysqli_real_escape_string($db,htmlspecialchars($_POST['email']));
              $nusername = mysqli_real_escape_string($db,htmlspecialchars($_POST['newuser']));
              $password = mysqli_real_escape_string($db,htmlspecialchars($_POST['password']));
              $password =sha1($password);
              $larequete = "select * from user where username like \"$nusername\" ";
              $exec_requete = mysqli_query($db,$larequete);
              while($row = mysqli_fetch_array($exec_requete)){

                  $resultat[] = $row;
              }
              if(empty($resultat)){
              $requete = "insert into user(id, nom, prenom, dateN, adress, phone, email, username, password, type, visible,signaled)";
                    $requete .= "values (NULL,\"$nom\", \"$prenom\", \"$daten\", \"$adress\", \"$phone\",  \"$email\",\"$nusername\",\"$password\",0,-1,0)";
                             $exec_requete = mysqli_query($db,$requete);
                             echo "<p style='color:green'>Votre demande d'inscription est en cours de traitement, veuillez attendez un email.
                             <form id=\"form1\" action=\"http://127.0.0.1/site/verification.php\" method=\"POST\">
                             <input type=\"hidden\" name=\"guest\"/>
                             <br>tu peux accéder comme <a href=\"javascript:;\" onclick=\"document.getElementById('form1').submit();\">un invité</a>.</p>
                            </form>";
                            }
                             else{
                              echo "<p style='color:red'>Nom d'utilisateur déjà pris, veuillez réessayer.</p>";
                          }

                          }
              ?>
                <a class="small" href="log.php">Si vous possédez déjà un compte, veuillez vous identifier!</a>





   </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
</div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js">

  </script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
