<?php
// Incluimos la conexión a la base de datos
require "../config/Conexion.php";

Class Reportes{

    // Constructor vacío
    public function __construct(){

    }

    // Registra la generación de un reporte
    public function registrar($reporte,$usuario_id){
        $sql="INSERT INTO tbl_reportes (reporte,fecha_generacion,usuario_id) VALUES ('$reporte',NOW(),'$usuario_id')";
        return ejecutarConsulta($sql);
    }

    // Obtiene el total de miembros agrupados por estado
    public function miembrosPorEstado(){
        $sql="SELECT Mi_Estado, COUNT(*) AS total FROM tbl_miembros GROUP BY Mi_Estado";
        return ejecutarConsulta($sql);
    }
}

?>

