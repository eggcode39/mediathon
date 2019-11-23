<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="<?php echo _SERVER_ . _ICON_;?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?= _TITLE_;?> - Login</title>

  <!-- Custom fonts for this template-->
  <link href="<?=_SERVER_ . _STYLES_ADMIN_;?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!--<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">-->

  <!-- Custom styles for this template-->
  <link href="<?=_SERVER_ . _STYLES_ADMIN_;?>css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Alertify -->
    <script src="<?php echo _SERVER_ . _STYLES_ALL_;?>alertifyjs/alertify.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo _SERVER_ . _STYLES_ALL_;?>alertifyjs/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="<?php echo _SERVER_ . _STYLES_ALL_;?>alertifyjs/css/themes/default.css">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image" style="background-image: url('<?= _SERVER_ . _STYLES_ALL_;?>fondo.jpg');background-position: center;background-size: cover;"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">¡Bienvenido!</h1>
                  </div>
                  <div class="user">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" name="user" id="user" aria-describedby="emailHelp" placeholder="Usuario">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" name="pass" id="pass"  placeholder="Contraseña">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="recordar">
                        <label class="custom-control-label" for="recordar">Recordarme</label>
                      </div>
                    </div>
                    <a id="btn-iniciar-sesion" style="color: white;" class="btn btn-primary btn-user btn-block" onclick="loginsistema()">Iniciar Sesión</a>
                    <hr>
                  </div>
                  <hr>
                  <!--<div class="text-center">
                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="register.html">Create an Account!</a>
                  </div>-->
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?= _SERVER_ ._STYLES_ADMIN_;?>vendor/jquery/jquery.min.js"></script>
  <script src="<?= _SERVER_ ._STYLES_ADMIN_;?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= _SERVER_ ._STYLES_ADMIN_;?>vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= _SERVER_ ._STYLES_ADMIN_;?>js/sb-admin-2.min.js"></script>
  <script>
      $(document).ready(function(){
          $('#pass').keypress(function(e){
              if(e.which === 13){
                  loginsistema();
              }
          });
          $('#user').keypress(function(e){
              if(e.which === 13){
                  loginsistema();
              }
          });
      });

      function loginsistema() {
          var valor = "correcto";
          var usuario = $('#user').val();
          var contrasenha = $('#pass').val();
          var recordar = document.getElementById("recordar").checked;
          if(usuario==""){
              alertify.error('Ingrese un usuario.');
              $('#user').css('border','solid red');
              valor = "incorrecto";
          } else {
              $('#user').css('border','');
          }
          if(contrasenha==""){
              alertify.error('Ingrese la contraseña.');
              $('#pass').css('border','solid red');
              valor = "incorrecto";
          } else {
              $('#pass').css('border','');
          }
          if(valor=="correcto"){
              var cadena = "user=" + usuario +
                  "&pass=" + contrasenha +
                  "&remember=" + recordar;
              $.ajax({
                  type: "POST",
                  url: "<?php echo _SERVER_;?>api/login/singIn",
                  data: cadena,
                  dataType: 'json',
                  beforeSend: function () {
                      $("#btn-iniciar-sesion").html("Cargando...");
                      $("#btn-iniciar-sesion").attr("disabled", true);
                  },
                  success:function (r) {
                      $("#btn-iniciar-sesion").attr("disabled", false);
                      $("#btn-iniciar-sesion").html("Iniciar Sesión");
                      switch (r.result.code) {
                          case 1:
                              alertify.success('Ingreso exitoso');
                              //location.href = "<?php echo _SERVER_;?>"
                              location.reload();
                              break;
                          case 2:
                              alertify.error('ERROR :(');
                              break;
                          case 3:
                              alertify.error('Usuario y/o Contraseña Incorrectos');
                              break;
                          default:
                              alertify.error('ERROR :(');
                              break;
                      }
                  }
              });
          }
      }
  </script>

</body>
</html>
