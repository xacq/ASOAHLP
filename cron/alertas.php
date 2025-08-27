<?php
require_once "../modelos/Alertas.php";
require_once "../config/Conexion.php";

$alerta = new Alertas();

$hoy = date('Y-m-d');
$limite = date('Y-m-d', strtotime('+7 days'));

// Cuotas pendientes próximas
$sql = "SELECT MeDi_id, DATE(Cuo_fechaPago) AS fecha FROM tbl_cuotas WHERE Cuo_Pagado = 0 AND DATE(Cuo_fechaPago) BETWEEN '$hoy' AND '$limite'";
$cuotas = ejecutarConsulta($sql);
while ($c = $cuotas->fetch_assoc()) {
    $existe = $alerta->existe('cuota', $c['MeDi_id'], $c['fecha']);
    if ($existe->num_rows == 0) {
        $alerta->insertar('cuota', $c['MeDi_id'], $c['fecha']);
    }
}

// Actividades próximas
$sql = "SELECT MeDi_id, DATE(Act_fecha) AS fecha FROM tbl_actividades WHERE DATE(Act_fecha) BETWEEN '$hoy' AND '$limite'";
$actividades = ejecutarConsulta($sql);
while ($a = $actividades->fetch_assoc()) {
    $existe = $alerta->existe('actividad', $a['MeDi_id'], $a['fecha']);
    if ($existe->num_rows == 0) {
        $alerta->insertar('actividad', $a['MeDi_id'], $a['fecha']);
    }
}

?>

