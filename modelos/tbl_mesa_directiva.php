<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Tbl_mesa_directiva
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($Mi_id,$cargo,$MeDi_FechaInicioFunciones,$login,$clave,$imagen,$permisos)
	{
		//UPDATE `tbl_mesa_directiva` SET `Mi_id` = '10', `MeDi_FechaInicioFunciones` = '2022-06-01', 
		//`login` = 'nirvana', `clave` = 'nirvana01', `imagen` = 'fghj' WHERE `tbl_mesa_directiva`.`MeDi_id` = 2

		//  $permisos = { 1 , 2 }
		$sql="INSERT INTO tbl_mesa_directiva (Mi_id,cargo,MeDi_FechaInicioFunciones,login,clave,imagen,condicion)
		VALUES ('$Mi_id','$cargo','$MeDi_FechaInicioFunciones','$login','$clave','$imagen','1')";
		// return ejecutarConsulta($sql);
		$idusuarionew=ejecutarConsulta_retornarID($sql);

		$i=0;
		$sw=true;
		//  {50, -1}
		while ($i < count($permisos) and $sw != false)    // 2  <  2
		{
			$sql_detalle = "INSERT INTO usuario_permiso(MeDi_id, idpermiso) VALUES('$idusuarionew', '$permisos[$i]')";
			$sw = ejecutarConsulta($sql_detalle) or false;   //  true or false
			$i=$i + 1;
		}
		
		return $sw;
	}

	//Implementamos un método para editar registros
	public function editar($MeDi_id,$Mi_id,$cargo,$MeDi_FechaInicioFunciones,$login,$clave,$imagen,$permisos)
	{
		//  $permisos = { 4 }

		$sql="UPDATE tbl_mesa_directiva SET Mi_id='$Mi_id',cargo='$cargo',MeDi_FechaInicioFunciones='$MeDi_FechaInicioFunciones',login='$login',clave='$clave',imagen='$imagen' WHERE MeDi_id='$MeDi_id'";
		ejecutarConsulta($sql);

		//Eliminamos todos los permisos asignados para volverlos a registrar
		$sqldel="DELETE FROM usuario_permiso WHERE MeDi_id='$MeDi_id'";
		ejecutarConsulta($sqldel);
		
		$i=0;
		$sw=true;

		while ($i < count($permisos) and $sw != false)
		{
			$sql_detalle = "INSERT INTO usuario_permiso(MeDi_id, idpermiso) VALUES('$MeDi_id', '$permisos[$i]')";
			$sw = ejecutarConsulta($sql_detalle) or false;
			$i=$i + 1;
		}

		return $sw;
		
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($MeDi_id)
	{
		$sql="UPDATE tbl_mesa_directiva SET condicion='0' WHERE MeDi_id='$MeDi_id'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($MeDi_id)
	{
		$sql="UPDATE tbl_mesa_directiva SET condicion='1' WHERE MeDi_id='$MeDi_id'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($MeDi_id)
	{
		$sql="SELECT * FROM tbl_mesa_directiva WHERE MeDi_id='$MeDi_id'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT a.MeDi_id,a.Mi_id,c.Mi_Nombres as tbl_miembros, 
		a.cargo,a.MeDi_FechaInicioFunciones,a.login,a.clave,a.condicion 
		FROM tbl_mesa_directiva a INNER JOIN tbl_miembros c ON a.Mi_id=c.Mi_id;";
		//"SELECT * FROM tbl_mesa_directiva";
		return ejecutarConsulta($sql);		
	}
	//Implementar un método para listar los permisos marcados
	public function listarmarcados($MeDi_id)
	{
		$sql="SELECT * FROM usuario_permiso WHERE MeDi_id='$MeDi_id'";
		return ejecutarConsulta($sql);
	}

	//Función para verificar el acceso al sistema
	public function verificar($login,$clave)
    {
    	$sql="SELECT MeDi_id,Mi_id,cargo,MeDi_FechaInicioFunciones,imagen,login FROM tbl_mesa_directiva WHERE login='$login' AND clave='$clave' AND condicion='1'"; 
    	//Mi_id,cargo,MeDi_FechaInicioFunciones,login,clave,imagen,condicion
		return ejecutarConsulta($sql);  
    }
}

?>