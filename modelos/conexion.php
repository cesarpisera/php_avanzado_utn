<?php

class Conexion {
    static public function conectar(){
        try {
            $link = new PDO(
                "mysql:host=localhost;port=3306;dbname=php_avanzado_496",
                "root",
                ""
            );
            $link->exec("set names utf8");
            return $link;
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
    }
}
