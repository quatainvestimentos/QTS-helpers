<?php

namespace QuataInvestimentos\Bank\Singulare\Remittance;
use QuataInvestimentos\Bank\Singulare\Remittance;
use QuataInvestimentos\Bank\Common;

trait Footer {

    public function extractFrom($line,$data,$pad=true)
    {
        switch(strtoupper($data)){
            case 'REGISTRO': $value = substr($line, 0, 1); break;
            case 'BRANCO': $value = substr($line, 1, 437); break;
            case 'SEQUENCIAL': $value = substr($line, 438, 6); break;
            default: return 'Coluna não aceita no extract remessa data: '. $data;
        }

        if($pad){ return Remittance::padLine($data, $value); }
        return $value;

    }

    public function replaceOn($line,$data,$new_value)
    {
        switch(strtoupper($data)){
            case 'REGISTRO': return substr_replace($line, $new_value, 0, 1); break;
            case 'BRANCO': return substr_replace($line, $new_value, 1, 437); break;
            case 'SEQUENCIAL': return substr_replace($line, $new_value, 438, 6); break;
            default: return 'Coluna não aceita no replace remessa data: ' . $data;
        }

    }

    public function padLine($data,$value)
    {
           
        $value = Common::cleanUp($value);
        $value = Common::removeExtraSpaces($value);

        $pad_replace = ' ';

        switch(strtoupper($data)){
            case 'REGISTRO': return str_pad(substr($value, 0, 1), 1, '0', STR_PAD_LEFT); break;
            case 'BRANCO': return str_pad(substr($value, 0, 437), 437, ' ', STR_PAD_RIGHT); break;
            case 'SEQUENCIAL': return str_pad(substr($value, 0, 6), 6, '0', STR_PAD_LEFT); break;
            default: return 'Coluna não aceita no extract remessa data: ' . $data;
        }
    }

}