<?php

class ControladorFormularios {

    /*---------------- Registro -------------------  */
    static public function ctrRegistro() {

        if (preg_match('/^[0-9a-zA-Z]+$/', $_POST["registroPassword"])) {
            // echo "Contraseña válida<br>";
        } else {
            echo "Contraseña no válida<br>";
        }
        
        if (preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["registroNombre"]) &&
            preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $_POST["registroEmail"]) &&
            preg_match('/^[0-9a-zA-Z]+$/', $_POST["registroPassword"])) {
        
            $tabla = "registros";
            $encriptarPassword = crypt($_POST["registroPassword"], '31H+uIt/znB6jzmNADXRNF');
        
            $datos = array(
                "nombre" => $_POST["registroNombre"],
                "email" => $_POST["registroEmail"],
                "password" => $encriptarPassword
            );
        
            $respuesta = ModeloFormularios::mdlRegistro($tabla, $datos);
        
            if ($respuesta == "ok") {
                echo '<div class="alert alert-success">Registro exitoso</div>';
            } else {
                echo '<div class="alert alert-danger">Error en el registro: ' . $respuesta . '</div>';
            }
        
            return $respuesta;
        
        } else {
            $respuesta = "error";
            echo '<div class="alert alert-danger">Error en la validación de datos</div>';
            return $respuesta;
        }
    }

    // Seleccionar registros
    static public function ctrSeleccionarRegistros($item, $valor) {
        $tabla = "registros";
        $respuesta = ModeloFormularios::mdlSeleccionarRegistros($tabla, $item, $valor);
        return $respuesta;
    }

    // Ingreso
    public function ctrIngreso() {
        if (isset($_POST["ingresoEmail"])) {
            $tabla = "registros";
            $item = "email";
            $valor = $_POST["ingresoEmail"];

            $respuesta = ModeloFormularios::mdlSeleccionarRegistros($tabla, $item, $valor);

            if ($respuesta["email"] == $_POST["ingresoEmail"] && crypt($_POST["ingresoPassword"], '31H+uIt/znB6jzmNADXRNF') == $respuesta["password"]) {
                $_SESSION["validarIngreso"] = "ok";
                echo '<script>window.location = "index.php?ruta=inicio";</script>';
            } else {
                echo '<div class="alert alert-danger">Error al ingresar</div>';
            }
        }
    }

    // Actualizar registro
    static public function ctrActualizarRegistro() {
        if (isset($_POST["actualizarNombre"])) {
            if (!empty($_POST["actualizarPassword"])) {
                $password = crypt($_POST["actualizarPassword"], '31H+uIt/znB6jzmNADXRNF');
            } else {
                $password = $_POST["passwordActual"];
            }

            $tabla = "registros";
            $datos = array(
                "id" => $_POST["idUsuario"],
                "nombre" => $_POST["actualizarNombre"],
                "email" => $_POST["actualizarEmail"],
                "password" => $password
            );

            $respuesta = ModeloFormularios::mdlActualizarRegistro($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<div class="alert alert-success">Registro actualizado</div>';
            } else {
                echo '<div class="alert alert-danger">Error al actualizar el registro: ' . $respuesta . '</div>';
            }

            return $respuesta;
        }
    }

    // Eliminar
	public function ctrEliminarRegistro() {
        if (isset($_POST["eliminarRegistro"])) {
            $tabla = "registros";
            $valor = $_POST["eliminarRegistro"];

            $respuesta = ModeloFormularios::mdlEliminarRegistro($tabla, $valor);

            if ($respuesta == "ok") {
                echo '<script>
                    if ( window.history.replaceState ) {
                        window.history.replaceState( null, null, window.location.href );
                    }
                    window.location = "index.php?ruta=inicio";
                </script>';
            } else {
                echo '<div class="alert alert-danger">Error al eliminar el registro: ' . $respuesta . '</div>';
            }

            return $respuesta;
        }
    }
}