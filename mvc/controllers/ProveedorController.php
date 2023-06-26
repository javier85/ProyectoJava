<?php
$rutaCarpeta = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$rutaProyecto = explode("/", $rutaCarpeta);

require_once $_SERVER['DOCUMENT_ROOT']. "/" . $rutaProyecto[1] .'/models/ProveedorModel.php';

class ProveedorController extends Connection
{
    public function list_proveedores()
    {
        $proveedor_obj=new Proveedor();
        $proveedores= $proveedor_obj->getAll();
        return $proveedores;
    }

    public function select_proveedores()
    {
        // FETCH_OBJ
        $sql = $this->dbConnection->prepare("SELECT * FROM proveedores WHERE id = ?");
        $sql->bindParam(1, $id);

        // Ejecutamos
        $sql->execute();

        // Ahora vamos a indicar el fetch mode cuando llamamos a fetch:
        if($row = $sql->fetch(PDO::FETCH_OBJ)) {
            // Creacion de objeto de la clase Proveedor
            $pro_obj = new Proveedor($row->id, $row->nombre_proveedor, $row->direccion);
        }else{
            $pro_obj = null;
        }
        return $pro_obj; // Se retorna el objeto de proveedores


    }
}



?>