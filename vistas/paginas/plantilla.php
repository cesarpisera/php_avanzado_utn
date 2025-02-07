<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles/style.css" rel="stylesheet" />
    <title>Local Comercial</title>
</head>
<body>
<!--Botonera-->
<section id="contenedor">
    <header>
        <nav id="botonera_principal">
            <ul>
                <li> <a href="index.php?ruta=registro"> Registro </a></li>
                <li> <a href="index.php?ruta=ingreso"> Ingreso </a></li>
                <li> <a href="index.php?ruta=inicio"> Inicio </a></li>
                <li> <a href="index.php?ruta=productos"> Productos </a></li>
                <li> <a href="index.php?ruta=usuarios"> Usuarios </a></li>
                <li> <a href="index.php?ruta=salir"> Salir </a></li>
            </ul>
        </nav>
        <div id="marca">
            <h1>Local Comercial</h1>
        </div>
    </header>

    <!--CONTENIDO-->
    <section id="contenido">
        <?php

        if (isset($_GET["ruta"])) {
            if (
                $_GET["ruta"] == "registro" ||
                $_GET["ruta"] == "ingreso" ||
                $_GET["ruta"] == "inicio" ||
                $_GET["ruta"] == "productos" ||
                $_GET["ruta"] == "editar" ||
                $_GET["ruta"] == "editarRegistro" ||
                $_GET["ruta"] == "usuarios" ||
                $_GET["ruta"] == "salir"
            ) {
                include "vistas/paginas/" . $_GET["ruta"] . ".php";
            } else {
                include "vistas/paginas/error404.php";
            }
        } else {
            include "vistas/paginas/registro.php";
        }

        ?>
    </section>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="vistas/js/script.js"></script>
</body>
</html>
