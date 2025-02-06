<?php

class ProductosControlador {

    // Guardar producto
    public function ctrGuardarProducto() {
        if (isset($_POST["nom_producto"]) && isset($_FILES["img_producto"])) {

            // Validar y subir la imagen del producto
            $directorio = $_SERVER['DOCUMENT_ROOT'] . "/public/imagenes/";
            $nombreImagen = basename($_FILES["img_producto"]["name"]);
            $rutaImagen = $directorio . $nombreImagen;
            $rutaImagenBD = "/public/imagenes/" . $nombreImagen;
            
            if (!file_exists($directorio)) {
                mkdir($directorio, 0777, true);
            }

            if (move_uploaded_file($_FILES["img_producto"]["tmp_name"], $rutaImagen)) {
                $tabla = "productos";
                $datos = array(
                    "nom_producto" => $_POST["nom_producto"],
                    "tipo_producto" => $_POST["tipo_producto"],
                    "desc_producto" => $_POST["desc_producto"],
                    "img_producto" => $rutaImagenBD // Usar la ruta relativa para la base de datos
                );

                $respuesta = ProductosModelo::mdlGuardarProducto($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '<script>
                        alert("Producto guardado exitosamente");
                        window.location = "index.php?ruta=productos";
                    </script>';
                } else {
                    echo '<script>
                        alert("Error al guardar el producto");
                    </script>';
                }
            } else {
                echo '<script>
                    alert("Error al subir la imagen");
                </script>';
            }
        }
    }

    // Actualizar producto
    public function ctrActualizarProducto() {
        if (isset($_POST["actualizarNomProducto"])) {

            // Validar y subir la nueva imagen del producto si existe
            $rutaImagenBD = isset($_POST["imagenActual"]) ? $_POST["imagenActual"] : "";
            if (isset($_FILES["actualizarImgProducto"]["tmp_name"]) && !empty($_FILES["actualizarImgProducto"]["tmp_name"])) {

                $directorio = $_SERVER['DOCUMENT_ROOT'] . "/public/imagenes/";
                $nombreImagen = basename($_FILES["actualizarImgProducto"]["name"]);
                $rutaImagen = $directorio . $nombreImagen;
                $rutaImagenBD = "/public/imagenes/" . $nombreImagen;

                if (!file_exists($directorio)) {
                    mkdir($directorio, 0777, true);
                }

                move_uploaded_file($_FILES["actualizarImgProducto"]["tmp_name"], $rutaImagen);
            }

            $tabla = "productos";
            $datos = array(
                "id" => $_POST["idProducto"],
                "nom_producto" => $_POST["actualizarNomProducto"],
                "tipo_producto" => $_POST["actualizarTipoProducto"],
                "desc_producto" => $_POST["actualizarDescProducto"],
                "img_producto" => $rutaImagenBD // Usar la ruta relativa para la base de datos
            );

            $respuesta = ProductosModelo::mdlActualizarProducto($tabla, $datos);

            if ($respuesta == "ok") {
                return "ok";
            } else {
                echo '<script>
                    alert("Error al actualizar el producto");
                </script>';
            }
        }
    }

    // Eliminar producto
    public function ctrEliminarProducto() {
        if (isset($_POST["eliminarRegistro"])) {

            $tabla = "productos";
            $id = $_POST["eliminarRegistro"];

            $respuesta = ProductosModelo::mdlEliminarProducto($tabla, $id);

            if ($respuesta == "ok") {
                echo '<script>
                    alert("Producto eliminado exitosamente");
                    window.location = "index.php?ruta=productos";
                </script>';
            } else {
                echo '<script>
                    alert("Error al eliminar el producto");
                </script>';
            }
        }
    }
}

?>
