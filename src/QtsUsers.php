<?php 

namespace QuataInvestimentos;

class QtsUsers 
{

    public static function isValid($key, $env='LOCAL')
    {

        switch(strtoupper($env)){
            case 'LOCAL': $endpoint = 'http://local-users.quatainvestimentos.com.br:4001/api/'; break;
            case 'TESTING': $endpoint = 'https://dev-users.quatainvestimentos.com.br/api/'; break;
            case 'PRODUCTION': $endpoint = 'http://users.quatainvestimentos.com.br/api/'; break;
            default: echo 'Endpoint de alertas desconhecido: ' . $env; exit;
        }

        $results = QtsApi::fetch($endpoint . 'validate/' . $key, 'GET', [
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

}