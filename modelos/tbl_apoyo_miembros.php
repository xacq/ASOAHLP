<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Tbl_apoyo_miembros
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($Mi_id,$TiApo,$ApoMi_Cantidad,$ApoMi_Observaciones,$ApoMi_registro)  
	{
		$sql="INSERT INTO tbl_apoyo_miembros (Mi_id,TiApo,ApoMi_Cantidad,ApoMi_Observaciones,ApoMi_registro,condicion)
		VALUES ('$Mi_id','$TiApo','$ApoMi_Cantidad','$ApoMi_Observaciones','$ApoMi_registro','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($ApoMi_id,$Mi_id,$TiApo,$ApoMi_Cantidad,$ApoMi_Observaciones,$ApoMi_registro)
	{
		$sql="UPDATE tbl_apoyo_miembros SET Mi_id='$Mi_id',TiApo='$TiApo',ApoMi_Cantidad='$ApoMi_Cantidad',ApoMi_Observaciones='$ApoMi_Observaciones',ApoMi_registro='$ApoMi_registro' 
		WHERE ApoMi_id='$ApoMi_id'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar registros
	public function desactivar($ApoMi_id)
	{
		$sql="UPDATE tbl_apoyo_miembros SET condicion='0' WHERE ApoMi_id='$ApoMi_id'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar($ApoMi_id)
	{
		$sql="UPDATE tbl_apoyo_miembros SET condicion='1' WHERE ApoMi_id='$ApoMi_id'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($ApoMi_id)
	{
		$sql="SELECT * FROM tbl_apoyo_miembros WHERE ApoMi_id='$ApoMi_id'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
        public function listar()
        {
                $sql="SELECT a.ApoMi_id,a.Mi_id,c.Mi_Nombres as tbl_miembros,
                        a.TiApo,a.ApoMi_Cantidad,a.ApoMi_Observaciones,a.ApoMi_registro,a.condicion
                        FROM tbl_apoyo_miembros a INNER JOIN tbl_miembros c
                        ON a.Mi_id=c.Mi_id";
                return ejecutarConsulta($sql);
        }

        //Obtener donaciones filtradas por CI del miembro
        public function buscarPorCI($CI)
        {
                $sql="SELECT a.ApoMi_id,a.Mi_id,c.Mi_Nombres as tbl_miembros,
                        a.TiApo,a.ApoMi_Cantidad,a.ApoMi_Observaciones,a.ApoMi_registro,a.condicion
                        FROM tbl_apoyo_miembros a INNER JOIN tbl_miembros c
                        ON a.Mi_id=c.Mi_id WHERE c.CI='$CI'";
                return ejecutarConsulta($sql);
        }
}

?>