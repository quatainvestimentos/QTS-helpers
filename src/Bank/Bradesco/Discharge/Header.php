<?php

namespace QuataInvestimentos\Bank\Bradesco\Discharge;
use QuataInvestimentos\Bank\Common;

trait Header {

    public function extractFrom($line,$data,$pad=true)
    {

        switch(strtoupper($data)){
            case 'REGISTRO': $value = substr($line, 0, 1); break;
            case 'IDENTIFICACAO': $value = substr($line, 1, 1); break;
            case 'RETORNO': $value = substr($line, 2, 7); break;
            case 'COD_SERVICO': $value = substr($line, 9, 2); break;
            case 'COBRANCA': $value = substr($line, 11, 15); break;
            case 'CODIGO_EMPRESA': $value = substr($line, 26, 20); break;
            case 'NOME_EMPRESA': $value = substr($line, 46, 30); break;
            case 'NUMERO': $value = substr($line, 76, 3); break;
            case 'BANCO': $value = substr($line, 79, 15); break;
            case 'ARQUIVO': $value = substr($line, 94, 6); break;
            case 'GRAVACAO': $value = substr($line, 100, 8); break;
            case 'AVISO_BANCARIO': $value = substr($line, 108, 5); break;
            case 'BRANCO_1': $value = substr($line, 113, 266); break;
            case 'DATA_CREDITO': $value = substr($line, 379, 6); break;
            case 'BRANCO_2': $value = substr($line, 385, 9); break;
            case 'SEQUENCIAL': $value = substr($line, 394, 6); break;
            default: return 'Coluna não aceita no extract remessa data: '. $data;
        }

        if($pad){ return Discharge::padLine($data, $value); }
        return $value;

    }

    public function help()
    {
        $data = [
            'CNAB' => 'BRADESCO',
            'TYPE' => 'HEADER',
            'REGISTRO' => [ 
                'position_from' => '001',
                'position_to' => '001',
                'size' => '001',
                'content' => '0',
                'type' => 'Numérico',
            ],
            'IDENTIFICACAO' => [ 
                'position_from' => '002',
                'position_to' => '002',
                'size' => '001',
                'content' => '2',
                'type' => 'Numérico',
            ],
            'RETORNO' => [ 
                'position_from' => '003',
                'position_to' => '009',
                'size' => '007',
                'content' => 'Retorno',
                'type' => 'Alfanumérico',
            ],
            'COD_SERVICO' => [ 
                'position_from' => '010',
                'position_to' => '011',
                'size' => '002',
                'content' => '01',
                'type' => 'Numérico',
            ],
            'COBRANCA' => [ 
                'position_from' => '012',
                'position_to' => '026',
                'size' => '015',
                'content' => 'Cobrança',
                'type' => 'Alfanumérico',
            ],
            'CODIGO_EMPRESA' => [ 
                'position_from' => '027',
                'position_to' => '046',
                'size' => '020',
                'content' => 'Nº Empresa (convênio)',
                'type' => 'Numérico',
            ],
            'NOME_EMPRESA' => [ 
                'position_from' => '047',
                'position_to' => '076',
                'size' => '030',
                'content' => 'Razão Social (Banco/Cliente/Fundo)',
                'type' => 'Alfanumérico',
            ],
            'NUMERO' => [ 
                'position_from' => '077',
                'position_to' => '079',
                'size' => '003',
                'content' => '237 ou 329',
                'type' => 'Numérico',
            ],
            'BANCO' => [ 
                'position_from' => '080',
                'position_to' => '094',
                'size' => '015',
                'content' => 'BRADESCO ou QI SCD',
                'type' => 'Alfanumérico',
            ],
            'ARQUIVO' => [ 
                'position_from' => '095',
                'position_to' => '100',
                'size' => '006',
                'content' => 'DDMMAA',
                'type' => 'Numérico',
            ],
            'GRAVACAO' => [ 
                'position_from' => '101',
                'position_to' => '108',
                'size' => '008',
                'content' => '01600000',
                'type' => 'Numérico',
            ],
            'AVISO_BANCARIO' => [ 
                'position_from' => '109',
                'position_to' => '113',
                'size' => '005',
                'content' => 'Nº aviso',
                'type' => 'Numérico',
            ],
            'BRANCO_1' => [ 
                'position_from' => '114',
                'position_to' => '379',
                'size' => '266',
                'content' => 'BRANCO',
                'type' => '',
            ],
            'DATA_CREDITO' => [ 
                'position_from' => '380',
                'position_to' => '385',
                'size' => '006',
                'content' => 'DDMMAA',
                'type' => 'Numérico',
            ],
            'BRANCO_2' => [ 
                'position_from' => '386',
                'position_to' => '394',
                'size' => '009',
                'content' => 'BRANCO',
                'type' => '',
            ],
            'SEQUENCIAL' => [ 
                'position_from' => '395',
                'position_to' => '400',
                'size' => '006',
                'content' => '000001',
                'type' => 'Numérico',
                ]
            ];

        return $data;
    
    }

    public function replaceOn($line,$data,$new_value)
    {

        switch(strtoupper($data)){
            case 'REGISTRO': return substr_replace($line, $new_value, 0, 1); break;
            case 'IDENTIFICACAO': return substr_replace($line, $new_value, 1, 1); break;
            case 'RETORNO': return substr_replace($line, $new_value, 2, 7 ); break;
            case 'COD_SERVICO': return substr_replace($line, $new_value, 9, 2); break;
            case 'COBRANCA': return substr_replace($line, $new_value, 11, 15); break;
            case 'CODIGO_EMPRESA': return substr_replace($line, $new_value, 26, 20); break;
            case 'NOME_EMPRESA': return substr_replace($line, $new_value, 46, 30); break;
            case 'NUMERO': return substr_replace($line, $new_value, 76, 3); break;
            case 'BANCO': return substr_replace($line, $new_value, 79, 15); break;
            case 'ARQUIVO': return substr_replace($line, $new_value, 94, 6); break;
            case 'GRAVACAO': return substr_replace($line, $new_value, 100, 8); break;
            case 'AVISO_BANCARIO': return substr_replace($line, $new_value, 108, 5); break;
            case 'BRANCO_1': return substr_replace($line, $new_value, 113, 266); break;
            case 'DATA_CREDITO': return substr_replace($line, $new_value, 379, 6); break;
            case 'BRANCO_2': return substr_replace($line, $new_value, 385, 9); break;
            case 'SEQUENCIAL': return substr_replace($line, $new_value, 394, 6); break;
            default: return 'Coluna não aceita no replace remessa data: ' . $data;
        }

    }

    public function padLine($data,$value)
    {

        $value = Common::cleanUp($value);
        $value = Common::removeExtraSpaces($value);

        $pad_replace = ' ';

        switch(strtoupper($data)){
            case 'REGISTRO': return str_pad($value, 1, '0', STR_PAD_LEFT); break;
            case 'IDENTIFICACAO': return str_pad($value, 1, '0', STR_PAD_LEFT); break;
            case 'RETORNO': return str_pad($value, 7, ' ', STR_PAD_RIGHT); break;
            case 'COD_SERVICO': return str_pad($value, 2, '0', STR_PAD_LEFT); break;
            case 'COBRANCA': return str_pad($value, 15, ' ', STR_PAD_RIGHT); break;
            case 'CODIGO_EMPRESA': return str_pad($value, 20, '0', STR_PAD_LEFT); break;
            case 'NOME_EMPRESA': return str_pad($value, 30, ' ', STR_PAD_RIGHT); break;
            case 'NUMERO': return str_pad($value, 3, '0', STR_PAD_LEFT); break;
            case 'BANCO': return str_pad($value, 15, ' ', STR_PAD_RIGHT); break;
            case 'ARQUIVO': return str_pad($value, 6, '0', STR_PAD_LEFT); break;
            case 'GRAVACAO': return str_pad($value, 8, '0', STR_PAD_LEFT); break;
            case 'AVISO_BANCARIO': return str_pad($value, 5, '0', STR_PAD_LEFT); break;
            case 'BRANCO_1': return str_pad($value, 266, '0', STR_PAD_LEFT); break;
            case 'DATA_CREDITO': return str_pad($value, 6, '0', STR_PAD_LEFT); break;
            case 'BRANCO_2': return str_pad($value, 9, '0', STR_PAD_LEFT); break;
            case 'SEQUENCIAL': return str_pad($value, 6, '0', STR_PAD_LEFT); break;
            default: return 'Coluna não aceita no extract remessa data: ' . $data;
        }
    }

}