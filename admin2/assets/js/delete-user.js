function Mostrar(id, name){
    $(function() {
        console.log( "ready!" );
        $('#value-modal').text(name);
        $('#eliminar').val(id);
        $('#id-delete').val(id);
    });
}

function EliminarUsuario(btn){
    $.ajax({
        url: 'php/delete-user.php',
        type: 'POST',
        data: {
        	id: $('#id-delete').val(),
        },
        success: function(){
            document.location.href='table-user.php';
        }
    });
}