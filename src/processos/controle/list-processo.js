$(document).ready(function() {

    $('#table-processo').DataTable({
        "processing": true,
        "serverSide": true,
        "pageLength": 5,
        "lengthMenu": [5, 10, 25, 50],
        "language": {
            "url": "recursos/DataTable/dataTables.brazil.json"
        },
        "ajax": {
            "url": "src/processos/modelo/list-processo.php",
            "type": "POST"
        },
        "columns": [{
                "data": "idprocesso",
                "className": "text-center"
            },
            {
                "data": "num_processo",
                "className": "text-center"
            },
            {
                "data": "titulo",
                "className": "text-center"
            },
            {
                "data": "dataprocesso",
                "className": "text-center"
            },
            {
                "data": "dataencerramento",
                "className": "text-center"
            },
            {
                "data": "idtipos_processo",
                "className": "text-center"
            },
            {
                "data": "idprocesso",
                "className": "text-center",
                "orderable": false,
                "searchable": false,
                "render": function(data) {
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