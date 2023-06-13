<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
</head>
<body>
    <?php 
        $conexion=mysqli_connect("localhost","root","","inventario") or die("Problemas con la conexión");
    ?>
    <a href="inicio.php">Regresar</a>
    <center>
        <header>
            <h1>Sistema de Inventarios</h1>
            <h2>Productos</h2>
        </header>
        <form method="post">
            <table width="10%">
                <tr>
                    <td><label>ID:</label></td>
                    <td><label>Nombre:</label></td>
                </tr>
                <tr>
                    <td><input type="number" style="width:90%" name="id"></td>
                    <td><input type="text" name="nombre" size="12.5%"></td>
                </tr>
                <tr><td><label>Precio:</label></td></tr>
                <tr><td colspan="2"><input type="number" name="precio" style="width:95%"></td></tr>
                <tr><td><label>Proveedor:</label></td></tr>
                <tr><td colspan="2">
                    <select name="proveedorID">
                        <option selected>Seleccione un proveedor</option>
                        <?php
                            $consulta="select id, nombre_proveedor from proveedores";
                            $resultado=mysqli_query($conexion,$consulta);
                            if (mysqli_num_rows($resultado)>0){
                                while($row=mysqli_fetch_assoc($resultado)){
                                    $id=$row["id"];
                                    $nombre=$row["nombre_proveedor"];
                                    echo '<option value="'.$id.'">'.$nombre.'</option>';
                                }
                            }
                        ?> 
                    </select>
                </td></tr>
                <tr>
                    <td><input type="submit" value="Crear" name="crear"></td>
                    <td align="right"><input type="submit" value="Listar" name="listar"></td>
                </tr></td>
                <tr>
                    <td colspan="2">
                        <table border="1" width="10%">
                            <tr>
                                <td>ID</td>
                                <td>Nombre</td>
                                <td>Precio</td>
                                <td>Proveedor</td>
                            </tr>
                            <?php
                                if(isset($_POST["listar"])){
                                    $consulta="select productos.id,productos.nombre,productos.precio,proveedores.nombre_proveedor
                                    from productos JOIN proveedores on productos.proveedorID=proveedores.id
                                    WHERE productos.proveedorID=proveedores.id;";
                                    $resultado=mysqli_query($conexion,$consulta);
                                    while($row=mysqli_fetch_assoc($resultado)){
                                        echo "<tr>";
                                        echo "<td>".$row['id']."</td>";
                                        echo "<td>".$row['nombre']."</td>";
                                        echo "<td>".$row['precio']."</td>";
                                        echo "<td>".$row['nombre_proveedor']."</td>";
                                        echo "</tr>";
                                    }
                                }
                                
                            ?>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td><input type="submit" value="Actualizar" name="actualizar"></td>
                    <td align="right"><input type="submit" value="Eliminar" name="eliminar"></td>
                </tr>
            </table>
        </form>
    </center>
    <?php 
        if(isset($_POST["crear"])){
            if(strlen ($_POST["nombre"])>=7 && $_POST["precio"]>=100 && $_POST["proveedorID"]>=1){
                mysqli_query($conexion,"insert into productos(nombre,precio,proveedorID) 
                values ('$_REQUEST[nombre]',$_REQUEST[precio],$_REQUEST[proveedorID])")
                or die("Problemas con la inserción de datos".mysqli_error($conexion));
        
                mysqli_close($conexion);
                echo "<script>alert('Producto creado con exito');</script>";
            }else{
                echo "<script>alert('Por favor llene todos los campos');</script>";
            }
        }
        if (isset($_POST["actualizar"])){
            $parametro=$_REQUEST["id"];
            $nombre=$_REQUEST["nombre"];
            $precio=$_REQUEST["precio"];
            $proveedor=$_REQUEST["proveedorID"];
            $consulta="update productos SET nombre='$nombre',precio='$precio',proveedorID='$proveedor'
            WHERE id='$parametro';";
            mysqli_query($conexion,$consulta);
            echo "<script>alert('Producto actualizado con exito');</script>";
        }
        if (isset($_POST["eliminar"])){
            $parametro=$_REQUEST["id"];
            $consulta="delete from productos where id= '$parametro'";
            mysqli_query($conexion,$consulta);
            echo "<script>alert('El producto se ha eliminado');</script>";
        }             
    ?>
</body>
</html>