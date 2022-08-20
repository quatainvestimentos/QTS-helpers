<?php

namespace QuataInvestimentos\Bank\Bradesco\Remittance;

use QuataInvestimentos\Bank\Bradesco\Remittance;
use QuataInvestimentos\Bank\Common;

trait Footer {

    public function extractFooterFrom($line,$data,$pad=true)
    {

        switch(strtoupper($data)){
            case 'REGISTRO': $value = substr($line, 0, 1); break;
            case 'BANCO': $value = substr($line, 1, 393); break;
            case 'SEQUENCIAL': $value = substr($line, 394, 6); break;
            
            default: return 'Coluna não aceita no extract remessa data: '. $data;
        }

        if($pad){ return Remittance::padLine($data, $value); }
        return $value;

    }

    public function footerHelp()
    {
        $data = [
            'CNAB' => 'BRADESCO',
            'TYPE' => 'FOOTER',
            'REGISTRO' => [ 
                'position_from' => '001',
                'position_to' => '001',
                'size' => '001',
                'content' => '9',
                'type' => 'Numérico',
            ],
            'BRANCO' => [ 
                'position_from' => '002',
                'position_to' => '394',
                'size' => '393',
                'content' => 'Branco',
                'type' => 'Alfanumérico',
            ],
            'SEQUENCIAL' => [ 
                'position_from' => '395',
                'position_to' => '400',
                'size' => '006',
                'content' => 'Nº Seqüencial do Último Registro',
                'type' => 'Numérico',
            ],

        ];
        return $data;
    }

    public function footerReplaceOn($line,$data,$new_value)
    {

        switch(strtoupper($data)){

            case 'REGISTRO': return substr_replace($line, $new_value, 0, 1); break;
            case 'BRANCO': return substr_replace($line, $new_value, 1, 393); break;
            case 'SEQUENCIAL': return substr_replace($line, $new_value, 394, 6); break;

            default: return 'Coluna não aceita no replace remessa data: ' . $data;
        }

    }

    public function footerPadLine($data,$value)
    {

        $value = Common::cleanUp($value);
        $value = Common::removeExtraSpaces($value);

        $pad_replace = ' ';

        switch(strtoupper($data)){

            case 'REGISTRO': return str_pad($value, 1, '0', STR_PAD_LEFT); break;
            case 'BRANCO': return str_pad($value, 393, $pad_replace, STR_PAD_RIGHT); break;
            case 'SEQUENCIAL': return str_pad($value, 6, '0', STR_PAD_LEFT); break;

            default: return 'Coluna não aceita no extract remessa data: ' . $data;
        }
    }

}