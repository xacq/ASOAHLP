<?php 
require_once "../modelos/Categoria.php";

$categoria = new Categoria();

// recibimos los valores desde un form con el metodo POST
// preguntamos si existe un envio en caso de existir se manda  limpiar cadena
$idcategoria = isset($_POST["idcategoria"])? limpiarCadena($_POST["idcategoria"]) : "";
$nombre =isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$descripcion =isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";

// desde un archivo js se hara una peticion a este archivo mandando una opcion
// preguntamos que opcion es la que nos pidieron
switch ($_GET["op"]){
	case 'guardaryeditar':
		// es el mismo case por que nos daremos cuenta con el idcategoria si llega vacio o con datos		
		if (empty($idcategoria)){
			$rspta = $categoria->insertar($nombre,$descripcion); //rsta viene del modelo 1:ok 0:algo va mal
			echo $rspta ? "Categoría registrada" : "Categoría no se pudo registrar";
		}
		else {
			$rspta = $categoria->editar($idcategoria,$nombre,$descripcion);
			echo $rspta ? "Categoría actualizada" : "Categoría no se pudo actualizar";
		}
	break;

        case 'desactivar':
                // cambiamos a Inactivo el estado con el metodo definido
                $rspta = $categoria->desactivar($idcategoria);
                echo $rspta ? "Categoría inactiva" : "Categoría no se puede inactivar";
        break;

        case 'activar':
                // cambiamos a Activo el estado con el metodo definido
                $rspta = $categoria->activar($idcategoria);
                echo $rspta ? "Categoría activa" : "Categoría no se puede activar";
        break;

	case 'mostrar':
		$rspta = $categoria->mostrar($idcategoria);
 		//Codificar el resultado utilizando json y lo imprimimos para que se retorne un json
 		echo json_encode($rspta);
	break;
		

	case 'listar':
		$rspta=$categoria->listar();
 		//Vamos a declarar un array
 		$data = Array();  //    []
		// recorremos la tabla de respuestas con un while y dentro una variable reg que toma 
		// el valor de cada una de las rows de rsta
 		while ($reg = $rspta->fetch_object()){
			 // guardamos en el array data los valores de reg
 			// $data[] = array(
			// 	"0"=>$reg->idcategoria,
			// 	"1"=>$reg->nombre,
			// 	"2"=>$reg->descripcion,
			// 	"3"=>$reg->condicion
			// 	);			
			
			$data[]=array(
				
 				"0"=>($reg->condicion)? '<button class="btn btn-warning" onclick="mostrar('.$reg->idcategoria.')">editar</button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idcategoria.')">Inactivar</button>' 
					 :
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idcategoria.')">editar</button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idcategoria.')">Activar</button>',

				// "0"=>'<button class="btn btn-warning" onclick="mostrar(' . $reg->idcategoria . ')">editar</button>'
				// .' <button class="btn btn-danger" onclick="desactivar('.$reg->idcategoria.')">descativar</button>'
				//,
				
				"1"=>$reg->nombre,
 				"2"=>$reg->descripcion,
 				"3"=>($reg->condicion)? '<span>Activo</span>' : '<span>Inactivo</span>'
				
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