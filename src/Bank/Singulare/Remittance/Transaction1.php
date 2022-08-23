<?php

namespace QuataInvestimentos\Bank\Singulare\Remittance;
use QuataInvestimentos\Bank\Common;

trait Transaction1 {

    public function extractFrom($line,$data,$pad=true)
    {

        switch(strtoupper($data)){
            case 'REGISTRO': $value = substr($line, 0, 1); break;
            case 'DEBITO_AUTOMATICO': $value = substr($line, 1, 19); break;
            case 'COOBRIGACAO': $value = substr($line, 20, 2); break;
            case 'CARACTERISTICA': $value = substr($line, 22, 2); break;
            case 'MODALIDADE': $value = substr($line, 24, 4); break;
            case 'NATUREZA': $value = substr($line, 28, 2); break;
            case 'ORIGEM': $value = substr($line, 30, 4); break;
            case 'CLASSE_RISCO': $value = substr($line, 34, 2); break;
            case 'ZEROS_1': $value = substr($line, 36, 1); break;
            case 'NUM_CONTROLE_PARTICIPANTE': $value = substr($line, 37, 25); break;
            case 'NUM_BANCO': $value = substr($line, 62, 3); break;
            case 'ZEROS_2': $value = substr($line, 65, 5); break;
            case 'IDENTIFICACAO': $value = substr($line, 70, 11); break;
            case 'NOSSO_NUM_DV': $value = substr($line, 81, 1); break;
            case 'VALOR_PAGO': $value = substr($line, 82, 10); break;
            case 'EMISSAO_COBRANCA': $value = substr($line, 92, 1); break;
            case 'EMISSAO_DEBITO_AUTOMATICO': $value = substr($line, 93, 1); break;
            case 'LIQUIDACAO': $value = substr($line, 94, 6); break;
            case 'OPERACAO_BANCO': $value = substr($line, 100, 4); break;
            case 'RATEIO': $value = substr($line, 104, 1); break;
            case 'AVISO_DEBITO': $value = substr($line, 105, 1); break;
            case 'BRANCO': $value = substr($line, 106, 2); break;
            case 'OCORRENCIA': $value = substr($line, 108, 2); break;
            case 'NUM_DOCUMENTO': $value = substr($line, 110, 10); break;
            case 'VENCIMENTO': $value = substr($line, 120, 6); break;
            case 'VALOR': $value = substr($line, 126, 13); break;
            case 'COD_BANCO': $value = substr($line, 139, 3); break;
            case 'AGENCIA': $value = substr($line, 142, 5); break;
            case 'ESPECIE_TITULO': $value = substr($line, 147, 2); break;
            case 'IDENTIFICACAO_OPERACAO': $value = substr($line, 149, 1); break;
            case 'EMISSAO': $value = substr($line, 150, 6); break;
            case 'INSTRUCAO_1': $value = substr($line, 156, 2); break;
            case 'INSTRUCAO_2': $value = substr($line, 158, 1); break;
            case 'TIPO_INSCRICAO': $value = substr($line, 159, 2); break;
            case 'ZEROS_2': $value = substr($line, 161, 11); break;
            case 'NUM_TERMO_CESSAO': $value = substr($line, 173, 19); break;
            case 'VALOR_PARCELA': $value = substr($line, 192, 13); break;
            case 'VALOR_ABATIMENTO': $value = substr($line, 205, 13); break;
            case 'IDENTIFICACAO_TIPO_INSCRICAO': $value = substr($line, 218, 2); break;
            case 'SACADO_INSCRICAO': $value = substr($line, 220, 14); break;
            case 'SACADO_NOME': $value = substr($line, 234, 40); break;
            case 'SACADO_ENDERECO': $value = substr($line, 274, 40); break;
            case 'NFE_NUMERO': $value = substr($line, 314, 9); break;
            case 'NFE_SERIE': $value = substr($line, 323, 3); break;
            case 'SACADO_CEP': $value = substr($line, 326, 8); break;
            case 'CEDENTE': $value = substr($line, 334, 60); break;
            case 'NFE': $value = substr($line, 394, 44); break;
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
            case 'DEBITO_AUTOMATICO': return substr_replace($line, $new_value, 1, 19); break;
            case 'COOBRIGACAO': return substr_replace($line, $new_value, 20, 2); break;
            case 'CARACTERISTICA': return substr_replace($line, $new_value, 22, 2); break;
            case 'MODALIDADE': return substr_replace($line, $new_value, 24, 4); break;
            case 'NATUREZA': return substr_replace($line, $new_value, 28, 2); break;
            case 'ORIGEM': return substr_replace($line, $new_value, 30, 4); break;
            case 'CLASSE_RISCO': return substr_replace($line, $new_value, 34, 2); break;
            case 'ZEROS_1': return substr_replace($line, $new_value, 36, 1); break;
            case 'NUM_CONTROLE_PARTICIPANTE': return substr_replace($line, $new_value, 37, 25); break;
            case 'NUM_BANCO': return substr_replace($line, $new_value, 62, 3); break;
            case 'ZEROS_2': return substr_replace($line, $new_value, 65, 5); break;
            case 'IDENTIFICACAO': return substr_replace($line, $new_value, 70, 11); break;
            case 'NOSSO_NUM_DV': return substr_replace($line, $new_value, 81, 1); break;
            case 'VALOR_PAGO': return substr_replace($line, $new_value, 82, 10); break;
            case 'EMISSAO_COBRANCA': return substr_replace($line, $new_value, 92, 1); break;
            case 'EMISSAO_DEBITO_AUTOMATICO': return substr_replace($line, $new_value, 93, 1); break;
            case 'LIQUIDACAO': return substr_replace($line, $new_value, 95, 6); break;
            case 'OPERACAO_BANCO': return substr_replace($line, $new_value, 100, 4); break;
            case 'RATEIO': return substr_replace($line, $new_value, 104, 1); break;
            case 'AVISO_DEBITO': return substr_replace($line, $new_value, 105, 1); break;
            case 'BRANCO': return substr_replace($line, $new_value, 106, 2); break;
            case 'OCORRENCIA': return substr_replace($line, $new_value, 108, 2); break;
            case 'NUM_DOCUMENTO': return substr_replace($line, $new_value, 110, 10); break;
            case 'VENCIMENTO': return substr_replace($line, $new_value, 120, 6); break;
            case 'VALOR': return substr_replace($line, $new_value, 126, 13); break;
            case 'COD_BANCO': return substr_replace($line, $new_value, 139, 3); break;
            case 'AGENCIA': return substr_replace($line, $new_value, 142, 5); break;
            case 'ESPECIE_TITULO': return substr_replace($line, $new_value, 147, 2); break;
            case 'IDENTIFICACAO_OPERACAO': return substr_replace($line, $new_value, 149, 1); break;
            case 'EMISSAO': return substr_replace($line, $new_value, 150, 6); break;
            case 'INSTRUCAO_1': return substr_replace($line, $new_value, 156, 2); break;
            case 'INSTRUCAO_2': return substr_replace($line, $new_value, 158, 1); break;
            case 'TIPO_INSCRICAO': return substr_replace($line, $new_value, 159, 2); break;
            case 'ZEROS_2': return substr_replace($line, $new_value, 161, 11); break;
            case 'NUM_TERMO_CESSAO': return substr_replace($line, $new_value, 173, 19); break;
            case 'VALOR_PARCELA': return substr_replace($line, $new_value, 192, 13); break;
            case 'VALOR_ABATIMENTO': return substr_replace($line, $new_value, 205, 13); break;
            case 'IDENTIFICACAO_TIPO_INSCRICAO': return substr_replace($line, $new_value, 218, 2); break;
            case 'SACADO_INSCRICAO': return substr_replace($line, $new_value, 220, 14); break;
            case 'SACADO_NOME': return substr_replace($line, $new_value,  234, 40); break;
            case 'SACADO_ENDERECO': return substr_replace($line, $new_value, 274, 40); break;
            case 'NFE_NUMERO': return substr_replace($line, $new_value, 314, 9); break;
            case 'NFE_SERIE': return substr_replace($line, $new_value, 323, 3); break;
            case 'SACADO_CEP': return substr_replace($line, $new_value, 326, 8); break;
            case 'CEDENTE': return substr_replace($line, $new_value, 334, 60); break;
            case 'NFE': return substr_replace($line, $new_value, 394, 44); break;
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
            case 'DEBITO_AUTOMATICO': return str_pad(substr($value, 0, 19), 19, ' ', STR_PAD_RIGHT); break;
            case 'COOBRIGACAO': return str_pad(substr($value, 0, 2), 2, '0', STR_PAD_LEFT); break;
            case 'CARACTERISTICA': return str_pad(substr($value, 0, 2), 2, '0', STR_PAD_LEFT); break;
            case 'MODALIDADE': return str_pad(substr($value, 0, 4), 4, '0', STR_PAD_LEFT); break;
            case 'NATUREZA': return str_pad(substr($value, 0, 2), 2, '0', STR_PAD_LEFT); break;
            case 'ORIGEM': return str_pad(substr($value, 0, 4), 4, '0', STR_PAD_LEFT); break;
            case 'CLASSE_RISCO': return str_pad(substr($value, 0, 2), 2, ' ', STR_PAD_RIGHT); break;
            case 'ZEROS_1': return str_pad(substr($value, 0, 1), 1, '0', STR_PAD_LEFT); break;
            case 'NUM_CONTROLE_PARTICIPANTE': return str_pad(substr($value, 0, 25), 25, ' ', STR_PAD_RIGHT); break;
            case 'NUM_BANCO': return str_pad(substr($value, 0, 3), 3, '0', STR_PAD_LEFT); break;
            case 'ZEROS_2': return str_pad(substr($value, 0, 5), 5, '0', STR_PAD_LEFT); break;
            case 'IDENTIFICACAO': return str_pad(substr($value, 0, 11), 11, '0', STR_PAD_LEFT); break;
            case 'NOSSO_NUM_DV': return str_pad(substr($value, 0, 1), 1, ' ', STR_PAD_RIGHT); break;
            case 'VALOR_PAGO': return str_pad(substr($value, 0, 10), 10, '0', STR_PAD_LEFT); break;
            case 'EMISSAO_COBRANCA': return str_pad(substr($value, 0, 1), 1, '0', STR_PAD_LEFT); break;
            case 'EMISSAO_DEBITO_AUTOMATICO': return str_pad(substr($value, 0, 1), 1, ' ', STR_PAD_RIGHT); break;
            case 'LIQUIDACAO': return str_pad(substr($value, 0, 6), 6, '0', STR_PAD_LEFT); break;
            case 'OPERACAO_BANCO': return str_pad(substr($value, 0, 4), 4, ' ', STR_PAD_RIGHT); break;
            case 'RATEIO': return str_pad(substr($value, 0, 1), 1, ' ', STR_PAD_RIGHT); break;
            case 'AVISO_DEBITO': return str_pad(substr($value, 0, 1), 1, '0', STR_PAD_LEFT); break;
            case 'BRANCO': return str_pad(substr($value, 0, 2), 2, ' ', STR_PAD_RIGHT); break;
            case 'OCORRENCIA': return str_pad(substr($value, 0, 2), 2, '0', STR_PAD_LEFT); break;
            case 'NUM_DOCUMENTO': return str_pad(substr($value, 0, 10), 10, ' ', STR_PAD_RIGHT); break;
            case 'VENCIMENTO': return str_pad(substr($value, 0, 6), 6, '0', STR_PAD_LEFT); break;
            case 'VALOR': return str_pad(substr($value, 0, 13), 13, '0', STR_PAD_LEFT); break;
            case 'COD_BANCO': return str_pad(substr($value, 0, 3), 3, '0', STR_PAD_LEFT); break;
            case 'AGENCIA': return str_pad(substr($value, 0, 5), 5, '0', STR_PAD_LEFT); break;
            case 'ESPECIE_TITULO': return str_pad(substr($value, 0, 2), 2, '0', STR_PAD_LEFT); break;
            case 'IDENTIFICACAO_OPERACAO': return str_pad(substr($value, 0, 1), 1, ' ', STR_PAD_RIGHT); break;
            case 'EMISSAO': return str_pad(substr($value, 0, 6), 6, '0', STR_PAD_LEFT); break;
            case 'INSTRUCAO_1': return str_pad(substr($value, 0, 2), 2, '0', STR_PAD_LEFT); break;
            case 'INSTRUCAO_2':return str_pad(substr($value, 0, 1), 1, '0', STR_PAD_LEFT); break;
            case 'TIPO_INSCRICAO': return str_pad(substr($value, 0, 2), 2, ' ', STR_PAD_RIGHT); break;
            case 'ZEROS_2': return str_pad(substr($value, 0, 11), 11, ' ', STR_PAD_RIGHT); break;
            case 'NUM_TERMO_CESSAO': return str_pad(substr($value, 0, 19), 19, ' ', STR_PAD_RIGHT); break;
            case 'VALOR_PARCELA': return str_pad(substr($value, 0, 13), 13, '0', STR_PAD_LEFT); break;
            case 'VALOR_ABATIMENTO': return str_pad(substr($value, 0, 13), 13, '0', STR_PAD_LEFT); break;
            case 'IDENTIFICACAO_TIPO_INSCRICAO': return str_pad(substr($value, 0, 2), 2, '0', STR_PAD_LEFT); break;
            case 'SACADO_INSCRICAO': return str_pad(substr($value, 0, 14), 14, '0', STR_PAD_LEFT); break;
            case 'SACADO_NOME': return str_pad(substr($value, 0, 40), 40, ' ', STR_PAD_RIGHT); break;
            case 'SACADO_ENDERECO': return str_pad(substr($value, 0, 40), 40, ' ', STR_PAD_RIGHT); break;
            case 'NFE_NUMERO': return str_pad(substr($value, 0, 9), 9, ' ', STR_PAD_RIGHT); break;
            case 'NFE_SERIE': return str_pad(substr($value, 0, 3), 3, ' ', STR_PAD_RIGHT); break;
            case 'SACADO_CEP': return str_pad(substr($value, 0, 8), 8, '0', STR_PAD_LEFT); break;
            case 'CEDENTE': return str_pad(substr($value, 0, 60), 60, ' ', STR_PAD_RIGHT); break;
            case 'NFE': return str_pad(substr($value, 0, 44), 44, ' ', STR_PAD_RIGHT); break;
            case 'SEQUENCIAL':return str_pad(substr($value, 0, 6), 6, '0', STR_PAD_LEFT); break;
            default: return 'Coluna não aceita no extract remessa data: ' . $data;
        }
    }

}