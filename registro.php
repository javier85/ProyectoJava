<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <a href="index.php">Regresar</a>
    <?php
        $conexion=mysqli_connect("localhost","root","","inventario") or die("Problemas con la conexión");
    ?>
    <header><center>
        <h1>Sistema de Inventario</h1>
        <h2>Registro de Usuario</h2>
    </center></header>
    <center>
        <form method="post">
            <table>
                <tr>
                    <td><label>Nombres:</label></td>
                </tr>
                <tr>
                    <td><input type="text" name="nombres"></td>
                </tr>
                <tr>
                    <td><label>Apellidos:</label></td>
                </tr>
                <tr>
                    <td><input type="text" name="apellidos"></td>
                </tr>
                <tr>
                    <td><label>Teléfono</label></td>
                </tr>
                <tr>
                    <td><input type="text" name="telefono"></td>
                </tr>
                <tr>
                    <td><label>E-mail:</label></td>
                </tr>
                <tr>
                    <td><input type="email" name="correo"></td>
                </tr>
                <tr>
                    <td><label>Nombre de usuario:</label></td>
                </tr>
                <tr>
                    <td><input type="text" name="username"></td>
                </tr>
                <tr>
                    <td><label>Contraseña</label></td>
                </tr>
                <tr>
                    <td><input type="password" name="password"></td>
                </tr>
                <tr>
                    <td align="center"><input type="submit" value="Registrarse" name="registrar"></td>
                </tr>
            </table>    
        </form>
    </center>
</body>
<?php 
    
    if(isset($_POST["registrar"])){
        mysqli_query($conexion,"insert into usuarios(nombres,apellidos,telefono,correo,username,password) 
        values ('$_REQUEST[nombres]','$_REQUEST[apellidos]','$_REQUEST[telefono]','$_REQUEST[correo]',
        '$_REQUEST[username]','$_REQUEST[password]')") 
        or die("Problemas con la inserción de datos".mysqli_error($conexion));
            
        mysqli_close($conexion);
        echo "<script>alert('Usuario creado con éxito');</script>";
    }
?>
</html>