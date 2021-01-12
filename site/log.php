<?php
session_start();
unset($_SESSION['username']);
unset($_SESSION['username']);
unset($_SESSION['guest']);
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>MadinaTech - Connexion</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary" style="background: linear-gradient(#9EB9D4, #FFFDE4);">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center" style="margin:5%">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block"><img src="log.png" alt=""></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4"> Bienvenu sur Madinatona!</h1>
                  </div>
                  <form action="http://127.0.0.1/site/verification.php" method="POST" class="user">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user"  placeholder="Entrer le nom d'utilisateur" name="username" required>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user"  placeholder="Entrer le mot de passe" name="password" required>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                      </div>
                    </div>
                    <input type="submit" class="btn btn-primary btn-user btn-block" id='submit' value='Connexion' ></a>
                    <hr></form><form action="verification.php" method="POST" class="user">
                    <input type="submit" class="btn btn-google btn-user btn-block" id='submit' name="guest" value="Entrer en tant qu'invité?" ></a>

                    <hr>
                    <?php
                    if(isset($_GET['erreur'])){
                        $err = $_GET['erreur'];
                        if($err==1 || $err==2)
                            echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>
                            <hr>
                            ";
                    }
                    ?>
                  </form>
                  </div>
                  <div class="text-center">
                    <a class="small" href="http://127.0.0.1/site/inscrire.php">Créer un compte!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
