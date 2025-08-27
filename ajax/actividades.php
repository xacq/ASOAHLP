<?php
require_once "../modelos/Actividades.php";

$actividades = new Actividades();

$Act_id=isset($_POST["Act_id"])? limpiarCadena($_POST["Act_id"]):"";
$Act_Nombre=isset($_POST["Act_Nombre"])? limpiarCadena($_POST["Act_Nombre"]):"";
$Act_descripcion=isset($_POST["Act_descripcion"])? limpiarCadena($_POST["Act_descripcion"]):"";
$Act_fecha=isset($_POST["Act_fecha"])? limpiarCadena($_POST["Act_fecha"]):"";
$Mi_Id=isset($_POST["Mi_Id"])? limpiarCadena($_POST["Mi_Id"]):"";

switch($_GET["op"]){
    case 'guardaryeditar':
        if(empty($Act_id)){
            $rspta=$actividades->insertar($Act_Nombre,$Act_descripcion,$Act_fecha,$Mi_Id);
            echo $rspta?"Actividad registrada":"Actividad no se pudo registrar";
        }else{
            // editar no implementado
        }
    break;

    case 'listar':
        $rspta=$actividades->listar();
        $data=Array();
        while($reg=$rspta->fetch_object()){
            $data[]=array(
                "0"=>$reg->Act_Nombre,
                "1"=>$reg->Act_descripcion,
                "2"=>$reg->Act_fecha
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
