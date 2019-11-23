function enviar_respuesta(respuesta, id_noticia, id_user) {
    var valor = true;

    if (valor){
        var cadena = "respuesta=" + respuesta +
            "&id_noticia=" + id_noticia +
            "&id_user=" + id_user;
        $.ajax({
            type:"POST",
            url: urlweb + "api/Inicio/enviar_respuesta",
            data: cadena,
            success:function (r) {
                if(r==1){
                    alertify.success("¡Respuesta Registrada!");
                    location.href = urlweb +  'inicio/respuesta/' + id_noticia;
                } else {
                    alertify.error("Se Rompió el Sitio Web :(");
                }
            }
        });
    }
}