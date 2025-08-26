<?php
// incluir la conexion a la bd
require "../config/Conexion.php";

Class Tbl_auspiciantes{
    public function __construct(){

    }

    // insertar
    public function insertar($aus_Nombre, $aus_pais, $aus_departamento, $aus_ciudad, $Otro_dato, $imagen){     
        $sql = "INSERT INTO tbl_auspiciantes (aus_Nombre,aus_pais,aus_departamento, aus_ciudad, Otro_dato, imagen, condicion)
        VALUES ('$aus_Nombre', '$aus_pais','$aus_departamento','$aus_ciudad','$Otro_dato','$imagen','1')";
        return ejecutarConsulta($sql);
    }

    // editar
      public function editar($aus_id,$aus_Nombre, $aus_pais, $aus_departamento, $aus_ciudad, $Otro_dato, $imagen){
        $sql = "UPDATE tbl_auspiciantes SET aus_Nombre='$aus_Nombre', aus_pais='$aus_pais', aus_departamento='$aus_departamento',aus_ciudad='$aus_ciudad',Otro_dato='$Otro_dato',imagen='$imagen' 
        WHERE aus_id='$aus_id'";
        return ejecutarConsulta($sql);
    }

    // eliminar = desactivar osea condicion = 0
    public function desactivar($aus_id){
        $sql = "UPDATE tbl_auspiciantes SET condicion='0' 
        WHERE aus_id='$aus_id'";
        return ejecutarConsulta($sql);
    }

    // activar = activar osea condicion = 1
    public function activar($aus_id){
        $sql = "UPDATE tbl_auspiciantes SET condicion='1' 
        WHERE aus_id='$aus_id'";
        return ejecutarConsulta($sql);
    }

    // mostrar UN registro 
    public function mostrar($aus_id){
        $sql = "SELECT * FROM tbl_auspiciantes WHERE aus_id='$aus_id'";
        return ejecutarConsultaSimpleFila($sql);
    }

    // listar TODOS los registros 
    public function listar(){
        $sql = "SELECT * FROM tbl_auspiciantes";
        return ejecutarConsulta($sql);
    }

    public function select()
	{
		$sql="SELECT * FROM tbl_auspiciantes WHERE condicion=1";
		return ejecutarConsulta($sql);		
	}


}

?>