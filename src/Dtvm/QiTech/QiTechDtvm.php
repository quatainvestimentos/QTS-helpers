<?php 

namespace QuataInvestimentos\Dtvm\QiTech;
use QuataInvestimentos\QtsHelpers;
use QuataInvestimentos\Dtvm\QiTech\QtsDtvmEs512 as Qts;

trait QiTechDtvm 
{

    public static function QiTechDtvmFetch($method='GET',$endpoint,$payload=[])
    {

        try {

            if(!isset($endpoint)){
                throw new \Exception("Endpoint de conexão DTVM não informado", 1);
            }

            # Qi Tech DTVM needs that the endpoint contains slash at the beginning
            # It's part of the token creation and validation

            if($endpoint[0] !== '/'){
                $endpoint = '/' . $endpoint;
            }

            /**
             * Body
             */

            // QtsHelpers::debug('Body da Request',$payload);

            $encoded_header = Qts::QiTechDtvmJwtEncrypt($method,$endpoint,$payload);
            if(!isset($encoded_header->status) || $encoded_header->status !== 200){
                return (object)[
                    'status' => $encoded_header->status,
                    'data' => $encoded_header->data
                ];
            }

            // QtsHelpers::debug('Header encodado em JWT para a Request',$encoded_header->data);

            /**
             * Validate Endpoints (Domains)
             */

            switch(strtoupper($endpoint)){
                case '/AUTHENTICATION_TEST':
                case '/ASSIGNOR_REGISTRY/ASSIGNOR_REGISTRY':
                    $domain = env('QI_DTVM_MANAGER_DOMAIN');
                    break;
                default:
                    $domain = env('QI_DTVM_ASSIGNOR_DOMAIN');
            }

            $client = new \GuzzleHttp\Client(['headers' => $encoded_header->data]);

            switch(strtoupper($method)){
                case 'GET':
                    $request = $client->get($domain . $endpoint);
                    break;
                
                case 'POST':
                    $request = $client->post($domain . $endpoint, ['json' => $payload]);
                    break;
                
                case 'PUT': 
                    $request = $client->put($domain . $endpoint, ['json' => $payload]);
                    break;
                
                case 'DELETE': 
                    $request = $client->delete($domain . $endpoint, ['json' => $payload]);
                    break;
            }
        
        } catch (\Exception $e){

            $exception = ($e->getMessage() ? $e->getMessage() : null);
            $data = ($exception ? $exception : json_decode($e->getResponse()->getBody()->getContents(), true));
            // QtsHelpers::debug('ERRO',$data);

            return (object)['status' => 422,'data' => $data]; 

        }

       
        $data = json_decode($request->getBody(), true);
        return (object)['status' => $request->getStatusCode(),'data' => $data]; 

    }

    public static function QiTechDtvmCurl($endpoint,$file)
    {

        // TODO

    }

}