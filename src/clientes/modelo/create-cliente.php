<?php

    include('../../banco/conexao.php');

    if($conexao){

        $requestData = $_REQUEST;

        if(!empty($requestData['nome']) && !empty($requestData['ativo'])){

            $data = str_replace('/','-',$requestData['dataagora']);
            $data = date('Y-m-d H:i:s', strtotime($data));
            $requestData['ativo'] = $requestData['ativo'] == 'on' ? 'S' : 'N';

            $sql = "INSERT INTO clientes (nome, telefone, email, ativo, datacriacao, datamodificacao) VALUES('$requestData[nome]', '$requestData[telefone]', '$requestData[email]', '$requestData[ativo]', '$data', '$data')";

            $resultado = mysqli_query($conexao, $sql);
            if($resultado){
                $dados = array(
                    'tipo' => TP_MSG_SUCCESS,
                    'mensagem' => "Cliente cadastrado com sucesso."
                );
            } else {
                $dados = array(
                    'tipo' => TP_MSG_ERROR,
                    'mensagem' => "Não foi possível cadastrar o cliente."
                );
            }

        } else {
            $dados = array(
                'tipo' => TP_MSG_INFO,
                'mensagem' => MSG_CAMPOS_OBRIGATORIOS
            );
        }  
        
        mysqli_close($conexao);

    } else {
        $dados = array(
            'tipo' => TP_MSG_INFO,
            'mensagem' => MSG_FALHA_CONEXAO
        );
    }

    echo json_encode($dados);