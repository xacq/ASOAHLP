<?php
// incluir la conexion a la bd
require "../config/Conexion.php";

Class Tbl_miembros{
    public function __construct(){

    }

    // insertar
    public function insertar($Mi_Nombres,$Mi_Apellido,$Mi_FechaNacimiento,$Mi_Celular,$Mi_Email,$Mi_Departamento,$Mi_Ocupacion,$Mi_Direccion,$Mi_tiempo,$CI,$Civil,$CarnetDiscapacidad,$imagen){     
        $sql = "INSERT INTO tbl_miembros (Mi_Nombres,Mi_Apellido,Mi_FechaNacimiento,Mi_Celular,Mi_Email,Mi_Departamento,Mi_Ocupacion,Mi_Direccion,Mi_tiempo,CI,Civil,CarnetDiscapacidad,imagen,condicion) VALUES ('$Mi_Nombres','$Mi_Apellido','$Mi_FechaNacimiento','$Mi_Celular','$Mi_Email','$Mi_Departamento','$Mi_Ocupacion','$Mi_Direccion','$Mi_tiempo','$CI','$Civil','$CarnetDiscapacidad','$imagen', '1')";
        return ejecutarConsulta($sql);
    }

    // editar
      public function editar($Mi_id,$Mi_Nombres,$Mi_Apellido,$Mi_FechaNacimiento,$Mi_Celular,$Mi_Email,$Mi_Departamento,$Mi_Ocupacion,$Mi_Direccion,$Mi_tiempo,$CI,$Civil,$CarnetDiscapacidad,$imagen){
        $sql = "UPDATE tbl_miembros SET Mi_Nombres='$Mi_Nombres',Mi_Apellido='$Mi_Apellido',Mi_FechaNacimiento='$Mi_FechaNacimiento',Mi_Celular='$Mi_Celular',Mi_Email='$Mi_Email',Mi_Departamento='$Mi_Departamento',Mi_Ocupacion='$Mi_Ocupacion',Mi_Direccion='$Mi_Direccion',Mi_tiempo='$Mi_tiempo',CI='$CI',Civil='$Civil',CarnetDiscapacidad='$CarnetDiscapacidad',imagen='$imagen' 
        WHERE Mi_id='$Mi_id'";
        return ejecutarConsulta($sql);
        //UPDATE `tbl_miembros` SET `Mi_FechaNacimiento` = '1996-08-03' WHERE `tbl_miembros`.`Mi_id` = 9
    }

    // eliminar = desactivar osea condicion = 0
    public function desactivar($Mi_id){
        $sql = "UPDATE tbl_miembros SET condicion='0' WHERE Mi_id='$Mi_id'";
        return ejecutarConsulta($sql);
    }

    // activar = activar osea condicion = 1
    public function activar($Mi_id){
        $sql = "UPDATE tbl_miembros SET condicion='1' WHERE Mi_id='$Mi_id'";
        return ejecutarConsulta($sql);
    }

    // mostrar UN registro 
    public function mostrar($Mi_id){
        $sql = "SELECT * FROM tbl_miembros WHERE Mi_id='$Mi_id'";
        return ejecutarConsultaSimpleFila($sql);
    }

    // listar TODOS los registros 
    public function listar(){
        $sql = "SELECT * FROM tbl_miembros";
        return ejecutarConsulta($sql);
    }

    public function select()
	{
		$sql="SELECT * FROM tbl_miembros WHERE condicion=1";
		return ejecutarConsulta($sql);		
	}
}
?>