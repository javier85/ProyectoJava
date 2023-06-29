<?php
include_once '../../controllers/Proveedor.controllers.php';
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


</head>
<body>
    <?php
        // Se crea una instancia de la clase ProveedorController
        $proveedor_obj = new ProveedorController();
        // Se llama al método que lista a todos los pacientes
        $proveedores = $proveedor_obj->list_proveedores();
    ?>
    <div class="container-fluid backg1">
        HEADER MENU
    </div>

    <div class="container">
        <h1>Gestionar Proveedores</h1>
        <div class="row">
            <div class="col">
                <a class="btn btn-success btn-lg" href="#" role="button">Insertar</a>
            </div>
            <div class="col">
                <a class="btn btn-success btn-lg" href="#" role="button">Exportar Excel</a>
            </div>
        </div>
        <div class="row">
            <div class="col-3">ID</div>
            <div class="col-3">Nombre</div>
            <div class="col-3">Direccion</div>
        </div>
        <?php foreach ($proveedores as $item) {?>
        <div class="row">
            <div class="col-3"><?php echo $item->id; ?></div>
            <div class="col-3"><?php echo $item->nombre_proveedor; ?></div>
            <div class="col-3"><?php echo $item->direccion; ?></div>
            <div class="col-1">
                <a class="btn btn-warning btn-lg" href="#" role="button">Ver</a>
            </div>
            <div class="col-1">
                <a class="btn btn-primary btn-lg"
                href="edit_proveedor.php?doc=<?php echo $item->id; ?>" role="button">Editar</a>
            </div>
            <div class="col-1">
                <a class="btn btn-danger btn-lg" href="#" role="button">Eliminar</a>
            </div>
        </div><br>
        <?php ?>
    </div>
    <br>
    <div class="container-fluid backg1">FOOTER</div>
    <?php   
     }
    ?>
</body>
</html>