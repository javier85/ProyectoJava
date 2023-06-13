<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
<body>
    <header><center>
        <h1>Sistema de Inventario</h1>
        <h2>Inicio de Sesión</h2>
    </center></header>
    <center>
        <form method="post">
            <table>
                <tr>
                    <td><label>Username:</label></td>
                </tr>
                <tr>
                    <td><input type="text" name="username"></td>
                </tr>
                <tr>
                    <td><label>Password:</label></td>
                </tr>
                <tr>
                    <td><input type="password" name="password"></td>
                </tr>
                <tr>
                    <td align="center"><input type="submit" value="Ingresar" name="ingresar"></td>
                </tr>
                <tr>
                    <td align="center"><a href="registro.php">Registrarse</a></td>
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