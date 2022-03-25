<?php

namespace QuataInvestimentos;

class QtsApi 
{

    public static function fetchError($endpoint, $params, $exceptions, $errors='LOCAL')
    {
        
        $payload = (isset($params['json']) && $params['json'] ? $params['json'] : []);
        if(isset($params['json']) && $params['json']) { unset($params['json']); }

        if(isset($exceptions) && $exceptions){
            foreach($exceptions as $exception):
                $payload['exceptions'][] = $exception;
            endforeach;
        }

        /**
         * Save error into database
         */

        $payload = [
            'person_api_key' => (isset($payload->person_api_key) ? $payload->person_api_key : '00000000-0000-0000-0000-000000000000'),
            'app' => $endpoint,
            'filename' => (isset($payload->trace_filename) ? $payload->trace_filename : 'N/I'),
            'line' => (isset($payload->trace_line) ? $payload->trace_line : 0),
            'payload' => json_encode($payload)
        ];

        switch(strtoupper($errors)){
            case 'LOCAL': $endpoint = 'http://local-docs.quatainvestimentos.com.br:4003/api/'; break;
            case 'TESTING': $endpoint = 'http://dev-docs.quatainvestimentos.com.br/api/'; break;
            case 'PRODUCTION': $endpoint = 'http://docs.quatainvestimentos.com.br/api/'; break;
            default: echo 'Endpoint de debug desconhecido: ' . $debug; exit;
        }

        $params += [\GuzzleHttp\RequestOptions::JSON => $payload];

        try { 

            $client = new \GuzzleHttp\Client();
            $request = $client->post( $endpoint . 'errors', $params );

        } catch (\Exception $e){

            return false;
            
        }

        return true;
        
    }

    public static function fetch($endpoint,$method='GET',$payload=[],$timeout=5)
    {

        $params = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer: marcelomotta',
                'ApiKey' => 'flux'
            ],
            'timeout' => 5
        ];

        try {

            $client = new \GuzzleHttp\Client();

            switch(strtoupper($method)){
                case 'GET':
                    $request = $client->get( $endpoint, $params );
                    break;
                
                case 'POST':
                    $params += [\GuzzleHttp\RequestOptions::JSON => $payload];
                    $request = $client->post( $endpoint, $params );
                    break;
                
                case 'PUT': 
                    $params += [\GuzzleHttp\RequestOptions::JSON => $payload];
                    $request = $client->put( $endpoint, $params );
                    break;
                
                case 'DELETE': 
                    $request = $client->delete( $endpoint, $params );
                    break;
            }
            
            $response = $request->getBody()->getContents();

        } catch (\Exception $e){

            $error_complement = (env('APP_ENV') === 'local') ? 'Caso queira rodar localmente, tente iniciar o serviço utilizando "php artisan serve" no projeto desejado' : '';
            
            $data = [
                'Por favor, verifique se a URL que está tentando se conectar está disponível: <b>' . $endpoint . '</b>',
                $error_complement
            ];

            /**
             * Check connection refused (not catched by Guzzle)
             */

            $guzzle_available = true;
            if(strpos($e->getMessage(), 'Connection refused') !== false){
                $guzzle_available = false;
                $data[] = 'A conexão foi recusada pelo servidor, verifique se o endpoint está disponível para acesso';
            }

            /**
             * Substitui o erro padrão por outros erros
             * Se existirem (validado pelo status code)
             */
            
            if($guzzle_available && $e->getResponse()->getStatusCode() !== 200){

                $response = (object)json_decode($e->getResponse()->getBody()->getContents(), true);
                $status_code = $e->getResponse()->getStatusCode();

                $response = (isset($response->results) && $response->results) ? $response->results : ['Erro desconhecido: ' . Qts::cleanSpecialChars(strip_tags($e->getMessage()))];

                $data = [];
                foreach($response as $key => $value):
                    $value = (is_array($value) ? $value[0] : $value);
                    $data[] = $value;
                endforeach;
            
            }

            /**
             * Post Error at errors endpoint
             */

            if(isset($payload['errors']) && $payload['errors']){
                QtsApi::fetchError($endpoint, $params, $data, $payload['errors']);
            }

            return (object)['status' => 500, 'data' => $data];
            
        }

        $data = json_decode($response);
        return (object)['status' => 200, 'data' => $data];

    }

}