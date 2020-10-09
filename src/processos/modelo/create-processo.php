<?php

    include('../../banco/conexao.php');

    if($conexao){

        $requestData = $_REQUEST;

        if(!empty($requestData['nome']) && !empty($requestData['ativo'])){

            $data = str_replace('/','-',$requestData['dataagora']);
            $data = date('Y-m-d H:i:s', strtotime($data));
            $requestData['ativo'] = $requestData['ativo'] == 'on' ? 'S' : 'N';

            $sql = "INSERT INTO processos (num_processo, titulo, descricao, arquivo, dataprocesso, dataencerramento, idtipos_processo, idcliente) VALUES('$requestData[num_processo]', '$requestData[titulo]', '$requestData[descricao]', $requestData[arquivo], '$data', '$data', '$idtipos_processo', '$idcliente')";

            $resultado = mysqli_query($conexao, $sql);
            if($resultado){
                $dados = array(
                    'tipo' => TP_MSG_SUCCESS,
                    'mensagem' => "Processo cadastrado com êxito."
                );
            } else {
                $dados = array(
                    'tipo' => TP_MSG_ERROR,
                    'mensagem' => "Não foi possível cadastrar o Processo."
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