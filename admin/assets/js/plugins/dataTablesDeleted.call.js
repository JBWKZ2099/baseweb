var rowsArray = $('#table_gen tbody').attr("data-rows").split(',');
var final = [];
$.each(rowsArray, function(i, val){ final.push({data:val, name:val}); });
final.push({ data:'actions',name:'actions',orderable:false,searchable:false});
var active = $('#table_gen tbody').attr("data-active");
var ajaxDirection = direction+'/admin/'+active+'/datadeleted';
$('#table_gen').DataTable({
  processing: true,
  serverSide: true,
  ajax: ajaxDirection,
  columns: final,
  language: { "url": "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"}
});
