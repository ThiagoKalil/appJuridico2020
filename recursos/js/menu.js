$(document).ready(function() {

    $('.list-cliente').click(function() {
        $('.conteudo').load('src/clientes/visao/list-cliente.html')
    })

    $('.list-tipo_processo').click(function() {
        $('.conteudo').load('src/tipos_processos/visao/list-tipo_processo.html')
    })

    $('.list-processo').click(function() {
        $('.conteudo').load('src/processos/visao/list-processo.html')
    })
})