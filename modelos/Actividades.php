<?php
require "../config/Conexion.php";

class Actividades
{
    public function __construct()
    {
    }

    public function insertar($Act_Nombre,$Act_descripcion,$Act_fecha,$Mi_Id)
    {
        $sql="INSERT INTO tbl_actividades(Act_Nombre,Act_descripcion,Act_fecha,Act_estado) VALUES ('$Act_Nombre','$Act_descripcion','$Act_fecha','1')";
        $idactividad=ejecutarConsulta_retornarID($sql);
        if($idactividad){
            // validar duplicados
            $sqlexiste="SELECT ParMi_id FROM tbl_participacionmiembros WHERE Act_id='$idactividad' AND Mi_Id='$Mi_Id'";
            $existe=ejecutarConsulta($sqlexiste);
            if($existe->num_rows==0){
                $sqlpart="INSERT INTO tbl_participacionmiembros(Act_id,Mi_Id,ParMi_tipo,ParMi_observaciones,ParMi_Activo,ParMi_Registro) VALUES ('$idactividad','$Mi_Id','Creador','',1,NOW())";
                ejecutarConsulta($sqlpart);
            }
            return true;
        }
        return false;
    }

    public function listar()
    {
        $sql="SELECT * FROM tbl_actividades";
        return ejecutarConsulta($sql);
    }
}
?>
