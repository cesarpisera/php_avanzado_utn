<?php

require_once "conexion.php";

class ModeloFormularios {

    // ------------------Insertar Registro-------------
    static public function mdlRegistro($tabla, $datos) {
        try {
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, email, password) VALUES (:nombre, :email, :password)");
    
            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
            $stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
    
            if ($stmt->execute()) {
                return "ok";
            } else {
                // Depuración
                echo "Error al ejecutar la consulta: ";
                print_r($stmt->errorInfo());
            }
    
            $stmt->closeCursor();
            $stmt = null;
    
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // ------------------Seleccionar Registro-----------
    static public function mdlSeleccionarRegistros($tabla, $item, $valor) {
        try {
            if ($item == null && $valor == null) {
                $stmt = Conexion::conectar()->prepare("SELECT *,DATE_FORMAT(fecha, '%d/%m/%Y') AS fecha FROM $tabla ORDER BY id DESC");
                $stmt->execute();
                $result = $stmt->fetchAll();
            } else {
                $stmt = Conexion::conectar()->prepare("SELECT *,DATE_FORMAT(fecha, '%d/%m/%Y') AS fecha FROM $tabla WHERE $item = :$item ORDER BY id DESC");
                $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
                $stmt->execute();
                $result = $stmt->fetch();
            }

            $stmt->closeCursor();
            $stmt = null;
            return $result;

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // ------------------Actualizar Registro-----------
    static public function mdlActualizarRegistro($tabla, $datos) {
        try {
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, email = :email, password = :password WHERE id = :id");
            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
            $stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
            $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }

            $stmt->closeCursor();
            $stmt = null;

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // ------------------Eliminar Registro-----------
    static public function mdlEliminarRegistro($tabla, $valor) {
        try {
            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
            $stmt->bindParam(":id", $valor, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }

            $stmt->closeCursor();
            $stmt = null;

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
