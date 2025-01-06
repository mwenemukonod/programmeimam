<?php session_start();
  include 'conn.php';

  $giris = $_POST['envoyer'];
  $username = $_POST['username'];
  $passwd = $_POST['passwd'];
  $kontrol = 0;

  if (isset($giris)) {
    $girisSor = $db->query("SELECT * FROM imam WHERE nomcomplet = '$username'")->fetch(PDO::FETCH_ASSOC);
 
    if ($girisSor) {

      $gelenPasswd = $passwd;
      $string = $password;
      $encrypt_method = 'AES-256-CBC';
      $secret_key = '11*_33';
      $secret_iv = '22-=**_';
      $key = hash('sha256', $secret_key); 
      $iv = substr(hash('sha256', $secret_iv), 0, 16); 

      $sifrelendi = openssl_encrypt($gelenPasswd,$encrypt_method, $key, false, $iv);
      $sifre_cozuldu = openssl_decrypt($sifrelendi,$encrypt_method, $key, false, $iv);

      if ($girisSor['motdepasse'] == $gelenPasswd) {
        echo "Başarili. !";
        $kontrol = 1;
      }

      switch ($kontrol) {

      case '1':
        if($girisSor['role']=='admin')
      {
        $_SESSION["login"] = "true";
        $_SESSION['user_name'] = $username;

        header("Location:admin.php");
      }
      elseif($girisSor['role']=='imam'){
        $_SESSION["login"] = "true";
        $_SESSION['user_name'] = $username;

        header("Location:./template/pages/sitparimam.php");
      }
        break;

      case '0':
        echo "ez. !";
        break;
      }
    }
  }

 ?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Programme Imam</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="template/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="template/assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="template/assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="template/assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
          <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-4 mx-auto">
              <div class="card-body px-5 py-5">
                <h3 class="card-title text-left mb-3">Se connecter ici</h3>

                <form action="" method="post">
                  <div class="form-group"> 
                    <label>Nom utilisateur *</label>
                    <input type="text" class="form-control p_input" name="username">
                  </div>
                  <div class="form-group">
                    <label>Mot de passe *</label>
                    <input type="Password" class="form-control p_input" id="pass" name="passwd">
                  </div>
                
                  <div class="text-center">
                    <input type="submit" style="height: 50px;" class="btn btn-primary btn-block enter-btn" name="envoyer">
                  </div>
                </form>

              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
    <script type="text/javascript">
      var passshow = document.getElementById("passshow");
      var pass = document.getElementById("pass");

      function sifre_göster(){
      if (passshow.checked)
          pass.type = "text";  
      if(!passshow.checked)
        pass.type = "password";
      }
      
    </script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/hoverable-collapse.js"></script>
    <script src="../../assets/js/misc.js"></script>
    <script src="../../assets/js/settings.js"></script>
    <script src="../../assets/js/todolist.js"></script>
    <!-- endinject -->
  </body>
</html>
