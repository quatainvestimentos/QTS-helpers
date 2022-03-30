<?php

namespace QuataInvestimentos;

use QuataInvestimentos\QtsHelpers;

class QtsApi 
{

    public static function fetchWarning($payload, $timeout=5, $warnings='LOCAL')
    {

        if(!isset($payload['qts_headers']['token']) || !isset($payload['qts_headers']['client_secret'])){
            return (object)['status' => 500, 'data' => ['Favor informar o token e o client secret para fazer conexões com a API']];
        }

        $params = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer: ' . $payload['qts_headers']['token'],
                'client_secret' => $payload['qts_headers']['client_secret']
            ],
            'timeout' => $timeout
        ];

        /**
         * Unset payload headers from request
         */

        $payload['qts_headers'] = null;
        unset($payload['qts_headers']);
        
        $payload = [
            'person_api_key' => (isset($payload->person_api_key) && $payload->person_api_key ? $payload->person_api_key : 'Não informado'),
            'text' => (isset($payload->text) && $payload->text ? $payload->text : 'Não informado'),
            'json' => (isset($payload->json) && $payload->json ? $payload->json : 'Não informado')
        ];

        switch(strtoupper($warnings)){
            case 'LOCAL': $endpoint = 'http://local-docs.quatainvestimentos.com.br:4003/api/'; break;
            case 'TESTING': $endpoint = 'http://dev-docs.quatainvestimentos.com.br/api/'; break;
            case 'PRODUCTION': $endpoint = 'http://docs.quatainvestimentos.com.br/api/'; break;
            default: echo 'Endpoint de alertas desconhecido: ' . $warnings; exit;
        }

        $params += [\GuzzleHttp\RequestOptions::JSON => $payload];

        try { 

            $client = new \GuzzleHttp\Client();
            $request = $client->post( $endpoint . 'warnings', $params );

        } catch (\Exception $e){

            return false;
            
        }

        return true;
        
    }

    public static function fetchDebug($payload, $timeout=5, $debugs='LOCAL')
    {

        if(!isset($payload['qts_headers']['token']) || !isset($payload['qts_headers']['client_secret'])){
            return (object)['status' => 500, 'data' => ['Favor informar o token e o client secret para fazer conexões com a API']];
        }

        $params = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer: ' . $payload['qts_headers']['token'],
                'client_secret' => $payload['qts_headers']['client_secret']
            ],
            'timeout' => $timeout
        ];

        /**
         * Unset payload headers from request
         */

        $payload['qts_headers'] = null;
        unset($payload['qts_headers']);
        
        $payload = [
            'person_api_key' => (isset($payload->person_api_key) && $payload->person_api_key ? $payload->person_api_key : 'Não informado'),
            'text' => (isset($payload->text) && $payload->text ? $payload->text : 'Não informado'),
            'json' => (isset($payload->json) && $payload->json ? $payload->json : 'Não informado')
        ];

        switch(strtoupper($debugs)){
            case 'LOCAL': $endpoint = 'http://local-docs.quatainvestimentos.com.br:4003/api/'; break;
            case 'TESTING': $endpoint = 'http://dev-docs.quatainvestimentos.com.br/api/'; break;
            case 'PRODUCTION': $endpoint = 'http://docs.quatainvestimentos.com.br/api/'; break;
            default: echo 'Endpoint de debug desconhecido: ' . $debugs; exit;
        }

        $params += [\GuzzleHttp\RequestOptions::JSON => $payload];

        try { 

            $client = new \GuzzleHttp\Client();
            $request = $client->post( $endpoint . 'debugs', $params );

        } catch (\Exception $e){

            return false;
            
        }

        return true;
        
    }

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
            case 'TESTING': $endpoint = 'https://dev-docs.quatainvestimentos.com.br/api/'; break;
            case 'PRODUCTION': $endpoint = 'https://docs.quatainvestimentos.com.br/api/'; break;
            default: echo 'Endpoint de erro desconhecido: ' . $errors; exit;
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

        if(!isset($payload['qts_headers']['token']) || !isset($payload['qts_headers']['client_secret'])){
            return (object)['status' => 500, 'data' => ['Favor informar o token e o client secret para fazer conexões com a API']];
        }

        $params = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer: ' . $payload['qts_headers']['token'],
                'client_secret' => $payload['qts_headers']['client_secret']
            ],
            'timeout' => $timeout
        ];

        /**
         * Unset payload headers from request
         */

        $payload['qts_headers'] = null;
        unset($payload['qts_headers']);

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
                # Acumula os erros em data
                $data[] = 'A conexão foi recusada pelo servidor, verifique se o endpoint está disponível para acesso';
            }

            if(strpos($e->getMessage(), 'Operation timed out after') !== false){
                $guzzle_available = false;
                # Retorna apenas esse erro
                $data = ['A requisição foi encerrada devido ao tempo lento de resposta da API, configurado em ' . $timeout . ' segundo(s)'];
            }

            /**
             * Substitui o erro padrão por outros erros
             * Se existirem (validado pelo status code)
             */
            
            if($guzzle_available && $e->getResponse()->getStatusCode() !== 200){

                $response = (object)json_decode($e->getResponse()->getBody()->getContents(), true);
                $status_code = $e->getResponse()->getStatusCode();

                $response = (isset($response->results) && $response->results) ? $response->results : ['Erro desconhecido: ' . QtsHelpers::cleanSpecialChars(strip_tags($e->getMessage()))];

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