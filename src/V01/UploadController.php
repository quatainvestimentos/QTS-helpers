<?php

namespace QuataInvestimentos\V01;
use QuataInvestimentos\Qts;

trait UploadController
{   

    public static function V01PostUpload($data)
    { 

        /**
         * Upload types
         *  1	Documentação de cliente
         *  2	Documentação de input de crédito
         *  3	Termo de Cessão	termo-cessao
         *  4	Memória de Calculo
         *  5	Remessa cliente
         *  6	Complemento remessa
         *  7	NF-S (complemento de remessa)
         *  8	Termo de Cessão Assinado
         *  9	CNAB remessa paulista
         *  10	CNAB Remessa Instrução
         *  11	VAN
         */
        
        switch(strtoupper($data->file_type)){
            case 'REMITTANCE':
            case 'INSTRUCTION':
            case 'DISCHARGE': 
                $upload_type = 5;
                break;
            default:
                $upload_type = null;
        }

        if(!$upload_type){
            return (object)[
                'status' => 403,
                'data' => 'Tipo de arquivo para upload desconhecido: ' . $upload_type
            ];
        }

        $payload = [
            "id_upload_tipo" => $upload_type,
            "nm_arquivo" => $data->name,
            "type" => $data->mime_type,
            "base64" => base64_encode($data->file)
        ];

        $endpoint = "v1/TbUpload/uploadBase64";
        $results = Qts::v1Fetch('POST',$endpoint,$payload,true);
        $upload_data = (isset($results->data) && $results->data ?  $results->data : []);

        # Verifica se houve erro no upload por parte do QTS
        if(!$upload_data['status']){
            return (object)[
                'status' => 401,
                'data' => $upload_data['data']
            ];
        }
        
        # Verifica se houve erro no upload por parte da requisição via API
        if(!isset($results->status) || $results->status >= 400){
            return (object)[
                'status' => $results->status,
                'data' => $results->data
            ];
        }

        return (object)[
            'status' => 200,
            'data' => $upload_data['data']['id_upload']
        ];

    }

}