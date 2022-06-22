<?php

namespace QuataInvestimentos\V01;
use QuataInvestimentos\Qts;

trait InstructionController 
{    

    public static function V01PostInstruction($data)
    {

        /**
         * Attach Upload Id at
         * the Instruction File
         */

        $payload = [
            "parametros" => [
                "id_upload" => $data->file_id,
            ],
            "context" => [
                "id_cliente" => $data->qts_client_id,
                "env" => "V02"
            ]
        ];

        $endpoint = "v1/TbInstrucaoSolicitada/uploadInstrucao";

        $results = Qts::v1Fetch('POST',$endpoint,$payload);
        $upload_data = (isset($results->data) && $results->data ?  $results->data : []);
        
        if(!isset($results->status) || $results->status >= 400){
            return (object)[
                'status' => $results->status,
                'data' => $results->data
            ];
        }

        /**
         * Send Complete Payload/Instruction 
         */

        $payload = [
            "dataCadastro" => [
                "data" => $upload_data,
            ],
            "context" => [
                "id_cliente" => $data->qts_client_id,
                "env" => "V02"
            ]
        ];

        $endpoint = "v1/TbInstrucaoSolicitada/cadastrarUploadInstrucao";

        $results = Qts::v1Fetch('POST',$endpoint,$payload);
        $data = (isset($results->data) && $results->data ?  $results->data : []);
        
        if(!isset($results->status) || $results->status >= 400){
            return (object)[
                'status' => $results->status,
                'data' => $results->data
            ];
        }
    
        $results = [];

        foreach($data as $key => $value):

            if(strtoupper($key) === 'VALIDOS'){

                if(isset($value[0]) && $value[0]){
                    foreach($value[0] as $v):
                        
                        if(isset($v['data']['data'])){
                            $results[] = 'Instrução recusada: ' . $v['data']['data'];
                        }

                        if(isset($v['cadastrados']) && is_array($v['cadastrados'][0])){
                            foreach($v['cadastrados'][0] as $cadastrado):
                                $results[] = 'Instrução cadastrada para o título: ' . $cadastrado;
                            endforeach;
                        }

                        if(isset($v['indisponiveis'])){
                            foreach($v['indisponiveis'] as $indisponivel):
                                $results[] = $indisponivel['mensagem'] . ' Número do título: ' . $indisponivel['sDocumento'];
                            endforeach;
                        }

                    endforeach;
                }

            }

            if(strtoupper($key) === 'INVALIDOS'){

                if(isset($value[0]) && $value[0]){
                    foreach($value[0] as $v):
                        $results[] = 'Instrução inválida: ' . $v['data']['data'];
                    endforeach;
                }

            }

        endforeach;

        return (object)[
            'status' => 200,
            'data' => $results
        ];
        
    }

}