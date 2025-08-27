<?php 
require_once "../modelos/Articulo.php";

$articulo=new Articulo();

$idarticulo=isset($_POST["idarticulo"])? limpiarCadena($_POST["idarticulo"]):"";
$idcategoria=isset($_POST["idcategoria"])? limpiarCadena($_POST["idcategoria"]):"";
$codigo=isset($_POST["codigo"])? limpiarCadena($_POST["codigo"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$stock=isset($_POST["stock"])? limpiarCadena($_POST["stock"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		
		// validacion de si existe una imagen y si se cargo algo en el campo imagen de tipo file 
		if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name']))
		{
			$imagen=$_POST["imagenactual"];   ///  para cuando sea editar no seleccionara ninguna imagen pero 
			// debe cargarse la imagen que estaba de muestra 
		}
		// en caso de que si exista nos aseguramos que sea una imagen
		else 
		{
			// obtenemos la extension   whatsapp1212.11.05.15.jpeg = [whatsapp1212 , 11 , 05 , 15 , jpeg]
			$ext = explode(".", $_FILES["imagen"]["name"]);   #    mantequilla.jpg   =   [mantequilla , jpg]
			// preguntamos que tipo de extencion tiene de otra forma 
			if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png")
			{
				// cambiamos el nombre de la imagen con la fecha y extension

				$imagen = round(microtime(true)) . '.' . end($ext);    #  65165156165.jpg
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/articulos/" . $imagen);
			}
		}

		if (empty($idarticulo)){
			$rspta=$articulo->insertar($idcategoria,$codigo,$nombre,$stock,$descripcion,$imagen);
			echo $rspta ? "Artículo registrado" : "Artículo no se pudo registrar";
		}
		else {
			$rspta=$articulo->editar($idarticulo,$idcategoria,$codigo,$nombre,$stock,$descripcion,$imagen);
			echo $rspta ? "Artículo actualizado" : "Artículo no se pudo actualizar";
		}
	break;

        case 'desactivar':
                $rspta=$articulo->desactivar($idarticulo);
                echo $rspta ? "Artículo inactivo" : "Artículo no se puede inactivar";
                break;
        break;

        case 'activar':
                $rspta=$articulo->activar($idarticulo);
                echo $rspta ? "Artículo activo" : "Artículo no se puede activar";
                break;
        break;

	case 'mostrar':
		$rspta=$articulo->mostrar($idarticulo);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
	break;

	case 'listar':
		$rspta=$articulo->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idarticulo.')">editar</button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idarticulo.')">Inactivar</button>'
					 :
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idarticulo.')">editar</button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idarticulo.')">Activar</button>',
 				"1"=>$reg->nombre,
 				"2"=>$reg->categoria,
 				"3"=>$reg->codigo,
 				"4"=>$reg->stock,
 				"5"=>"<img src='../files/articulos/".$reg->imagen."' height='50px' width='50px' >",
				//"5"=>$reg->imagen,
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


	/// para seleccionar categoria en el select del form
	///  Para crear el Select dinamico 
	case "selectCategoria":
		require_once "../modelos/Categoria.php";
		$categoria = new Categoria();

		$rspta = $categoria->select();
		
		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idcategoria . '>' . $reg->nombre . '</option>';
				}
		
	break;
}
?>