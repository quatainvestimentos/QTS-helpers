<?php 

namespace QuataInvestimentos\Dtvm\QiTech;
use QuataInvestimentos\QtsHelpers;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Rsa\Sha256;
use Lcobucci\JWT\Signer\Ecdsa\Sha512;
use Lcobucci\JWT\Parser;

trait QtsDtvmEs512 
{

    public static function QiTechDtvmJwtEncrypt($method,$endpoint,$payload=[])
    {

        $signer = new Sha512();

        try {
            
            $private_key = new Key( file_get_contents( storage_path() . env('QI_DTVM_QUATA_PRIVATE_KEY_PATH')) );
            // QtsHelpers::debug('Private Key',file_get_contents( storage_path() . env('QI_DTVM_QUATA_PRIVATE_KEY_PATH')));
        
        } catch(\Exception $e){

            return (object)[
                'status' => 401,
                'data' => [
                    'Parece que não foi possível encriptar a request',
                    'Favor verificar se você já possui as chaves públicas/privadas e API Key da Qi Tech DTVM',
                    'Leia a documentação em: https://qts.quatainvestimentos.com.br/documentacao'
                ],
            ];

        }

        try {

            $token = (new Builder())->issuedAt(time())
                ->withClaim('timestamp', gmdate("Y-m-d\TH:i:s"))
                ->withClaim('method', $method)
                ->withClaim('uri', $endpoint);

            if(isset($payload) && $payload){

                $body_bytes = json_encode($payload);
                $md5_body = md5($body_bytes);

                $token->withClaim('payload_md5', $md5_body);

            }
            
            $token = $token->getToken($signer, $private_key);
        
            $jwt = (string)$token;
        
            $headers = [
                "API-CLIENT-KEY" => env('QI_DTVM_CLIENT_API_KEY'),
                "AUTHORIZATION" => $jwt
            ];

        } catch (\Exception $e) {
            
            return (object)[
                'status' => 401,
                'data' => [
                    'Não foi possível gerar o header de autenticação DTVM',
                    $e->getMessage()
                ],
            ];
        
        }

        return (object)[
            'status' => 200,
            'data' => $headers
        ];

    }

}