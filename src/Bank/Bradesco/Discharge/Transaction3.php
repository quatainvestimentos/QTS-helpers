<?php

namespace QuataInvestimentos\Bank\Bradesco\Discharge;
use QuataInvestimentos\Bank\Bradesco\Discharge;
use QuataInvestimentos\Bank\Common;

trait Transaction3 {

    public function extractTransaction3From($line,$data,$pad=true)
    {

        switch(strtoupper($data)){
            case 'REGISTRO': $value = substr($line, 0, 1); break;
            case 'CONVENIO': $value = substr($line, 1, 16); break;
            case 'NOSSO_NUM': $value = substr($line, 17, 11); break;
            case 'NOSSO_NUM_DV': $value = substr($line, 28, 1); break;
            case 'COD_CALCULO_RATEIO': $value = substr($line, 29, 1); break;
            case 'TIPO_VALOR_INFORMADO': $value = substr($line, 30, 1); break;
            case 'FILLER_1': $value = substr($line, 31, 12); break;
            case 'COD_BANCO_BENEFICIARIO_1': $value = substr($line, 43, 3); break;
            case 'AGENCIA_BENEFICIARIO_1': $value = substr($line, 46, 5); break;
            case 'AGENCIA_DV_BENEFICIARIO_1': $value = substr($line, 51, 1); break;
            case 'CONTA_CORRENTE_BENEFICIARIO_1': $value = substr($line, 52, 12); break;
            case 'CONTA_CORRENTE_DV_BENEFICIARIO_1': $value = substr($line, 64, 1); break;
            case 'VALOR_BENEFICIARIO_1': $value = substr($line, 65, 15); break;
            case 'NOME_BENEFICIARIO_1': $value = substr($line, 80, 40); break;
            case 'FILLER_2': $value = substr($line, 120, 21); break;
            case 'PARCELA_1': $value = substr($line, 141, 6); break;
            case 'FLOATING_BENEFICIARIO_1': $value = substr($line, 147, 3); break;
            case 'DATA_CREDITO_BENEFICIARIO_1': $value = substr($line, 150, 8); break;
            case 'STATUS_OCORRENCIA_ROTEIRO': $value = substr($line, 158, 2); break;
            case 'COD_BANCO_BENEFICIARIO_2': $value = substr($line, 160, 3); break;
            case 'AGENCIA_BENEFICIARIO_2': $value = substr($line, 163, 5); break;
            case 'AGENCIA_DV_BENEFICIARIO_2': $value = substr($line, 168, 1); break;
            case 'CONTA_CORRENTE_BENEFICIARIO_2': $value = substr($line, 169, 12); break;
            case 'CONTA_CORRENTE_DV_BENEFICIARIO_2': $value = substr($line, 181, 1); break;
            case 'VALOR_BENEFICIARIO_2': $value = substr($line, 182, 15); break;
            case 'NOME_BENEFICIARIO_2': $value = substr($line, 197, 40); break;
            case 'FILLER_3': $value = substr($line, 237, 21); break;
            case 'PARCELA_2': $value = substr($line, 258, 6); break;
            case 'FLOATING_BENEFICIARIO_2': $value = substr($line, 264, 3); break;
            case 'DATA_CREDITO_BENEFICIARIO_2': $value = substr($line, 267, 8); break;
            case 'STATUS_OCORRENCIA_ROTEIRO_2': $value = substr($line, 275, 2); break;
            case 'COD_BANCO_BENEFICIARIO_3': $value = substr($line, 277, 3); break;
            case 'AGENCIA_BENEFICIARIO_3': $value = substr($line, 280, 5); break;
            case 'AGENCIA_DV_BENEFICIARIO_3': $value = substr($line, 285, 1); break;
            case 'CONTA_CORRENTE_BENEFICIARIO_3': $value = substr($line, 286, 12); break;
            case 'CONTA_CORRENTE_DV_BENEFICIARIO_3': $value = substr($line, 298, 1); break;
            case 'VALOR_BENEFICIARIO_3': $value = substr($line, 299, 15); break;
            case 'NOME_BENEFICIARIO_3': $value = substr($line, 314, 40); break;
            case 'FILLER_4': $value = substr($line, 354, 21); break;
            case 'PARCELA_3': $value = substr($line, 375, 6); break;
            case 'FLOATING_BENEFICIARIO_3': $value = substr($line, 381, 3); break;
            case 'DATA_CREDITO_BENEFICIARIO_3': $value = substr($line, 384, 8); break;
            case 'STT_OCORRENCIA_RATEIO': $value = substr($line, 392, 2); break;
            case 'SEQUENCIAL': $value = substr($line, 394, 6); break;
            
            default: return 'Coluna não aceita no extract remessa data: '. $data;
        }

        if($pad){ return Discharge::padLine($data, $value); }
        return $value;

    }

    public static function extractAllFromTransaction3($line,$pad=true)
    {

        $type = 'TRANSACTION3';

        $registro = Discharge::extractFrom($type,$line,'registro',$pad);
        $convenio = Discharge::extractFrom($type,$line,'convenio',$pad);
        $nosso_num = Discharge::extractFrom($type,$line,'nosso_num',$pad);
        $nosso_num_dv = Discharge::extractFrom($type,$line,'nosso_num_dv',$pad);
        $cod_calculo_rateio = Discharge::extractFrom($type,$line,'cod_calculo_rateio',$pad);
        $tipo_valor_informado = Discharge::extractFrom($type,$line,'tipo_valor_informado',$pad);
        $filler_1 = Discharge::extractFrom($type,$line,'filler_1',$pad);
        $cod_banco_beneficiario_1 = Discharge::extractFrom($type,$line,'cod_banco_beneficiario_1',$pad);
        $agencia_beneficiario_1 = Discharge::extractFrom($type,$line,'agencia_beneficiario_1',$pad);
        $agencia_dv_beneficiario_1 = Discharge::extractFrom($type,$line,'agencia_dv_beneficiario_1',$pad);
        $conta_corrente_beneficiario_1 = Discharge::extractFrom($type,$line,'conta_corrente_beneficiario_1',$pad);
        $conta_corrente_dv_beneficiario_1 = Discharge::extractFrom($type,$line,'conta_corrente_dv_beneficiario_1',$pad);
        $valor_beneficiario_1 = Discharge::extractFrom($type,$line,'valor_beneficiario_1',$pad);
        $nome_beneficiario_1 = Discharge::extractFrom($type,$line,'nome_beneficiario_1',$pad);
        $filler_2 = Discharge::extractFrom($type,$line,'filler_2',$pad);
        $parcela_1 = Discharge::extractFrom($type,$line,'parcela_1',$pad);
        $floating_beneficiario_1 = Discharge::extractFrom($type,$line,'floating_beneficiario_1',$pad);
        $data_credito_beneficiario_1 = Discharge::extractFrom($type,$line,'data_credito_beneficiario_1',$pad);
        $status_ocorrencia_roteiro = Discharge::extractFrom($type,$line,'status_ocorrencia_roteiro',$pad);
        $cod_banco_beneficiario_2 = Discharge::extractFrom($type,$line,'cod_banco_beneficiario_2',$pad);
        $agencia_beneficiario_2 = Discharge::extractFrom($type,$line,'agencia_beneficiario_2',$pad);
        $agencia_dv_beneficiario_2 = Discharge::extractFrom($type,$line,'agencia_dv_beneficiario_2',$pad);
        $conta_corrente_beneficiario_2 = Discharge::extractFrom($type,$line,'conta_corrente_beneficiario_2',$pad);
        $conta_corrente_dv_beneficiario_2 = Discharge::extractFrom($type,$line,'conta_corrente_dv_beneficiario_2',$pad);
        $valor_beneficiario_2 = Discharge::extractFrom($type,$line,'valor_beneficiario_2',$pad);
        $nome_beneficiario_2 = Discharge::extractFrom($type,$line,'nome_beneficiario_2',$pad);
        $filler_3 = Discharge::extractFrom($type,$line,'filler_3',$pad);
        $parcela_2 = Discharge::extractFrom($type,$line,'parcela_2',$pad);
        $floating_beneficiario_2 = Discharge::extractFrom($type,$line,'floating_beneficiario_2',$pad);
        $data_credito_beneficiario_2 = Discharge::extractFrom($type,$line,'data_credito_beneficiario_2',$pad);
        $status_ocorrencia_roteiro_2 = Discharge::extractFrom($type,$line,'status_ocorrencia_roteiro_2',$pad);
        $cod_banco_beneficiario_3 = Discharge::extractFrom($type,$line,'cod_banco_beneficiario_3',$pad);
        $agencia_beneficiario_3 = Discharge::extractFrom($type,$line,'agencia_beneficiario_3',$pad);
        $agencia_dv_beneficiario_3 = Discharge::extractFrom($type,$line,'agencia_dv_beneficiario_3',$pad);
        $conta_corrente_beneficiario_3 = Discharge::extractFrom($type,$line,'conta_corrente_beneficiario_3',$pad);
        $conta_corrente_dv_beneficiario_3 = Discharge::extractFrom($type,$line,'conta_corrente_dv_beneficiario_3',$pad);
        $valor_beneficiario_3 = Discharge::extractFrom($type,$line,'valor_beneficiario_3',$pad);
        $nome_beneficiario_3 = Discharge::extractFrom($type,$line,'nome_beneficiario_3',$pad);
        $filler_4 = Discharge::extractFrom($type,$line,'filler_4',$pad);
        $parcela_3 = Discharge::extractFrom($type,$line,'parcela_3',$pad);
        $floating_beneficiario_3 = Discharge::extractFrom($type,$line,'floating_beneficiario_3',$pad);
        $data_credito_beneficiario_3 = Discharge::extractFrom($type,$line,'data_credito_beneficiario_3',$pad);
        $stt_ocorrencia_rateio = Discharge::extractFrom($type,$line,'stt_ocorrencia_rateio',$pad);
        $sequencial = Discharge::extractFrom($type,$line,'sequencial',$pad);

        return 
        $registro . 
        $convenio . 
        $nosso_num . 
        $nosso_num_dv . 
        $cod_calculo_rateio . 
        $tipo_valor_informado . 
        $filler_1 . 
        $cod_banco_beneficiario_1 . 
        $agencia_beneficiario_1 . 
        $agencia_dv_beneficiario_1 . 
        $conta_corrente_beneficiario_1 . 
        $conta_corrente_dv_beneficiario_1 . 
        $valor_beneficiario_1 . 
        $nome_beneficiario_1 . 
        $filler_2 . 
        $parcela_1 . 
        $floating_beneficiario_1 . 
        $data_credito_beneficiario_1 . 
        $status_ocorrencia_roteiro . 
        $cod_banco_beneficiario_2 . 
        $agencia_beneficiario_2 . 
        $agencia_dv_beneficiario_2 . 
        $conta_corrente_beneficiario_2 . 
        $conta_corrente_dv_beneficiario_2 . 
        $valor_beneficiario_2 . 
        $nome_beneficiario_2 . 
        $filler_3 . 
        $parcela_2 . 
        $floating_beneficiario_2 . 
        $data_credito_beneficiario_2 . 
        $status_ocorrencia_roteiro_2 . 
        $cod_banco_beneficiario_3 . 
        $agencia_beneficiario_3 . 
        $agencia_dv_beneficiario_3 . 
        $conta_corrente_beneficiario_3 . 
        $conta_corrente_dv_beneficiario_3 . 
        $valor_beneficiario_3 . 
        $nome_beneficiario_3 . 
        $filler_4 . 
        $parcela_3 . 
        $floating_beneficiario_3 . 
        $data_credito_beneficiario_3 . 
        $stt_ocorrencia_rateio . 
        $sequencial;

    }

    public function transaction3Help(){
        $data = [
            'CNAB' => 'BRADESCO',
            'TYPE' => 'TIPO3',
            'REGISTRO' => [ 
                'position_from' => '001',
                'position_to' => '001',
                'size' => '001',
                'content' => 'Fixo “3”',
                'type' => 'Numérico',
            ],
            'CONVENIO' => [ 
                'position_from' => '002',
                'position_to' => '017',
                'size' => '016',
                'content' => 'Carteira, Agência, Conta-Corrente. Vide Obs. Pág. 49',
                'type' => 'Alfanumérico',
            ],
            'NOSSO_NUM' => [ 
                'position_from' => '018',
                'position_to' => '028',
                'size' => '011',
                'content' => 'Número Bancário Vide Obs. Pág. 49',
                'type' => 'Alfanumérico',
            ],
            'NOSSO_NUM_DV' => [ 
                'position_from' => '029',
                'position_to' => '029',
                'size' => '01',
                'content' => 'Número Bancário Vide Obs. Pág. 49',
                'type' => 'Alfanumérico',
            ],
            'COD_CALCULO_RATEIO' => [ 
                'position_from' => '030',
                'position_to' => '030',
                'size' => '001',
                'content' => '“1”= Valor Cobrado “2”= Valor do Registro “3”= Rateio pelo Menor Valor',
                'type' => 'Numérico',
            ],
            'TIPO_VALOR_INFORMADO' => [ 
                'position_from' => '031',
                'position_to' => '031',
                'size' => '001',
                'content' => '“1”= Percentual “2”= Valo',
                'type' => 'Numérico',
            ],
            'FILLER_1' => [ 
                'position_from' => '032',
                'position_to' => '043',
                'size' => '012',
                'content' => 'Brancos',
                'type' => 'Alfanumérico',
            ],
            'COD_BANCO_BENEFICIARIO_1' => [ 
                'position_from' => '044',
                'position_to' => '046',
                'size' => '003',
                'content' => 'Fixo “237”',
                'type' => 'Numérico',
            ],
            'AGENCIA_BENEFICIARIO_1' => [ 
                'position_from' => '047',
                'position_to' => '051',
                'size' => '005',
                'content' => 'Código da Agência',
                'type' => 'Numérico',
            ],
            'AGENCIA_DV_BENEFICIARIO_1' => [ 
                'position_from' => '052',
                'position_to' => '052',
                'size' => '001',
                'content' => 'Dígito da Agência',
                'type' => 'Alfanumérico',
            ],
            'CONTA_CORRENTE_BENEFICIARIO_1' => [ 
                'position_from' => '053',
                'position_to' => '064',
                'size' => '012',
                'content' => 'Número da Conta-Corrente do Beneficiário',
                'type' => 'Numérico',
            ],
            'CONTA_CORRENTE_DV_BENEFICIARIO_1' => [ 
                'position_from' => '065',
                'position_to' => '065',
                'size' => '001',
                'content' => 'Dígito da Conta-Corrente',
                'type' => 'Alfanumérico',
            ],
            'VALOR_BENEFICIARIO_1' => [ 
                'position_from' => '066',
                'position_to' => '080',
                'size' => '015',
                'content' => 'Valor em Reais Vide Obs. Pág. 49',
                'type' => 'Numérico',
            ],
            'NOME_BENEFICIARIO_1' => [ 
                'position_from' => '081',
                'position_to' => '120',
                'size' => '040',
                'content' => 'Nome do 1º Beneficiário',
                'type' => 'Alfanumérico',
            ],
            'FILLER_2' => [ 
                'position_from' => '121',
                'position_to' => '141',
                'size' => '021',
                'content' => 'Brancos',
                'type' => 'Alfanumérico',
            ],
            'PARCELA_1' => [ 
                'position_from' => '142',
                'position_to' => '147',
                'size' => '006',
                'content' => 'Identificação da Parcela',
                'type' => 'Alfanumérico',
            ],
            'FLOATING_BENEFICIARIO_1' => [ 
                'position_from' => '148',
                'position_to' => '150',
                'size' => '003',
                'content' => 'Quantidade de Dias para Crédito de Beneficiário',
                'type' => 'Numérico',
            ],
            'DATA_CREDITO_BENEFICIARIO_1' => [ 
                'position_from' => '151',
                'position_to' => '158',
                'size' => '008',
                'content' => 'Data do Crédito DDMMAAAA Vide Obs. Pág. 49',
                'type' => 'Numérico',
            ],
            'STATUS_OCORRENCIA_ROTEIRO' => [ 
                'position_from' => '159',
                'position_to' => '160',
                'size' => '002',
                'content' => 'Vide Obs. Pág. 49',
                'type' => 'Numérico',
            ],
            'COD_BANCO_BENEFICIARIO_2' => [ 
                'position_from' => '161',
                'position_to' => '163',
                'size' => '003',
                'content' => 'Fixo “237”',
                'type' => 'Numérico',
            ],
            'AGENCIA_BENEFICIARIO_2' => [ 
                'position_from' => '164',
                'position_to' => '168',
                'size' => '005',
                'content' => 'Código da Agência do Beneficiário',
                'type' => 'Numérico',
            ],
            'AGENCIA_DV_BENEFICIARIO_2' => [ 
                'position_from' => '169',
                'position_to' => '169',
                'size' => '001',
                'content' => 'Dígito da Agência',
                'type' => 'Alfanumérico',
            ],
            'CONTA_CORRENTE_BENEFICIARIO_2' => [ 
                'position_from' => '170',
                'position_to' => '181',
                'size' => '012',
                'content' => 'Número da Conta-Corrente do Beneficiário',
                'type' => 'Numérico',
            ],
            'CONTA_CORRENTE_DV_BENEFICIARIO_2' => [ 
                'position_from' => '182',
                'position_to' => '182',
                'size' => '001',
                'content' => 'Dígito da Conta-Corrente',
                'type' => 'Alfanumérico',
            ],
            'VALOR_BENEFICIARIO_2' => [ 
                'position_from' => '183',
                'position_to' => '197',
                'size' => '015',
                'content' => 'Valor em Reais Pág. 49',
                'type' => 'Numérico',
            ],
            'NOME_BENEFICIARIO_2' => [ 
                'position_from' => '198',
                'position_to' => '237',
                'size' => '040',
                'content' => 'Nome do 2º Beneficiário',
                'type' => 'Alfanumérico',
            ],
            'FILLER_3' => [ 
                'position_from' => '238',
                'position_to' => '258',
                'size' => '021',
                'content' => 'Brancos ',
                'type' => 'Alfanumérico',
            ],
            'PARCELA_2' => [ 
                'position_from' => '259',
                'position_to' => '264',
                'size' => '006',
                'content' => 'Identificação da Parcela',
                'type' => 'Alfanumérico',
            ],
            'FLOATING_BENEFICIARIO_2' => [ 
                'position_from' => '265',
                'position_to' => '267',
                'size' => '003',
                'content' => 'Quantidade de Dias para Crédito do Beneficiário',
                'type' => 'Numérico',
            ],
            'DATA_CREDITO_BENEFICIARIO_2' => [ 
                'position_from' => '268',
                'position_to' => '275',
                'size' => '008',
                'content' => 'Data do Crédito DDMMAAAA Vide Obs. Pág. 49',
                'type' => 'Numérico',
            ],
            'STATUS_OCORRENCIA_ROTEIRO_2' => [ 
                'position_from' => '276',
                'position_to' => '277',
                'size' => '002',
                'content' => 'Pág. 49',
                'type' => 'Numérico',
            ],
            'COD_BANCO_BENEFICIARIO_3' => [ 
                'position_from' => '278',
                'position_to' => '280',
                'size' => '003',
                'content' => 'Fixo “237”',
                'type' => 'Numérico',
            ],
            'AGENCIA_BENEFICIARIO_3' => [ 
                'position_from' => '281',
                'position_to' => '285',
                'size' => '005',
                'content' => 'Código da Agência do Beneficiário ',
                'type' => 'Numérico',
            ],
            'AGENCIA_DV_BENEFICIARIO_3' => [ 
                'position_from' => '286',
                'position_to' => '286',
                'size' => '001',
                'content' => 'Dígito da Agência',
                'type' => 'Alfanumérico',
            ],
            'CONTA_CORRENTE_BENEFICIARIO_3' => [ 
                'position_from' => '287',
                'position_to' => '298',
                'size' => '012',
                'content' => 'Número da Conta-Corrente do Beneficiário',
                'type' => 'Numérico',
            ],
            'CONTA_CORRENTE_DV_BENEFICIARIO_3' => [ 
                'position_from' => '299',
                'position_to' => '299',
                'size' => '001',
                'content' => 'Dígito da Conta-Corrente',
                'type' => 'Alfanumérico',
            ],
            'VALOR_BENEFICIARIO_3' => [ 
                'position_from' => '300',
                'position_to' => '314',
                'size' => '015',
                'content' => 'Valor em Reais',
                'type' => 'Numérico',
            ],
            'NOME_BENEFICIARIO_3' => [ 
                'position_from' => '315',
                'position_to' => '354',
                'size' => '040',
                'content' => 'Nome do 3º Beneficiário',
                'type' => 'Alfanumérico',
            ],
            'FILLER_4' => [ 
                'position_from' => '355',
                'position_to' => '375',
                'size' => '021',
                'content' => 'Brancos',
                'type' => 'Alfanumérico',
            ],
            'PARCELA_3' => [ 
                'position_from' => '376',
                'position_to' => '381',
                'size' => '006',
                'content' => 'Identificação da Parcela',
                'type' => 'Alfanumérico',
            ],
            'FLOATING_BENEFICIARIO_3' => [ 
                'position_from' => '382',
                'position_to' => '384',
                'size' => '003',
                'content' => 'Quantidade de Dias para Crédito do Beneficiário.',
                'type' => 'Numérico',
            ],
            'DATA_CREDITO_BENEFICIARIO_3' => [ 
                'position_from' => '385',
                'position_to' => '392',
                'size' => '008',
                'content' => 'Data do Crédito DDMMAAAA',
                'type' => 'Numérico',
            ],
            'STT_OCORRENCIA_RATEIO' => [ 
                'position_from' => '393',
                'position_to' => '394',
                'size' => '002',
                'content' => 'Vide Obs. Pág. 49',
                'type' => 'Numérico',
            ],
            'SEQUENCIAL' => [ 
                'position_from' => '395',
                'position_to' => '400',
                'size' => '006',
                'content' => 'Número Sequencial do Registro',
                'type' => 'Numérico',
            ],
    
           
        ];
        return $data;
    }

    public function transaction3ReplaceOn($line,$data,$new_value)
    {

        switch(strtoupper($data)){

            case 'REGISTRO': return substr_replace($line, $new_value, 0, 1); break;
            case 'CONVENIO': return substr_replace($line, $new_value, 1, 16); break;
            case 'NOSSO_NUM': return substr_replace($line, $new_value, 17, 11); break;
            case 'NOSSO_NUM_DV': return substr_replace($line, $new_value, 28, 1); break;
            case 'COD_CALCULO_RATEIO': return substr_replace($line, $new_value, 29, 1); break;
            case 'TIPO_VALOR_INFORMADO': return substr_replace($line, $new_value, 30, 1); break;
            case 'FILLER_1': return substr_replace($line, $new_value, 31, 12); break;
            case 'COD_BANCO_BENEFICIARIO_1': return substr_replace($line, $new_value, 43, 3); break;
            case 'AGENCIA_BENEFICIARIO_1': return substr_replace($line, $new_value, 46, 5); break;
            case 'AGENCIA_DV_BENEFICIARIO_1': return substr_replace($line, $new_value, 51, 1); break;
            case 'CONTA_CORRENTE_BENEFICIARIO_1': return substr_replace($line, $new_value, 52, 12); break;
            case 'CONTA_CORRENTE_DV_BENEFICIARIO_1': return substr_replace($line, $new_value, 64, 1); break;
            case 'VALOR_BENEFICIARIO_1': return substr_replace($line, $new_value, 65, 15); break;
            case 'NOME_BENEFICIARIO_1': return substr_replace($line, $new_value, 80, 40); break;
            case 'FILLER_2': return substr_replace($line, $new_value, 120, 21); break;
            case 'PARCELA_1': return substr_replace($line, $new_value, 141, 6); break;
            case 'FLOATING_BENEFICIARIO_1': return substr_replace($line, $new_value, 147, 3); break;
            case 'DATA_CREDITO_BENEFICIARIO_1': return substr_replace($line, $new_value, 150, 8); break;
            case 'STATUS_OCORRENCIA_ROTEIRO': return substr_replace($line, $new_value, 158, 2); break;
            case 'COD_BANCO_BENEFICIARIO_2': return substr_replace($line, $new_value, 160, 3); break;
            case 'AGENCIA_BENEFICIARIO_2': return substr_replace($line, $new_value, 163, 5); break;
            case 'AGENCIA_DV_BENEFICIARIO_2': return substr_replace($line, $new_value, 168, 1); break;
            case 'CONTA_CORRENTE_BENEFICIARIO_2': return substr_replace($line, $new_value, 169, 12); break;
            case 'CONTA_CORRENTE_DV_BENEFICIARIO_2': return substr_replace($line, $new_value, 181, 1); break;
            case 'VALOR_BENEFICIARIO_2': return substr_replace($line, $new_value, 182, 15); break;
            case 'NOME_BENEFICIARIO_2': return substr_replace($line, $new_value, 197, 40); break;
            case 'FILLER_3': return substr_replace($line, $new_value, 237, 21); break;
            case 'PARCELA_2': return substr_replace($line, $new_value, 258, 6); break;
            case 'FLOATING_BENEFICIARIO_2': return substr_replace($line, $new_value, 264, 3); break;
            case 'DATA_CREDITO_BENEFICIARIO_2': return substr_replace($line, $new_value, 267, 8); break;
            case 'STATUS_OCORRENCIA_ROTEIRO_2': return substr_replace($line, $new_value, 275, 2); break;
            case 'COD_BANCO_BENEFICIARIO_3': return substr_replace($line, $new_value, 277, 3); break;
            case 'AGENCIA_BENEFICIARIO_3': return substr_replace($line, $new_value, 280, 5); break;
            case 'AGENCIA_DV_BENEFICIARIO_3': return substr_replace($line, $new_value, 285, 1); break;
            case 'CONTA_CORRENTE_BENEFICIARIO_3': return substr_replace($line, $new_value, 286, 12); break;
            case 'CONTA_CORRENTE_DV_BENEFICIARIO_3': return substr_replace($line, $new_value, 298, 1); break;
            case 'VALOR_BENEFICIARIO_3': return substr_replace($line, $new_value, 299, 15); break;
            case 'NOME_BENEFICIARIO_3': return substr_replace($line, $new_value, 314, 40); break;
            case 'FILLER_4': return substr_replace($line, $new_value, 354, 21); break;
            case 'PARCELA_3': return substr_replace($line, $new_value, 375, 6); break;
            case 'FLOATING_BENEFICIARIO_3': return substr_replace($line, $new_value, 381, 3); break;
            case 'DATA_CREDITO_BENEFICIARIO_3': return substr_replace($line, $new_value, 384, 8); break;
            case 'STT_OCORRENCIA_RATEIO': return substr_replace($line, $new_value, 392, 2); break;
            case 'SEQUENCIAL': return substr_replace($line, $new_value, 394, 6); break;

            default: return 'Coluna não aceita no replace remessa data: ' . $data;
        }

    }

    public function transaction3PadLine($data,$value)
    {

        $value = Common::cleanUp($value);
        $value = Common::removeExtraSpaces($value);

        $pad_replace = ' ';

        switch(strtoupper($data)){

            case 'REGISTRO': return str_pad(substr($value, 0, 1), 1, "0", STR_PAD_LEFT); break;
            case 'CONVENIO': return str_pad(substr($value, 0, 16), 16, $pad_replace, STR_PAD_RIGHT); break;
            case 'NOSSO_NUM': return str_pad(substr($value, 0, 11), 11, $pad_replace, STR_PAD_RIGHT); break;
            case 'NOSSO_NUM_DV': return str_pad(substr($value, 0, 1), 1, $pad_replace, STR_PAD_RIGHT); break;
            case 'COD_CALCULO_RATEIO': return str_pad(substr($value, 0, 1), 1, "0", STR_PAD_LEFT); break;
            case 'TIPO_VALOR_INFORMADO': return str_pad(substr($value, 0, 1), 1, "0", STR_PAD_LEFT); break;
            case 'FILLER_1': return str_pad(substr($value, 0, 12), 12, $pad_replace, STR_PAD_RIGHT); break;
            case 'COD_BANCO_BENEFICIARIO_1': return str_pad(substr($value, 0, 3), 3, "0", STR_PAD_LEFT); break;
            case 'AGENCIA_BENEFICIARIO_1': return str_pad(substr($value, 0, 5), 5, "0", STR_PAD_LEFT); break;
            case 'AGENCIA_DV_BENEFICIARIO_1': return str_pad(substr($value, 0, 1), 1, $pad_replace, STR_PAD_RIGHT); break;
            case 'CONTA_CORRENTE_BENEFICIARIO_1': return str_pad(substr($value, 0, 12), 12, "0", STR_PAD_LEFT); break;
            case 'CONTA_CORRENTE_DV_BENEFICIARIO_1': return str_pad(substr($value, 0, 1), 1, $pad_replace, STR_PAD_RIGHT); break;
            case 'VALOR_BENEFICIARIO_1': return str_pad(substr($value, 0, 15), 15, "0", STR_PAD_LEFT); break;
            case 'NOME_BENEFICIARIO_1': return str_pad(substr($value, 0, 40), 40, $pad_replace, STR_PAD_RIGHT); break;
            case 'FILLER_2': return str_pad(substr($value, 0, 21), 21, $pad_replace, STR_PAD_RIGHT); break;
            case 'PARCELA_1': return str_pad(substr($value, 0, 6), 6, $pad_replace, STR_PAD_RIGHT); break;
            case 'FLOATING_BENEFICIARIO_1': return str_pad(substr($value, 0, 3), 3, "0", STR_PAD_LEFT); break;
            case 'DATA_CREDITO_BENEFICIARIO_1': return str_pad(substr($value, 0, 8), 8, "0", STR_PAD_LEFT); break;
            case 'STATUS_OCORRENCIA_ROTEIRO': return str_pad(substr($value, 0, 2), 2, "0", STR_PAD_LEFT); break;
            case 'COD_BANCO_BENEFICIARIO_2': return str_pad(substr($value, 0, 3), 3, "0", STR_PAD_LEFT); break;
            case 'AGENCIA_BENEFICIARIO_2': return str_pad(substr($value, 0, 5), 5, "0", STR_PAD_LEFT); break;
            case 'AGENCIA_DV_BENEFICIARIO_2': return str_pad(substr($value, 0, 1), 1, $pad_replace, STR_PAD_RIGHT); break;
            case 'CONTA_CORRENTE_BENEFICIARIO_2': return str_pad(substr($value, 0, 12), 12, "0", STR_PAD_LEFT); break;
            case 'CONTA_CORRENTE_DV_BENEFICIARIO_2': return str_pad(substr($value, 0, 1), 1, $pad_replace, STR_PAD_RIGHT); break;
            case 'VALOR_BENEFICIARIO_2': return str_pad(substr($value, 0, 15), 15, "0", STR_PAD_LEFT); break;
            case 'NOME_BENEFICIARIO_2': return str_pad(substr($value, 0, 40), 40, $pad_replace, STR_PAD_RIGHT); break;
            case 'FILLER_3': return str_pad(substr($value, 0, 21), 21, $pad_replace, STR_PAD_RIGHT); break;
            case 'PARCELA_2': return str_pad(substr($value, 0, 6), 6, $pad_replace, STR_PAD_RIGHT); break;
            case 'FLOATING_BENEFICIARIO_2': return str_pad(substr($value, 0, 3), 3, "0", STR_PAD_LEFT); break;
            case 'DATA_CREDITO_BENEFICIARIO_2': return str_pad(substr($value, 0, 8), 8, "0", STR_PAD_LEFT); break;
            case 'STATUS_OCORRENCIA_ROTEIRO_2': return str_pad(substr($value, 0, 2), 2, "0", STR_PAD_LEFT); break;
            case 'COD_BANCO_BENEFICIARIO_3': return str_pad(substr($value, 0, 3), 3, "0", STR_PAD_LEFT); break;
            case 'AGENCIA_BENEFICIARIO_3': return str_pad(substr($value, 0, 5), 5, "0", STR_PAD_LEFT); break;
            case 'AGENCIA_DV_BENEFICIARIO_3': return str_pad(substr($value, 0, 1), 1, $pad_replace, STR_PAD_RIGHT); break;
            case 'CONTA_CORRENTE_BENEFICIARIO_3': return str_pad(substr($value, 0, 12), 12, "0", STR_PAD_LEFT); break;
            case 'CONTA_CORRENTE_DV_BENEFICIARIO_3': return str_pad(substr($value, 0, 1), 1, $pad_replace, STR_PAD_RIGHT); break;
            case 'VALOR_BENEFICIARIO_3': return str_pad(substr($value, 0, 15), 15, "0", STR_PAD_LEFT); break;
            case 'NOME_BENEFICIARIO_3': return str_pad(substr($value, 0, 40), 40, $pad_replace, STR_PAD_RIGHT); break;
            case 'FILLER_4': return str_pad(substr($value, 0, 21), 21, $pad_replace, STR_PAD_RIGHT); break;
            case 'PARCELA_3': return str_pad(substr($value, 0, 6), 6, $pad_replace, STR_PAD_RIGHT); break;
            case 'FLOATING_BENEFICIARIO_3': return str_pad(substr($value, 0, 3), 3, "0", STR_PAD_LEFT); break;
            case 'DATA_CREDITO_BENEFICIARIO_3': return str_pad(substr($value, 0, 8), 8, "0", STR_PAD_LEFT); break;
            case 'STT_OCORRENCIA_RATEIO': return str_pad(substr($value, 0, 2), 2, "0", STR_PAD_LEFT); break;
            case 'SEQUENCIAL': return str_pad(substr($value, 0, 6), 6, "0", STR_PAD_LEFT); break;

            default: return 'Coluna não aceita no extract remessa data: ' . $data;
        }
    }

}