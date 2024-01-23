<?php

namespace QuataInvestimentos\V01;
use QuataInvestimentos\Qts;

trait RemittanceController 
{

    public static function V01PostRemittance($data)
    {

        /**
         * Send Complete Payload/Remittance 
         */

        $payload = [
            "parametros" => [
                "bull" => true,
                "complemento" => false,
                "dsObservacao" => "",
                "enviarValidos" => false,
                "finalizar" => true,
                "idClienteContaCorrente" => $data->qts_bank_account_id,
                "idContrato" => 0,
                "idEmissaoTipo" => $data->issue_type,
                "idEndossante" => 0,
                "idModalidade" => $data->modality,
                "idModalidadeCaracteristica" => 0,
                "idOperacao" => 0,
                "idOperacaoCaracteristica" => $data->operation_attribute,
                "idOperacaoTipo" => $data->operation_type,
                "idRemessa" => 0,
                "idUpload" => $data->file_id,
                "idUploadComplemento" => 0,
                "remessa" => 0,
                "stNfe" => false,
                "stNfs" => false
            ],
            "context" => [
                "id_cliente" => $data->qts_client_id,
                "env" => "V02"
            ]
        ];

        $endpoint = "v1/EnvioRemessa/index";

        $results = Qts::v1Fetch('POST',$endpoint,$payload,true);
        $data = (isset($results->data) && $results->data ?  $results->data : []);
        
        if(!isset($results->status) || $results->status >= 400){
            return (object)[
                'status' => $results->status,
                'data' => $results->data
            ];
        }

        /**
         * Finished
         */

        if(isset($data['erros']) && $data['erros']){

            $errors = [];
            $errors += Qts::bindRemittanceErrors($data['erros'], 'header');
            $errors += Qts::bindRemittanceErrors($data['erros'], 'campos');
            $errors += Qts::bindRemittanceErrors($data['erros'], 'linhas');

            return (object)[
                'status' => 403,
                'data' => $errors
            ];

        }

        return (object)[
            'status' => 200,
            'data' =>  ["Remessa id " . $data['idContrato'] . " cadastrada com " . count($data['titulosCadastrados']) . " título(s)"]
        ];
        
    }

}