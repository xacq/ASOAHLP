<?php
require_once "../modelos/tbl_miembros.php";
require_once "../modelos/tbl_historial_miembro.php";

$tbl_miembros = new Tbl_miembros();
$tbl_historial = new Tbl_historial_miembro();

// recibimos los valores desde un form con el metodo POST
// preguntamos si existe un envio en caso de existir se manda  limpiar cadena
$Mi_id = isset($_POST["Mi_id"])? limpiarCadena($_POST["Mi_id"]) : (isset($_GET["Mi_id"]) ? limpiarCadena($_GET["Mi_id"]) : "");
$Mi_Nombres =isset($_POST["Mi_Nombres"])? limpiarCadena($_POST["Mi_Nombres"]):"";
$Mi_Apellido =isset($_POST["Mi_Apellido"])? limpiarCadena($_POST["Mi_Apellido"]):"";
$Mi_FechaNacimiento =isset($_POST["Mi_FechaNacimiento"])? limpiarCadena($_POST["Mi_FechaNacimiento"]):"";
$Mi_Celular =isset($_POST["Mi_Celular"])? limpiarCadena($_POST["Mi_Celular"]):"";
$Mi_Email =isset($_POST["Mi_Email"])? limpiarCadena($_POST["Mi_Email"]):"";
$departamento_id =isset($_POST["departamento_id"])? limpiarCadena($_POST["departamento_id"]):"";
$ciudad_id =isset($_POST["ciudad_id"])? limpiarCadena($_POST["ciudad_id"]):"";
$Mi_Ocupacion =isset($_POST["Mi_Ocupacion"])? limpiarCadena($_POST["Mi_Ocupacion"]):"";
$Mi_Direccion =isset($_POST["Mi_Direccion"])? limpiarCadena($_POST["Mi_Direccion"]):"";
$Mi_tiempo = isset($_POST["Mi_tiempo"])? limpiarCadena($_POST["Mi_tiempo"]) : "";
$CI = isset($_POST["CI"])? limpiarCadena($_POST["CI"]) : "";
$estado_civil_id = isset($_POST["estado_civil_id"])? limpiarCadena($_POST["estado_civil_id"]) : "";
$CarnetDiscapacidad = isset($_POST["CarnetDiscapacidad"])? limpiarCadena($_POST["CarnetDiscapacidad"]) : "";
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
                                move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/usuarios/" . $imagen);
                        }
                }
                // es el mismo case por que nos daremos cuenta con el idcategoria si llega vacio o con datos
                if (empty($Mi_id)){
                        $rspta = $tbl_miembros->insertar($Mi_Nombres,$Mi_Apellido,$Mi_FechaNacimiento,$Mi_Celular,$Mi_Email,$ciudad_id,$Mi_Ocupacion,$Mi_Direccion,$Mi_tiempo,$CI,$estado_civil_id,$CarnetDiscapacidad,$imagen); //rsta viene del modelo 1:ok 0:algo va mal
                        if($rspta){
                                $tbl_historial->registrar($rspta,'Alta de miembro');
                        }
                        echo $rspta ? "Tbl_miembros registrado" : "Tbl_miembros no se pudo registrar";
                }
                else {
                        $rspta = $tbl_miembros->editar($Mi_id,$Mi_Nombres,$Mi_Apellido,$Mi_FechaNacimiento,$Mi_Celular,$Mi_Email,$ciudad_id,$Mi_Ocupacion,$Mi_Direccion,$Mi_tiempo,$CI,$estado_civil_id,$CarnetDiscapacidad,$imagen);
                        if($rspta){
                                $tbl_historial->registrar($Mi_id,'Actualización de datos');
                        }
                        echo $rspta ? "Tbl_miembros actualizada" : "Tbl_miembros no se pudo actualizar";
                }
        break;

        case 'desactivar':
                // cambiamos a Inactivo el estado con el metodo definido
                $rspta = $tbl_miembros->desactivar($Mi_id);
                if($rspta){
                        $tbl_historial->registrar($Mi_id,'Baja de miembro');
                }
                echo $rspta ? "Miembro inactivo" : "Miembro no se puede inactivar";
        break;

        case 'activar':
                // cambiamos a Activo el estado con el metodo definido
                $rspta = $tbl_miembros->activar($Mi_id);
                if($rspta){
                        $tbl_historial->registrar($Mi_id,'Reactivación de miembro');
                }
                echo $rspta ? "Miembro activo" : "Miembro no se puede activar";
        break;

        case 'mostrar':
                $rspta = $tbl_miembros->mostrar($Mi_id);
                //Codificar el resultado utilizando json y lo imprimimos para que se retorne un json
                echo json_encode($rspta);
        break;


        case 'listar':
                $rspta=$tbl_miembros->listar();
                //Vamos a declarar un array
                $data = Array();  //    []
                // recorremos la tabla de respuestas con un while y dentro una variable reg que toma
                // el valor de cada una de las rows de rsta
                while ($reg = $rspta->fetch_object()){
                         // guardamos en el array data los valores de reg
                        $data[]=array(

                                "0"=>($reg->Mi_Estado=='Activo')? '<button class="btn btn-warning" onclick="mostrar('.$reg->Mi_id.')"><i class="fa fa-edit" style="font-size:24px"></i></button>'.
                                        ' <button class="btn btn-danger" onclick="desactivar('.$reg->Mi_id.')"> <i class="fa fa-times-rectangle" style="font-size:24px"></i></button>'.
                                        ' <a class="btn btn-info" href="historial_miembro.php?Mi_id='.$reg->Mi_id.'"><i class="fa fa-clock-o" style="font-size:24px"></i></a>'
                                         :
                                        '<button class="btn btn-warning" onclick="mostrar('.$reg->Mi_id.')"><i class="fa fa-edit" style="font-size:24px"></i></button>'.
                                        ' <button class="btn btn-primary" onclick="activar('.$reg->Mi_id.')"> <i class="fa fa-check-square-o" style="font-size:24px"></i></button>'.
                                        ' <a class="btn btn-info" href="historial_miembro.php?Mi_id='.$reg->Mi_id.'"><i class="fa fa-clock-o" style="font-size:24px"></i></a>',

                                "1"=>$reg->Mi_Nombres,
                                "2"=>$reg->Mi_Apellido,
                                "3"=>$reg->Mi_FechaNacimiento,
                                "4"=>$reg->Mi_Celular,
                                "5"=>$reg->Mi_Email,
                                "6"=>$reg->Ciudad,
                                "7"=>$reg->Mi_Ocupacion,
                                "8"=>$reg->Mi_Direccion,
                                "9"=>$reg->Mi_tiempo,
                                "10"=>$reg->CI,
                                "11"=>$reg->EstadoCivil,
                                "12"=>$reg->CarnetDiscapacidad,
                                "13"=>"<img src='../files/usuarios/".$reg->imagen."' height='50px' width='50px' >",
                                "14"=>($reg->Mi_Estado=='Activo')? '<span>Activo</span>' : '<span>Inactivo</span>'
                        );
                }
                $results = array(
                        "sEcho"=>1, //Información para el datatables
                        "iTotalRecords"=>count($data), //enviamos el total registros al datatable
                        "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
                        "aaData"=>$data);
                echo json_encode($results);

        break;

        case 'historial':
                $rspta=$tbl_historial->listar($Mi_id);
                $data = Array();
                while ($reg = $rspta->fetch_object()){
                        $data[]=array(
                                "0"=>$reg->descripcion,
                                "1"=>$reg->fecha_registro
                        );
                }
                $results = array(
                        "sEcho"=>1,
                        "iTotalRecords"=>count($data),
                        "iTotalDisplayRecords"=>count($data),
                        "aaData"=>$data);
                echo json_encode($results);

        break;

        case 'selectEstadoCivil':
                $rspta=$tbl_miembros->selectEstadoCivil();
                while ($reg = $rspta->fetch_object())
                                {
                                        echo '<option value=' . $reg->id . '>' . $reg->nombre . '</option>';
                                }
        break;

        case 'selectDepartamentos':
                $rspta=$tbl_miembros->selectDepartamentos();
                while ($reg = $rspta->fetch_object())
                                {
                                        echo '<option value=' . $reg->id . '>' . $reg->nombre . '</option>';
                                }
        break;

        case 'selectCiudades':
                $departamento_id = $_GET["departamento_id"];
                $rspta=$tbl_miembros->selectCiudades($departamento_id);
                while ($reg = $rspta->fetch_object())
                                {
                                        echo '<option value=' . $reg->id . '>' . $reg->nombre . '</option>';
                                }
        break;
}
?>
