<?php
$rutaCarpeta = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$rutaProyecto = explode("/", $rutaCarpeta);

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


?>