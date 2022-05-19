<?php 

namespace QuataInvestimentos;

trait QiTech 
{

    public static function qiFetch($method='GET',$endpoint,$payload=[])
    {

        /**
         * Replace Client API Key
         */

        $endpoint = str_replace('{CLIENT-API-KEY}', env('QI_CLIENT_API_KEY'), $endpoint);

        /**
         * Body
         */

        // Qts::debug('Body da Request',$payload);

        $encoded_body = Qts::jwtEncrypt('BODY','','',$payload);
        if(!isset($encoded_body->status) || $encoded_body->status !== 200){
            return (object)[
                'status' => 404,
                'data' => $encoded_body->data
            ];
        }

        // Qts::debug('Body encodado em JWT para a Request',$encoded_body->data);
        // Qts::debug('MD5 do Body tokenizado', md5($encoded_body->data));

        /**
         * Header
         */

        $encrypt_header = (isset($payload) && $payload ? $encoded_body->data : []);
        $encoded_header = Qts::jwtEncrypt('HEADER',$method,$endpoint,$encrypt_header);

        if(!isset($encoded_header->status) || $encoded_header->status !== 200){
            return (object)[
                'status' => 404,
                'data' => $encoded_header->data
            ];
        }

        /**
         * Montar os headers
         */

        $params = [
            'debug'   => false,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'AUTHORIZATION' => "QIT ".env('QI_CLIENT_API_KEY').":" . $encoded_header->data,
                'API-CLIENT-KEY' => env('QI_CLIENT_API_KEY')
            ],
            'timeout' => 10
        ];

        try {

            $client = new \GuzzleHttp\Client();

            switch(strtoupper($method)){
                case 'GET':
                    $params += (isset($payload) && $payload ? ['query' => ['encoded_body' => $encoded_body->data]] : []);
                    $request = $client->get( env('QI_DOMAIN') . $endpoint, $params );
                    break;
                
                case 'POST':
                    $params += [\GuzzleHttp\RequestOptions::JSON => ['encoded_body' => $encoded_body->data]];
                    $request = $client->post( env('QI_DOMAIN') . $endpoint, $params );
                    break;
                
                case 'PUT': 
                    $params += [\GuzzleHttp\RequestOptions::JSON => ['encoded_body' => $encoded_body->data]];
                    $request = $client->put( env('QI_DOMAIN') . $endpoint, $params );
                    break;
                
                case 'DELETE': 
                    $params += (isset($payload) && $payload ? ['query' => ['encoded_body' => $encoded_body->data]] : []);
                    $request = $client->delete( env('QI_DOMAIN') . $endpoint, $params );
                    break;
            }
            
            $response = $request->getBody()->getContents();

        } catch (\Exception $e){

            
            $exception = ($e->getMessage() ? $e->getMessage() : null);
            $data = ($exception ? $exception : json_decode($e->getResponse()->getBody()->getContents(), true));

            // Qts::debug('ERRO',$data);

            return (object)[
                'status' => 401,
                'data' => $data
            ];
            
        }

        return Qts::decrypt($response);

    }

    public static function qiCurl($endpoint,$file)
    {

        /**
         * Disponíveis somente 'upload' e 'multibank_cnab'
         */

        switch(strtoupper($endpoint)){
            case 'MULTIBANK_CNAB':
                $endpoint = strtolower($endpoint);
                break;
            default:
                $endpoint = 'upload';
        }

        /**
         * Header
         * Uploads utilizam-se somente de token do header
         */

        $encoded_header = Qts::jwtEncrypt('HEADER','POST',$endpoint,$file->md5);

        if(!isset($encoded_header->status) || $encoded_header->status !== 200){
            return (object)[
                'status' => 404,
                'data' => $encoded_header->data
            ];
        }

        // print_r($file);
        // exit;

        try {

            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => env('QI_DOMAIN') . $endpoint,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => [
                    'file' => new \CurlFile(
                        $file->name,
                        $file->mime,
                        $file->postname
                    )
                ],
                CURLOPT_HTTPHEADER => [
                    'AUTHORIZATION: QIT '.env('QI_CLIENT_API_KEY').':' . $encoded_header->data,
                    'API-CLIENT-KEY: ' . env('QI_CLIENT_API_KEY')
                ]
            ]);

            $response = curl_exec($curl);
            curl_close($curl);

        } catch (\Exception $e){

            $data = ($e->getMessage() ? $e->getMessage() : null);
            // Qts::debug('Houve um erro ao fazer a chamada na API',$data);
            return (object)['status' => 500,'data' => $data]; 

        }

        if(strpos($file->name, 'storage/app/temp') !== false){
            @unlink($file->name);
        }

        return Qts::decrypt($response);

    }

}