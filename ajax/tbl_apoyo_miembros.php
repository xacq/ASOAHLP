<?php 
require_once "../modelos/tbl_apoyo_miembros.php";

$tbl_apoyo_miembros=new Tbl_apoyo_miembros();

$ApoMi_id=isset($_POST["ApoMi_id"])? limpiarCadena($_POST["ApoMi_id"]):"";
$Mi_id=isset($_POST["Mi_id"])? limpiarCadena($_POST["Mi_id"]):"";
$TiApo=isset($_POST["TiApo"])? limpiarCadena($_POST["TiApo"]):"";
$ApoMi_Cantidad=isset($_POST["ApoMi_Cantidad"])? limpiarCadena($_POST["ApoMi_Cantidad"]):"";
$ApoMi_Observaciones=isset($_POST["ApoMi_Observaciones"])? limpiarCadena($_POST["ApoMi_Observaciones"]):"";
$ApoMi_registro=isset($_POST["ApoMi_registro"])? limpiarCadena($_POST["ApoMi_registro"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':

		if (empty($ApoMi_id)){
			$rspta=$tbl_apoyo_miembros->insertar($Mi_id,$TiApo,$ApoMi_Cantidad,$ApoMi_Observaciones,$ApoMi_registro);
			echo $rspta ? "Tipo de ayuda registrada" : "Tipo de ayuda no se pudo registrar";
		}
		else {
			$rspta=$tbl_apoyo_miembros->editar($ApoMi_id,$Mi_id,$TiApo,$ApoMi_Cantidad,$ApoMi_Observaciones,$ApoMi_registro);
			echo $rspta ? "Tipo de ayuda actualizada" : "Tipo de ayuda no se pudo actualizar";
		}
	break;

        case 'desactivar':
                $rspta=$tbl_apoyo_miembros->desactivar($ApoMi_id);
                echo $rspta ? "Tipo de ayuda inactiva" : "Tipo de ayuda no se puede inactivar";
                break;
        break;

        case 'activar':
                $rspta=$tbl_apoyo_miembros->activar($ApoMi_id);
                echo $rspta ? "Tipo de ayuda activa" : "Tipo de ayuda no se puede activar";
                break;
        break;

	case 'mostrar':
		$rspta=$tbl_apoyo_miembros->mostrar($ApoMi_id);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
	break;

        case 'listar':
                $rspta=$tbl_apoyo_miembros->listar();
                //Vamos a declarar un array
                $data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->ApoMi_id.')"> <i class="fa fa-edit" style="font-size:24px"></i> </button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->ApoMi_id.')"> <i class="fa fa-times-rectangle" style="font-size:24px"></i></button>'
					 :
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->ApoMi_id.')"> <i class="fa fa-edit" style="font-size:24px"></i> </button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->ApoMi_id.')"> <i class="fa fa-check-square-o" style="font-size:24px"></i> </button>',
 				"1"=>$reg->tbl_miembros,
 				"2"=>$reg->TiApo,
 				"3"=>$reg->ApoMi_Cantidad,
 				"4"=>$reg->ApoMi_Observaciones,
				"5"=>$reg->ApoMi_registro,
                                "6"=>($reg->condicion)?'<span>Activo</span>':'<span>Inactivo</span>'
                                );
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
                echo json_encode($results);

        break;

        case 'buscarPorCI':
                $CI=isset($_GET["CI"])? limpiarCadena($_GET["CI"]):"";
                $rspta=$tbl_apoyo_miembros->buscarPorCI($CI);
                $data= Array();

                while ($reg=$rspta->fetch_object()){
                        $data[]=array(
                                "0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->ApoMi_id.')"> <i class="fa fa-edit" style="font-size:24px"></i> </button>'.
                                        ' <button class="btn btn-danger" onclick="desactivar('.$reg->ApoMi_id.')"> <i class="fa fa-times-rectangle" style="font-size:24px"></i></button>'
                                         :
                                        '<button class="btn btn-warning" onclick="mostrar('.$reg->ApoMi_id.')"> <i class="fa fa-edit" style="font-size:24px"></i> </button>'.
                                        ' <button class="btn btn-primary" onclick="activar('.$reg->ApoMi_id.')"> <i class="fa fa-check-square-o" style="font-size:24px"></i> </button>',
                                "1"=>$reg->tbl_miembros,
                                "2"=>$reg->TiApo,
                                "3"=>$reg->ApoMi_Cantidad,
                                "4"=>$reg->ApoMi_Observaciones,
                                "5"=>$reg->ApoMi_registro,
                                "6"=>($reg->condicion)?'<span>Activo</span>':'<span>Inactivo</span>'
                                );
                }
                $results = array(
                        "sEcho"=>1,
                        "iTotalRecords"=>count($data),
                        "iTotalDisplayRecords"=>count($data),
                        "aaData"=>$data);
                echo json_encode($results);

        break;


        /// para seleccionar categoria en el select del form
        ///  Para crear el Select dinamico
        case "selectCategoria":
		//require_once "../modelos/Categoria.php";
		//$categoria = new Categoria();

		require_once "../modelos/tbl_miembros.php";
		$tbl_miembros = new Tbl_miembros();
		$rspta = $tbl_miembros->select();
		
		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->Mi_id . '>' . $reg->Mi_Nombres . '</option>';
				}
		
	break;
}
?>