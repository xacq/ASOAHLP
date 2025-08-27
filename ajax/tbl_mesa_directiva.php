<?php 
require_once "../modelos/tbl_mesa_directiva.php";

$tbl_mesa_directiva=new Tbl_mesa_directiva();

$MeDi_id=isset($_POST["MeDi_id"])? limpiarCadena($_POST["MeDi_id"]):"";
$Mi_id=isset($_POST["Mi_id"])? limpiarCadena($_POST["Mi_id"]):"";
$cargo=isset($_POST["cargo"])? limpiarCadena($_POST["cargo"]):"";
$MeDi_FechaInicioFunciones=isset($_POST["MeDi_FechaInicioFunciones"])? limpiarCadena($_POST["MeDi_FechaInicioFunciones"]):"";
$login=isset($_POST["login"])? limpiarCadena($_POST["login"]):"";
$clave=isset($_POST["clave"])? limpiarCadena($_POST["clave"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";

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
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/usuarios/" . $imagen);
			}
		}
		//Hash SHA256 en la contraseña
		$clavehash=hash("SHA256",$clave);

		//7c9e7c1494b2684ab7c19d6aff737e460fa9e98d5a234da1310c97ddf5691834
		//7c9e7c1494b2684ab7c19d6aff737e460fa9e98d5a234da1310c97ddf5691834

		if (empty($MeDi_id)){
			$rspta=$tbl_mesa_directiva->insertar($Mi_id,$cargo,$MeDi_FechaInicioFunciones,$login,$clavehash,$imagen,$_POST['permiso']);
			echo $rspta ? "Usuario registrado" : "No se pudieron registrar todos los datos del usuario";
		}
		else {
			$rspta=$tbl_mesa_directiva->editar($MeDi_id,$Mi_id,$MeDi_FechaInicioFunciones,$cargo,$login,$clavehash,$imagen,$_POST['permiso']);
			echo $rspta ? "Usuario actualizado" : "Usuario no se pudo actualizar";
		}
	break;

        case 'desactivar':
                $rspta=$tbl_mesa_directiva->desactivar($MeDi_id);
                echo $rspta ? "Usuario inactivo" : "Usuario no se puede inactivar";
        break;

        case 'activar':
                $rspta=$tbl_mesa_directiva->activar($MeDi_id);
                echo $rspta ? "Usuario activo" : "Usuario no se puede activar";
        break;

	//editar
	case 'mostrar':
		$rspta=$tbl_mesa_directiva->mostrar($MeDi_id);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$tbl_mesa_directiva->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->MeDi_id.')">editar</button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->MeDi_id.')">Inactivar</button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->MeDi_id.')">editar</button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->MeDi_id.')">Activar</button>',
 				"1"=>$reg->tbl_miembros,
 				"2"=>$reg->cargo,
 				"3"=>$reg->MeDi_FechaInicioFunciones,
 				"4"=>$reg->login,
 				"5"=>"<img src='../files/usuarios/".$reg->imagen."' height='50px' width='50px' >",
				//"7"=>$reg->imagen,
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

	case 'permisos':
		//Obtenemos todos los permisos de la tabla permisos
		require_once "../modelos/Permiso.php";
		$permiso = new Permiso();
		$rspta = $permiso->listar();

		//Obtener los permisos asignados al usuario
		$id=$_GET['id'];
		$marcados = $tbl_mesa_directiva->listarmarcados($id);
		
		//Declaramos el array para almacenar todos los permisos marcados
		$valores=array();

		//Almacenar los permisos asignados al usuario en el array

		// marcados = {(1)(2)(3)(5)}  -   marcados = {}

		while ($per = $marcados->fetch_object())
		{
		array_push($valores, $per->idpermiso);
		}
		// valores = [1 2 3 5]   -  valores = []

		//Mostramos la lista de permisos en la vista y si están o no marcados
		// reg = { 1 2 3 4 5}
		while ($reg = $rspta->fetch_object())
		{
			$sw = in_array($reg->idpermiso, $valores)? 'checked':'';			
			echo '<li> <input type="checkbox" '.$sw.'  name="permiso[]" value="'.$reg->idpermiso.'">'.$reg->Mi_id.'</li>';
			//echo '<li> <input type="checkbox"  name="permiso[]" value="'.$reg->idpermiso.'">'.$reg->nombre.'</li>';
		}
				
	break;

	case 'verificar':
		$logina=$_POST['logina'];
	    $clavea=$_POST['clavea'];

	    //Hash SHA256 en la contraseña
		$clavehash=hash("SHA256",$clavea);

		$rspta=$tbl_mesa_directiva->verificar($logina, $clavehash);

		$fetch=$rspta->fetch_object();
		

		if (isset($fetch))
	    {
			// si se pudo logear bien
	        //Declaramos las variables de sesión
	        $_SESSION['MeDi_id']=$fetch->MeDi_id;
	        $_SESSION['Mi_id']=$fetch->Mi_id;
	        $_SESSION['imagen']=$fetch->imagen;
	        $_SESSION['login']=$fetch->login;

	        //Obtenemos los permisos del usuario
	    	$marcados = $tbl_mesa_directiva->listarmarcados($fetch->MeDi_id);
			
	    	//Declaramos el array para almacenar todos los permisos marcados
			$valores=array();

			//Almacenamos los permisos marcados en el array
			while ($per = $marcados->fetch_object())
				{
					array_push($valores, $per->idpermiso);
				}
				//   [1   2  3   5]
			//Determinamos los accesos de la tbl_mesa_directiva
			in_array(1,$valores)? $_SESSION['escritorio']=1 : $_SESSION['escritorio']=0;
			in_array(2,$valores)? $_SESSION['administracion']=1 : $_SESSION['administracion']=0;
			in_array(3,$valores)? $_SESSION['eventos']=1 : $_SESSION['eventos']=0;
			in_array(4,$valores)? $_SESSION['parametricos']=1 : $_SESSION['parametricos']=0;
			in_array(5,$valores)? $_SESSION['accesos']=1 : $_SESSION['accesos']=0;
			//in_array(6,$valores)?$_SESSION['consultac']=1:$_SESSION['consultac']=0;
			//in_array(7,$valores)?$_SESSION['consultav']=1:$_SESSION['consultav']=0;

	    }
	    echo json_encode($fetch);
	break;

	case 'salir':
		//Limpiamos las variables de sesión   
        session_unset();
        //Destruìmos la sesión
        session_destroy();
        //Redireccionamos al login
        header("Location: ../index.php");

	break;

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
