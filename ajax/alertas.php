<?php
require_once "../modelos/Alertas.php";

$alerta = new Alertas();

switch ($_GET["op"]) {
    case 'marcar':
        $id = intval($_GET['id']);
        $alerta->marcarLeida($id);
        header('Location: ../vistas/escritorio.php');
    break;
}

?>

