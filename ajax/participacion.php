<?php
require_once "../modelos/Participacion.php";

$participacion = new Participacion();

switch($_GET["op"]){
    case 'listar':
        $rspta=$participacion->listar();
        $data=Array();
        while($reg=$rspta->fetch_object()){
            $data[]=array(
                "0"=>$reg->Act_Nombre,
                "1"=>$reg->Mi_Nombres,
                "2"=>$reg->ParMi_tipo,
                "3"=>$reg->ParMi_observaciones,
                "4"=>$reg->ParMi_Registro
            );
        }
        $results=array(
            "sEcho"=>1,
            "iTotalRecords"=>count($data),
            "iTotalDisplayRecords"=>count($data),
            "aaData"=>$data);
        echo json_encode($results);
    break;
}
?>
