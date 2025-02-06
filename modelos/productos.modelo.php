<?php
require_once "conexion.php";
class ProductosModelo {
    // Guardar producto en la base de datos
    static public function mdlGuardarProducto($tabla, $datos) {
        try {
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nom_producto, tipo_producto, desc_producto, img_producto) VALUES (:nom_producto, :tipo_producto, :desc_producto, :img_producto)");
            $stmt->bindParam(":nom_producto", $datos["nom_producto"], PDO::PARAM_STR);
            $stmt->bindParam(":tipo_producto", $datos["tipo_producto"], PDO::PARAM_STR);
            $stmt->bindParam(":desc_producto", $datos["desc_producto"], PDO::PARAM_STR);
            $stmt->bindParam(":img_producto", $datos["img_producto"], PDO::PARAM_STR);
            if ($stmt->execute()) {
                return "ok";
            } else {
                print_r($stmt->errorInfo());
            }
            $stmt->closeCursor();
            $stmt = null;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Seleccionar productos de la base de datos
    static public function mdlSeleccionarProductos($item = null, $valor = null) {
        try {
            if ($item != null) {
                $stmt = Conexion::conectar()->prepare("SELECT * FROM productos WHERE $item = :$item");
                $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetch();
            } else {
                $stmt = Conexion::conectar()->prepare("SELECT * FROM productos");
                $stmt->execute();
                return $stmt->fetchAll();
            }
            $stmt->closeCursor();
            $stmt = null;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Eliminar producto de la base de datos
    static public function mdlEliminarProducto($tabla, $id) {
        try {
            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return "ok";
            } else {
                print_r($stmt->errorInfo());
            }
            $stmt->closeCursor();
            $stmt = null;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Actualizar producto en la base de datos
    static public function mdlActualizarProducto($tabla, $datos) {
        try {
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nom_producto = :nom_producto, tipo_producto = :tipo_producto, desc_producto = :desc_producto, img_producto = :img_producto WHERE id = :id");
            $stmt->bindParam(":nom_producto", $datos["nom_producto"], PDO::PARAM_STR);
            $stmt->bindParam(":tipo_producto", $datos["tipo_producto"], PDO::PARAM_STR);
            $stmt->bindParam(":desc_producto", $datos["desc_producto"], PDO::PARAM_STR);
            $stmt->bindParam(":img_producto", $datos["img_producto"], PDO::PARAM_STR);
            $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
            if ($stmt->execute()) {
                return "ok";
            } else {
                print_r($stmt->errorInfo());
            }
            $stmt->closeCursor();
            $stmt = null;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
