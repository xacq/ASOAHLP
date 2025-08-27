<?php
// incluir la conexion a la bd
require "../config/Conexion.php";

Class Tbl_tiposhipoacusia{
    public function __construct(){

    }

    // insertar
    public function insertar($hipo_nombre,$hipo_Descripcion,$imagen){
        $sql = "INSERT INTO tbl_tiposhipoacusia (hipo_nombre,hipo_Descripcion,imagen) VALUES ('$hipo_nombre','$hipo_Descripcion','$imagen')";
        return ejecutarConsulta($sql);
    }

    // editar
    public function editar($hipo_id,$hipo_nombre,$hipo_Descripcion,$imagen){
        $sql = "UPDATE tbl_tiposhipoacusia SET hipo_nombre='$hipo_nombre', hipo_Descripcion='$hipo_Descripcion', imagen='$imagen' WHERE hipo_id='$hipo_id'";
        return ejecutarConsulta($sql);
    }

    // mostrar UN registro
    public function mostrar($hipo_id){
        $sql = "SELECT * FROM tbl_tiposhipoacusia WHERE hipo_id='$hipo_id'";
        return ejecutarConsultaSimpleFila($sql);
    }

    // listar TODOS los registros
    public function listar(){
        $sql = "SELECT * FROM tbl_tiposhipoacusia";
        return ejecutarConsulta($sql);
    }
}
?>
