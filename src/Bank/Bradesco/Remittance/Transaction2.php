<?php

namespace QuataInvestimentos\Bank\Bradesco\Remittance;

trait Transaction2 {

    public function extractFrom($line,$data,$pad=true)
    {

        switch(strtoupper($data)){
            case 'REGISTRO': $value = substr($line, 0, 1); break;
            case 'MENSAGEM_1': $value = substr($line, 1, 80); break;
            case 'MENSAGEM_2': $value = substr($line, 81, 80); break;
            case 'MENSAGEM_3': $value = substr($line, 161, 80); break;
            case 'MENSAGEM_4': $value = substr($line, 241, 80); break;
            case 'DATA_LIMITE_DESCONTO': $value = substr($line, 321, 6); break;
            case 'VALOR_DESCONTO': $value = substr($line, 327, 13); break;
            case 'DATA_LIMITE_DESCONTO_2': $value = substr($line, 340, 6); break;
            case 'VALOR_DESCONTO_2': $value = substr($line, 346, 13); break;
            case 'RESERVA': $value = substr($line, 359, 7); break;
            case 'CARTEIRA': $value = substr($line, 366, 3); break;
            case 'AGENCIA': $value = substr($line, 369, 5); break;
            case 'CONTA_CORRENTE': $value = substr($line, 374, 7); break;
            case 'CONTA_CORRENTE_DV': $value = substr($line, 381, 1); break;
            case 'NOSSO_NUM': $value = substr($line, 382, 11); break;
            case 'NOSSO_NUM_DV': $value = substr($line, 393, 1); break;
            case 'SEQUENCIAL': $value = substr($line, 394, 6); break;
            
            default: return 'Coluna não aceita no extract remessa data: '. $data;
        }

        /**
         * Por regras do banco, data_limite_desconto e valor_desconto
         * não podem ser vazios, tem que ser preenchidos com zero
         */

        $check_required_fields = false;

        switch(strtoupper($data)){
            case 'DATA_LIMITE_DESCONTO':
            case 'VALOR_DESCONTO':
            case 'DATA_LIMITE_DESCONTO_2':
            case 'VALOR_DESCONTO_2': 
                $check_required_fields = true;
                break;
        }

        if($check_required_fields){
            $value = (int)$value;
            if(!$value){ $value = (string)$this->padLine($data, $value); }
        }

        if($pad){ return $this->padLine($data, $value); }
        return $value;

    }

    public function help(){
        $data = [
            'CNAB' => 'BRADESCO',
            'TYPE' => 'TIPO2',
            'REGISTRO' => [ 
                'position_from' => '001',
                'position_to' => '001',
                'size' => '001',
                'content' => 'Fixo “3”',
                'type' => 'Numérico',
            ],
            'MENSAGEM_1' => [ 
                'position_from' => '002',
                'position_to' => '081',
                'size' => '080',
                'content' => 'Mensagem',
                'type' => 'Alfanumérico',
            ],
            'MENSAGEM_2' => [ 
                'position_from' => '082',
                'position_to' => '161',
                'size' => '080',
                'content' => 'Mensagem',
                'type' => 'Alfanumérico',
            ],
            'MENSAGEM_3' => [ 
                'position_from' => '162',
                'position_to' => '241',
                'size' => '080',
                'content' => 'Mensagem',
                'type' => 'Alfanumérico',
            ],
            'MENSAGEM_4' => [ 
                'position_from' => '242',
                'position_to' => '321',
                'size' => '080',
                'content' => 'Mensagem',
                'type' => 'Alfanumérico',
            ],
            'DATA_LIMITE_DESCONTO_2' => [ 
                'position_from' => '322',
                'position_to' => '327',
                'size' => '006',
                'content' => 'DDMMAA',
                'type' => 'Numérico',
            ],
            'VALOR_DESCONTO_1' => [ 
                'position_from' => '328',
                'position_to' => '340',
                'size' => '013',
                'content' => 'Valor Desconto',
                'type' => 'Numérico',
            ],
            'DATA_LIMITE_DESCONTO_3' => [ 
                'position_from' => '341',
                'position_to' => '346',
                'size' => '006',
                'content' => 'DDMMAA',
                'type' => 'Numérico',
            ],
            'VALOR_DESCONTO_2' => [ 
                'position_from' => '347',
                'position_to' => '359',
                'size' => '013',
                'content' => 'Valor do Desconto',
                'type' => 'Numérico',
            ],
            'RESERVA' => [ 
                'position_from' => '360',
                'position_to' => '366',
                'size' => '007',
                'content' => 'Filler',
                'type' => 'Alfanumérico',
            ],
            'CARTEIRA' => [ 
                'position_from' => '367',
                'position_to' => '369',
                'size' => '003',
                'content' => 'Nº da Carteira',
                'type' => 'Numérico',
            ],
            'AGENCIA' => [ 
                'position_from' => '370',
                'position_to' => '374',
                'size' => '005',
                'content' => 'Código da Agência Beneficiário',
                'type' => 'Numérico',
            ],
            'CONTA-CORRENTE' => [ 
                'position_from' => '375',
                'position_to' => '381',
                'size' => '007',
                'content' => 'Nº da Conta-Corrente',
                'type' => 'Numérico',
            ],
            'DIGITO' => [ 
                'position_from' => '382',
                'position_to' => '382',
                'size' => '001',
                'content' => 'DAC C/C',
                'type' => 'Alfanumérico',
            ],
            'NOSSO_NUMERO' => [ 
                'position_from' => '383',
                'position_to' => '393',
                'size' => '011',
                'content' => 'Número Bancário Vide Obs. Pág. 22',
                'type' => 'Numérico',
            ],
            'DAC_NOSSO_NUMERO' => [ 
                'position_from' => '394',
                'position_to' => '394',
                'size' => '001',
                'content' => 'Dígito Vide Obs. Pág. 22',
                'type' => 'Alfanumérico',
            ],
            'SEQUENCIAL' => [ 
                'position_from' => '395',
                'position_to' => '400',
                'size' => '006',
                'content' => 'Nº Sequencial de Registro',
                'type' => 'Numérico',
            ]
        ];
        return $data;
    }

    public function replaceOn($line,$data,$new_value)
    {

        switch(strtoupper($data)){

            case 'REGISTRO': return substr_replace($line, $new_value, 0, 1); break;
            case 'MENSAGEM_1': return substr_replace($line, $new_value, 1, 80); break;
            case 'MENSAGEM_2': return substr_replace($line, $new_value, 81, 80); break;
            case 'MENSAGEM_3': return substr_replace($line, $new_value, 161, 80); break;
            case 'MENSAGEM_4': return substr_replace($line, $new_value, 241, 80); break;
            case 'DATA_LIMITE_DESCONTO': return substr_replace($line, $new_value, 321, 6); break;
            case 'VALOR_DESCONTO': return substr_replace($line, $new_value, 327, 13); break;
            case 'DATA_LIMITE_DESCONTO_2': return substr_replace($line, $new_value, 340, 6); break;
            case 'VALOR_DESCONTO_2': return substr_replace($line, $new_value, 346, 13); break;
            case 'RESERVA': return substr_replace($line, $new_value, 359, 7); break;
            case 'CARTEIRA': return substr_replace($line, $new_value, 366, 3); break;
            case 'AGENCIA': return substr_replace($line, $new_value, 369, 5); break;
            case 'CONTA_CORRENTE': return substr_replace($line, $new_value, 374, 7); break;
            case 'CONTA_CORRENTE_DV': return substr_replace($line, $new_value, 381, 1); break;
            case 'NOSSO_NUM': return substr_replace($line, $new_value, 382, 11); break;
            case 'NOSSO_NUM_DV': return substr_replace($line, $new_value, 393, 1); break;
            case 'SEQUENCIAL': return substr_replace($line, $new_value, 394, 6); break;

            default: return 'Coluna não aceita no replace remessa data: ' . $data;
        }

    }

    public function padLine($data,$value)
    {

        $value = $this->cleanUp($value);
        $value = $this->removeExtraSpaces($value);

        $pad_replace = ' ';

        switch(strtoupper($data)){

            case 'REGISTRO': return str_pad($value, 1, '2', STR_PAD_LEFT); break;
            case 'MENSAGEM_1': return str_pad($value, 80, $pad_replace, STR_PAD_RIGHT); break;
            case 'MENSAGEM_2': return str_pad($value, 80, $pad_replace, STR_PAD_RIGHT); break;
            case 'MENSAGEM_3': return str_pad($value, 80, $pad_replace, STR_PAD_RIGHT); break;
            case 'MENSAGEM_4': return str_pad($value, 80, $pad_replace, STR_PAD_RIGHT); break;
            case 'DATA_LIMITE_DESCONTO': return str_pad($value, 6, '0', STR_PAD_LEFT); break;
            case 'VALOR_DESCONTO': return str_pad($value, 13, '0', STR_PAD_LEFT); break;
            case 'DATA_LIMITE_DESCONTO_2': return str_pad($value, 6, '0', STR_PAD_LEFT); break;
            case 'VALOR_DESCONTO_2': return str_pad($value, 13, '0', STR_PAD_LEFT); break;
            case 'RESERVA': return str_pad($value, 7, $pad_replace, STR_PAD_RIGHT); break;
            case 'CARTEIRA': return str_pad($value, 3, '0', STR_PAD_LEFT); break;
            case 'AGENCIA': return str_pad($value, 5, '0', STR_PAD_LEFT); break;
            case 'CONTA_CORRENTE': return str_pad($value, 7, '0', STR_PAD_LEFT); break;
            case 'CONTA_CORRENTE_DV': return str_pad($value, 1, '0', STR_PAD_LEFT); break;
            case 'NOSSO_NUM': return str_pad($value, 11, '0', STR_PAD_LEFT); break;
            case 'NOSSO_NUM_DV': return str_pad($value, 1, '0', STR_PAD_LEFT); break;
            case 'SEQUENCIAL': return str_pad($value, 6, '0', STR_PAD_LEFT); break;

            default: return 'Coluna não aceita no extract remessa data: ' . $data;
        }
    }

}