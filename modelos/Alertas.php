<?php
require "../config/Conexion.php";

class Alertas
{
    public function __construct()
    {
    }

    public function insertar($tipo, $Mi_id, $fecha)
    {
        $sql = "INSERT INTO tbl_alertas (tipo_alerta, Mi_id, fecha, leida) VALUES ('$tipo', '$Mi_id', '$fecha', 0)";
        return ejecutarConsulta($sql);
    }

    public function marcarLeida($id)
    {
        $sql = "UPDATE tbl_alertas SET leida = 1 WHERE id = '$id'";
        return ejecutarConsulta($sql);
    }

    public function listar()
    {
        $sql = "SELECT * FROM tbl_alertas ORDER BY fecha ASC";
        return ejecutarConsulta($sql);
    }

    public function existe($tipo, $Mi_id, $fecha)
    {
        $sql = "SELECT id FROM tbl_alertas WHERE tipo_alerta='$tipo' AND Mi_id='$Mi_id' AND fecha='$fecha'";
        return ejecutarConsulta($sql);
    }
}

?>

