
var tabla;

function init(){
    mostrarform(false);
    listar();

    // submit
    $("#formulario").on("submit", function(e){
        guardaryeditar(e);                          
    });
    
    	//Cargamos los items al select categoria
	$.post("../ajax/tbl_apoyo_miembros.php?op=selectCategoria", function(r){
		$("#Mi_id").html(r);	
		$('#Mi_id').selectpicker('refresh');
	});
}

function limpiar(){
    $("#ApoMi_id").val("");
    $("#TiApo").val("");
	$("#ApoMi_Cantidad").val("");
    $("#ApoMi_Observaciones").val("");
	$("#ApoMi_registro").val("");
}

function mostrarform(flag){
    limpiar();
    if(flag){
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled",false);
        $("#btnagregar").hide();
    }
    else{
        $("#imagenmuestra").hide();
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
        $("#btnagregar").show();
    }
}


function cancelarform(){
    limpiar();
    mostrarform(false);
}

function listar(){
    tabla = $('#tbllistado').dataTable(
        {
            "aProcessing": true,//Activamos el procesamiento del datatables
            "aServerSide": true,//Paginación y filtrado realizados por el servidor
            dom: 'Bfrtip',//Definimos los elementos del control de tabla
            buttons: [		          // botones para tener esas opciones
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'pdf'
                    ],
            "ajax":		// parametro ajax que hace referenncia al categoria de ajax
                    {
                        url: '../ajax/tbl_apoyo_miembros.php?op=listar',  // otra url
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

function buscarPorCI(){
    var ci = $("#ciBuscar").val();
    if(ci){
        tabla.ajax.url('../ajax/tbl_apoyo_miembros.php?op=buscarPorCI&CI='+ci).load();
    }else{
        tabla.ajax.url('../ajax/tbl_apoyo_miembros.php?op=listar').load();
    }
}


function guardaryeditar(e){
    e.preventDefault();  // no se realiza la accion por defecto
    $("#btnGuardar").prop("disabled",true);
    var formData = new FormData($("#formulario")[0]);
    $.ajax({
        url: "../ajax/tbl_apoyo_miembros.php?op=guardaryeditar",
        type: "POST",
        data: formData, // se mandan los datos del form
        contentType: false,
        processData: false,
        success: function(datos)  // si todo va bien con el ajax se ejecuta esto y recibe los datos en ¨datos¨
        {                    
                //bootbox.alert(datos);	          
                alert(datos);	          
                mostrarform(false);
                tabla.ajax.reload(null,false);
        }
    });
    limpiar();
}

// editar
function mostrar(ApoMi_id){
    
    $.post("../ajax/tbl_apoyo_miembros.php?op=mostrar",{ApoMi_id : ApoMi_id}, function(data, status)
	{   
       // console.log("mando");
		data = JSON.parse(data);		
		mostrarform(true);
		$("#Mi_id").val(data.Mi_id);
		$('#Mi_id').selectpicker('refresh'); // para refrescar el select
		$("#TiApo").val(data.TiApo);
        $('#TiApo').selectpicker('refresh');
		$("#ApoMi_Cantidad").val(data.ApoMi_Cantidad);
		$("#ApoMi_Observaciones").val(data.ApoMi_Observaciones);
		$("#ApoMi_registro").val(data.ApoMi_registro);
        $('#ApoMi_registro').selectpicker('refresh');
 		$("#ApoMi_id").val(data.ApoMi_id);
 	})
}

function desactivar(ApoMi_id){
    var opcion = confirm("¿Está seguro de INACTIVAR el usuario?");
	//confirm("¿Está Seguro de desactivar el usuario?", function(result){
		if(opcion)
        {
        	$.post("../ajax/tbl_apoyo_miembros.php?op=desactivar", {ApoMi_id : ApoMi_id}, function(e){
        		alert(e);
	            tabla.ajax.reload(null,false);
        	});	
        }
	//})
}


function activar(ApoMi_id){
    var opcion = confirm("¿Está seguro de ACTIVAR el usuario?");
	//confirm("¿Está Seguro de activar el usuario?", function(result){
		if(opcion)
        {
        	$.post("../ajax/tbl_apoyo_miembros.php?op=activar", {ApoMi_id : ApoMi_id}, function(e){
        		alert(e);
	            tabla.ajax.reload(null,false);
        	});	
        }
	//})
}

init();


