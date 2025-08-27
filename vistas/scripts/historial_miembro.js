var tabla;

function init(){
    var Mi_id = $("#Mi_id").val();
    tabla = $('#tbllistado').dataTable(
        {
            "aProcessing": true,
            "aServerSide": true,
            dom: 'Bfrtip',
            buttons: [],
            "ajax":
                    {
                        url: '../ajax/tbl_miembros.php?op=historial&Mi_id='+Mi_id,
                        type : "get",
                        dataType : "json",
                        error: function(e){
                            console.log(e.responseText);
                        }
                    },
            "bDestroy": true,
            "iDisplayLength": 5,
            "order": [[ 1, "desc" ]]
        }).DataTable();
}

init();

