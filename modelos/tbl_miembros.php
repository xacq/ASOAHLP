<?php
// incluir la conexion a la bd
require "../config/Conexion.php";

Class Tbl_miembros{
    public function __construct(){

    }

    // insertar
    public function insertar($Mi_Nombres,$Mi_Apellido,$Mi_FechaNacimiento,$Mi_Celular,$Mi_Email,$ciudad_id,$Mi_Ocupacion,$Mi_Direccion,$Mi_tiempo,$CI,$estado_civil_id,$CarnetDiscapacidad,$imagen){
        $sql = "INSERT INTO tbl_miembros (Mi_Nombres,Mi_Apellido,Mi_FechaNacimiento,Mi_Celular,Mi_Email,ciudad_id,Mi_Ocupacion,Mi_Direccion,Mi_tiempo,CI,estado_civil_id,CarnetDiscapacidad,imagen,Mi_Estado) VALUES ('$Mi_Nombres','$Mi_Apellido','$Mi_FechaNacimiento','$Mi_Celular','$Mi_Email','$ciudad_id','$Mi_Ocupacion','$Mi_Direccion','$Mi_tiempo','$CI','$estado_civil_id','$CarnetDiscapacidad','$imagen','Activo')";
        return ejecutarConsulta_retornarID($sql);

    }

    public function insertarDocumento($Mi_id,$tipo_documento,$ruta_archivo){
        $sql = "INSERT INTO tbl_documentos_miembro (Mi_id,tipo_documento,ruta_archivo,fecha_subida) VALUES ('$Mi_id','$tipo_documento','$ruta_archivo',NOW())";
        return ejecutarConsulta($sql);
    }

    public function listarDocumentos($Mi_id){
        $sql = "SELECT * FROM tbl_documentos_miembro WHERE Mi_id='$Mi_id'";
        return ejecutarConsulta($sql);

    }

    // editar
      public function editar($Mi_id,$Mi_Nombres,$Mi_Apellido,$Mi_FechaNacimiento,$Mi_Celular,$Mi_Email,$ciudad_id,$Mi_Ocupacion,$Mi_Direccion,$Mi_tiempo,$CI,$estado_civil_id,$CarnetDiscapacidad,$imagen){
        $sql = "UPDATE tbl_miembros SET Mi_Nombres='$Mi_Nombres',Mi_Apellido='$Mi_Apellido',Mi_FechaNacimiento='$Mi_FechaNacimiento',Mi_Celular='$Mi_Celular',Mi_Email='$Mi_Email',ciudad_id='$ciudad_id',Mi_Ocupacion='$Mi_Ocupacion',Mi_Direccion='$Mi_Direccion',Mi_tiempo='$Mi_tiempo',CI='$CI',estado_civil_id='$estado_civil_id',CarnetDiscapacidad='$CarnetDiscapacidad',imagen='$imagen' WHERE Mi_id='$Mi_id'";
        return ejecutarConsulta($sql);
        //UPDATE `tbl_miembros` SET `Mi_FechaNacimiento` = '1996-08-03' WHERE `tbl_miembros`.`Mi_id` = 9
    }

    // cambiar estado a Inactivo
    public function desactivar($Mi_id){
        $sql = "UPDATE tbl_miembros SET Mi_Estado='Inactivo' WHERE Mi_id='$Mi_id'";
        return ejecutarConsulta($sql);
    }

    // cambiar estado a Activo
    public function activar($Mi_id){
        $sql = "UPDATE tbl_miembros SET Mi_Estado='Activo' WHERE Mi_id='$Mi_id'";
        return ejecutarConsulta($sql);
    }

    // mostrar UN registro
    public function mostrar($Mi_id){
        $sql = "SELECT m.*, c.departamento_id FROM tbl_miembros m LEFT JOIN tbl_ciudades c ON m.ciudad_id=c.id WHERE Mi_id='$Mi_id'";
        return ejecutarConsultaSimpleFila($sql);
    }

    // listar TODOS los registros
    public function listar(){
        $sql = "SELECT m.*, c.nombre AS Ciudad, d.nombre AS Departamento, e.nombre AS EstadoCivil FROM tbl_miembros m LEFT JOIN tbl_ciudades c ON m.ciudad_id=c.id LEFT JOIN tbl_departamentos d ON c.departamento_id=d.id LEFT JOIN tbl_estado_civil e ON m.estado_civil_id=e.id";
        return ejecutarConsulta($sql);
    }

    public function select()
        {
                $sql="SELECT * FROM tbl_miembros WHERE Mi_Estado='Activo'";
                return ejecutarConsulta($sql);
        }

    public function selectEstadoCivil()
        {
                $sql="SELECT * FROM tbl_estado_civil";
                return ejecutarConsulta($sql);
        }

    public function selectDepartamentos()
        {
                $sql="SELECT * FROM tbl_departamentos";
                return ejecutarConsulta($sql);
        }

    public function selectCiudades($departamento_id)
        {
                $sql="SELECT * FROM tbl_ciudades WHERE departamento_id='$departamento_id'";
                return ejecutarConsulta($sql);
        }
}
?>
