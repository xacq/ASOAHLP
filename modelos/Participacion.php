<?php
require "../config/Conexion.php";

class Participacion
{
    public function __construct()
    {
    }

    public function listar()
    {
        $sql="SELECT p.ParMi_id,a.Act_Nombre,m.Mi_Nombres, p.ParMi_tipo, p.ParMi_observaciones, p.ParMi_Registro FROM tbl_participacionmiembros p INNER JOIN tbl_actividades a ON p.Act_id=a.Act_id INNER JOIN tbl_miembros m ON p.Mi_Id=m.Mi_id";
        return ejecutarConsulta($sql);
    }
}
?>
