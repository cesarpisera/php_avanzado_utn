<h2>Carga de Productos</h2>
<div>
    <form class="" method="post" enctype="multipart/form-data">
        <div>
            <label for="nom_producto">Nombre del Producto:</label>
            <input type="text" class="" id="nom_producto" name="nom_producto" required>

            <label for="tipo_producto">Tipo de Producto:</label>
            <input type="text" class="" id="tipo_producto" name="tipo_producto" required>

            <label for="desc_producto">Descripción:</label>
            <textarea class="" id="desc_producto" name="desc_producto" required></textarea>

            <label for="img_producto">Imagen del Producto:</label>
            <input type="file" class="" id="img_producto" name="img_producto" accept="image/*" required>
        </div>

        <input type="hidden" name="productoForm" value="true">
        <button type="submit" class="enviar">Guardar Producto</button>
    </form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["productoForm"])) {
    if (!empty($_POST["nom_producto"]) && !empty($_POST["tipo_producto"]) && !empty($_POST["desc_producto"]) && !empty($_FILES["img_producto"])) {
        $producto = new ProductosControlador();
        $producto->ctrGuardarProducto();
    }
}
?>

