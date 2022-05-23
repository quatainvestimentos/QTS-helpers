<?php

namespace QuataInvestimentos\Bank\Singulare;

trait Header {

    public function extractFrom($line,$data,$pad=true)
    {

        switch(strtoupper($data)){
            case 'REGISTRO': $value = substr($line, 0, 1); break;
            case 'IDENTIFICACAO': $value = substr($line, 1, 1); break;
            case 'REMESSA': $value = substr($line, 2, 7); break;
            case 'COD_SERVICO': $value = substr($line, 9, 2); break;
            case 'SERVICO': $value = substr($line, 11, 15); break;
            case 'CONVENIO_CONSULTORIA': $value = substr($line, 26, 20); break;
            case 'NOME_CONSULTORIA': $value = substr($line, 46, 30); break;
            case 'COD_BANCO_CONSULTORIA': $value = substr($line, 76, 3); break;
            case 'NOME_BANCO_CONSULTORIA': $value = substr($line, 79, 15); break;
            case 'DATA_ARQUIVO': $value = substr($line, 94, 6); break;
            case 'BRANCO_1': $value = substr($line, 100, 8); break;
            case 'IDENTIFICACAO_SISTEMA': $value = substr($line, 108, 2); break;
            case 'SEQUENCIAL_REMESSA': $value = substr($line, 110, 7); break;
            case 'BRANCO_2': $value = substr($line, 117, 2); break;
            case 'RETENCAO': $value = substr($line, 119, 10); break;
            case 'COD_BANCO': $value = substr($line, 129, 3); break;
            case 'AGENCIA': $value = substr($line, 132, 4); break;
            case 'CONTA_CORRENTE': $value = substr($line, 136, 14); break;
            case 'BRANCO_3': $value = substr($line, 150, 288); break;
            case 'SEQUENCIAL': $value = substr($line, 438, 6); break;
            default: return 'Coluna não aceita no extract remessa data: '. $data;
        }

        if($pad){ return $this->padLine($data, $value); }
        return $value;

    }

    public function replaceOn($line,$data,$new_value)
    {
        switch(strtoupper($data)){
            case 'REGISTRO': return substr_replace($line, $new_value, 0, 1); break;
            case 'IDENTIFICACAO': return substr_replace($line, $new_value, 1, 1); break;
            case 'REMESSA': return substr_replace($line, $new_value, 2, 7); break;
            case 'COD_SERVICO': return substr_replace($line, $new_value, 9, 2); break;
            case 'SERVICO': return substr_replace($line, $new_value, 11, 15); break;
            case 'CONVENIO_CONSULTORIA': return substr_replace($line, $new_value, 26, 20); break;
            case 'NOME_CONSULTORIA': return substr_replace($line, $new_value, 46, 30); break;
            case 'COD_BANCO_CONSULTORIA': return substr_replace($line, $new_value, 76, 3); break;
            case 'NOME_BANCO_CONSULTORIA': return substr_replace($line, $new_value, 79, 15); break;
            case 'DATA_ARQUIVO': return substr_replace($line, $new_value, 94, 6); break;
            case 'BRANCO_1': return substr_replace($line, $new_value, 100, 8); break;
            case 'IDENTIFICACAO_SISTEMA': return substr_replace($line, $new_value, 108, 2); break;
            case 'SEQUENCIAL_REMESSA': return substr_replace($line, $new_value, 110, 7); break;
            case 'BRANCO_2': return substr_replace($line, $new_value, 117, 2); break;
            case 'RETENCAO': return substr_replace($line, $new_value, 119, 10); break;
            case 'COD_BANCO': return substr_replace($line, $new_value, 129, 3); break;
            case 'AGENCIA': return substr_replace($line, $new_value, 132, 4); break;
            case 'CONTA_CORRENTE': return substr_replace($line, $new_value, 136, 14); break;
            case 'BRANCO_3': return substr_replace($line, $new_value, 150, 288); break;
            case 'SEQUENCIAL': return substr_replace($line, $new_value, 438, 6); break;
            default: return 'Coluna não aceita no replace remessa data: ' . $data;
        }

    }

    public function padLine($data,$value)
    {
           
        $value = $this->cleanUp($value);
        $value = $this->removeExtraSpaces($value);

        $pad_replace = ' ';

        switch(strtoupper($data)){
            case 'REGISTRO': return str_pad($value, 1, '0', STR_PAD_LEFT); break;
            case 'IDENTIFICACAO': return str_pad($value, 1, '0', STR_PAD_LEFT); break;
            case 'REMESSA': return str_pad($value, 7, ' ', STR_PAD_RIGHT); break;
            case 'COD_SERVICO': return str_pad($value, 2, '0', STR_PAD_LEFT); break;
            case 'SERVICO': return str_pad($value, 15, ' ', STR_PAD_RIGHT); break;
            case 'CONVENIO_CONSULTORIA': return str_pad($value, 20, '0', STR_PAD_LEFT); break;
            case 'NOME_CONSULTORIA': return str_pad($value, 30, ' ', STR_PAD_RIGHT); break;
            case 'COD_BANCO_CONSULTORIA': return str_pad($value, 3, '0', STR_PAD_LEFT); break;
            case 'NOME_BANCO_CONSULTORIA': return str_pad($value, 15, ' ', STR_PAD_RIGHT); break;
            case 'DATA_ARQUIVO': return str_pad($value, 6, '0', STR_PAD_LEFT); break;
            case 'BRANCO_1': return str_pad($value, 8, ' ', STR_PAD_RIGHT); break;
            case 'IDENTIFICACAO_SISTEMA': return str_pad($value, 2, ' ', STR_PAD_RIGHT); break;
            case 'SEQUENCIAL_REMESSA': return str_pad($value, 7, '0', STR_PAD_LEFT); break;
            case 'BRANCO_2': return str_pad($value, 2, ' ', STR_PAD_RIGHT); break;
            case 'RETENCAO': return str_pad($value, 10, '0', STR_PAD_LEFT); break;
            case 'COD_BANCO': return str_pad($value, 3, '0', STR_PAD_LEFT); break;
            case 'AGENCIA':return str_pad($value, 4, '0', STR_PAD_LEFT); break;
            case 'CONTA_CORRENTE': return str_pad($value, 14, '0', STR_PAD_LEFT); break;
            case 'BRANCO_3': return str_pad($value, 288, ' ', STR_PAD_RIGHT); break;
            case 'SEQUENCIAL': return str_pad($value, 6, '0', STR_PAD_LEFT); break;
            default: return 'Coluna não aceita no extract remessa data: ' . $data;
        }
    }

}