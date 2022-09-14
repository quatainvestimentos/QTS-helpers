<?php

namespace QuataInvestimentos\Bank\Bradesco\Remittance;
use QuataInvestimentos\Bank\Bradesco\Remittance;
use QuataInvestimentos\Bank\Common;

trait Transaction6 {

    public function extractTransaction6From($line,$data,$pad=true)
    {

        switch(strtoupper($data)){
            case 'REGISTRO': $value = substr($line, 0, 1); break;
            case 'CARTEIRA': $value = substr($line, 1, 3); break;
            case 'AGENCIA': $value = substr($line, 4, 5); break;
            case 'CONTA_CORRENTE': $value = substr($line, 9, 7); break;
            case 'NOSSO_NUM': $value = substr($line, 16, 11); break;
            case 'NOSSO_NUM_DV': $value = substr($line, 27, 1); break;
            case 'TIPO_OPERACAO': $value = substr($line, 28, 1); break;
            case 'CHEQUE_ESPECIAL': $value = substr($line, 29, 1); break;
            case 'SALDO_APOS_VENCIMENTO': $value = substr($line, 30, 1); break;
            case 'COD_CONTRATO': $value = substr($line, 31, 25); break;
            case 'VALIDADE_CONTRATO': $value = substr($line, 56, 8); break;
            case 'BRANCOS': $value = substr($line, 64, 330); break;
            case 'SEQUENCIAL': $value = substr($line, 395, 6); break;
            
            default: return 'Coluna não aceita no extract remessa data: '. $data;
        }

        if($pad){ return Remittance::padLine('TRANSACTION6', $data, $value); }
        return $value;

    }

    public static function extractAllFromTransaction6($line, $pad=true)
    {

        $type = 'TRANSACTION6';

        $registro = Remittance::extractFrom($type,$line,'registro', $pad);
        $carteira = Remittance::extractFrom($type,$line,'carteira', $pad);
        $agencia = Remittance::extractFrom($type,$line,'agencia', $pad);
        $conta_corrente = Remittance::extractFrom($type,$line,'conta_corrente', $pad);
        $nosso_num = Remittance::extractFrom($type,$line,'nosso_num', $pad);
        $nosso_num_dv = Remittance::extractFrom($type,$line,'nosso_num_dv', $pad);
        $tipo_operacao = Remittance::extractFrom($type,$line,'tipo_operacao', $pad);
        $cheque_especial = Remittance::extractFrom($type,$line,'cheque_especial', $pad);
        $saldo_apos_vencimento = Remittance::extractFrom($type,$line,'saldo_apos_vencimento', $pad);
        $cod_contrato = Remittance::extractFrom($type,$line,'cod_contrato', $pad);
        $validade_contrato = Remittance::extractFrom($type,$line,'validade_contrato', $pad);
        $brancos = Remittance::extractFrom($type,$line,'brancos', $pad);
        $sequencial = Remittance::extractFrom($type,$line,'sequencial', $pad);

        return 
        $registro .
        $carteira .
        $agencia .
        $conta_corrente .
        $nosso_num .
        $nosso_num_dv .
        $tipo_operacao .
        $cheque_especial .
        $saldo_apos_vencimento .
        $cod_contrato .
        $validade_contrato .
        $brancos .
        $sequencial;

    }

    public function transaction6Help()
    {
        $data = [
            'CNAB' => 'BRADESCO',
            'TYPE' => 'TYPE6',
            'REGISTRO' => [ 
                'position_from' => '001',
                'position_to' => '001',
                'size' => '001',
                'content' => 'Fixo 6',
                'type' => 'Numérico',
            ],
            'CARTEIRA' => [ 
                'position_from' => '002',
                'position_to' => '004',
                'size' => '003',
                'content' => 'Nº da Carteira',
                'type' => 'Numérico',
            ],
            'AGENCIA' => [ 
                'position_from' => '005',
                'position_to' => '009',
                'size' => '005',
                'content' => 'Código da Agência do Beneficiário',
                'type' => 'Numérico',
            ],
            'CONTA_CORRENTE' => [ 
                'position_from' => '010',
                'position_to' => '016',
                'size' => '007',
                'content' => 'Número da Conta-Corrente',
                'type' => 'Numérico',
            ],
            'NOSSO_NUM' => [ 
                'position_from' => '017',
                'position_to' => '027',
                'size' => '011',
                'content' => 'Nosso Número',
                'type' => 'Numérico',
            ],
            'NOSSO_NUM_DV' => [ 
                'position_from' => '028',
                'position_to' => '028',
                'size' => '001',
                'content' => 'Dígito do Nosso Número',
                'type' => 'Alfanumérico',
            ],
            'TIPO_OPERACAO' => [ 
                'position_from' => '029',
                'position_to' => '029',
                'size' => '001',
                'content' => '1-Operação de Crédito, 2-Arrendamento Mercantil, 3-Outros',
                'type' => 'Numérico',
            ],
            'CHEQUE_ESPECIAL' => [ 
                'position_from' => '030',
                'position_to' => '030',
                'size' => '001',
                'content' => 'S ou N',
                'type' => 'Alfanumérico',
            ],
            'SALDO_APOS_VENCIMENTO' => [ 
                'position_from' => '031',
                'position_to' => '031',
                'size' => '001',
                'content' => 'S ou N',
                'type' => 'Alfanumérico',
            ],
            'COD_CONTRATO' => [ 
                'position_from' => '032',
                'position_to' => '056',
                'size' => '025',
                'content' => 'Número Operação Contratada”',
                'type' => 'Numérico',
            ],
            'VALIDADE_CONTRATO' => [ 
                'position_from' => '057',
                'position_to' => '064',
                'size' => '008',
                'content' => 'DD/MM/AAAA ou Indeterminado (99999999)',
                'type' => 'Numérico',
            ],
            'BRANCOS' => [ 
                'position_from' => '065',
                'position_to' => '395',
                'size' => '330',
                'content' => 'Brancos',
                'type' => 'Alfanumérico',
            ]
        ];

        return $data;
    }

    public function transaction6ReplaceOn($line,$data,$new_value)
    {

        switch(strtoupper($data)){

            case 'REGISTRO': return substr_replace($line, $new_value, 0, 1); break;
            case 'CARTEIRA': return substr_replace($line, $new_value, 1, 3); break;
            case 'AGENCIA': return substr_replace($line, $new_value, 4, 5); break;
            case 'CONTA_CORRENTE': return substr_replace($line, $new_value, 9, 7); break;
            case 'NOSSO_NUM': return substr_replace($line, $new_value, 16, 11); break;
            case 'NOSSO_NUM_DV': return substr_replace($line, $new_value, 27, 1); break;
            case 'TIPO_OPERACAO': return substr_replace($line, $new_value, 28, 1); break;
            case 'CHEQUE_ESPECIAL': return substr_replace($line, $new_value, 29, 1); break;
            case 'SALDO_APOS_VENCIMENTO': return substr_replace($line, $new_value, 30, 1); break;
            case 'COD_CONTRATO': return substr_replace($line, $new_value, 31, 25); break;
            case 'VALIDADE_CONTRATO': return substr_replace($line, $new_value, 56, 8); break;
            case 'BRANCOS': return substr_replace($line, $new_value, 64, 330); break;
            case 'SEQUENCIAL': return substr_replace($line, $new_value, 395, 6); break;

            default: return 'Coluna não aceita no replace remessa data: ' . $data;
        }

    }

    public function transaction6PadLine($data,$value)
    {

        $value = Common::cleanUp($value);
        $value = Common::removeExtraSpaces($value);

        $pad_replace = ' ';

        switch(strtoupper($data)){

            case 'REGISTRO': return str_pad(substr($value, 0, 1), 1, '6', STR_PAD_LEFT); break;
            case 'CARTEIRA': return str_pad(substr($value, 0, 3), 3, '0', STR_PAD_LEFT); break;
            case 'AGENCIA': return str_pad(substr($value, 0, 5), 5, '0', STR_PAD_LEFT); break;
            case 'CONTA_CORRENTE': return str_pad(substr($value, 0, 7), 7, '0', STR_PAD_LEFT); break;
            case 'NOSSO_NUM': return str_pad(substr($value, 0, 11), 11, '0', STR_PAD_LEFT); break;
            case 'NOSSO_NUM_DV': return str_pad(substr($value, 0, 1), 1, $pad_replace, STR_PAD_RIGHT); break;
            case 'TIPO_OPERACAO': return str_pad(substr($value, 0, 1), 1, '0', STR_PAD_LEFT); break;
            case 'CHEQUE_ESPECIAL': return str_pad(substr($value, 0, 1), 1, $pad_replace, STR_PAD_RIGHT); break;
            case 'SALDO_APOS_VENCIMENTO': return str_pad(substr($value, 0, 1), 1); break;
            case 'COD_CONTRATO': return str_pad(substr($value, 0, 25), 25, $pad_replace, STR_PAD_RIGHT); break;
            case 'VALIDADE_CONTRATO': return str_pad(substr($value, 0, 8), 8, '0', STR_PAD_LEFT); break;
            case 'BRANCOS': return str_pad(substr($value, 0, 330), 330, $pad_replace, STR_PAD_RIGHT); break;
            case 'SEQUENCIAL': return str_pad(substr($value, 0, 6), 6, '0', STR_PAD_LEFT); break;

            default: return 'Coluna não aceita no extract remessa data: ' . $data;
        }
    }

}