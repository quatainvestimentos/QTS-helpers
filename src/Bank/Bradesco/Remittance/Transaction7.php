<?php

namespace QuataInvestimentos\Bank\Bradesco\Remittance;
use QuataInvestimentos\Bank\Common;

trait Transaction7 {

    public function extractTransaction7From($line,$data,$pad=true)
    {

        switch(strtoupper($data)){
            case 'REGISTRO': $value = substr($line, 0, 1); break;
            case 'ENDERECO_BENEFICIARIO': $value = substr($line, 1, 45); break;
            case 'SACADO_CEP_PREFIXO': $value = substr($line, 46, 5); break;
            case 'SACADO_CEP_SUFIXO': $value = substr($line, 51, 3); break;
            case 'SACADO_CIDADE': $value = substr($line, 54, 20); break;
            case 'SACADO_UF': $value = substr($line, 74, 2); break;

            case 'RESERVA': $value = substr($line, 76, 290); break;
            case 'CARTEIRA': $value = substr($line, 366, 3); break;
            case 'AGENCIA': $value = substr($line, 369, 5); break;
            case 'CONTA_CORRENTE': $value = substr($line, 374, 7); break;
            case 'CONTA_CORRENTE_DV': $value = substr($line, 381, 1); break;

            case 'NOSSO_NUM': $value = substr($line, 382, 11); break;
            case 'NOSSO_NUM_DV': $value = substr($line, 393, 1); break;
            case 'SEQUENCIAL': $value = substr($line, 394, 6); break;
            
            default: return 'Coluna não aceita no extract remessa data: '. $data;
        }

        if($pad){ return Remittance::padLine($data, $value); }
        return $value;

    }

    public function transaction7Help()
    {
        $data = [
            'CNAB' => 'BRADESCO',
            'TYPE' => 'TYPE7',
            'REGISTRO' => [ 
                'position_from' => '001',
                'position_to' => '001',
                'size' => '001',
                'content' => '7',
                'type' => 'Numérico',
            ],
            'ENDERECO_BENEFICIARIO' => [ 
                'position_from' => '002',
                'position_to' => '046',
                'size' => '045',
                'content' => 'Endereço Sacador/Avalista',
                'type' => 'Alfanumérico',
            ],
            'SACADO_CEP_PREFIXO' => [ 
                'position_from' => '047',
                'position_to' => '051',
                'size' => '005',
                'content' => 'CEP',
                'type' => 'Numérico',
            ],
            'SACADO_CEP_SUFIXO' => [ 
                'position_from' => '052',
                'position_to' => '054',
                'size' => '003',
                'content' => 'Sufixo CEP',
                'type' => 'Numérico',
            ],
            'SACADO_CIDADE' => [ 
                'position_from' => '055',
                'position_to' => '074',
                'size' => '020',
                'content' => 'Cidade',
                'type' => 'Alfanumérico',
            ],
            'SACADO_UF' => [ 
                'position_from' => '075',
                'position_to' => '076',
                'size' => '002',
                'content' => 'UF',
                'type' => 'Alfanumérico',
            ],
            'RESERVA' => [ 
                'position_from' => '077',
                'position_to' => '366',
                'size' => '290',
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
                'content' => 'DAC C/C',
                'type' => 'Numérico',
            ],
            'CONTA_CORRENTE' => [ 
                'position_from' => '375',
                'position_to' => '381',
                'size' => '007',
                'content' => 'Nº da Conta Corrente',
                'type' => 'Numérico',
            ],
            'CONTA_CORRENTE_DV' => [ 
                'position_from' => '382',
                'position_to' => '382',
                'size' => '001',
                'content' => 'DAC C/C',
                'type' => 'Alfanumérico',
            ],
            'NOSSO_NUM' => [ 
                'position_from' => '383',
                'position_to' => '393',
                'size' => '011',
                'content' => 'Número Bancário',
                'type' => 'Numérico',
            ],
            'NOSSO_NUM_DV' => [ 
                'position_from' => '394',
                'position_to' => '394',
                'size' => '001',
                'content' => 'Dígito N/N',
                'type' => 'Alfanumérico',
            ],
            'SEQUENCIAL' => [ 
                'position_from' => '395',
                'position_to' => '400',
                'size' => '006',
                'content' => 'Nº Seqüencial de Registro',
                'type' => 'Numérico',
                ]
        ];
        return $data;
    }

    public function transaction7ReplaceOn($line,$data,$new_value)
    {

        switch(strtoupper($data)){

            case 'REGISTRO': return substr_replace($line, $new_value, 0, 1); break;
            case 'ENDERECO_BENEFICIARIO': return substr_replace($line, $new_value, 1, 45); break;
            case 'SACADO_CEP_PREFIXO': return substr_replace($line, $new_value, 46, 5); break;
            case 'SACADO_CEP_SUFIXO': return substr_replace($line, $new_value, 51, 3); break;
            case 'SACADO_CIDADE': return substr_replace($line, $new_value, 54, 20); break;
            case 'SACADO_UF': return substr_replace($line, $new_value, 74, 2); break;

            case 'RESERVA': return substr_replace($line, $new_value, 76, 290); break;
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

    public function transaction7PadLine($data,$value)
    {

        $value = Common::cleanUp($value);
        $value = Common::removeExtraSpaces($value);

        $pad_replace = ' ';

        switch(strtoupper($data)){

            case 'REGISTRO': return str_pad($value, 1, '7', STR_PAD_LEFT); break;
            case 'ENDERECO_BENEFICIARIO': return str_pad($value, 45, $pad_replace, STR_PAD_RIGHT); break;
            case 'SACADO_CEP_PREFIXO': return str_pad($value, 5, '0', STR_PAD_LEFT); break;
            case 'SACADO_CEP_SUFIXO': return str_pad($value, 3, '0', STR_PAD_LEFT); break;
            case 'SACADO_CIDADE': return str_pad($value, 20, $pad_replace, STR_PAD_RIGHT); break;
            case 'SACADO_UF': return str_pad($value, 2, $pad_replace, STR_PAD_RIGHT); break;

            case 'RESERVA': return str_pad($value, 290, $pad_replace, STR_PAD_RIGHT); break;
            case 'CARTEIRA': return str_pad($value, 3, '0', STR_PAD_LEFT); break;
            case 'AGENCIA': return str_pad($value, 5, '0', STR_PAD_LEFT); break;
            case 'CONTA_CORRENTE': return str_pad($value, 7, '0', STR_PAD_LEFT); break;
            case 'CONTA_CORRENTE_DV': return str_pad($value, 1, $pad_replace, STR_PAD_RIGHT); break;

            case 'NOSSO_NUM': return str_pad($value, 11, '0', STR_PAD_LEFT); break;
            case 'NOSSO_NUM_DV': return str_pad($value, 1, $pad_replace, STR_PAD_RIGHT); break;
            case 'SEQUENCIAL': return str_pad($value, 6, '0', STR_PAD_LEFT); break;

            default: return 'Coluna não aceita no extract remessa data: ' . $data;
        }
    }

}