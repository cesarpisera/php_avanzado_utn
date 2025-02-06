<?php

if(isset($_GET["id"])){
    $item = "id";
    $valor = $_GET["id"];
    $producto = ProductosModelo::mdlSeleccionarProductos($item, $valor);
}

?>

<div>
    <form method="post" enctype="multipart/form-data">
        <input type="text" value="<?php echo $producto["nom_producto"]; ?>" placeholder="Escriba el nombre del producto" id="nom_producto" name="actualizarNomProducto" required>
        <input type="text" value="<?php echo $producto["tipo_producto"]; ?>" placeholder="Escriba el tipo de producto" id="tipo_producto" name="actualizarTipoProducto" required>          
        <textarea placeholder="Escriba la descripción del producto" id="desc_producto" name="actualizarDescProducto" required><?php echo $producto["desc_producto"]; ?></textarea>
        <input type="file" placeholder="Seleccione una nueva imagen" id="img_producto" name="actualizarImgProducto" accept="image/*">
        <img src="<?php echo $producto["img_producto"]; ?>" alt="Imagen del Producto" width="100">
        <input type="hidden" name="idProducto" value="<?php echo $producto["id"]; ?>">

        <?php
        // Crear una instancia de ProductosControlador
        $actualizar = new ProductosControlador();
        $resultado = $actualizar->ctrActualizarProducto();

        if($resultado == "ok"){
            echo '<script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
            </script>';

            echo '<div class="alert alert-success">El producto ha sido actualizado</div>
            <script>
                setTimeout(function(){
                    window.location = "index.php?ruta=productos";
                },3000);
            </script>
            ';
        }
        ?>
        
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
