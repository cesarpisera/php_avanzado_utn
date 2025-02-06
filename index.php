<?php

session_start();

require_once "controladores/plantilla.controlador.php";
require_once "controladores/formularios.controlador.php";
require_once "controladores/productos.controlador.php"; // Agrega el controlador de productos

require_once "modelos/formularios.modelo.php";
require_once "modelos/productos.modelo.php"; // Agrega el modelo de productos


// Instancia y llama al controlador de la plantilla
$plantilla = new ControladorPlantilla();
$plantilla->ctrGetPlantilla();
