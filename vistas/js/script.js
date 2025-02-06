$("#email").change(function(){
    $(".alerta").remove();

    let email = $(this).val();
    // console.log("email", email);

    let datos = new FormData();
    datos.append("validarEmail", email);

    $.ajax({
        url: "ajax/formularios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            if (respuesta) {
                $('#email').val("");
                $('#email').parent().after(`
                    <div class="alerta alerta-advertencia">
                    <strong>Error:</strong>
                    El correo eletrónico ya existe en la base de datos, por favor ingrese otro diferente
                    </div>
                    `);
            }
        },
    });
});