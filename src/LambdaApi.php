<?php

namespace QuataInvestimentos;

trait LambdaApi 
{

    public static function lambdaFetch($endpoint,$method='GET',$headers=[],$payload=[])
    {

        if(!isset($headers['x-api-key'])){
            return (object)['status' => 405, 'data' => [['Favor informar o x-api-key para fazer conexões com a API']]];
        }

        $params = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'x-api-key' => (isset($headers['x-api-key']) && $headers['x-api-key'] ? 'Bearer ' . $headers['x-api-key'] : null)
            ],
            'timeout' => (isset($headers['timeout']) && $headers['timeout'] ? $headers['timeout'] : 5)
        ];

        try {

            $client = new \GuzzleHttp\Client();

            switch(strtoupper($method)){
                case 'GET':
                    $params += (isset($payload) && $payload ? ['query' => $payload] : []);
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
                    $params += (isset($payload) && $payload ? ['query' => $payload] : []);
                    $request = $client->delete( $endpoint, $params );
                    break;
            }
            
            $response = $request->getBody()->getContents();

        } catch (\Exception $e){

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
                $data = ['A requisição foi encerrada devido ao tempo lento de resposta da API, configurado em ' . $params['timeout'] . ' segundo(s)'];
            }

            if(strpos($e->getMessage(), 'Resolving timed out after') !== false){
                $guzzle_available = false;
                # Retorna apenas esse erro
                $data = ['O servidor destino não respondeu e devolveu um erro de timeout, configurado para estourar em ' . $params['timeout'] . ' segundo(s)'];
            }

            if(strpos($e->getMessage(), '401 Unauthorized') !== false){
                $guzzle_available = false;
                # Retorna apenas esse erro
                $data = ['Não autorizado. Favor validar/enviar token e client_secret antes de fazer requisições na API'];
            }

            if(strpos($e->getMessage(), 'Could not resolve host:') !== false){
                $guzzle_available = false;
                # Retorna apenas esse erro
                $data = ['Não foi possível chamar a URL/endpoint: ' . $endpoint];
            }

            if(strpos($e->getMessage(), 'SSL certificate problem: certificate has expired') !== false){
                $guzzle_available = false;
                # Retorna apenas esse erro
                $data = ['O certificado SSL da URL/endpoint: ' . $endpoint . ' está expirado. Não é possível conectar com o serviço'];
            }

            if(strpos($e->getMessage(), 'SSL certificate problem: unable to get local issuer certificate') !== false){
                $guzzle_available = false;
                # Retorna apenas esse erro
                $data = ['Não foi possível acessar a URL/endpoint: ' . $endpoint . ' em seu ambiente local pois há uma falha de validação do certificado SSL. Talvez esteja relacionado com o php.ini "curl.cainfo" e/ou "cacert.pem"'];
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

                if(!is_array($response)){
                    $data[] = $response;
                }

                if(is_array($response)){

                    foreach($response as $key => $value):
                        $value = (is_array($value) ? $value[0] : $value);
                        $data[] = $value;
                    endforeach;

                }
            
            }

            /**
             * Post Error at errors endpoint
             */

            if(isset($payload['errors']) && $payload['errors']){
                Qts::fetchError($endpoint, $params, $data, $payload['errors']);
            }

            return (object)['status' => (isset($status_code) && $status_code ? $status_code : 500), 'data' => $data];
            
        }

        $data = json_decode($response);
        return (object)['status' => 200, 'data' => $data];

    }

}