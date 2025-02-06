<?php
require_once "../controladores/formularios.controlador.php";
require_once "../modelos/formularios.modelo.php";

// clase ajax

class AjaxFormularios {
    //validar email existente
    public $validarEmail;

    public function ajaxValidarEmail(){
        $item = "email";
        $valor = $this -> validarEmail;

        $respuesta = ControladorFormularios::ctrSeleccionarRegistros($item, $valor);
        echo json_encode($respuesta);
    }
}

// objeto AJAX que recibe la variable POST

if(isset($_POST["validarEmail"])){
    $valEmail = new AjaxFormularios();
    $valEmail -> validarEmail = $_POST["validarEmail"];
    $valEmail -> ajaxValidarEmail();
}