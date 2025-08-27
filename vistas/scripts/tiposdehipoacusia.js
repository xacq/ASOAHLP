var tabla;

function init(){
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function(e){
        guardaryeditar(e);
    });

    $("#imagenmuestra").hide();
}

function limpiar(){
    $("#hipo_id").val("");
    $("#hipo_nombre").val("");
    $("#hipo_Descripcion").val("");
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
    tabla = $('#tbllistado').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdf'
        ],
        "ajax": {
            url: '../ajax/tbl_tiposhipoacusia.php?op=listar',
            type : "get",
            dataType : "json",
            error: function(e){
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 5,
        "order": [[ 0, "desc" ]]
    }).DataTable();
}

function guardaryeditar(e){
    e.preventDefault();
    $("#btnGuardar").prop("disabled",true);
    var formData = new FormData($("#formulario")[0]);
    $.ajax({
        url: "../ajax/tbl_tiposhipoacusia.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos)
        {
            alert(datos);
            mostrarform(false);
            tabla.ajax.reload();
        }
    });
    limpiar();
}

function mostrar(hipo_id){
    $.post("../ajax/tbl_tiposhipoacusia.php?op=mostrar",{hipo_id : hipo_id}, function(data, status){
        data = JSON.parse(data);
        mostrarform(true);
        $("#hipo_id").val(data.hipo_id);
        $("#hipo_nombre").val(data.hipo_nombre);
        $("#hipo_Descripcion").val(data.hipo_Descripcion);
        $("#imagenmuestra").show();
        $("#imagenmuestra").attr("src","../files/tiposhipoacusia/"+data.imagen);
        $("#imagenactual").val(data.imagen);
    })
}

init();
