<?php

if (!isset($_SESSION["validarIngreso"])) {

    echo '<script>window.location = "index.php?ruta=ingreso";</script>';

    return;

} else {

    if ($_SESSION["validarIngreso"] != "ok") {

        echo '<script>window.location = "index.php?ruta=ingreso";</script>';

        return;
    }
}

$productos = ProductosModelo::mdlSeleccionarProductos();

?>

<h2>Productos</h2>
<table class="tabla">
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Descripción</th>
            <th>Imagen</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($productos as $key => $value): ?>
        <tr>
            <td><?php echo ($key + 1); ?></td>
            <td><?php echo $value["nom_producto"]; ?></td>
            <td><?php echo $value["tipo_producto"]; ?></td>
            <td><?php echo $value["desc_producto"]; ?></td>
            <td><img src="<?php echo $value["img_producto"]; ?>" alt="Imagen del Producto" width="100"></td>
            <td><?php echo $value["fecha"]; ?></td>
            <td>
                <div>
                    <a href="index.php?ruta=editar&id=<?php echo $value["id"]; ?>" class="boton_editar">Editar</a>

                    <form method="post">
                        <input type="hidden" value="<?php echo $value["id"]; ?>" name="eliminarRegistro">
                        <button type="submit" class="boton_borrar">Borrar</button>

                        <?php
                            $eliminar = new ProductosControlador();
                            $eliminar->ctrEliminarProducto();
                        ?>
                    </form>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
