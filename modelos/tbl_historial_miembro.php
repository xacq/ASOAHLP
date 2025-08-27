<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

class Tbl_historial_miembro
{
    //Implementamos nuestro constructor
    public function __construct()
    {

    }

    //Registrar evento en el historial
    public function registrar($Mi_id,$descripcion)
    {
        $sql="INSERT INTO tbl_historial_miembro (Mi_id,descripcion,fecha_registro) VALUES ('$Mi_id','$descripcion',NOW())";
        return ejecutarConsulta($sql);
    }

    //Listar historial por miembro
    public function listar($Mi_id)
    {
        $sql="SELECT descripcion,fecha_registro FROM tbl_historial_miembro WHERE Mi_id='$Mi_id' ORDER BY fecha_registro DESC";
        return ejecutarConsulta($sql);
    }
}
?>
