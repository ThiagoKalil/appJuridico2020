<?php

    include('../../banco/conexao.php');

    if($conexao){

        $requestData = $_REQUEST;

        if(!empty($requestData['draw']) || isset($requestData['draw'])){

            $colunas = $requestData['columns'];

            $sql = "SELECT idcliente, nome, email, telefone, DATE_FORMAT(datamodificacao, '%d/%m/%Y %H:%i:%s') as datamodificacao, ativo FROM clientes WHERE 1=1 ";

            $resultado = mysqli_query($conexao, $sql);
            $totalRegistros = mysqli_num_rows($resultado);

            $filtro = $requestData['search']['value'];
            if(!empty($filtro)){
                $sql .= " AND (idcliente LIKE '$filtro%' ";
                $sql .= " OR nome LIKE '$filtro%') "; 
            }

            $resultado = mysqli_query($conexao, $sql);
            $totalFiltrados = mysqli_num_rows($resultado);

            $colunaOrdem = $requestData['order'][0]['column'];
            $ordem = $colunas[$colunaOrdem]['data'];
            $direcao = $requestData['order'][0]['dir'];

            $inicio = $requestData['start'];
            $tamanho = $requestData['length'];

            $sql .= " ORDER BY $ordem $direcao LIMIT $inicio, $tamanho"; 

            $resultado = mysqli_query($conexao, $sql);
            $dados = array();
            while($linha = mysqli_fetch_assoc($resultado)){
                $dados[] = array_map('utf8_encode', $linha);
            }

            $json_data = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => intval($totalRegistros),
                "recordsFiltered" => intval($totalFiltrados),
                "data" => $dados
            );

        } else {
            $json_data = array(
                "draw" => 0,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => array()
            );
        }

        mysqli_close($conexao);

    } else {
        $json_data = array(
            "draw" => 0,
            "recordsTotal" => 0,
            "recordsFiltered" => 0,
            "data" => array()
        );
    }

    echo json_encode($json_data,  JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

  