
var tabla;

function init(){
    mostrarform(false);
    listar();

    // submit
    $("#formulario").on("submit", function(e){
        guardaryeditar(e);
    });

    $("#imagenmuestra").hide();

}

function limpiar(){
    $("#aus_id").val("");
    $("#aus_Nombre").val("");
    $("#aus_pais").val("");
    $("#aus_ciudad").val("");
    $("#Otro_dato").val("");
    $("#imagenmuestra").attr("src","");
	$("#imagenactual").val("");
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
                        url: '../ajax/tbl_auspiciantes.php?op=listar',  // crear
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



function guardaryeditar(e){
    e.preventDefault();  // no se realiza la accion por defecto
    $("#btnGuardar").prop("disabled",true);
    var formData = new FormData($("#formulario")[0]);
    $.ajax({
        url: "../ajax/tbl_auspiciantes.php?op=guardaryeditar",
        type: "POST",
        data: formData, // se mandan los datos del form
        contentType: false,
        processData: false,
        success: function(datos)  // si todo va bien con el ajax se ejecuta esto y recibe los datos en ¨datos¨
        {                    
                //bootbox.alert(datos);	          
                alert(datos);	          
                mostrarform(false);
                tabla.ajax.reload();
        }
    });
    limpiar();
}

function mostrar(aus_id){
    $.post("../ajax/tbl_auspiciantes.php?op=mostrar",{aus_id : aus_id}, function(data, status){
        data = JSON.parse(data);
        mostrarform(true);
        $("#aus_id").val(data.aus_id);
        $("#aus_Nombre").val(data.aus_Nombre);
        $("#aus_pais").val(data.aus_pais);
        $("#aus_departamento").val(data.aus_departamento);
		$("#aus_departamento").selectpicker('refresh');
        $("#aus_ciudad").val(data.aus_pais);
        $("#Otro_dato").val(data.Otro_dato);
        $("#imagenmuestra").attr("src","../files/auspiciantes/"+data.imagen);
		$("#imagenactual").val(data.imagen);
    })
}

function desactivar(aus_id){
    var opcion = confirm("¿Está Seguro de desactivar este auspiciantes?");
    if(opcion) 		// entra solo si da ACEPTAR
    {
        $.post("../ajax/tbl_auspiciantes.php?op=desactivar", {aus_id : aus_id}, function(e){
            alert(e);
            tabla.ajax.reload();
        });	
    }
}


function activar(aus_id){
    var opcion = confirm("¿Está Seguro de activar este auspiciantes?");
    if(opcion) 		// entra solo si da ACEPTAR
    {
        $.post("../ajax/tbl_auspiciantes.php?op=activar", {aus_id : aus_id}, function(e){
            alert(e);
            tabla.ajax.reload();
        });	
    }
}

init();

