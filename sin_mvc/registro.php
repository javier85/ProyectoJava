<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/registro.css">
    <title>Registro</title>
</head>
<body>
    <a href="index.php">Regresar</a>
    <?php
        $conexion=mysqli_connect("localhost","root","","inventario") or die("Problemas con la conexión");
    ?>
    <center>
        <form method="post">
            <table>
                <tr rowspan="3">
                    <td colspan="2" align="center"><img src="img/logoregistro.png" class="logo"></td>
                </tr>
                <tr>
                    <td><label class="letra">Nombres:</label></td>
                </tr>
                <tr>
                    <td><input type="text" name="nombres" class="datos"></td>
                </tr>
                <tr>
                    <td><label class="letra">Apellidos:</label></td>
                </tr>
                <tr>
                    <td><input type="text" name="apellidos" class="datos"></td>
                </tr>
                <tr>
                    <td><label class="letra">Teléfono</label></td>
                </tr>
                <tr>
                    <td><input type="text" name="telefono" class="datos"></td>
                </tr>
                <tr>
                    <td><label class="letra">E-mail:</label></td>
                </tr>
                <tr>
                    <td><input type="email" name="correo" class="datos"></td>
                </tr>
                <tr>
                    <td><label class="letra">Nombre de usuario:</label></td>
                </tr>
                <tr>
                    <td><input type="text" name="username" class="datos"></td>
                </tr>
                <tr>
                    <td><label class="letra">Contraseña</label></td>
                </tr>
                <tr>
                    <td><input type="password" name="password" class="datos"></td>
                </tr>
                <tr>
                    <td align="center"><input type="submit" value="Registrarse" name="registrar"
                    class="submit"></td>
                </tr>
            </table>    
        </form>
    </center>
</body>
<?php 
    
    if(isset($_POST["registrar"])){
        if(strlen($_POST["nombres"])>=1 && strlen($_POST["apellidos"])>=1 && strlen($_POST["telefono"]>=1)
        && strlen($_POST["correo"])>=1 && strlen($_POST["username"])>=1 && strlen($_POST["password"])>=1){
            mysqli_query($conexion,"insert into usuarios(nombres,apellidos,telefono,correo,username,password) 
            values ('$_REQUEST[nombres]','$_REQUEST[apellidos]','$_REQUEST[telefono]','$_REQUEST[correo]',
            '$_REQUEST[username]','$_REQUEST[password]')") 
            or die("Problemas con la inserción de datos".mysqli_error($conexion));
                
            mysqli_close($conexion);
            echo "<script>alert('Usuario creado con éxito');</script>";
        }
        else{
            echo "<script>alert('Por favor llene todos los campos');</script>";
        }   
    }
?>
</html>