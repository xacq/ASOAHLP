<?php
require_once "../modelos/tbl_tiposhipoacusia.php";

$tbl_tiposhipoacusia = new Tbl_tiposhipoacusia();

$hipo_id = isset($_POST["hipo_id"])? limpiarCadena($_POST["hipo_id"]):"";
$hipo_nombre = isset($_POST["hipo_nombre"])? limpiarCadena($_POST["hipo_nombre"]):"";
$hipo_Descripcion = isset($_POST["hipo_Descripcion"])? limpiarCadena($_POST["hipo_Descripcion"]):"";
$imagen = isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";

switch ($_GET["op"]){
    case 'guardaryeditar':
        if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name']))
        {
            $imagen=$_POST["imagenactual"];
        }
        else
        {
            $ext = explode(".", $_FILES["imagen"]["name"]);
            if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png")
            {
                $imagen = round(microtime(true)) . '.' . end($ext);
                move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/tiposhipoacusia/" . $imagen);
            }
        }
        if (empty($hipo_id)){
            $rspta=$tbl_tiposhipoacusia->insertar($hipo_nombre,$hipo_Descripcion,$imagen);
            echo $rspta ? "Tipo de hipoacusia registrado" : "Tipo de hipoacusia no se pudo registrar";
        }
        else {
            $rspta=$tbl_tiposhipoacusia->editar($hipo_id,$hipo_nombre,$hipo_Descripcion,$imagen);
            echo $rspta ? "Tipo de hipoacusia actualizado" : "Tipo de hipoacusia no se pudo actualizar";
        }
    break;

    case 'mostrar':
        $rspta=$tbl_tiposhipoacusia->mostrar($hipo_id);
        echo json_encode($rspta);
    break;

    case 'listar':
        $rspta=$tbl_tiposhipoacusia->listar();
        $data=Array();
        while ($reg=$rspta->fetch_object()){
            $data[]=array(
                "0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->hipo_id.')"><i class="fa fa-edit" style="font-size:24px"></i></button>',
                "1"=>$reg->hipo_nombre,
                "2"=>$reg->hipo_Descripcion,
                "3"=>"<img src='../files/tiposhipoacusia/".$reg->imagen."' height='50px' width='50px' >"
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
