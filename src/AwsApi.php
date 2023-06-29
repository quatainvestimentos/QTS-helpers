<?php

namespace QuataInvestimentos;

trait AwsApi 
{

    public static function lambda($url, $payload, $method='GET', $headers=[])
    {

        $method = (!isset($method) || !$method ? 'GET' : strtoupper($method));

        if(!isset($headers['x-api-key']) || !$headers['x-api-key']){
            return (object)[
                'status' => 401,
                'data' => [
                    "Por favor informe a chave/token 'x-api-key' para comunicação com os servidores AWS"
                ]
            ];
        }

        $headers['timeout'] = (!isset($headers['timeout']) || !$headers['timeout'] ? 30 : $headers['timeout']);

        if((int)$headers['timeout'] >= 540){
            return (object)[
                'status' => 405,
                'data' => [
                    'O máximo de timout permitido para funções AWS Lambda é 10 minutos (600 segundos)',
                    'Evite custos desnecessários e otimize os scripts para rodarem abaixo de 5 minutos'
                ]
            ];
        }

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);

        switch($method){
            case 'GET':
            case 'PUT':
            case 'DELETE':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
                break;
            case 'POST': 
                curl_setopt($ch, CURLOPT_POST, true);
                break;
        }
        
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'x-api-key: ' . $headers['x-api-key']
        ]);

        curl_setopt($ch, CURLOPT_TIMEOUT, $headers['timeout']);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, false);
        
    }

}