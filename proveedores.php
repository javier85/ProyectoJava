<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proveedores</title>
    <link rel="stylesheet" href="css/proveedores.css">
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
                    <td colspan="2" align="center"><img src="img/logoproveedores.png" class="logo"></td> 
                </tr>
                <tr>
                    <td><label class="letra">ID:</label></td>
                    <td><label class="letra">Nombre:</label></td>
                </tr>
                <tr>
                    <td><input type="number" name="id" class="id"></td>
                    <td><input type="text" name="nombre" class="nombre"></td>
                </tr>
                <tr>
                    <td colspan="2"><label class="letra">Dirección</label></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="text" name="direccion" class="direccion"></td>
                </tr>
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
                        <table border="1">
                            <tr>
                                <td class="letrat">ID</td>
                                <td class="letrat">Nombre</td>
                                <td class="letrat">Direccion</td>
                            </tr>
                            <?php
                                if(isset($_POST["listar"])){
                                    $consulta="select * from proveedores";
                                    $resultado=mysqli_query($conexion,$consulta);
                                    while($row=mysqli_fetch_assoc($resultado)){
                                        echo "<tr>";
                                        echo "<td class='letrabd'>".$row['id']."</td>";
                                        echo "<td class='letrabd'>".$row['nombre_proveedor']."</td>";
                                        echo "<td class='letrabd'>".$row['direccion']."</td>";
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