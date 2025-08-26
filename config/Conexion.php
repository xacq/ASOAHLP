<?php

require_once 'global.php';

$conexion = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);

mysqli_query( $conexion, 'SET NAMES "' . DB_ENCODE . '"  ');

if(mysqli_connect_error()){
    printf("Fallo al conectar a la BD ",mysqli_connect_error());
    exit();
}

if(!function_exists('ejecutarConsulta')){
//    select * from persona          
    function ejecutarConsulta($sql){
        global $conexion;
        $query = $conexion->query($sql);
        return $query;
    }
//    select * from persona where id_persona = 2
    function ejecutarConsultaSimpleFila($sql){
        global $conexion;
        $query = $conexion->query($sql);
        $row = $query->fetch_assoc();
        return $row;
    }
//  insert into persona values (40, 'ppepe', '515415615')
    function ejecutarConsulta_retornarID($sql){
        global $conexion;
        $query = $conexion->query($sql);
        return $conexion->insert_id;
    }
    function limpiarCadena($sql){
        global $conexion;
        $str = mysqli_real_escape_string($conexion,trim($sql));
        return htmlspecialchars($str);
    }
}


?>