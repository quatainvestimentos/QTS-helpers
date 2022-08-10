<?php

namespace QuataInvestimentos\V01;
use QuataInvestimentos\Qts;

trait DischargeController 
{    

    public function V01GetDischarge($data)
    {

        # pendentes (will not be used for now)
        $types = ['padrao','liquidacao','instrucoes','rejeitados'];

        /**
         * Attach Upload Id at
         * the Instruction File
         */

        $download_files = [];

        foreach($types as $type):

            /**
             * Discount also has 'Simple Charge' 
             * To download automatically
             * 
             * if discount, push to array (6) Simple Charge
             */

            $modalities_array = [$data->modality];
            if((int)$data->modality === 1){ $modalities_array[] = 6; }

            foreach($modalities_array as $modality):

                $payload = [
                    "parametros" => [
                        "idFundo" => [$data->fund, $data->fund],
                        "idModalidade" => $modality,
                        "tipoRetorno" => $type,
                        "pagina" => 1,
                        "quantidade" => 10,
                        "dateFrom" => $data->reference_date,
                        "dateTo" => $data->reference_date,
                        "nmModalidade" => Qts::bindNmModality($modality),
                        "modalidadeList" => [
                            "id_modalidade" => $modality,
                            "nm_modalidade" => Qts::bindNmModality($modality)
                        ]
                    ],
                    "context" => [
                        "id_cliente" => $data->qts_client_id,
                        "env" => "V02"
                    ]
                ];

                $endpoint = "v1/TbUpload/listagemArquivoRetorno";

                $results = Qts::v1Fetch('POST',$endpoint,$payload);
                $data_files = (isset($results->data) && $results->data ?  $results->data : []);

                # Cleaning data
                unset($data_files['count']);
                unset($data_files['arquivos']['total']);

                foreach($data_files['arquivos'] as $fund_id => $files):
                    foreach($files as $file):

                        # Check if the file belongs to the client
                        # Every QTS discharge file, has the qts_client_id at the beginning

                        $check_file_name = explode('-', $file['nm_arquivo']);

                        if($file['dt_arquivo'] === $data->reference_date && (int)$check_file_name[0] === (int)$data->qts_client_id){

                            $download_files[] = (object)[
                                'name' => $file['nm_arquivo'],
                                'modality' => $file['id_modalidade'],
                                'fund_id' => $file['id_fundo'],
                                'type' => $type
                            ];

                        }

                    endforeach;
                endforeach;

                /**
                 * Debug
                 */

                if(isset($data->debug) && $data->debug){

                    $debug_payload = (object)[
                        'person_api_key' => '0000000000-0000000000-0000000000-000',
                        'text' => "Debug do V01GetDischarge: {$data->qts_client_id} (Fundo: {$data->fund}, Modalidade: {$modality}, Tipo: {$type})",
                        'json' => [
                            'payload' => $payload,
                            'endpoint' => $endpoint,
                            'results' => $results
                        ]
                    ];

                    $debug_results = Qts::fetchDebug([
                        'client-secret' => env('CLIENT_SECRET'),
                        'timeout' => 30
                    ], $debug_payload, strtoupper(env('APP_ENV')));

                }

            endforeach;

        endforeach;

        /**
         * Debug
         */

        if(isset($data->debug) && $data->debug){

            $debug_payload = (object)[
                'person_api_key' => '0000000000-0000000000-0000000000-000',
                'text' => "Debug do V01GetDischarge: {$data->qts_client_id} (Filtered Files)",
                'json' => [
                    'filtered' => $download_files
                ]
            ];

            $debug_results = Qts::fetchDebug([
                'client-secret' => env('CLIENT_SECRET'),
                'timeout' => 30
            ], $debug_payload, strtoupper(env('APP_ENV')));

        }

        if(!isset($results->status) || $results->status >= 400){
            return (object)[
                'status' => $results->status,
                'data' => $results->data
            ];
        }

        return (object)[
            'status' => 200,
            'data' => $download_files
        ];
    
    }

    public function V01DownloadDischarge($files)
    {

         /**
         * Auth
         */

        $results = Qts::QtsAccessToken();
        if(!isset($results->status) || $results->status >= 400){
            return (object)[
                'status' => $results->status,
                'data' => $results->data
            ];
        }

        $access_token = $results->data->access_token;

        $results = [];
        foreach($files->data as $file):

            $url = env('QTSV1_DOMAIN') . 'v1/TbUpload';
            
            $params = http_build_query([
                "downloadRetorno" => true,
                "idFundo" => $file->fund_id,
                "idModalidade" => $file->modality,
                "nmArquivo" => $file->name,
                "tipoRetorno" => $file->type,
                "token" => $access_token,
            ]);

            $file_path = 'temp-discharge/' . $file->name;


            try {

                /**
                 * Delete any existing file that has the same name
                 * In order to avoid caching
                 */

                if( \Storage::disk('local')->exists($file_path) ) {
                    \Storage::disk('local')->delete($file_path);
                }
            
            } catch (\Exception $e){

                return (object)[
                    'status' => 403,
                    'data' => $e->getMessage()
                ];

            }


            try {

                \Storage::disk('local')->put($file_path, file_get_contents("{$url}?{$params}"), 'public');

            } catch (\Exception $e){

                return (object)[
                    'status' => 403,
                    'data' => $e->getMessage()
                ];

            }

            /**
             * Register at Database
             */

            $results[] = (object)[
                'temp_path' => $file_path,
                'name' => $file->name,
            ];

        endforeach;

        return (object)[
            'status' => 200,
            'data' => $results
        ];

    }

    public function V01ImprovedGetDischarge($data)
    {

        $payload = [
            "fundos" => [$data->fund],
            "idModalidade" => $data->modality,
            "dateFrom" => $data->reference_date,
            "dateTo" => $data->reference_date,
            "idCliente" => $data->qts_client_id,
            "env" => "V02"
        ];

        $endpoint = "v1/TbUpload/V2ListagemArquivoRetorno";

        $results = Qts::v1Fetch('POST',$endpoint,$payload);
        $data = (isset($results->data) && $results->data ?  $results->data : []);

        if(!isset($results->status) || $results->status >= 400){
            return (object)[
                'status' => $results->status,
                'data' => $data
            ];
        }

        return (object)[
            'status' => 200,
            'data' => $data
        ];
    
    }

}