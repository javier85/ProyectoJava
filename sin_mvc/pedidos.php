<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos</title>
    <link rel="stylesheet" href="css/pedidos.css">
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
            <td><label class="letra">ID</label></td>
            <td><label class="letra">Producto:</label></td>
        </tr>
        <tr>
            <td><input type="text" size="6" name="id" class="id"></td>
            <td>
                <select name="productoID" class="producto">
                    <option selected>Seleccione un producto</option>
                        <?php
                            $consulta="select id, nombre from productos";
                            $resultado=mysqli_query($conexion,$consulta);
                            if (mysqli_num_rows($resultado)>0){
                                while($row=mysqli_fetch_assoc($resultado)){
                                    $id=$row["id"];
                                    $nombre=$row["nombre"];
                                    echo '<option value="'.$id.'">'.$nombre.'</option>';
                                }
                            }
                        ?> 
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2"><label class="letra">Cantidad: </label></td>
        </tr>
        <tr>
            <td colspan="2"><input type="number" name="cantidad" class="cantidad"></td>
        </tr>
        <tr>
            <td colspan="2"><label class="letra">Fecha del Pedido (aa-mm-dd):</label></td>
        </tr>
        <tr>
            <td colspan="2" class="letra">
            <?php
                $fechaActual = date('Y-m-d');
                echo $fechaActual;
            ?>
            </td>
        </tr>
        <tr>
            <td><input type="submit" name="crear" value="Crear" class="botones"></td>
            <td align="right"><input type="submit" name="listar" value="Listar" name="listar" class="botones"></td>
        </tr>
        <tr>
            <td><input type="submit" value="Actualizar" name="actualizar" class="botones"></td>
            <td align="right"><input type="submit" value="Eliminar" name="eliminar" class="botones"></td>
        </tr>
        <tr>
            <td colspan="2">
                <table border="1">
                    <tr>
                        <td class="letrat">ID</td>
                        <td class="letrat">ProductoID</td>
                        <td class="letrat">Cantidad</td>
                        <td class="letrat">Fecha</td>
                    </tr>
                    <?php
                        if(isset($_POST["listar"])){
                            $consulta="select pedidos.id,productos.nombre,pedidos.cantidad,pedidos.fechaPedido
                            from pedidos join productos on pedidos.productoID=productos.id
                            where pedidos.productoID=productos.id;";
                            $resultado=mysqli_query($conexion,$consulta);
                            while($row=mysqli_fetch_assoc($resultado)){
                                echo "<tr>";
                                echo "<td class='letrabd'>".$row['id']."</td>";
                                echo "<td class='letrabd'>".$row['nombre']."</td>";
                                echo "<td class='letrabd'>".$row['cantidad']."</td>";
                                echo "<td class='letrabd'>".$row['fechaPedido']."</td>";
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
</body>
<?php
    if(isset($_POST["crear"])){
        if($_POST["productoID"]>=1 && $_POST["cantidad"]>=1){
            mysqli_query($conexion,"insert into pedidos(productoID,cantidad) 
            values ($_REQUEST[productoID],$_REQUEST[cantidad])")
            or die("Problemas con la inserción de datos".mysqli_error($conexion));
    
            mysqli_close($conexion);
            echo "<script>alert('Pedido creado con exito');</script>";
        }else{
            echo "<script>alert('Por favor llene todos los campos');</script>";
        }
    }
    if (isset($_POST["actualizar"])){
        $parametro=$_REQUEST["id"];
        $producto=$_REQUEST["productoID"];
        $cantidad=$_REQUEST["cantidad"];
        $consulta="update pedidos SET productoID='$producto',cantidad='$cantidad'
        WHERE id='$parametro';";
        mysqli_query($conexion,$consulta);
        echo "<script>alert('Pedido actualizado con exito');</script>";
    }
    if (isset($_POST["eliminar"])){
        $parametro=$_POST["id"];
        $consulta = "delete from pedidos where id= '$parametro'";
        mysqli_query($conexion,$consulta);
        echo "<script>alert('El pedido se ha eliminado');</script>";
    } 
?>
</html>