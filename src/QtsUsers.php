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

}