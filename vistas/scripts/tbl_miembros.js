var tabla;

function init(){
    mostrarform(false);
    listar();

    // submit
    $("#formulario").on("submit", function(e){
        guardaryeditar(e);
    });

    $("#imagenmuestra").hide();

    $.post("../ajax/tbl_miembros.php?op=selectEstadoCivil", function(r){
        $("#estado_civil_id").html(r);
        $('#estado_civil_id').selectpicker('refresh');
    });

    $.post("../ajax/tbl_miembros.php?op=selectDepartamentos", function(r){
        $("#departamento_id").html(r);
        $('#departamento_id').selectpicker('refresh');
    });

    $("#departamento_id").on('change', function(){
        var id = $(this).val();
        $.post("../ajax/tbl_miembros.php?op=selectCiudades&departamento_id="+id, function(r){
            $("#ciudad_id").html(r);
            $('#ciudad_id').selectpicker('refresh');
        });
    });
}

function limpiar(){
    $("#Mi_id").val("");
    $("#Mi_Nombres").val("");
	$("#Mi_Apellido").val("");
    $("#Mi_FechaNacimiento").val("");
	$("#Mi_Celular").val("");
	$("#Mi_Email").val("");
    $("#Mi_Ocupacion").val("");
        $("#Mi_Direccion").val("");
        $("#Mi_tiempo").val("");
        $("#CI").val("");
        $("#departamento_id").val("");
        $('#departamento_id').selectpicker('refresh');
        $("#ciudad_id").val("");
        $('#ciudad_id').selectpicker('refresh');
        $("#estado_civil_id").val("");
        $('#estado_civil_id').selectpicker('refresh');
        $("#CarnetDiscapacidad").val("");
        $('#CarnetDiscapacidad').selectpicker('refresh');
        $("#imagenmuestra").attr("src","");
        $("#imagenactual").val("");
        $("#tipo_documento").val("");
        $("#documento").val("");
        $("#tblDocumentos tbody").html("");
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
                        url: '../ajax/tbl_miembros.php?op=listar',  // crear
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
        url: "../ajax/tbl_miembros.php?op=guardaryeditar",
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
                tabla.ajax.reload();
                listarDocumentos($("#Mi_id").val());
        }
    });
    limpiar();
}

function listarDocumentos(Mi_id){
    $.post("../ajax/tbl_miembros.php?op=listarDocumentos", {Mi_id : Mi_id}, function(r){
        $("#tblDocumentos tbody").html(r);
    });
}

function mostrar(Mi_id){
    $.post("../ajax/tbl_miembros.php?op=mostrar",{Mi_id : Mi_id}, function(data, status){
        data = JSON.parse(data);
        mostrarform(true);
        $("#Mi_id").val(data.Mi_id);
        $("#Mi_Nombres").val(data.Mi_Nombres);
		$("#Mi_Apellido").val(data.Mi_Apellido);
		$("#Mi_FechaNacimiento").val(data.Mi_FechaNacimiento);
		$("#Mi_FechaNacimiento").selectpicker('refresh');
		$("#Mi_Celular").val(data.Mi_Celular);
		$("#Mi_Email").val(data.Mi_Email);
                $("#departamento_id").val(data.departamento_id);
                $('#departamento_id').selectpicker('refresh');
                $.post("../ajax/tbl_miembros.php?op=selectCiudades&departamento_id="+data.departamento_id,function(r){
                        $("#ciudad_id").html(r);
                        $('#ciudad_id').val(data.ciudad_id);
                        $('#ciudad_id').selectpicker('refresh');
                });
                $("#Mi_Ocupacion").val(data.Mi_Ocupacion);
                $("#Mi_Direccion").val(data.Mi_Direccion);
                $("#Mi_tiempo").val(data.Mi_tiempo);
                $("#CI").val(data.CI);
                $("#estado_civil_id").val(data.estado_civil_id);
                $('#estado_civil_id').selectpicker('refresh');
                $("#CarnetDiscapacidad").val(data.CarnetDiscapacidad);
                $('#CarnetDiscapacidad').selectpicker('refresh');
                $("#imagenmuestra").show();
                $("#imagenmuestra").attr("src","../files/usuarios/"+data.imagen);
                $("#imagenactual").val(data.imagen);
                listarDocumentos(data.Mi_id);
    })
}

function desactivar(Mi_id){
    var opcion = confirm("¿Está Seguro de inactivar este usuario?");
    if(opcion) 		// entra solo si da ACEPTAR
    {
        $.post("../ajax/tbl_miembros.php?op=desactivar", {Mi_id : Mi_id}, function(e){
            alert(e);
            tabla.ajax.reload(null,false);
        });	
    }
}

function activar(Mi_id){
    var opcion = confirm("¿Está Seguro de activar este usuario?");
    if(opcion) 		// entra solo si da ACEPTAR
    {
        $.post("../ajax/tbl_miembros.php?op=activar", {Mi_id : Mi_id}, function(e){
            alert(e);
            tabla.ajax.reload(null,false);
        });	
    }
}

init();

