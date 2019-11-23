<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 23/11/2019
 * Time: 4:36
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="<?php echo _SERVER_ . _ICON_;?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?= _TITLE_;?> - Registro</title>

    <!-- Custom fonts for this template-->
    <link href="<?=_SERVER_ . _STYLES_ADMIN_;?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">


    <!-- Custom styles for this template-->
    <link href="<?=_SERVER_ . _STYLES_ADMIN_;?>css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Alertify -->
    <script src="<?php echo _SERVER_ . _STYLES_ALL_;?>alertifyjs/alertify.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo _SERVER_ . _STYLES_ALL_;?>alertifyjs/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="<?php echo _SERVER_ . _STYLES_ALL_;?>alertifyjs/css/themes/default.css">

</head>

<body class="bg-gradient-primary">

<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">¡Create una Cuenta!</h1>
                        </div>
                        <div class="user">
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" id="person_name" placeholder="Nombres">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-user" id="person_surname" placeholder="Apellidos">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input class="form-control form-control-user" onkeyup="return validar_numeros(this.id)" maxlength="8" type="text" id="person_dni" placeholder="DNI">
                                </div>
                                <div class="col-sm-6">
                                    <input  class="form-control form-control-user" type="date" id="person_birth" placeholder="Fecha de Nacimiento">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" onkeyup="return validar_numeros(this.id)" id="person_number_phone" placeholder="Número de Teléfono">
                                </div>
                                <div class="col-sm-6">
                                    <select class="form-control form-control-user" id="person_genre">
                                        <option value="">Seleccione un Género...</option>
                                        <option value="M">Masculino</option>
                                        <option value="F">Femenino</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="person_address" placeholder="Dirección Casa">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="user_nickname" placeholder="Nombre Usuario">
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" id="user_password1" placeholder="Contraseña">
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" id="user_password2" placeholder="Repetir Contraseña">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" id="user_email" placeholder="Correo Usuario">
                            </div>
                            <a onclick="save_doc()" id="btn-reg-addu" style="color: white;" class="btn btn-primary btn-user btn-block">
                                Registrar Cuenta
                            </a>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= _SERVER_ ._STYLES_ADMIN_;?>vendor/jquery/jquery.min.js"></script>
<script src="<?=_SERVER_ . _STYLES_ADMIN_;?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?=_SERVER_ . _STYLES_ADMIN_;?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?=_SERVER_ . _STYLES_ADMIN_;?>js/sb-admin-2.min.js"></script>
<script>
    //Llamar así: onkeyup="return validar_numeros(this.id)"
    function validar_numeros(id) {
        var text = document.getElementById(id).value;
        var expreg = new RegExp(/^[0-9]*$/);
        if(expreg.test(text)){
            return true;
        } else {
            alertify.error("Carácter Inválido");
            //var long = text.length;
            //var text_to_extract = long - 1;
            //document.getElementById(id).value = text.substring(0, text_to_extract);
            var re = /[a-zA-ZñáéíóúÁÉÍÓÚ´.*+?^$&!¡¿#%/{}()='|[\]\\"]/g;
            document.getElementById(id).value = text.replace(re, '');
            return false;
        }
    }

    function save_doc() {
        var valor = "correcto";
        var person_name = $('#person_name').val();
        var person_surname = $('#person_surname').val();
        var person_dni = $('#person_dni').val();
        var person_birth = $('#person_birth').val();
        var person_number_phone = $('#person_number_phone').val();
        var person_genre = $('#person_genre').val();
        var person_address = $('#person_address').val();
        var person_city = "Iquitos";
        var person_country = "Perú";
        var user_nickname = $('#user_nickname').val();
        var user_password1 = $('#user_password1').val();
        var user_password2 = $('#user_password2').val();
        var user_email = $('#user_email').val();
        var id_role = 4;

        if(user_nickname == ""){
            alertify.error('El campo Nombre está vacío');
            $('#user_nickname').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#user_nickname').css('border','');
        }

        if(id_role == ""){
            alertify.error('El campo Rol está vacío');
            $('#id_role').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#id_role').css('border','');
        }

        if(user_password1 !== user_password2){
            alertify.error('Las Contraseñas no coinciden');
            $('#user_password1').css('border','solid red');
            $('#user_password2').css('border','solid red');
            valor = "incorrecto";
        } else {
            if(user_password1 == ""){
                alertify.error('El campo Contraseña está vacío');
                $('#user_password1').css('border','solid red');
                $('#user_password2').css('border','solid red');
                valor = "incorrecto";
            } else {
                $('#user_password1').css('border','');
                $('#user_password2').css('border','');
            }
        }

        if(user_email == ""){
            alertify.error('El campo Correo está vacío');
            $('#user_email').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#user_email').css('border','');
        }

        if(person_name == ""){
            alertify.error('El campo Nombre está vacío');
            $('#person_name').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#person_name').css('border','');
        }

        if(person_surname == ""){
            alertify.error('El campo Apellidos está vacío');
            $('#person_surname').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#person_surname').css('border','');
        }

        if(person_dni == ""){
            alertify.error('El campo DNI está vacío');
            $('#person_dni').css('border','solid red');
            valor = "incorrecto";
        } else {
            if(person_dni.length !== 8){
                alertify.error('El campo DNI no contiene 8 digitos');
                $('#person_dni').css('border','solid red');
                valor = "incorrecto";
            } else {
                $('#person_dni').css('border','');
            }
        }

        if(person_birth == ""){
            alertify.error('El campo Fecha de Nacimiento está vacío');
            $('#person_birth').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#person_birth').css('border','');
        }

        if(person_number_phone == ""){
            alertify.error('El campo Teléfono está vacío');
            $('#person_number_phone').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#person_number_phone').css('border','');
        }

        if(person_genre == ""){
            alertify.error('El campo Género está vacío');
            $('#person_genre').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#person_genre').css('border','');
        }

        if(person_address == ""){
            alertify.error('El campo Dirección está vacío');
            $('#person_address').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#person_address').css('border','');
        }


        if (valor == "correcto"){
            var cadena = "person_name=" + person_name +
                "&person_surname=" + person_surname +
                "&person_dni=" + person_dni +
                "&person_birth=" + person_birth +
                "&person_number_phone=" + person_number_phone +
                "&person_genre=" + person_genre +
                "&person_address=" + person_address +
                "&person_city=" + person_city +
                "&person_country=" + person_country +
                "&user_nickname=" + user_nickname +
                "&user_password=" + user_password1 +
                "&user_email=" + user_email +
                "&id_role=" + id_role;
            $.ajax({
                type:"POST",
                url: "<?php echo _SERVER_;?>api/registrar/registrar",
                data: cadena,
                dataType: 'json',
                beforeSend: function () {
                    $("#btn-reg-addu").html("Cargando...");
                    $("#btn-reg-addu").attr("disabled", true);
                },
                success:function (r) {
                    $("#btn-reg-addu").attr("disabled", false);
                    $("#btn-reg-addu").html("Registrar Cuenta");
                    switch (r.result.code) {
                        case 1:
                            alert('Usuario Creado. Ahora Inicie Sesión');
                            location.href = '<?php echo _SERVER_;?>Admin';
                            break;
                        case 2:
                            alertify.error("Fallo el envio");
                            break;
                        case 3:
                            alertify.warning("Este usuario ya está siendo usado");
                            $('#user_nickname').css('border','solid red');
                            break;
                        case 4:
                            alertify.warning("Este DNI ya se encuentra en uso");
                            $('#person_dni').css('border','solid red');
                            break;
                        case 5:
                            alertify.warning("Este Correo ya se encuentra en uso");
                            $('#user_email').css('border','solid red');
                            break;
                        case 6:
                            alertify.error("FALLO MORTAL :(");
                            break;
                        default:
                            alertify.error("ERROR DESCONOCIDO");
                    }
                }
            });
        }

    }
</script>
</body>

</html>

