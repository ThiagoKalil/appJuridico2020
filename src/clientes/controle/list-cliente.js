$(document).ready(function(){

    $('#table-cliente').DataTable({
        "processing": true,
        "serverSide": true,
        "pageLength": 5,
        "lengthMenu": [5, 10, 25, 50],
        "language":{
            "url": "recursos/DataTable/dataTables.brazil.json"
        },
        "ajax": {
            "url": "src/clientes/modelo/list-cliente.php",
            "type": "POST"
        },
        "columns": [
           { "data": "idcliente" },
           { "data": "nome" },
           { "data": "email" },
           { 
               "data": "telefone",
               "className": 'text-center'
           },
           {
               "data": "datamodificacao",
               "className": 'text-center'
           },
           {
               "data": "ativo",
               "className": 'text-center',
               "orderable": false,
               "searchable": false,
               "render": function(data){
                   let classAtivo = data == "S" ? 'fas fa-check text-success' : 'fas fa-times text-danger'
                   return `<i class="${classAtivo}"></i>`
               }
           },
           {
               "data": "idcliente",
               "className": "text-right",
               "orderable": false,
               "searchable": false,
               "render": function(data){
                   return `
                    <button id="${data}" class="btn btn-sm btn-primary btn-visualizar"><i class="fas fa-eye"></i></button>
                    <button id="${data}" class="btn btn-sm btn-warning btn-editar"><i class="fas fa-pencil-alt"></i></button>
                    <button id="${data}" class="btn btn-sm btn-danger btn-deletar"><i class="fas fa-trash"></i></button>
                   `
               }
           }
        ]
    })

})