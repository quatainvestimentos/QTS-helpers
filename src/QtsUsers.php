<?php 

namespace QuataInvestimentos;

trait QtsUsers 
{

    protected static function getEndpoint($env)
    {
        switch(strtoupper($env)){
            case 'LOCAL': $endpoint = 'http://local-users.quatainvestimentos.com.br:4001/api/'; break;
            case 'TESTING': $endpoint = 'https://dev-users.quatainvestimentos.com.br/api/'; break;
            case 'PRODUCTION': $endpoint = 'http://users.quatainvestimentos.com.br/api/'; break;
            default: echo 'Endpoint de alertas desconhecido: ' . $env; exit;
        }

        return $endpoint;
    }

    public static function isValid($key, $env='LOCAL')
    {

        $results = Qts::fetch(Qts::getEndpoint($env) . 'validate/' . $key, 'GET', [
            'token' => 'N/A',
            'client-secret' => 'N/A'
        ]);

        $data = (isset($results->data) && $results->data ? $results->data : []);

        if(isset($results->status) && $results->status !== 200){
            return (object)['status' => 404, 'data' => [
                'Parece que o usuário informado não existe no QTS: ' . $key,
                'Ambiente: ' . $env
            ]];
        }

    }

    public static function cachedUsers($env='LOCAL')
    {

        $results = Qts::fetch(Qts::getEndpoint($env) . 'cache/users', 'GET', ['client-secret' => env('CLIENT_SECRET')]);
        $data = (isset($results->data) && $results->data ? $results->data : []);

        if(isset($results->status) && $results->status !== 200){
            return (object)['status' => 404, 'data' => $results->data];
        }

        return (object)['status' => 200, 'data' => (isset($data->results) && $data->results ? $data->results : [])];

    }

    public static function getUserData($env, $api_key, $select='*')
    {

         $results = Qts::fetch(Qts::getEndpoint($env) . 'users/' . $api_key, 'GET', [
            'client-secret' => env('CLIENT_SECRET')
        ]);

        $user = (isset($results->data->results) && $results->data->results ? $results->data->results : []);

        if(!isset($results->status) || $results->status >= 400){
            return (object)['status' => $results->status, 'data' =>$results->data ];
        }

        $new_data = [];
        if($select !== '*'){
            
            $get_only = explode(',', $select);
            $get_only = array_map(fn ($str) => strtoupper(trim($str)), $get_only);

            foreach($user as $key => $value):
                if(in_array(strtoupper($key), $get_only)){
                    $new_data += [strtolower($key) => $value];
                }
            endforeach;
            $user = (object)$new_data;
        }

        return (object)['status' => 201, 'data' => $user];
    }

    public static function getNonCustomersByEin($env, $ein)
    {

        $results = Qts::fetch(Qts::getEndpoint($env) . 'users/non-customers/by/'.$ein, 'GET', [
            'client-secret' => env('CLIENT_SECRET')
        ]);

        $data = (isset($results->data->results) && $results->data->results ? $results->data->results : []);

        if(!isset($results->status) || $results->status >= 400){
            return (object)['status' => $results->status, 'data' =>$results->data ];
        }

        return (object)['status' => 201, 'data' => $data];
    }

    public static function filterPerson($key, $object)
    {
        foreach($object as $person):
            if($person->api_key === $key){
                return $person;
                break;
            }
        endforeach;

        return (object)[];

    }

    public static function filterPersonBy($key, $value, $object)
    {
        foreach($object as $person):

            $person = (array)$person;

            if($person[$key] === $value){
                return (object)$person;
                break;
            }
        endforeach;

        return (object)[];

    }

    public static function filterByMatchingKeys($user_api_key, $ein, $object)
    {

        foreach($object as $person):

            if(!isset($person->user_api_key)){ continue; }
            if(!isset($person->ein)){ continue; }

            if(
                (string)$person->user_api_key === (string)$user_api_key && 
                (string)$person->ein === (string)$ein
            ){
                
                return $person;
                break;
                
            }
        endforeach;

        return (object)[];

    }

    public static function filterPersonByEinAndAsset($ein, $asset, $object)
    {
        foreach($object as $person):

            if(!isset($person->ein)){ continue; }
            if(!isset($person->asset)){ continue; }

            $ein = str_pad($ein, 14, 0, STR_PAD_LEFT);
            $ein_prefix = substr($ein, 0, 8);

            if(
                strpos($person->ein, $ein_prefix) !== false && 
                strtoupper($person->asset) === $asset
            ){
                return $person;
                break;
            }

        endforeach;

        return (object)[];

    }

    public static function findAsset($apelido)
    {
        if(strpos($apelido, '(SOMA)') !== false){
            return 'SOMA_ASSET';
        }

        if(strpos($apelido, '(ARCEL)') !== false){
            return 'GRUPO_ARCEL';
        }

        return 'QUATA_INVESTIMENTOS';
        
    }

    public static function extractFilename($string) {
        $tokens = explode('/', $string);
        $total_tokens = count($tokens);
        return $tokens[ $total_tokens - 1];
    }

    public static function cachedUsersFrom($role, $env='LOCAL')
    {

        $results = Qts::cachedUsers($env);
        if(isset($results->status) && $results->status !== 200){
            return (object)['status' => 404, 'data' => $results->data];
        }

        $role = md5(strtoupper($role));
        $filtered = [];

        foreach($results->data as $d):
            if($d->access_role === $role){
                $filtered[] = $d;
            }
        endforeach;

        return (object)['status' => 200, 'data' => $filtered];

    }

    public static function getCompaniesFromQts($env)
    {

        $results = Qts::fetch(Qts::getEndpoint($env) . 'customers-users', 'GET', [
            'client-secret' => env('CLIENT_SECRET')
        ]);

        $data = (isset($results->data->results) && $results->data->results ? $results->data->results : []);

        if(!isset($results->status) || $results->status >= 400){
            return (object)['status' => $results->status, 'data' =>$results->data ];
        }

        return (object)['status' => 201, 'data' => $data];
    }

}