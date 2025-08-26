
var tabla;

function init(){
    mostrarform(false);
    listar();

    // submit
    $("#formulario").on("submit", function(e){
        guardaryeditar(e);                          
    });
    
    	//Cargamos los items al select categoria
	$.post("../ajax/articulo.php?op=selectCategoria", function(r){
		$("#idcategoria").html(r);	
		$('#idcategoria').selectpicker('refresh');
	});

	$("#imagenmuestra").hide();

}

function limpiar(){
    $("#idarticulo").val("");
    $("#codigo").val("");
	$("#nombre").val("");
    $("#stock").val("");
	$("#descripcion").val("");
	$("#imagenmuestra").attr("src","");
	$("#imagenactual").val("");
	$("#imagen").val("");
	$("#print").hide();
	
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
                        url: '../ajax/articulo.php?op=listar',  // otra url
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
        url: "../ajax/articulo.php?op=guardaryeditar",
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

// editar
function mostrar(idarticulo){
    
    $.post("../ajax/articulo.php?op=mostrar",{idarticulo : idarticulo}, function(data, status)
	{   
       // console.log("mando");
		data = JSON.parse(data);		
		mostrarform(true);
		$("#idcategoria").val(data.idcategoria);
		$('#idcategoria').selectpicker('refresh'); // para refrescar el select
		$("#codigo").val(data.codigo);
		$("#nombre").val(data.nombre);
		$("#stock").val(data.stock);
		$("#descripcion").val(data.descripcion);
		$("#imagenmuestra").show();   			//   el img a lado del "cargar imagen "
		$("#imagenmuestra").attr("src","../files/articulos/"+data.imagen);   //  carga la imagen 
		$("#imagenactual").val(data.imagen);
 		$("#idarticulo").val(data.idarticulo);
 		generarbarcode();

 	})
}

function desactivar(idarticulo){
    var opcion = confirm("¿Está Seguro de desactivar la artículo?");
	//confirm("¿Está Seguro de desactivar el artículo?", function(result){
		if(opcion)
        {
        	$.post("../ajax/articulo.php?op=desactivar", {idarticulo : idarticulo}, function(e){
        		alert(e);
	            tabla.ajax.reload();
        	});	
        }
	//})
}


function activar(idarticulo){
    var opcion = confirm("¿Está Seguro de ACTIVAR la Artículo?");
	//confirm("¿Está Seguro de activar el Artículo?", function(result){
		if(opcion)
        {
        	$.post("../ajax/articulo.php?op=activar", {idarticulo : idarticulo}, function(e){
        		alert(e);
	            tabla.ajax.reload();
        	});	
        }
	//})
}



//función para generar el código de barras
function generarbarcode()
{
    nombre=$("#nombre").val();
    $("#nmcodigo").html("<p>"+nombre+"</p>");
	codigo=$("#codigo").val();
	JsBarcode("#barcode", codigo);
	$("#print").show();
}

//Función para imprimir el Código de barras
function imprimir()
{
	$("#print").printArea();
}


init();


