<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proveedores</title>
</head>
<body>
    <?php
        $conexion=mysqli_connect("localhost","root","","inventario") or die("Problemas con la conexión");
    ?>
    <a href="inicio.php">Regresar</a>
    <header><center>
        <h1>Sistema de Inventarios</h1>
        <h2>Proveedores</h2>
    </center></header>
    <center>
        <form method="post">
            <table width="10%">
                <tr>
                    <td><label>ID:</label></td>
                    <td><label>Nombre:</label></td>
                </tr>
                <tr>
                    <td><input type="number" name="id" style="width:90%"></td>
                    <td><input type="text" name="nombre" size="12%"></td>
                </tr>
                <tr>
                    <td colspan="2"><label>Dirección</label></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="text" name="direccion" size="22%"></td>
                </tr>
                <tr>
                    <td><input type="submit" value="Crear" name="crear"></td>
                    <td align="right"><input type="submit" value="Listar" name="listar"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table border="1">
                            <tr>
                                <td>ID</td>
                                <td>Nombre</td>
                                <td>Direccion</td>
                            </tr>
                            <?php
                                if(isset($_POST["listar"])){
                                    $consulta="select * from proveedores";
                                    $resultado=mysqli_query($conexion,$consulta);
                                    while($row=mysqli_fetch_assoc($resultado)){
                                        echo "<tr>";
                                        echo "<td>".$row['id']."</td>";
                                        echo "<td>".$row['nombre_proveedor']."</td>";
                                        echo "<td>".$row['direccion']."</td>";
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
        if (isset($_POST["crear"])){    
            if(strlen($_POST["nombre"])>=3 && strlen($_POST["direccion"])>=4){
                mysqli_query($conexion,"insert into proveedores(nombre_proveedor,direccion) 
                values ('$_REQUEST[nombre]','$_REQUEST[direccion]')")
                or die("Problemas con la inserción de datos".mysqli_error($conexion));
                mysqli_close($conexion);
                echo "<script>alert('Proveedor creado con exito');</script>";
            }else{
                echo "<script>alert('Por favor llene todos los campos');</script>";
            }
        }
        if (isset($_POST["actualizar"])){
            $parametro=$_REQUEST["id"];
            $nombre=$_REQUEST["nombre"];
            $direccion=$_REQUEST["direccion"];
            $consulta="update proveedores SET nombre_proveedor = '$nombre',direccion='$direccion'
            WHERE id='$parametro';";
            mysqli_query($conexion,$consulta);
            echo "<script>alert('Proveedor actualizado correctamente');</script>";
        }
        if (isset($_POST["eliminar"])){
            $parametro=$_REQUEST["id"];
            $consulta="delete from proveedores where id= '$parametro'";
            mysqli_query($conexion,$consulta);
            echo "<script>alert('El proveedor se ha eliminado');</script>";
        }
    ?>
</body>
</html>