<?php 

namespace QuataInvestimentos\V01;
use QuataInvestimentos\Qts;

trait QtsV01 
{

    public static function v1Fetch($method='GET',$endpoint,$payload=[])
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

        /**
         * Montar os headers
         */

        $params = [
            'debug'   => false,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => "{$access_token}",
            ],
            'timeout' => 300
        ];

        try {

            $client = new \GuzzleHttp\Client();

            switch(strtoupper($method)){
                case 'GET':
                    $params += (isset($payload) && $payload ? ['query' => $payload] : []);
                    $request = $client->get( env('QTSV1_DOMAIN') . $endpoint, $params );
                    break;
                
                case 'POST':
                    $params += [\GuzzleHttp\RequestOptions::JSON => $payload];
                    $request = $client->post( env('QTSV1_DOMAIN') . $endpoint, $params );
                    break;
                
                case 'PUT': 
                    $params += [\GuzzleHttp\RequestOptions::JSON => $payload];
                    $request = $client->put( env('QTSV1_DOMAIN') . $endpoint, $params );
                    break;
                
                case 'DELETE': 
                    $params += (isset($payload) && $payload ? ['query' => $payload] : []);
                    $request = $client->delete( env('QTSV1_DOMAIN') . $endpoint, $params );
                    break;
            }
            
            $response = $request->getBody()->getContents();

        } catch (\Exception $e){

            
            $exception = ($e->getMessage() ? $e->getMessage() : null);
            $data = ($exception ? $exception : json_decode($e->getResponse()->getBody()->getContents(), true));

            return (object)[
                'status' => 401,
                'data' => $data
            ];
            
        }

        $response = json_decode($response, true);

        return (object)[
            'status' => 200,
            'data' => $response['data']
        ];

    }

    protected static function QtsAccessToken()
    {

        $keycloak = 'https://'.env('QTSV1_KEYCLOAK_ENV').'.quatainvestimentos.com.br/auth/realms/'.env('QTSV1_KEYCLOAK_REALM').'/protocol/openid-connect/token';

        $payload = [
            "client_id" => env('QTSV1_KEYCLOAK_CLIENT_ID'),
            "grant_type" => env('QTSV1_KEYCLOAK_GRANT_TYPE'),
            "username" => env('QTSV1_KEYCLOAK_USERNAME'),
            "password" => env('QTSV1_KEYCLOAK_PASSWORD'),
        ];

        try {

            $client = new \GuzzleHttp\Client();
            $request = $client->post( $keycloak, ['form_params' => $payload] );
            $response = $request->getBody()->getContents();

        } catch (\Exception $e){

            $exception = ($e->getMessage() ? $e->getMessage() : null);
            $data = ($exception ? $exception : json_decode($e->getResponse()->getBody()->getContents(), true));

            return (object)[
                'status' => 401,
                'data' => $data
            ];
            
        }

        $response = json_decode($response, true);
        $access_token = (strtoupper(env('APP_ENV')) === 'LOCAL' ? 'jD53Ktq2TNFT8Q868N4C' : $response['access_token']);

        return (object)[
            'status' => 200,
            'data' => (object)['access_token' => $access_token]
        ];

    }

    public static function bindRemittanceData($v02_structure)
    {
        switch(strtoupper($v02_structure)){
            case 'BANK': return 1; break;
            case 'ASSIGNOR': return 2; break;
            case 'DISCOUNT': return 1; break;
            case 'WARRANTY': return 2; break;
            case 'REAL_STATE': return 3; break;
            case 'CONFIRMING': return 4; break;
            case 'DEVELOPMENT': return 5; break;
            case 'SIMPLE_CHARGE': return 6; break;
            case 'WORKING_CAPITAL': return 7; break;
            case 'MARKET_DEBT': return 8; break;
            case 'PULVERIZED': return 2; break;
            case 'INTERCOMPANY': return 3; break;
            case 'CONFIDENTIAL_FACTORING': return 4; break;
            case 'DUPLICATAS': return 1; break;
            case 'MULTISETORIAL': return 1; break;
            case 'PRASS_II': return 5; break;
            case 'QUATA_NX': return 33; break;
            default: return null;
        }
    }

    protected static function bindRemittanceErrors($data, $key='campos')
    {

        $results = [];

        if(isset($data[$key]) && $data[$key]){
            foreach($data[$key] as $d):

                $results[] = (
                    isset($d['idTituloBanco'][0]['dsMensagem']) && 
                    $d['idTituloBanco'][0]['dsMensagem'] ? 
                    $d['idTituloBanco'][0]['dsMensagem'] : 
                    $d
                );

            endforeach;
        }

        return $results;

    }

}