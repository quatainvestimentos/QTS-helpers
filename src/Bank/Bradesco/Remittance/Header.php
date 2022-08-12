<?php

namespace QuataInvestimentos\Bank\Bradesco\Remittance;

use QuataInvestimentos\Bank\Bradesco\Remittance;
use QuataInvestimentos\Bank\Common;

trait Header {

    public static function extractHeaderFrom($line,$data,$pad=true)
    {

        switch(strtoupper($data)){
            case 'REGISTRO': $value = substr($line, 0, 1); break;
            case 'IDENTIFICACAO': $value = substr($line, 1, 1); break;
            case 'REMESSA': $value = substr($line, 2, 7); break;
            case 'COD_SERVICO': $value = substr($line, 9, 2); break;
            case 'SERVICO': $value = substr($line, 11, 15); break;
            case 'CONVENIO': $value = substr($line, 26, 20); break;
            case 'NOME_EMPRESA': $value = substr($line, 46, 30); break;
            case 'COD_BANCO': $value = substr($line, 76, 3); break;
            case 'NOME_BANCO': $value = substr($line, 79, 15); break;
            case 'DATA_ARQUIVO': $value = substr($line, 94, 6); break;
            case 'BRANCO_1': $value = substr($line, 100, 8); break;
            case 'IDENTIFICACAO_SISTEMA': $value = substr($line, 108, 2); break;
            case 'SEQUENCIAL_REMESSA': $value = substr($line, 110, 7); break;
            case 'BRANCO_2': $value = substr($line, 117, 277); break;
            case 'SEQUENCIAL': $value = substr($line, 394, 6); break;
            default: return 'Coluna não aceita no extract remessa data: '. $data;
        }

        if($pad){ return Remittance::padLine('HEADER',$data, $value); }
        return $value;

    }

    public static function extractAllFromHeader($line)
    {

        $type = 'HEADER';

        $registro = Remittance::extractFrom($type,$line,'registro', false);
        $identificacao = Remittance::extractFrom($type,$line,'identificacao', false);
        $remessa = Remittance::extractFrom($type,$line,'remessa', false);
        $cod_servico = Remittance::extractFrom($type,$line,'cod_servico', false);
        $servico = Remittance::extractFrom($type,$line,'servico', false);
        $convenio = Remittance::extractFrom($type,$line,'convenio', false);
        $nome_empresa = Remittance::extractFrom($type,$line,'nome_empresa', false);
        $cod_banco = Remittance::extractFrom($type,$line,'cod_banco', false);
        $nome_banco = Remittance::extractFrom($type,$line,'nome_banco', false);
        $data_arquivo = Remittance::extractFrom($type,$line,'data_arquivo', false);
        $branco_1 = Remittance::extractFrom($type,$line,'branco_1', false);
        $identificacao_sistema = Remittance::extractFrom($type,$line,'identificacao_sistema', false);
        $sequencial_remessa = Remittance::extractFrom($type,$line,'sequencial_remessa', false);
        $branco_2 = Remittance::extractFrom($type,$line,'branco_2', false);
        $sequencial = Remittance::extractFrom($type,$line,'sequencial', false);

        return 
        $registro . 
        $identificacao . 
        $remessa . 
        $cod_servico . 
        $servico . 
        $convenio . 
        $nome_empresa . 
        $cod_banco . 
        $nome_banco . 
        $data_arquivo . 
        $branco_1 . 
        $identificacao_sistema . 
        $sequencial_remessa . 
        $branco_2 . 
        $sequencial;
    }

    public function headerHelp()
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
                'content' => '1',
                'type' => 'Numérico',
            ],
            'REMESSA' => [ 
                'position_from' => '003',
                'position_to' => '009',
                'size' => '007',
                'content' => 'REMESSA',
                'type' => 'Alfanumérico',
            ],
            'COD_SERVICO' => [ 
                'position_from' => '010',
                'position_to' => '011',
                'size' => '002',
                'content' => '01',
                'type' => 'Numérico',
            ],
            'SERVICO' => [ 
                'position_from' => '012',
                'position_to' => '026',
                'size' => '015',
                'content' => 'COBRANCA',
                'type' => 'Alfanumérico',
            ],
            'CONVENIO' => [ 
                'position_from' => '027',
                'position_to' => '046',
                'size' => '020',
                'content' => 'Será informado pelo Braesco, quando do cadastramento da conta do beneficiário na sua Agência. Esse código deve ser alinhado à direita com zeros à esquerda.',
                'type' => 'Numérico',
            ],
            'NOME_EMPRESA' => [ 
                'position_from' => '047',
                'position_to' => '076',
                'size' => '030',
                'content' => 'Razão Social',
                'type' => 'Alfanumérico',
            ],
            'COD_BANCO' => [ 
                'position_from' => '077',
                'position_to' => '079',
                'size' => '003',
                'content' => '237',
                'type' => 'Numérico',
            ],
            'NOME_BANCO' => [ 
                'position_from' => '080',
                'position_to' => '094',
                'size' => '015',
                'content' => 'Bradesco',
                'type' => 'Alfanumérico',
            ],
            'DATA_ARQUIVO' => [ 
                'position_from' => '095',
                'position_to' => '100',
                'size' => '006',
                'content' => 'DDMMAA (cada reprocessamento exige uma nova data)',
                'type' => 'Numérico',
            ],
            'BRANCO_1' => [ 
                'position_from' => '101',
                'position_to' => '108',
                'size' => '008',
                'content' => 'Branco',
                'type' => 'Alfanumérico',
            ],
            'IDENTIFICACAO_SISTEMA' => [ 
                'position_from' => '109',
                'position_to' => '110',
                'size' => '002',
                'content' => 'MX',
                'type' => 'Alfanumérico',
            ],
            'SEQUENCIAL_REMESSA' => [ 
                'position_from' => '111',
                'position_to' => '117',
                'size' => '007',
                'content' => 'O número de remessa deve iniciar de 0000001 e incrementado de + 1 a cada novoarquivo-remessa, com  o  objetivo  de  evitar  que  ocorra  duplicidade  de  arquivo,não  podendo,  em  hipótese  alguma,  ser repetida ou zerada.',
                'type' => 'Numérico',
            ],
            'BRANCO_2' => [ 
                'position_from' => '118',
                'position_to' => '394',
                'size' => '277',
                'content' => 'Branco',
                'type' => 'Alfanumérico',
            ],
            'SEQUENCIAL' => [ 
                'position_from' => '395',
                'position_to' => '400',
                'size' => '006',
                'content' => 'Nº Sequencial do Registro de Um em Um',
                'type' => 'Numérico',
            ]
        ];

        return $data;

    }

    public function headerReplaceOn($line,$data,$new_value)
    {

        switch(strtoupper($data)){
            case 'REGISTRO': return substr_replace($line, $new_value, 0, 1); break;
            case 'IDENTIFICACAO': return substr_replace($line, $new_value, 1, 1); break;
            case 'REMESSA': return substr_replace($line, $new_value, 2, 7); break;
            case 'COD_SERVICO': return substr_replace($line, $new_value, 9, 2); break;
            case 'SERVICO': return substr_replace($line, $new_value, 13, 15); break;
            case 'CONVENIO': return substr_replace($line, $new_value, 26, 20); break;
            case 'NOME_EMPRESA': return substr_replace($line, $new_value, 46, 30); break;
            case 'COD_BANCO': return substr_replace($line, $new_value, 76, 3); break;
            case 'NOME_BANCO': return substr_replace($line, $new_value, 79, 15); break;
            case 'DATA_ARQUIVO': return substr_replace($line, $new_value, 94, 6); break;
            case 'BRANCO_1': return substr_replace($line, $new_value, 100, 8); break;
            case 'IDENTIFICACAO_SISTEMA': return substr_replace($line, $new_value, 108, 2); break;
            case 'SEQUENCIAL_REMESSA': return substr_replace($line, $new_value, 110, 7); break;
            case 'BRANCO_2': return substr_replace($line, $new_value, 117, 277); break;
            case 'SEQUENCIAL': return substr_replace($line, $new_value, 394, 6); break;
            default: return 'Coluna não aceita no replace remessa data: ' . $data;
        }

    }

    public function HeaderPadLine($data,$value)
    {

        $value = Common::cleanUp($value);
        $value = Common::removeExtraSpaces($value);

        $pad_replace = ' ';

        switch(strtoupper($data)){
            case 'REGISTRO': return str_pad($value, 1, '0', STR_PAD_LEFT); break;
            case 'IDENTIFICACAO': return str_pad($value, 1, '0', STR_PAD_LEFT); break;
            case 'REMESSA': return str_pad($value, 7, ' ', STR_PAD_RIGHT); break;
            case 'COD_SERVICO': return str_pad($value, 2, '0', STR_PAD_LEFT); break;
            case 'SERVICO': return str_pad($value, 15, ' ', STR_PAD_RIGHT); break;
            case 'CONVENIO': return str_pad($value, 20, '0', STR_PAD_LEFT); break;
            case 'NOME_EMPRESA': return str_pad($value, 30, ' ', STR_PAD_RIGHT); break;
            case 'COD_BANCO': return str_pad($value, 3, '0', STR_PAD_LEFT); break;
            case 'NOME_BANCO': return str_pad($value, 15, ' ', STR_PAD_RIGHT); break;
            case 'DATA_ARQUIVO': return str_pad($value, 6, '0', STR_PAD_LEFT); break;
            case 'BRANCO_1': return str_pad($value, 8, ' ', STR_PAD_RIGHT); break;
            case 'IDENTIFICACAO_SISTEMA': return str_pad($value, 2, ' ', STR_PAD_RIGHT); break;
            case 'SEQUENCIAL_REMESSA': return str_pad($value, 7, '0', STR_PAD_LEFT); break;
            case 'BRANCO_2': return str_pad($value, 277, ' ', STR_PAD_RIGHT); break;
            case 'SEQUENCIAL': return str_pad($value, 6, '0', STR_PAD_LEFT); break;
            default: return 'Coluna não aceita no extract remessa data: ' . $data;
        }
    }

}