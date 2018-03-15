function mostrar(id){
    $(function() {
        $('#value-modal').text('¿Está seguro que deseas eliminar este registro?');
        $('#eliminar').val(id);
        $('#id_delete').val(id);
    });
}