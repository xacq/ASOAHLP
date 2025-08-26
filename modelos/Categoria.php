<?php
// incluir la conexion a la bd
require "../config/Conexion.php";

Class Categoria{
    public function __construct(){

    }

    // insertar
    public function insertar($nombre, $descripcion){     
        $sql = "INSERT INTO categoria (nombre,descripcion,condicion)
        VALUES ('$nombre', '$descripcion', '1')";
        return ejecutarConsulta($sql);
    }

    // editar
      public function editar($idcategoria,$nombre, $descripcion){
        $sql = "UPDATE categoria SET nombre='$nombre', descripcion='$descripcion' 
        WHERE idcategoria='$idcategoria'";
        return ejecutarConsulta($sql);
    }

    // eliminar = desactivar osea condicion = 0
    public function desactivar($idcategoria){
        $sql = "UPDATE categoria SET condicion='0' 
        WHERE idcategoria='$idcategoria'";
        return ejecutarConsulta($sql);
    }

    // activar = activar osea condicion = 1
    public function activar($idcategoria){
        $sql = "UPDATE categoria SET condicion='1' 
        WHERE idcategoria='$idcategoria'";
        return ejecutarConsulta($sql);
    }

    // mostrar UN registro 
    public function mostrar($idcategoria){
        $sql = "SELECT * FROM categoria WHERE idcategoria='$idcategoria'";
        return ejecutarConsultaSimpleFila($sql);
    }

    // listar TODOS los registros 
    public function listar(){
        $sql = "SELECT * FROM categoria";
        return ejecutarConsulta($sql);
    }

    public function select()
	{
		$sql="SELECT * FROM categoria WHERE condicion=1";
		return ejecutarConsulta($sql);		
	}


}

?>