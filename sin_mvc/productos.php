<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="css/productos.css">
</head>
<body>
    <?php 
        $conexion=mysqli_connect("localhost","root","","inventario") or die("Problemas con la conexión");
    ?>
    <a href="inicio.php">Regresar</a>
    <center>
        <form method="post">
            <table width="10%">
                <tr>
                    <td colspan="2" align="center"><img src="img/logoproductos.png" class="logo"></td> 
                </tr>
                <tr>
                    <td><label class="letra">ID:</label></td>
                    <td><label class="letra">Nombre:</label></td>
                </tr>
                <tr>
                    <td><input type="number" name="id" class="id"></td>
                    <td><input type="text" name="nombre" class="nombre"></td>
                </tr>
                <tr><td><label class="letra">Precio:</label></td></tr>
                <tr><td colspan="2"><input type="number" name="precio" class="precio"></td></tr>
                <tr><td><label class="letra">Proveedor:</label></td></tr>
                <tr><td colspan="2">
                    <select name="proveedorID" class="proveedor">
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
                    <td><input type="submit" value="Crear" name="crear" class="botones"></td>
                    <td align="right"><input type="submit" value="Listar" name="listar" class="botones"></td>
                </tr>
                <tr>
                    <td><input type="submit" value="Actualizar" name="actualizar" class="botones"></td>
                    <td align="right"><input type="submit" value="Eliminar" name="eliminar" class="botones"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table border="1" width="10%">
                            <tr>
                                <td class="letrat">ID</td>
                                <td class="letrat">Nombre</td>
                                <td class="letrat">Precio</td>
                                <td class="letrat">Proveedor</td>
                            </tr>
                            <?php
                                if(isset($_POST["listar"])){
                                    $consulta="select productos.id,productos.nombre,productos.precio,proveedores.nombre_proveedor
                                    from productos JOIN proveedores on productos.proveedorID=proveedores.id
                                    WHERE productos.proveedorID=proveedores.id;";
                                    $resultado=mysqli_query($conexion,$consulta);
                                    while($row=mysqli_fetch_assoc($resultado)){
                                        echo "<tr>";
                                        echo "<td class='letrabd'>".$row['id']."</td>";
                                        echo "<td class='letrabd'>".$row['nombre']."</td>";
                                        echo "<td class='letrabd'>".$row['precio']."</td>";
                                        echo "<td class='letrabd'>".$row['nombre_proveedor']."</td>";
                                        echo "</tr>";
                                    }
                                }
                                
                            ?>
                        </table>
                    </td>
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