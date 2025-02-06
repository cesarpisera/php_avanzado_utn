<h2>Registro</h2>
<div>
    <form class="" method="post">
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" class="" id="nombre" name="registroNombre">

            <label for="email">Email:</label>
            <input type="email" class="" id="email" name="registroEmail">

            <label for="pwd">Contraseña:</label>
            <input type="password" class="" id="pwd" name="registroPassword">
        </div>

        <input type="hidden" name="registroForm" value="true">
        <button type="submit" class="enviar">Enviar</button>
    </form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["registroForm"])) {
    if (!empty($_POST["registroNombre"]) && !empty($_POST["registroEmail"]) && !empty($_POST["registroPassword"])) {
        $registro = ControladorFormularios::ctrRegistro();
    }
}
?>