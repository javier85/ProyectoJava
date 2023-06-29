<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <center>
        <form method="post">
            <table>
                <tr rowspan="3">
                    <td colspan="2">
                        <img src="img/fondo.png" class="fondo">
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><img src="img/imagenindex.png" class="logo"></td> 
                </tr>
                <tr>
                    <td><label class="letra">Username:</label></td>
                </tr>
                <tr>
                    <td><input type="text"  class="datos" name="username"></td>
                </tr>
                <tr>
                    <td><label class="letra">Password:</label></td>
                </tr>
                <tr>
                    <td><input type="password" class="datos" name="password"></td>
                </tr>
                <tr>
                    <td align="center"><input type="submit" value="Ingresar" name="ingresar" class="submit"></td>
                </tr>
                <tr>
                    <td align="center"><a href="registro.php" class="link">Registrarse</a></td>
                </tr>
            </table>
        </form>
    </center>
</body>
<?php
    if (isset($_POST["ingresar"])){
        $dbhost="localhost";
        $dbuser="root";
        $dbpass="";
        $dbname="inventario";

        $conn=mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
        if(!$conn)
        {
            die("No hay conexión: ".mysqli_connect_error());
        }

        $username=$_POST["username"];
        $password=$_POST["password"];

        $query = mysqli_query($conn,"SELECT * FROM usuarios WHERE username='".$username."' and password='".$password."'");
        $nr= mysqli_num_rows($query);

        if($nr==1)
        {
            echo "<script>alert('Inicio de Sesión Exitoso');</script>";
            header("location:inicio.php");
        }
        else if($nr!=1)
        {
            echo "<script>alert('Error de Inicio de Sesión');</script>";
        }
    }
?>
</html>