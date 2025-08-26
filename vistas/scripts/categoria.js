
var tabla;

function init(){
    mostrarform(false);
    listar();

    // submit
    $("#formulario").on("submit", function(e){
        guardaryeditar(e);
    });
    
}

function limpiar(){
    $("#idcategoria").val("");
    $("#nombre").val("");
    $("#descripcion").val("");
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
                        url: '../ajax/categoria.php?op=listar',  // crear
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
        url: "../ajax/categoria.php?op=guardaryeditar",
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

function mostrar(idcategoria){
    $.post("../ajax/categoria.php?op=mostrar",{idcategoria : idcategoria}, function(data, status){
        data = JSON.parse(data);
        mostrarform(true);
        $("#idcategoria").val(data.idcategoria);
        $("#nombre").val(data.nombre);
        $("#descripcion").val(data.descripcion);
    })
}

function desactivar(idcategoria){
    var opcion = confirm("¿Está Seguro de desactivar la Categoría?");
    if(opcion) 		// entra solo si da ACEPTAR
    {
        $.post("../ajax/categoria.php?op=desactivar", {idcategoria : idcategoria}, function(e){
            alert(e);
            tabla.ajax.reload();
        });	
    }
}


function activar(idcategoria){
    var opcion = confirm("¿Está Seguro de activar la Categoría?");
    if(opcion) 		// entra solo si da ACEPTAR
    {
        $.post("../ajax/categoria.php?op=activar", {idcategoria : idcategoria}, function(e){
            alert(e);
            tabla.ajax.reload();
        });	
    }
}

init();

