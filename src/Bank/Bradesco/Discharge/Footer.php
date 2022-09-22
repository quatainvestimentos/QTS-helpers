<?php

namespace QuataInvestimentos\Bank\Bradesco\Discharge;
use QuataInvestimentos\Bank\Bradesco\Discharge;
use QuataInvestimentos\Bank\Common;

trait Footer {

    public function extractFrom($line,$data,$pad=true)
    {

        switch(strtoupper($data)){
            case 'REGISTRO': $value = substr($line, 0, 1); break;
            case 'RETORNO': $value = substr($line, 1, 1); break;
            case 'TIPO_REGISTRO': $value = substr($line, 2, 2); break;
            case 'COD_BANCO': $value = substr($line, 4, 3); break;
            case 'BRANCOS_1': $value = substr($line, 7, 10); break;
            case 'QUANT_TITULO': $value = substr($line, 17, 8); break;
            case 'VAL_TOTAL': $value = substr($line, 25, 14); break;
            case 'N_AVISO_BANCARIO': $value = substr($line, 39, 8); break;
            case 'BRANCOS_2': $value = substr($line, 47, 10); break;
            case 'COD_CONTA_CORRENTE_1_BENEFICIARIO': $value = substr($line, 52, 12); break;
            case 'QUANT_REG_OCORRENCIA_02': $value = substr($line, 62, 12); break;
            case 'VALOR_REG_OCORRENCIA_06_LIQUIDACAO': $value = substr($line, 74, 12); break;
            case 'QUANT_REG_OCORRENCIA_06_LIQUIDACAO': $value = substr($line, 86, 5); break;
            case 'VALOR_REG_OCORRENCIA_06': $value = substr($line, 91, 12); break;
            case 'QUANT_REG_OCORRENCIA_09_10': $value = substr($line, 103, 5); break;
            case 'VALOR_REG_OCORRENCIA_09_10': $value = substr($line, 108, 12); break;
            case 'QUANT_REG_OCORRENCIA_13': $value = substr($line, 120, 5); break;
            case 'VALOR_REG_OCORRENCIA_13': $value = substr($line, 125, 12); break;
            case 'QUANT_REG_OCORRENCIA_14': $value = substr($line, 137, 5); break;
            case 'VALOR_REG_OCORRENCIA_14': $value = substr($line, 142, 12); break;
            case 'QUANT_REG_OCORRENCIA_12': $value = substr($line, 154, 5); break;
            case 'VALOR_REG_OCORRENCIA_12': $value = substr($line, 159, 12); break;
            case 'QUANT_REG_OCORRENCIA_19': $value = substr($line, 171, 5); break;
            case 'VALOR_REG_OCORRENCIA_19': $value = substr($line, 176, 12); break;
            case 'NOME_2_BENEFICIARIO': $value = substr($line, 197, 40); break;
            case 'BRANCOS_3': $value = substr($line, 188, 174); break;
            case 'VALOR_TOTAL_RATEIOS': $value = substr($line, 362, 15); break;
            case 'QUANT_TOTAL_RATEIOS': $value = substr($line, 377, 8); break;
            case 'BRANCOS_4': $value = substr($line, 267, 8); break;
            case 'SEQUENCIAL': $value = substr($line, 394, 6); break;
            
            default: return 'Coluna não aceita no extract retorno data: '. $data;
        }

        if($pad){ return Discharge::padLine($data, $value); }
        return $value;

    }

    public static function extractAllFromFooter($line,$pad=true)
    {

        $type = 'FOOTER';
        
        $registro = Discharge::extractFrom($type,$line,'registro',$pad);
        $retorno = Discharge::extractFrom($type,$line,'retorno',$pad);
        $tipo_registro = Discharge::extractFrom($type,$line,'tipo_registro',$pad);
        $cod_banco = Discharge::extractFrom($type,$line,'cod_banco',$pad);
        $brancos_1 = Discharge::extractFrom($type,$line,'brancos_1',$pad);
        $quant_titulo = Discharge::extractFrom($type,$line,'quant_titulo',$pad);
        $val_total = Discharge::extractFrom($type,$line,'val_total',$pad);
        $n_aviso_bancario = Discharge::extractFrom($type,$line,'n_aviso_bancario',$pad);
        $brancos_2 = Discharge::extractFrom($type,$line,'brancos_2',$pad);
        $cod_conta_corrente_1_beneficiario = Discharge::extractFrom($type,$line,'cod_conta_corrente_1_beneficiario',$pad);
        $quant_reg_ocorrencia_02 = Discharge::extractFrom($type,$line,'quant_reg_ocorrencia_02',$pad);
        $valor_reg_ocorrencia_06_liquidacao = Discharge::extractFrom($type,$line,'valor_reg_ocorrencia_06_liquidacao',$pad);
        $quant_reg_ocorrencia_06_liquidacao = Discharge::extractFrom($type,$line,'quant_reg_ocorrencia_06_liquidacao',$pad);
        $valor_reg_ocorrencia_06 = Discharge::extractFrom($type,$line,'valor_reg_ocorrencia_06',$pad);
        $quant_reg_ocorrencia_09_10 = Discharge::extractFrom($type,$line,'quant_reg_ocorrencia_09_10',$pad);
        $valor_reg_ocorrencia_09_10 = Discharge::extractFrom($type,$line,'valor_reg_ocorrencia_09_10',$pad);
        $quant_reg_ocorrencia_13 = Discharge::extractFrom($type,$line,'quant_reg_ocorrencia_13',$pad);
        $valor_reg_ocorrencia_13 = Discharge::extractFrom($type,$line,'valor_reg_ocorrencia_13',$pad);
        $quant_reg_ocorrencia_14 = Discharge::extractFrom($type,$line,'quant_reg_ocorrencia_14',$pad);
        $valor_reg_ocorrencia_14 = Discharge::extractFrom($type,$line,'valor_reg_ocorrencia_14',$pad);
        $quant_reg_ocorrencia_12 = Discharge::extractFrom($type,$line,'quant_reg_ocorrencia_12',$pad);
        $valor_reg_ocorrencia_12 = Discharge::extractFrom($type,$line,'valor_reg_ocorrencia_12',$pad);
        $quant_reg_ocorrencia_19 = Discharge::extractFrom($type,$line,'quant_reg_ocorrencia_19',$pad);
        $valor_reg_ocorrencia_19 = Discharge::extractFrom($type,$line,'valor_reg_ocorrencia_19',$pad);
        $nome_2_beneficiario = Discharge::extractFrom($type,$line,'nome_2_beneficiario',$pad);
        $brancos_3 = Discharge::extractFrom($type,$line,'brancos_3',$pad);
        $valor_total_rateios = Discharge::extractFrom($type,$line,'valor_total_rateios',$pad);
        $quant_total_rateios = Discharge::extractFrom($type,$line,'quant_total_rateios',$pad);
        $brancos_4 = Discharge::extractFrom($type,$line,'brancos_4',$pad);
        $sequencial = Discharge::extractFrom($type,$line,'sequencial',$pad);

        return 
        $registro . 
        $retorno . 
        $tipo_registro . 
        $cod_banco . 
        $brancos_1 . 
        $quant_titulo . 
        $val_total . 
        $n_aviso_bancario . 
        $brancos_2 . 
        $cod_conta_corrente_1_beneficiario . 
        $quant_reg_ocorrencia_02 . 
        $valor_reg_ocorrencia_06_liquidacao . 
        $quant_reg_ocorrencia_06_liquidacao . 
        $valor_reg_ocorrencia_06 . 
        $quant_reg_ocorrencia_09_10 . 
        $valor_reg_ocorrencia_09_10 . 
        $quant_reg_ocorrencia_13 . 
        $valor_reg_ocorrencia_13 . 
        $quant_reg_ocorrencia_14 . 
        $valor_reg_ocorrencia_14 . 
        $quant_reg_ocorrencia_12 . 
        $valor_reg_ocorrencia_12 . 
        $quant_reg_ocorrencia_19 . 
        $valor_reg_ocorrencia_19 . 
        $nome_2_beneficiario . 
        $brancos_3 . 
        $valor_total_rateios . 
        $quant_total_rateios . 
        $brancos_4 . 
        $sequencial;

    }

    public function help(){
        $data = [
            'CNAB' => 'BRADESCO',
            'TYPE' => 'TRAILLER',
            'REGISTRO' => [ 
                'position_from' => '001',
                'position_to' => '001',
                'size' => '001',
                'content' => '9',
                'type' => 'Numérico',
            ],
            'RETORNO' => [ 
                'position_from' => '002',
                'position_to' => '002',
                'size' => '001',
                'content' => '2',
                'type' => 'Numérico',
            ],
            'TIPO_REGISTRO' => [ 
                'position_from' => '003',
                'position_to' => '004',
                'size' => '002',
                'content' => '01',
                'type' => 'Numérico',
            ],
            'COD_BANCO' => [ 
                'position_from' => '005',
                'position_to' => '007',
                'size' => '003',
                'content' => '237',
                'type' => 'Numérico',
            ],
            'BRANCOS_1' => [ 
                'position_from' => '008',
                'position_to' => '017',
                'size' => '010',
                'content' => 'Brancos',
                'type' => 'Alfanuméric',
            ],
            'QUANT_TITULO' => [ 
                'position_from' => '018',
                'position_to' => '025',
                'size' => '008',
                'content' => 'Quantidade de Títulos em Cobrança',
                'type' => 'Numérico',
            ],
            'VAL_TOTAL' => [ 
                'position_from' => '026',
                'position_to' => '039',
                'size' => '014',
                'content' => 'Valor Total em Cobrança',
                'type' => 'Numérico',
            ],
            'N_AVISO_BANCARIO' => [ 
                'position_from' => '040',
                'position_to' => '047',
                'size' => '008',
                'content' => 'Nº do Aviso Bancário',
                'type' => 'Numérico',
            ],
            'BRANCOS_2' => [ 
                'position_from' => '048',
                'position_to' => '057',
                'size' => '010',
                'content' => 'Brancos',
                'type' => 'Alfanumérico',
            ],
            'COD_CONTA_CORRENTE_1_BENEFICIARIO' => [ 
                'position_from' => '053',
                'position_to' => '064',
                'size' => '012',
                'content' => 'Número da Conta-Corrente do Beneficiário',
                'type' => 'Numérico',
            ],
            'QUANT_REG_OCORRENCIA_02' => [ 
                'position_from' => '063',
                'position_to' => '074',
                'size' => '012',
                'content' => 'Valor dos Registros',
                'type' => 'Numérico',
            ],
            'VALOR_REG_OCORRENCIA_06_LIQUIDACAO' => [ 
                'position_from' => '075',
                'position_to' => '086',
                'size' => '012',
                'content' => 'Valor dos Registros',
                'type' => 'Numérico',
            ],
            'QUANT_REG_OCORRENCIA_06_LIQUIDACAO' => [ 
                'position_from' => '087',
                'position_to' => '091',
                'size' => '005',
                'content' => 'Quantidade de Registros',
                'type' => 'Numérico',
            ],
            'VALOR_REG_OCORRENCIA_06' => [ 
                'position_from' => '092',
                'position_to' => '103',
                'size' => '012',
                'content' => 'Valor dos Registros',
                'type' => 'Numérico',
            ],
            'QUANT_REG_OCORRENCIA_09_10' => [ 
                'position_from' => '104',
                'position_to' => '108',
                'size' => '005',
                'content' => 'Quantidade de Registros Baixados',
                'type' => 'Numérico',
            ],
            'VALOR_REG_OCORRENCIA_09_10' => [ 
                'position_from' => '109',
                'position_to' => '120',
                'size' => '012',
                'content' => 'Valor dos Registros Baixados',
                'type' => 'Numérico',
            ],
            'QUANT_REG_OCORRENCIA_13' => [ 
                'position_from' => '121',
                'position_to' => '125',
                'size' => '005',
                'content' => 'Quantidade de Registros',
                'type' => 'Numérico',
            ],
            'VALOR_REG_OCORRENCIA_13' => [ 
                'position_from' => '126',
                'position_to' => '137',
                'size' => '012',
                'content' => 'Valor dos Registros',
                'type' => 'Numérico',
            ],
            'QUANT_REG_OCORRENCIA_14' => [ 
                'position_from' => '138',
                'position_to' => '142',
                'size' => '005',
                'content' => 'Quantidade dos Registros',
                'type' => 'Numérico',
            ],
            'VALOR_REG_OCORRENCIA_14' => [ 
                'position_from' => '143',
                'position_to' => '154',
                'size' => '012',
                'content' => 'Valor dos Registros',
                'type' => 'Numérico',
            ],
            'QUANT_REG_OCORRENCIA_12' => [ 
                'position_from' => '155',
                'position_to' => '159',
                'size' => '005',
                'content' => 'Quantidade de Registros',
                'type' => 'Numérico',
            ],
            'VALOR_REG_OCORRENCIA_12' => [ 
                'position_from' => '160',
                'position_to' => '171',
                'size' => '012',
                'content' => 'Valor dos Registros',
                'type' => 'Numérico',
            ],
            'QUANT_REG_OCORRENCIA_19' => [ 
                'position_from' => '172',
                'position_to' => '176',
                'size' => '005',
                'content' => 'Quantidade de Registros',
                'type' => 'Numérico',
            ],
            'VALOR_REG_OCORRENCIA_19' => [ 
                'position_from' => '177',
                'position_to' => '188',
                'size' => '012',
                'content' => 'Valor dos Registros',
                'type' => 'Numérico',
            ],
            'NOME_2_BENEFICIARIO' => [ 
                'position_from' => '198',
                'position_to' => '237',
                'size' => '040',
                'content' => 'Nome do 2º Beneficiário',
                'type' => 'Numérico',
            ],
            'BRANCOS_3' => [ 
                'position_from' => '189',
                'position_to' => '362',
                'size' => '174',
                'content' => 'Brancos',
                'type' => 'Alfanumérico',
            ],
            'VALOR_TOTAL_RATEIOS' => [ 
                'position_from' => '363',
                'position_to' => '377',
                'size' => '015',
                'content' => 'Valor Total Rateios ',
                'type' => 'Numérico',
            ],
            'QUANT_TOTAL_RATEIOS' => [ 
                'position_from' => '378',
                'position_to' => '385',
                'size' => '08',
                'content' => 'Quantidade Rateios Efetuados',
                'type' => 'Numérico',
            ],
            'BRANCOS_4' => [ 
                'position_from' => '268',
                'position_to' => '275',
                'size' => '008',
                'content' => 'Brancos',
                'type' => 'Alfanumérico',
            ],
            'SEQUENCIAL' => [ 
                'position_from' => '395',
                'position_to' => '400',
                'size' => '006',
                'content' => 'Nº Sequencial do Registro',
                'type' => 'Numérico',
            ],
            
    
           
        ];
        return $data;
    }

    public function replaceOn($line,$data,$new_value)
    {

        switch(strtoupper($data)){

            case 'REGISTRO': return substr_replace($line, $new_value, 0, 1); break;
            case 'RETORNO': return substr_replace($line, $new_value, 1, 1); break;
            case 'TIPO_REGISTRO': return substr_replace($line, $new_value, 2, 2); break;
            case 'COD_BANCO': return substr_replace($line, $new_value, 4, 3); break;
            case 'BRANCOS_1': return substr_replace($line, $new_value, 7, 10); break;
            case 'QUANT_TITULO': return substr_replace($line, $new_value, 17, 8); break;
            case 'VAL_TOTAL': return substr_replace($line, $new_value, 25, 14); break;
            case 'N_AVISO_BANCARIO': return substr_replace($line, $new_value, 39, 8); break;
            case 'BRANCOS_2': return substr_replace($line, $new_value, 47, 10); break;
            case 'COD_CONTA_CORRENTE_1_BENEFICIARIO': return substr_replace($line, $new_value, 52, 12); break;
            case 'QUANT_REG_OCORRENCIA_02': return substr_replace($line, $new_value, 62, 12); break;
            case 'VALOR_REG_OCORRENCIA_06_LIQUIDACAO': return substr_replace($line, $new_value, 74, 12); break;
            case 'QUANT_REG_OCORRENCIA_06_LIQUIDACAO': return substr_replace($line, $new_value, 86, 5); break;
            case 'VALOR_REG_OCORRENCIA_06': return substr_replace($line, $new_value, 91, 12); break;
            case 'QUANT_REG_OCORRENCIA_09_10': return substr_replace($line, $new_value, 103, 5); break;
            case 'VALOR_REG_OCORRENCIA_09_10': return substr_replace($line, $new_value, 108, 12); break;
            case 'QUANT_REG_OCORRENCIA_13': return substr_replace($line, $new_value, 120, 5); break;
            case 'VALOR_REG_OCORRENCIA_13': return substr_replace($line, $new_value, 125, 12); break;
            case 'QUANT_REG_OCORRENCIA_14': return substr_replace($line, $new_value, 137, 5); break;
            case 'VALOR_REG_OCORRENCIA_14': return substr_replace($line, $new_value, 142, 12); break;
            case 'QUANT_REG_OCORRENCIA_12': return substr_replace($line, $new_value, 154, 5); break;
            case 'VALOR_REG_OCORRENCIA_12': return substr_replace($line, $new_value, 159, 12); break;
            case 'QUANT_REG_OCORRENCIA_19': return substr_replace($line, $new_value, 171, 5); break;
            case 'VALOR_REG_OCORRENCIA_19': return substr_replace($line, $new_value, 176, 12); break;
            case 'NOME_2_BENEFICIARIO': return substr_replace($line, $new_value, 197, 40); break;
            case 'BRANCOS_3': return substr_replace($line, $new_value, 188, 174); break;
            case 'VALOR_TOTAL_RATEIOS': return substr_replace($line, $new_value, 362, 15); break;
            case 'QUANT_TOTAL_RATEIOS': return substr_replace($line, $new_value, 377, 8); break;
            case 'BRANCOS_4': return substr_replace($line, $new_value, 267, 8); break;
            case 'SEQUENCIAL': return substr_replace($line, $new_value, 394, 6); break;

            default: return 'Coluna não aceita no replace retorno data: ' . $data;
        }

    }

    public function padLine($data,$value)
    {

        $value = Common::cleanUp($value);
        $value = Common::removeExtraSpaces($value);

        $pad_replace = ' ';

        switch(strtoupper($data)){

            case 'REGISTRO': return str_pad(substr($value, 0, 1), 1, "0", STR_PAD_LEFT); break;
            case 'RETORNO': return str_pad(substr($value, 0, 1), 1, "0", STR_PAD_LEFT); break;
            case 'TIPO_REGISTRO': return str_pad(substr($value, 0, 2), 2, "0", STR_PAD_LEFT); break;
            case 'COD_BANCO': return str_pad(substr($value, 0, 3), 3, "0", STR_PAD_LEFT); break;
            case 'BRANCOS_1': return str_pad(substr($value, 0, 10), 10, $pad_replace, STR_PAD_RIGHT); break;
            case 'QUANT_TITULO': return str_pad(substr($value, 0, 8), 8, "0", STR_PAD_LEFT); break;
            case 'VAL_TOTAL': return str_pad(substr($value, 0, 14), 14, "0", STR_PAD_LEFT); break;
            case 'N_AVISO_BANCARIO': return str_pad(substr($value, 0, 8), 8, "0", STR_PAD_LEFT); break;
            case 'BRANCOS_2': return str_pad(substr($value, 0, 10), 10, $pad_replace, STR_PAD_RIGHT); break;
            case 'COD_CONTA_CORRENTE_1_BENEFICIARIO': return str_pad(substr($value, 0, 12), 12, "0", STR_PAD_LEFT); break;
            case 'QUANT_REG_OCORRENCIA_02': return str_pad(substr($value, 0, 12), 12, "0", STR_PAD_LEFT); break;
            case 'VALOR_REG_OCORRENCIA_06_LIQUIDACAO': return str_pad(substr($value, 0, 12), 12, "0", STR_PAD_LEFT); break;
            case 'QUANT_REG_OCORRENCIA_06_LIQUIDACAO': return str_pad(substr($value, 0, 5), 5, "0", STR_PAD_LEFT); break;
            case 'VALOR_REG_OCORRENCIA_06': return str_pad(substr($value, 0, 12), 12, "0", STR_PAD_LEFT); break;
            case 'QUANT_REG_OCORRENCIA_09_10': return str_pad(substr($value, 0, 5), 5, "0", STR_PAD_LEFT); break;
            case 'VALOR_REG_OCORRENCIA_09_10': return str_pad(substr($value, 0, 12), 12, "0", STR_PAD_LEFT); break;
            case 'QUANT_REG_OCORRENCIA_13': return str_pad(substr($value, 0, 5), 5, "0", STR_PAD_LEFT); break;
            case 'VALOR_REG_OCORRENCIA_13': return str_pad(substr($value, 0, 12), 12, "0", STR_PAD_LEFT); break;
            case 'QUANT_REG_OCORRENCIA_14': return str_pad(substr($value, 0, 5), 5, "0", STR_PAD_LEFT); break;
            case 'VALOR_REG_OCORRENCIA_14': return str_pad(substr($value, 0, 12), 12, "0", STR_PAD_LEFT); break;
            case 'QUANT_REG_OCORRENCIA_12': return str_pad(substr($value, 0, 5), 5, "0", STR_PAD_LEFT); break;
            case 'VALOR_REG_OCORRENCIA_12': return str_pad(substr($value, 0, 12), 12, "0", STR_PAD_LEFT); break;
            case 'QUANT_REG_OCORRENCIA_19': return str_pad(substr($value, 0, 5), 5, "0", STR_PAD_LEFT); break;
            case 'VALOR_REG_OCORRENCIA_19': return str_pad(substr($value, 0, 12), 12, "0", STR_PAD_LEFT); break;
            case 'NOME_2_BENEFICIARIO': return str_pad(substr($value, 0, 40), 40, "0", STR_PAD_LEFT); break;
            case 'BRANCOS_3': return str_pad(substr($value, 0, 174), 174, $pad_replace, STR_PAD_RIGHT); break;
            case 'VALOR_TOTAL_RATEIOS': return str_pad(substr($value, 0, 15), 15, "0", STR_PAD_LEFT); break;
            case 'QUANT_TOTAL_RATEIOS': return str_pad(substr($value, 0, 8), 8, "0", STR_PAD_LEFT); break;
            case 'BRANCOS_4': return str_pad(substr($value, 0, 8), 8, $pad_replace, STR_PAD_RIGHT); break;
            case 'SEQUENCIAL': return str_pad(substr($value, 0, 6), 6, "0", STR_PAD_LEFT); break;

            default: return 'Coluna não aceita no extract retorno data: ' . $data;
        }
    }

}