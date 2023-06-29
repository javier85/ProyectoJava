<?php
$rutaCarpeta = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$rutaProyecto = explode("/", $rutaCarpeta);

require_once $_SERVER['DOCUMENT_ROOT']. "/" . $rutaProyecto[1] .'/core/Connection.php';


class Proveedor extends Connection
{
    private $id;
    private $nombre_proveedor;
    private $direccion;

    public function __construct($id=null, $nombre_proveedor=null, $direccion=null)
    {
        $this->id=$id;
        $this->nombre_proveedor=$nombre_proveedor;
        $this->direccion=$direccion;
        parent::__construct();
    }
    /*
    public function getAll()
    {
        try
        {
            // FETCH_OBJ
            $sql=$this->dbConnection->prepare("SELECT * FROM proveedores");

            //ejecutamos
            $sql->execute();
            $resultSet=null;

            //Ahora indicamos el fetch mode cuando llamamos a fetch:
            while($row=$sql->fetch(PDO::FETCH_OBJ))
            {
                $resultSet[]=$row;
            }

            return $resultSet;
        }catch(PDOException $ex){   
            echo $ex->getMessage();
            die();
        }
    }
    */
    public function getAll()
    {
        try {
            // FETCH_OBJ
            $sql = $this->dbConnection->prepare("SELECT * FROM proveedores");

            // Ejecutamos
            $sql->execute();
            $resultSet = null;
            // Ahora vamos a indicar el fetch mode cuando llamamos a fetch:
            while ($row = $sql->fetch(PDO::FETCH_OBJ)) {
                $resultSet[] = $row;
            }
            return $resultSet;
        } catch (PDOException $ex) {
            echo '<div class="alert alert-danger container text-center" role="alert">
        <strong>ERROR EN SISTEMA CONSULTE A SU TI MAS CERCANO</strong>
    </div>';

            die();
        }
    }

    //funciones get y set de los atributos

    //el id en la base de datos es autoincrementable, por lo tanto solo tendremos metodo get
    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre_proveedor;
    }

    public function setid($id)
    {
        $this->id=$id;
        return $this;
    }
    public function setNombre($nombre_proveedor)
    {
        $this->nombre_proveedor=$nombre_proveedor;
        return $this;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function setDireccion($direccion)
    {
        $this->direccion=$direccion;
        return $this;
    }
}