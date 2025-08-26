<?php 
require_once "../modelos/tbl_auspiciantes.php";

$tbl_auspiciantes = new Tbl_auspiciantes();

// recibimos los valores desde un form con el metodo POST
// preguntamos si existe un envio en caso de existir se manda  limpiar cadena
$aus_id = isset($_POST["aus_id"])? limpiarCadena($_POST["aus_id"]) : "";
$aus_Nombre =isset($_POST["aus_Nombre"])? limpiarCadena($_POST["aus_Nombre"]):"";
$aus_pais =isset($_POST["aus_pais"])? limpiarCadena($_POST["aus_pais"]):"";
$aus_departamento =isset($_POST["aus_departamento"])? limpiarCadena($_POST["aus_departamento"]):"";
$aus_ciudad =isset($_POST["aus_ciudad"])? limpiarCadena($_POST["aus_ciudad"]):"";
$Otro_dato = isset($_POST["Otro_dato"])? limpiarCadena($_POST["Otro_dato"]) : "";
$imagen = isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]) : "";

// desde un archivo js se hara una peticion a este archivo mandando una opcion
// preguntamos que opcion es la que nos pidieron
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
				$imagen = round(microtime(true)) . '.' . end($ext);    // 5516511651.png
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/auspiciantes/" . $imagen);
			}
		}
		// es el mismo case por que nos daremos cuenta con el idcategoria si llega vacio o con datos		
		if (empty($aus_id)){
			$rspta = $tbl_auspiciantes->insertar($aus_Nombre, $aus_pais, $aus_departamento, $aus_ciudad, $Otro_dato, $imagen); //rsta viene del modelo 1:ok 0:algo va mal
			echo $rspta ? "Auspiciante registrado" : "Auspiciante no se pudo registrar";
		}
		else {
			$rspta = $tbl_auspiciantes->editar($aus_id,$aus_Nombre, $aus_pais, $aus_departamento, $aus_ciudad, $Otro_dato, $imagen);
			echo $rspta ? "Auspiciante actualizado" : "Auspiciante no se pudo actualizar";
		}
	break;

	case 'desactivar':
		// cambiamos a 0 el estado con el metodo definido
		$rspta = $tbl_auspiciantes->desactivar($aus_id);
 		echo $rspta ? "Auspiciante Desactivado" : "Auspiciante no se puede desactivar";
	break;

	case 'activar':
		// cambiamos a 1 el estado con el metodo definido
		$rspta = $tbl_auspiciantes->activar($aus_id);
 		echo $rspta ? "Auspiciante activado" : "Auspiciante no se puede activar";
	break;

	case 'mostrar':
		$rspta = $tbl_auspiciantes->mostrar($aus_id);
 		//Codificar el resultado utilizando json y lo imprimimos para que se retorne un json
 		echo json_encode($rspta);
	break;
		

	case 'listar':
		$rspta=$tbl_auspiciantes->listar();
 		//Vamos a declarar un array
 		$data = Array();  //    []
		// recorremos la tabla de respuestas con un while y dentro una variable reg que toma 
		// el valor de cada una de las rows de rsta
 		while ($reg = $rspta->fetch_object()){
			 // guardamos en el array data los valores de reg		
			
			$data[]=array(
				
 				"0"=>($reg->condicion)? '<button class="btn btn-warning" onclick="mostrar('.$reg->aus_id.')"> <i class="fa fa-edit" style="font-size:24px"></i> </button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->aus_id.')"> <i class="fa fa-times-rectangle" style="font-size:24px"></i> </button>' 
					 :
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->aus_id.')"> <i class="fa fa-edit" style="font-size:24px"></i> </button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->aus_id.')"> <i class="fa fa-times-rectangle" style="font-size:24px"></i> </button>',

					"1"=>$reg->aus_Nombre,
					"2"=>$reg->aus_pais,
					"3"=>$reg->aus_departamento,
					"4"=>$reg->aus_ciudad,
					"5"=>$reg->Otro_dato,
					"6"=>"<img src='../files/auspiciantes/".$reg->imagen."' height='50px' width='50px' >",
					"7"=>($reg->condicion)? '<span>activado</span>' : '<span>desactivado</span>'
 			);
		
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
}
?>