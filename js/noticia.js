function agregar_noticia() {
    var valor = "correcto";
    var noticia_titulo = $('#noticia_titulo').val();
    var noticia_contexto = $('#noticia_contexto').val();
    var noticia_bajada = $('#noticia_bajada').val();
    var noticia_estado = $('#noticia_estado').val();
    var noticia_mostrar = $('#noticia_mostrar').val();
    var noticia_link = $('#noticia_link').val();
    var noticia_esfake = $('#noticia_esfake').val();
    var noticia_motivo = $('#noticia_motivo').val();

    if(noticia_titulo == ""){
        alertify.error('El campo Titulo está vacío');
        $('#noticia_titulo').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#noticia_titulo').css('border','');
    }

    if(noticia_contexto == ""){
        alertify.error('El campo Contexto está vacío');
        $('#noticia_contexto').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#noticia_contexto').css('border','');
    }

    if(noticia_bajada == ""){
        alertify.error('El campo Bajada está vacío');
        $('#noticia_bajada').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#noticia_bajada').css('border','');
    }

    if(noticia_estado == ""){
        alertify.error('El campo Estado está vacío');
        $('#noticia_estado').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#noticia_estado').css('border','');
    }

    if(noticia_mostrar == ""){
        alertify.error('El campo Mostrar está vacío');
        $('#noticia_mostrar').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#noticia_mostrar').css('border','');
    }
    
    if (valor == "correcto"){
        var cadena = "noticia_titulo=" + noticia_titulo +
            "&noticia_contexto=" + noticia_contexto +
            "&noticia_bajada=" + noticia_bajada +
            "&noticia_estado=" + noticia_estado +
            "&noticia_link=" + noticia_link +
            "&noticia_esfake=" + noticia_esfake +
            "&noticia_motivo=" + noticia_motivo +
            "&noticia_mostrar=" + noticia_mostrar;
        $.ajax({
            type:"POST",
            url: urlweb + "api/noticia/guardar",
            data: cadena,
            success:function (r) {
                if(r==1){
                    alertify.success("¡Guardado!");
                    location.href = urlweb +  'noticia/ver';
                } else {
                    alertify.error("Fallo el envio");
                }
            }
        });
    }
}

function editar_noticia() {
    var valor = "correcto";
    var id_noticia = $('#id_noticia').val();
    var noticia_titulo = $('#noticia_titulo').val();
    var noticia_contexto = $('#noticia_contexto').val();
    var noticia_bajada = $('#noticia_bajada').val();
    var noticia_estado = $('#noticia_estado').val();
    var noticia_mostrar = $('#noticia_mostrar').val();
    var noticia_link = $('#noticia_link').val();
    var noticia_esfake = $('#noticia_esfake').val();
    var noticia_motivo = $('#noticia_motivo').val();

    if(noticia_titulo == ""){
        alertify.error('El campo Titulo está vacío');
        $('#noticia_titulo').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#noticia_titulo').css('border','');
    }

    if(noticia_contexto == ""){
        alertify.error('El campo Contexto está vacío');
        $('#noticia_contexto').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#noticia_contexto').css('border','');
    }

    if(noticia_bajada == ""){
        alertify.error('El campo Bajada está vacío');
        $('#noticia_bajada').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#noticia_bajada').css('border','');
    }

    if(noticia_estado == ""){
        alertify.error('El campo Estado está vacío');
        $('#noticia_estado').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#noticia_estado').css('border','');
    }

    if(noticia_mostrar == ""){
        alertify.error('El campo Mostrar está vacío');
        $('#noticia_mostrar').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#noticia_mostrar').css('border','');
    }

    if (valor == "correcto"){
        var cadena = "noticia_titulo=" + noticia_titulo +
            "&id_noticia=" + id_noticia +
            "&noticia_contexto=" + noticia_contexto +
            "&noticia_bajada=" + noticia_bajada +
            "&noticia_estado=" + noticia_estado +
            "&noticia_link=" + noticia_link +
            "&noticia_esfake=" + noticia_esfake +
            "&noticia_motivo=" + noticia_motivo +
            "&noticia_mostrar=" + noticia_mostrar;
        $.ajax({
            type:"POST",
            url: urlweb + "api/noticia/guardar",
            data: cadena,
            success:function (r) {
                if(r==1){
                    alertify.success("¡Guardado!");
                    location.href = urlweb +  'noticia/ver';
                } else {
                    alertify.error("Fallo el envio");
                }
            }
        });
    }
}