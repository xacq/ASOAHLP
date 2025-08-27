var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})

	$("#imagenmuestra").hide();
	//Cargamos los items al select categoria
	$.post("../ajax/tbl_mesa_directiva.php?op=selectCategoria", function(r){
		$("#Mi_id").html(r);	
		$('#Mi_id').selectpicker('refresh');
	});

	//Mostramos los permisos      //   mostrar todos los permisos
	$.post("../ajax/tbl_mesa_directiva.php?op=permisos&id=",function(r){
	//$.post("../ajax/tbl_mesa_directiva.php?op=permisos",function(r){
	        $("#permisos").html(r);
	});
}

//Función limpiar
function limpiar()
{
	$("#MeDi_id").val("");
	$("#cargo").val("");
	$("#MeDi_FechaInicioFunciones").val("");
	$("#login").val("");
	$("#clave").val("");
	$("#imagenmuestra").attr("src","");
	$("#imagenactual").val("");
	//$("#MeDi_id").val("");
}

//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}

//Función cancelarform
function cancelarform()
{
	limpiar();
	mostrarform(false);
}

//Función Listar
function listar()
{
	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/tbl_mesa_directiva.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}
//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/tbl_mesa_directiva.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          alert(datos);	          
	          mostrarform(false);
	          tabla.ajax.reload(null,false);
	    }

	});
	limpiar();
}

// editar
function mostrar(MeDi_id)
{
	$.post("../ajax/tbl_mesa_directiva.php?op=mostrar",{MeDi_id : MeDi_id}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#Mi_id").val(data.Mi_id);
		$('#Mi_id').selectpicker('refresh'); // para refrescar el select
		$("#cargo").val(data.cargo);
		$("#cargo").selectpicker('refresh');
		$("#MeDi_FechaInicioFunciones").val(data.MeDi_FechaInicioFunciones);
		$("#MeDi_FechaInicioFunciones").selectpicker('refresh');
		$("#login").val(data.login);
		$("#clave").val(data.clave);
		$("#imagenmuestra").show();
		$("#imagenmuestra").attr("src","../files/usuarios/"+data.imagen);
		$("#imagenactual").val(data.imagen);
		$("#MeDi_id").val(data.MeDi_id);

 	});
	 // ../ajax/tbl_mesa_directiva.php?op=permisos&id=1
 	$.post("../ajax/tbl_mesa_directiva.php?op=permisos&id="+MeDi_id,function(r){
	        $("#permisos").html(r);
	});
}

//Función para desactivar registros
function desactivar(MeDi_id)
{
    var opcion = confirm("¿Está Seguro de inactivar el Usuario?");
//	confirm("¿Está Seguro de desactivar el usuario?", function(result){
		if(opcion)
        {
        	$.post("../ajax/tbl_mesa_directiva.php?op=desactivar", {MeDi_id : MeDi_id}, function(e){
        		alert(e);
	            tabla.ajax.reload(null,false);
        	});	
        }
//	})
}

//Función para activar registros
function activar(MeDi_id)
{
	var opcion = confirm("¿Está Seguro de activar el Usuario?");
	//confirm("¿Está Seguro de activar el Usuario?", function(result){
		if(opcion)
        {
        	$.post("../ajax/tbl_mesa_directiva.php?op=activar", {MeDi_id : MeDi_id}, function(e){
        		alert(e);
	            tabla.ajax.reload(null,false);
        	});	
        }
	//})
}

init();