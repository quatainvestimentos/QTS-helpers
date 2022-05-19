<?php 

namespace QuataInvestimentos;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Rsa\Sha256;
use Lcobucci\JWT\Signer\Ecdsa\Sha512;
use Lcobucci\JWT\Parser;

trait QtsEs512 
{

    protected static function stringToSign($method,$endpoint,$payload=[])
    {

        /**
         * If endpoints: upload or multibank_cnab
         * The payload must be already an MD5 string
         */

        if(!is_array($payload) && strlen($payload) === 32){ $md5_body = $payload; } else {

            /**
             * The payload (other endpoints) could be an filled array/object
             * Or en empty string (no payload)
             * 
             * If "header" token: the payload is a string and is already tokenized 
             * If "body": the payload is an array
             * 
             * Check "Not Body" and Payload not tokenized
             */

            if(!is_array($payload) && strlen($payload) < 60){
                return (object)[
                    'status' => 401,
                    'data' => 'Parece que o payload do body não foi encodado/tokenizado em JWT antes de enviar para a criação de chave JWT para o Header'
                ];
            }

            $md5_body = (isset($payload) && $payload ? md5( $payload ) : '');
        }

        date_default_timezone_set('GMT');
        $utc_date = date('D, d M Y H:i:s e');

        /**
         * HTTP-Verb
         * Content-MD5
         * Content-Type (application/json, multipart/form-data, application/pdf)
         * Date em UTC (tempo universal coordenado)
         * RelativeURL
         */ 

        return (object)[
            'status' => 200,
            'data' => (string)"{$method}\n{$md5_body}\napplication/json\n{$utc_date}\n{$endpoint}"
        ];
    }

    protected static function signatureJson($method='GET',$endpoint,$payload=[])
    {

        # Espera que o payload já venha em JWT encodado (tokenizado)
        $string_to_sign = Qts::stringToSign($method,$endpoint,$payload);

        if(!isset($string_to_sign->status) || $string_to_sign->status !== 200){
            return (object)[
                'status' => $string_to_sign->status,
                'data' => $string_to_sign->data
            ];
        }

        return (object)[
            'status' => 200,
            'data' => [
                'alg' => 'ES512',
                'typ' => 'JWT',
                'sub' => env('QI_CLIENT_API_KEY'),
                'signature' => $string_to_sign->data
            ]
        ];
    }

    protected static function addPayload($token, $arg=[])
    {
        foreach($arg as $index => $value) {
            $token->with($index, $value);
        }
        return $token;
    }

    protected static function getTokenMetadata($parsed)
    {
        $metadata = [];
        foreach ($parsed->getClaims() as $name => $claim) {
            $metadata[$name] = $claim->getValue();
        }
        return (object)$metadata;
    }

    public static function jwtEncrypt($type='HEADER',$method,$endpoint,$payload=[])
    {

        $signer = new Sha512();

        try {
            
            $private_key = new Key( file_get_contents( storage_path() . env('QI_QUATA_PRIVATE_KEY_PATH')) );
        
        } catch(\Exception $e){

            return (object)[
                'status' => 401,
                'data' => [
                    'Parece que não foi possível encriptar a request',
                    'Favor verificar se você já possui as chaves públicas/privadas e API Key da Qi Tech',
                    'Leia a documentação em: https://qts.quatainvestimentos.com.br/documentacao'
                ],
            ];

        }

        $token = (new Builder());

        if(strtoupper($type) === 'HEADER'){
            # Espera que o payload já venha em JWT encodado (tokenizado)
            $payload = Qts::signatureJson($method,'/'.$endpoint,$payload);

            if(!isset($payload->status) && $payload->status !== 200){
                return (object)[
                    'status' => $payload->status,
                    'data' => $payload->data,
                ];
            }

            $payload = $payload->data;
            // Qts::debug('JWT Signature Json',$payload);
        }

        
        if(isset($payload) && $payload){
            // Qts::debug('Payload a ser tokenizado',$payload);
            $token = Qts::addPayload($token, $payload);
        }
        
        $token = $token->sign($signer, $private_key);
        $token = $token->getToken($signer, $private_key);
        $token = $token->__toString();

        // Qts::debug($type .' Encrypted Token',$token);

        return (object)[
            'status' => 200,
            'data' => $token
        ];

    }

    protected static function jwtDecrypt($encoded_body)
    {

        $signer = new Sha512();
        $public_key = new Key( file_get_contents( storage_path() . env('QI_PUBLIC_KEY_PATH')) );
        $token = (new Builder());

        $tokenParsed = (new Parser())->parse((string)$encoded_body);
        
        if(!$tokenParsed->verify($signer, $public_key)){
            return false;
        }

        $results = Qts::getTokenMetadata($tokenParsed);
        return $results;

    }

    public static function decrypt($response)
    {

        $data = json_decode($response);

        /**
         * Has the encoded_body
         */

        if(!isset($data->encoded_body)){
            return (object)[
                'status' => 404,
                'data' => ['Não foi possível encontrar/gerar o encoded_body para envio na API']
            ];
        }
    
        $data = Qts::jwtDecrypt($data->encoded_body);
        
        if(!$data){
            return (object)[
                'status' => 404,
                'data' => 'O token não parece ser válido'
            ];
        }

        return (object)[
            'status' => 200,
            'data' => $data
        ];

    }

}