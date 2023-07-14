<?php

namespace QuataInvestimentos\Bank\Bradesco\Discharge;
use QuataInvestimentos\Bank\Bradesco\Discharge;
use QuataInvestimentos\Bank\Common;

trait Transaction1 {

    public function extractTransaction1From($line,$data,$pad=true)
    {

        switch(strtoupper($data)){
            case 'REGISTRO': $value = substr($line, 0, 1); break;
            case 'TIPO_INSCRICAO': $value = substr($line, 1, 2); break;
            case 'NUM_INSCRICAO': $value = substr($line, 3, 14); break;
            case 'ZEROS_1': $value = substr($line, 17, 3); break;
            case 'BENEFICIARIA': $value = substr($line, 20, 17); break;
            case 'NUM_PARTICIPANTE': $value = substr($line, 37, 25); break;
            case 'ZEROS_2': $value = substr($line, 62, 8); break;
            case 'NOSSO_NUM': $value = substr($line, 70, 11); break;
            case 'NOSSO_NUM_DV': $value = substr($line, 81, 1); break;
            case 'BANCO_1': $value = substr($line, 82, 10); break;
            case 'BANCO_2': $value = substr($line, 92, 12); break;
            case 'RATEIO': $value = substr($line, 104, 1); break;
            case 'PAGAMENTO_PARCIAL': $value = substr($line, 105, 2); break;
            case 'CARTEIRA': $value = substr($line, 107, 1); break;
            case 'OCORRENCIA': $value = substr($line, 108, 2); break;
            case 'DATA_OCORRENCIA': $value = substr($line, 110, 6); break;
            case 'NUM_DOCUMENTO': $value = substr($line, 116, 10); break;
            case 'TITULO': $value = substr($line, 126, 20); break;
            case 'VENCIMENTO': $value = substr($line, 146, 6); break;
            case 'VALOR_TITULO_CENTAVOS': $value = substr($line, 152, 13); break;
            case 'BANCO_COBRADOR': $value = substr($line, 165, 3); break;
            case 'AGENCIA_COBRADORA': $value = substr($line, 168, 5); break;
            case 'ESPECIE': $value = substr($line, 173, 2); break;
            case 'DESPESAS_1_CENTAVOS': $value = substr($line, 175, 13); break;
            case 'DESPESAS_2_CENTAVOS': $value = substr($line, 188, 13); break;
            case 'JUROS_CENTAVOS': $value = substr($line, 201, 13); break;
            case 'IOF_CENTAVOS': $value = substr($line, 214, 13); break;
            case 'ABATIMENTO_CENTAVOS': $value = substr($line, 227, 13); break;
            case 'DESCONTO_CENTAVOS': $value = substr($line, 240, 13); break;
            case 'VALOR_PAGO_CENTAVOS': $value = substr($line, 253, 13); break;
            case 'JUROS_MORA_CENTAVOS': $value = substr($line, 266, 13); break;
            case 'OUTROS_CREDITOS_CENTAVOS': $value = substr($line, 279, 13); break;
            case 'BRANCOS_1': $value = substr($line, 292, 2); break;
            case 'MOTIVO_OCORRENCIA': $value = substr($line, 294, 1); break;
            case 'DATA_CREDITO': $value = substr($line, 295, 6); break;
            case 'ORIGEM_PAGAMENTO': $value = substr($line, 301, 3); break;
            case 'BRANCOS_2': $value = substr($line, 304, 10); break;
            case 'CHEQUE_BRADESCO': $value = substr($line, 314, 4); break;
            case 'MOTIVO_REJEICAO': $value = substr($line, 318, 10); break;
            case 'BRANCOS_3': $value = substr($line, 328, 40); break;
            case 'NUM_CARTORIO': $value = substr($line, 368, 2); break;
            case 'NUM_PROTOCOLO': $value = substr($line, 370, 10); break;
            case 'BRANCOS_4': $value = substr($line, 380, 14); break;
            case 'SEQUENCIAL': $value = substr($line, 394, 6); break;
            default: return 'Coluna não aceita no extract remessa data: '. $data;
        }

        if($pad){ return Discharge::padLine($data, $value); }
        return $value;

    }

    public static function extractAllFromTransaction1($line,$pad=true)
    {

        $type = 'TRANSACTION1';

        $registro = Discharge::extractFrom($type,$line,'registro',$pad);
        $tipo_inscricao = Discharge::extractFrom($type,$line,'tipo_inscricao',$pad);
        $num_inscricao = Discharge::extractFrom($type,$line,'num_inscricao',$pad);
        $zeros_1 = Discharge::extractFrom($type,$line,'zeros_1',$pad);
        $beneficiaria = Discharge::extractFrom($type,$line,'beneficiaria',$pad);
        $num_participante = Discharge::extractFrom($type,$line,'num_participante',$pad);
        $zeros_2 = Discharge::extractFrom($type,$line,'zeros_2',$pad);
        $nosso_num = Discharge::extractFrom($type,$line,'nosso_num',$pad);
        $nosso_num_dv = Discharge::extractFrom($type,$line,'nosso_num_dv',$pad);
        $banco_1 = Discharge::extractFrom($type,$line,'banco_1',$pad);
        $banco_2 = Discharge::extractFrom($type,$line,'banco_2',$pad);
        $rateio = Discharge::extractFrom($type,$line,'rateio',$pad);
        $pagamento_parcial = Discharge::extractFrom($type,$line,'pagamento_parcial',$pad);
        $carteira = Discharge::extractFrom($type,$line,'carteira',$pad);
        $ocorrencia = Discharge::extractFrom($type,$line,'ocorrencia',$pad);
        $data_ocorrencia = Discharge::extractFrom($type,$line,'data_ocorrencia',$pad);
        $num_documento = Discharge::extractFrom($type,$line,'num_documento',$pad);
        $titulo = Discharge::extractFrom($type,$line,'titulo',$pad);
        $vencimento = Discharge::extractFrom($type,$line,'vencimento',$pad);
        $valor_titulo = Discharge::extractFrom($type,$line,'valor_titulo_centavos',$pad);
        $banco_cobrador = Discharge::extractFrom($type,$line,'banco_cobrador',$pad);
        $agencia_cobradora = Discharge::extractFrom($type,$line,'agencia_cobradora',$pad);
        $especie = Discharge::extractFrom($type,$line,'especie',$pad);
        $despesas_1 = Discharge::extractFrom($type,$line,'despesas_1_centavos',$pad);
        $despesas_2 = Discharge::extractFrom($type,$line,'despesas_2_centavos',$pad);
        $juros = Discharge::extractFrom($type,$line,'juros_centavos',$pad);
        $iof = Discharge::extractFrom($type,$line,'iof_centavos',$pad);
        $abatimento = Discharge::extractFrom($type,$line,'abatimento_centavos',$pad);
        $desconto = Discharge::extractFrom($type,$line,'desconto_centavos',$pad);
        $valor_pago = Discharge::extractFrom($type,$line,'valor_pago_centavos',$pad);
        $juros_mora = Discharge::extractFrom($type,$line,'juros_mora_centavos',$pad);
        $outros_creditos = Discharge::extractFrom($type,$line,'outros_creditos_centavos',$pad);
        $brancos_1 = Discharge::extractFrom($type,$line,'brancos_1',$pad);
        $motivo_ocorrencia = Discharge::extractFrom($type,$line,'motivo_ocorrencia',$pad);
        $data_credito = Discharge::extractFrom($type,$line,'data_credito',$pad);
        $origem_pagamento = Discharge::extractFrom($type,$line,'origem_pagamento',$pad);
        $brancos_2 = Discharge::extractFrom($type,$line,'brancos_2',$pad);
        $cheque_bradesco = Discharge::extractFrom($type,$line,'cheque_bradesco',$pad);
        $motivo_rejeicao = Discharge::extractFrom($type,$line,'motivo_rejeicao',$pad);
        $brancos_3 = Discharge::extractFrom($type,$line,'brancos_3',$pad);
        $num_cartorio = Discharge::extractFrom($type,$line,'num_cartorio',$pad);
        $num_protocolo = Discharge::extractFrom($type,$line,'num_protocolo',$pad);
        $brancos_4 = Discharge::extractFrom($type,$line,'brancos_4',$pad);
        $sequencial = Discharge::extractFrom($type,$line,'sequencial',$pad);

        return 
        $registro . 
        $tipo_inscricao . 
        $num_inscricao . 
        $zeros_1 . 
        $beneficiaria . 
        $num_participante . 
        $zeros_2 . 
        $nosso_num . 
        $nosso_num_dv . 
        $banco_1 . 
        $banco_2 . 
        $rateio . 
        $pagamento_parcial . 
        $carteira . 
        $ocorrencia . 
        $data_ocorrencia . 
        $num_documento . 
        $titulo . 
        $vencimento . 
        $valor_titulo . 
        $banco_cobrador . 
        $agencia_cobradora . 
        $especie . 
        $despesas_1 . 
        $despesas_2 . 
        $juros . 
        $iof . 
        $abatimento . 
        $desconto . 
        $valor_pago . 
        $juros_mora . 
        $outros_creditos . 
        $brancos_1 . 
        $motivo_ocorrencia . 
        $data_credito . 
        $origem_pagamento . 
        $brancos_2 . 
        $cheque_bradesco . 
        $motivo_rejeicao . 
        $brancos_3 . 
        $num_cartorio . 
        $num_protocolo . 
        $brancos_4 . 
        $sequencial;

    }

    public function transaction1Help()
    {
        $data = [
            'CNAB' => 'BRADESCO',
            'TYPE' => 'TYPE1',
            'REGISTRO' => [ 
                'position_from' => '001',
                'position_to' => '001',
                'size' => '001',
                'content' => '1',
                'type' => 'Numérico',
                'friendly_name' => 'Número do Registo'
            ],
            'TIPO_INSCRICAO' => [ 
                'position_from' => '002',
                'position_to' => '003',
                'size' => '002',
                'content' => [
                    '01' => 'CPF',
                    '02' => 'CNPJ',
                    '03' => 'PIS/PASEP',
                    '98' => 'Não tem',
                    '99' => 'Outros',
                    'OBS' => 'Relativo ao Sacado'
                ],
                'type' => 'Numérico',
                'friendly_name' => 'CPF ou CNPJ do Sacado'
            ],
            'NUM_INSCRICAO' => [ 
                'position_from' => '004',
                'position_to' => '017',
                'size' => '014',
                'content' => 'CNPJ/CPF, Número, Filial, Controle do Sacado',
                'type' => 'Numérico',
                'friendly_name' => 'Número da Inscrição'
            ],
            'ZEROS_1' => [ 
                'position_from' => '018',
                'position_to' => '020',
                'size' => '003',
                'content' => 'Zeros',
                'type' => 'Numérico',
                'friendly_name' => 'Zeros'
            ],
            'BENEFICIARIA' => [ 
                'position_from' => '021',
                'position_to' => '037',
                'size' => '017',
                'content' => 'Zero, Carteira, Agência, Conta Corrente (convênio)',
                'type' => 'Alfanumérico',
                'friendly_name' => 'Convênio'
            ],
            'NUM_PARTICIPANTE' => [ 
                'position_from' => '038',
                'position_to' => '062',
                'size' => '025',
                'content' => 'Uso da Empresa',
                'type' => 'Alfanumérico',
                'content' => 'Sdocumento no banco de dados',
                'friendly_name' => 'Sdocumento'
            ],
            'ZEROS_2' => [ 
                'position_from' => '063',
                'position_to' => '070',
                'size' => '008',
                'content' => 'Zeros',
                'type' => 'Numérico',
                'friendly_name' => 'Zeros'
            ],
            'NOSSO_NUM' => [ 
                'position_from' => '071',
                'position_to' => '081',
                'size' => '011',
                'content' => 'Nº Banco',
                'type' => 'Numérico',
                'friendly_name' => 'Nosso Número'
            ],
            'NOSSO_NUM_DV' => [ 
                'position_from' => '082',
                'position_to' => '082',
                'size' => '01',
                'content' => 'Nº Banco (dv)',
                'type' => 'Numérico',
                'friendly_name' => 'Nosso Número DV'
            ],
            'BANCO_1' => [ 
                'position_from' => '083',
                'position_to' => '092',
                'size' => '010',
                'content' => 'Zeros',
                'type' => 'Numérico',
                'friendly_name' => 'Primeiro Banco'
            ],
            'BANCO_2' => [ 
                'position_from' => '093',
                'position_to' => '104',
                'size' => '012',
                'content' => 'Zeros',
                'type' => 'Numérico',
                'friendly_name' => 'Segundo Banco'
            ],
            'RATEIO' => [ 
                'position_from' => '105',
                'position_to' => '105',
                'size' => '001',
                'content' => 'R',
                'type' => 'Alfanumérico',
                'friendly_name' => 'Rateio'
            ],
            'PAGAMENTO_PARCIAL' => [ 
                'position_from' => '106',
                'position_to' => '107',
                'size' => '002',
                'content' => [
                    '00' => 'Não foi informado parcelamento ou o parcelamento foi rejeitado',
                    'Diferente 00' => 'Parcelamento aceito'
                ],
                'type' => 'Numérico',
                'friendly_name' => 'Parcelamento'
            ],
            'CARTEIRA' => [ 
                'position_from' => '108',
                'position_to' => '108',
                'size' => '001',
                'content' => 'Carteira',
                'type' => 'Numérico',
                'friendly_name' => 'Carteira'
            ],
            'OCORRENCIA' => [ 
                'position_from' => '109',
                'position_to' => '110',
                'size' => '002',
                'content' => [
                    'title' => 'Para Cobrança com Registro e sem Registro / Para as ocorrências sem motivos, as posições serão informadas com Zeros',
                    'options' => [
                        '02' => 'Entrada Confirmada (verificar motivo nas posições 319 a 328)',
                        '03' => 'Entrada Rejeitada (verificar motivo nas posições 319 a 328)',
                        '06' => 'Liquidação Normal (sem motivo)',
                        '07' => 'Conf. Exc. Cadastro Pagador Débito (verificar motivos nas posições 319 a 328)',
                        '08' => 'Rej. Ped. Exc. Cadastro de Pagador Débito (verificar motivos nas posições 319 a 328)',
                        '09' => 'Baixado Automat. via Arquivo (verificar motivo posições 319 a 328)',
                        '10' => 'Baixado conforme instruções da Agência (verificar motivo Pos.319 a 328)',
                        '11' => 'Em Ser - Arquivo de Títulos Pendentes',
                        '12' => 'Abatimento Concedido',
                        '13' => 'Abatimento Cancelado',
                        '14' => 'Vencimento Alterado',
                        '15' => 'Liquidação em Cartório (sem motivo)',
                        '16' => 'Título Pago em Cheque - Vinculado',
                        '17' => 'Liquidação após Baixa ou Título não Registrado (verificar motivo nas posições 319 a 328)',
                        '18' => 'Acerto de Depositária',
                        '19' => 'Confirmação Receb. Inst. de Protesto (verificar motivo pos.295 a 295)',
                        '20' => 'Confirmação Recebimento Instrução Sustação de Protesto',
                        '21' => 'Acerto do Controle do Participante',
                        '22' => 'Título com Pagamento Cancelado',
                        '23' => 'Entrada do Título em Cartório',
                        '24' => 'Entrada Rejeitada por CEP Irregular (verificar motivo pos.319 a 328)',
                        '25' => 'Confirmação Receb.Inst.de Protesto Falimentar (verificar pos.295 a 295)',
                        '27' => 'Baixa Rejeitada (verificar motivo posições 319 a 328)',
                        '28' => 'Débito de Tarifas/Custas (verificar motivo nas posições 319 a 328)',
                        '29' => 'Ocorrências do Pagador (verificar motivo nas posições 319 a 328)',
                        '30' => 'Alteração de Outros Dados Rejeitados (verificar motivo Pos.319 a 328)',
                        '31' => 'Confirmado Inclusão Cadastro Pagador',
                        '32' => 'Instrução Rejeitada (verificar motivo posições 319 a 328)',
                        '33' => 'Confirmação Pedido Alteração Outros Dados',
                        '34' => 'Retirado de Cartório e Manutenção Carteira',
                        '35' => 'Cancelamento do Agendamento do Débito Automático (verificar motivos pos. 319 a 328)',
                        '37' => 'Rejeitado Inclusão Cadastro Pagador (verificar motivos nas posições 319 a 328)',
                        '38' => 'Confirmado Alteração Pagador',
                        '39' => 'Rejeitado Alteração Cadastro Pagador (verificar motivos nas posições 319 a 328)',
                        '40' => 'Estorno de Pagamento',
                        '55' => 'Sustado Judicial',
                        '68' => 'Acerto dos Dados do Rateio de Crédito (verificar motivo posição de status do registro Tipo 3)',
                        '69' => 'Cancelamento de Rateio (verificar motivo posição de status do registro Tipo 3)',
                        '73' => 'Confirmação Receb. Pedido de Negativação',
                        '74' => 'Confir Pedido de Excl de Negat (com ou sem baixa)'
                    ]
                ],
                'type' => 'Alfanumérico',
                'friendly_name' => 'Ocorrência'
            ],
            'DATA_OCORRENCIA' => [ 
                'position_from' => '111',
                'position_to' => '116',
                'size' => '006',
                'content' => 'DDMMAA',
                'type' => 'Numérico',
                'friendly_name' => 'Data da Ocorrência'
            ],
            'NUM_DOCUMENTO' => [ 
                'position_from' => '117',
                'position_to' => '126',
                'size' => '010',
                'content' => 'Nº do Documento',
                'type' => 'Alfanumérico',
                'friendly_name' => 'Nº do Documento'
            ],
            'TITULO' => [ 
                'position_from' => '127',
                'position_to' => '146',
                'size' => '020',
                'content' => 'Nº Banco',
                'type' => 'Numérico',
                'content' => [
                    'title' => 'Normalmente utilizamos o nosso número + dígito verificador'
                ],
                'friendly_name' => 'Título (NossoNum+DV)'
            ],
            'VENCIMENTO' => [ 
                'position_from' => '147',
                'position_to' => '152',
                'size' => '006',
                'content' => 'DDMMAA',
                'type' => 'Numérico',
                'friendly_name' => 'Vencimento'
            ],
            'VALOR_TITULO_CENTAVOS' => [ 
                'position_from' => '153',
                'position_to' => '165',
                'size' => '013',
                'content' => 'Valor do Título',
                'type' => 'Numérico',
                'friendly_name' => 'Valor Título Centavos'
            ],
            'BANCO_COBRADOR' => [ 
                'position_from' => '166',
                'position_to' => '168',
                'size' => '003',
                'content' => 'Código do Banco Câmara de Compensação',
                'type' => 'Numérico',
                'friendly_name' => 'Banco Cobrador'
            ],
            'AGENCIA_COBRADORA' => [ 
                'position_from' => '169',
                'position_to' => '173',
                'size' => '005',
                'content' => 'Código da Agência do Banco Cobrador',
                'type' => 'Numérico',
                'friendly_name' => 'Agência Cobrador'
            ],
            'ESPECIE' => [ 
                'position_from' => '174',
                'position_to' => '175',
                'size' => '002',
                'content' => 'Branco',
                'type' => 'Alfanumérico',
                'friendly_name' => 'Espécie'
            ],
            'DESPESAS_1_CENTAVOS' => [ 
                'position_from' => '176',
                'position_to' => '188',
                'size' => '013',
                'content' => [
                    'title' => 'Despesas de cobrança para os Códigos de Ocorrência',
                    'options' => [
                        '02' => 'Entradas Confirmadas',
                        '28' => 'Débitos de Tarifas'
                    ]
                ],
                'type' => 'Numérico',
                'friendly_name' => 'Despesas de cobrança (Códigos de Ocorrência)'
            ],
            'DESPESAS_2_CENTAVOS' => [ 
                'position_from' => '189',
                'position_to' => '201',
                'size' => '013',
                'content' => 'Valor outras despesas custas de Protesto',
                'type' => 'Numérico',
                'friendly_name' => 'Despesas de cobrança (Despesas de Protesto)'
            ],
            'JUROS_CENTAVOS' => [ 
                'position_from' => '202',
                'position_to' => '214',
                'size' => '013',
                'content' => 'Será informado  Com zeros',
                'type' => 'Numérico',
                'friendly_name' => 'Valor dos Juros'
            ],
            'IOF_CENTAVOS' => [ 
                'position_from' => '215',
                'position_to' => '227',
                'size' => '013',
                'content' => 'Valor do IOF',
                'type' => 'Numérico',
                'friendly_name' => 'Valor do IOF'
            ],
            'ABATIMENTO_CENTAVOS' => [ 
                'position_from' => '228',
                'position_to' => '240',
                'size' => '013',
                'content' => 'Valor abatimento concedido',
                'type' => 'Numérico',
                'friendly_name' => 'Valor do Abatimento'
            ],
            'DESCONTO_CENTAVOS' => [ 
                'position_from' => '241',
                'position_to' => '253',
                'size' => '013',
                'content' => 'Valor desconto concedido',
                'type' => 'Numérico',
                'friendly_name' => 'Valor do Desconto'
            ],
            'VALOR_PAGO_CENTAVOS' => [ 
                'position_from' => '254',
                'position_to' => '266',
                'size' => '013',
                'content' => 'Valor Pago',
                'type' => 'Numérico',
                'friendly_name' => 'Valor Pago'
            ],
            'JUROS_MORA_CENTAVOS' => [ 
                'position_from' => '267',
                'position_to' => '279',
                'size' => '013',
                'content' => 'Juros de Mora',
                'type' => 'Numérico',
                'friendly_name' => 'Valor de Juros de Mora'
            ],
            'OUTROS_CREDITOS_CENTAVOS' => [ 
                'position_from' => '280',
                'position_to' => '292',
                'size' => '013',
                'content' => 'Sera informado com zeros',
                'type' => 'Numérico',
                'friendly_name' => 'Outros Créditos'
            ],
            'BRANCOS_1' => [ 
                'position_from' => '293',
                'position_to' => '294',
                'size' => '002',
                'content' => 'Brancos',
                'type' => 'Alfanumérico',
                'friendly_name' => 'Brancos'
            ],
            'MOTIVO_OCORRENCIA' => [ 
                'position_from' => '295',
                'position_to' => '295',
                'size' => '001',
                'content' => [
                    'A' => 'Aceito',
                    'D' => 'Desprezado'
                ],
                'type' => 'Alfanumérico',
                'friendly_name' => 'Motivo Ocorrência'
            ],
            'DATA_CREDITO' => [ 
                'position_from' => '296',
                'position_to' => '301',
                'size' => '006',
                'content' => 'DDMMAA',
                'type' => 'Numérico',
                'friendly_name' => 'Data do Crédito'
            ],
            'ORIGEM_PAGAMENTO' => [ 
                'position_from' => '302',
                'position_to' => '304',
                'size' => '03',
                'content' => 'Origem',
                'type' => 'Numérico',
                'friendly_name' => 'Origem do pagamento'
            ],
            'BRANCOS_2' => [ 
                'position_from' => '305',
                'position_to' => '314',
                'size' => '010',
                'content' => 'Brancos',
                'type' => 'Alfanumérico',
                'friendly_name' => 'Brancos'
            ],
            'CHEQUE_BRADESCO' => [ 
                'position_from' => '315',
                'position_to' => '318',
                'size' => '004',
                'content' => 'Codigo do Banco',
                'type' => 'Numérico',
                'friendly_name' => 'Código do Banco (cheque Bradesco)'
            ],
            'MOTIVO_REJEICAO' => [ 
                'position_from' => '319',
                'position_to' => '328',
                'size' => '010',
                'content' => 'Motivos das Rejeições para os Códigos de Ocorrência da Posição 109 a 110',
                'type' => 'Alfanumérico',
                'friendly_name' => 'Motivo Rejeição (ocorrências)'
            ],
            'BRANCOS_3' => [ 
                'position_from' => '329',
                'position_to' => '368',
                'size' => '040',
                'content' => 'Brancos',
                'type' => 'Alfanumérico',
                'friendly_name' => 'Brancos'
            ],
            'NUM_CARTORIO' => [ 
                'position_from' => '369',
                'position_to' => '370',
                'size' => '002',
                'content' => 'Número do Cartório',
                'type' => 'Numérico',
                'friendly_name' => 'Número do Cartório'
            ],
            'NUM_PROTOCOLO' => [ 
                'position_from' => '371',
                'position_to' => '380',
                'size' => '010',
                'content' => 'Número do Protocolo',
                'type' => 'Alfanumérico',
                'friendly_name' => 'Número do Protocolo'
            ],
            'BRANCOS_4' => [ 
                'position_from' => '381',
                'position_to' => '394',
                'size' => '014',
                'content' => 'Brancos',
                'type' => 'Numérico',
                'friendly_name' => 'Brancos'
            ],
            'SEQUENCIAL' => [ 
                'position_from' => '395',
                'position_to' => '400',
                'size' => '006',
                'content' => 'Nº Sequencial do Registro',
                'type' => 'Numérico',
                'friendly_name' => 'Nº Sequencial do Registro'
            ]
        ];

        return $data;
    }

    public function transaction1ReplaceOn($line,$data,$new_value)
    {

        switch(strtoupper($data)){
            case 'REGISTRO': return substr_replace($line, $new_value, 0, 1); break;
            case 'TIPO_INSCRICAO': return substr_replace($line, $new_value, 1, 2); break;
            case 'NUM_INSCRICAO': return substr_replace($line, $new_value, 3, 14); break;
            case 'ZEROS_1': return substr_replace($line, $new_value, 17, 3); break;
            case 'BENEFICIARIA': return substr_replace($line, $new_value, 20, 17); break;
            case 'NUM_PARTICIPANTE': return substr_replace($line, $new_value, 37, 25); break;
            case 'ZEROS_2': return substr_replace($line, $new_value, 62, 8); break;
            case 'NOSSO_NUM': return substr_replace($line, $new_value, 70, 11); break;
            case 'NOSSO_NUM_DV': return substr_replace($line, $new_value, 81, 1); break;
            case 'BANCO_1': return substr_replace($line, $new_value, 82, 10); break;
            case 'BANCO_2': return substr_replace($line, $new_value, 92, 12); break;
            case 'RATEIO': return substr_replace($line, $new_value, 104, 1); break;
            case 'PAGAMENTO_PARCIAL': return substr_replace($line, $new_value, 105, 2); break;
            case 'CARTEIRA': return substr_replace($line, $new_value, 107, 1); break;
            case 'OCORRENCIA': return substr_replace($line, $new_value, 108, 2); break;
            case 'DATA_OCORRENCIA': return substr_replace($line, $new_value, 110, 6); break;
            case 'NUM_DOCUMENTO': return substr_replace($line, $new_value, 116, 10); break;
            case 'TITULO': return substr_replace($line, $new_value, 126, 20); break;
            case 'VENCIMENTO': return substr_replace($line, $new_value, 146, 6); break;
            case 'VALOR_TITULO_CENTAVOS': return substr_replace($line, $new_value, 152, 13); break;
            case 'BANCO_COBRADOR': return substr_replace($line, $new_value, 165, 3); break;
            case 'AGENCIA_COBRADORA': return substr_replace($line, $new_value, 168, 5); break;
            case 'ESPECIE': return substr_replace($line, $new_value, 173, 2); break;
            case 'DESPESAS_1_CENTAVOS': return substr_replace($line, $new_value, 175, 13); break;
            case 'DESPESAS_2_CENTAVOS': return substr_replace($line, $new_value, 188, 13); break;
            case 'JUROS_CENTAVOS': return substr_replace($line, $new_value, 201, 13); break;
            case 'IOF_CENTAVOS': return substr_replace($line, $new_value, 214, 13); break;
            case 'ABATIMENTO_CENTAVOS': return substr_replace($line, $new_value, 227, 13); break;
            case 'DESCONTO_CENTAVOS': return substr_replace($line, $new_value, 240, 13); break;
            case 'VALOR_PAGO_CENTAVOS': return substr_replace($line, $new_value, 253, 13); break;
            case 'JUROS_MORA_CENTAVOS': return substr_replace($line, $new_value, 266, 13); break;
            case 'OUTROS_CREDITOS_CENTAVOS': return substr_replace($line, $new_value, 279, 13); break;
            case 'BRANCOS_1': return substr_replace($line, $new_value, 292, 2); break;
            case 'MOTIVO_OCORRENCIA': return substr_replace($line, $new_value, 294, 1); break;
            case 'DATA_CREDITO': return substr_replace($line, $new_value, 295, 6); break;
            case 'ORIGEM_PAGAMENTO': return substr_replace($line, $new_value, 301, 3); break;
            case 'BRANCOS_2':return substr_replace($line, $new_value, 304, 10); break;
            case 'CHEQUE_BRADESCO': return substr_replace($line, $new_value, 314, 4); break;
            case 'MOTIVO_REJEICAO': return substr_replace($line, $new_value, 318, 10); break;
            case 'BRANCOS_3': return substr_replace($line, $new_value, 328, 40); break;
            case 'NUM_CARTORIO': return substr_replace($line, $new_value, 368, 2); break;
            case 'NUM_PROTOCOLO': return substr_replace($line, $new_value, 370, 10); break;
            case 'BRANCOS_4': return substr_replace($line, $new_value,  380, 14); break;
            case 'SEQUENCIAL': return substr_replace($line, $new_value, 394, 6); break;
            default: return 'Coluna não aceita no replace remessa data: ' . $data;
        }

    }

    public function transaction1PadLine($data,$value)
    {

        $value = Common::cleanUp($value);
        $value = Common::removeExtraSpaces($value);

        $pad_replace = ' ';

        switch(strtoupper($data)){
            case 'REGISTRO': return str_pad(substr($value, 0, 1), 1, '0', STR_PAD_LEFT); break;
            case 'TIPO_INSCRICAO': return str_pad(substr($value, 0, 2), 2, '0', STR_PAD_LEFT); break;
            case 'NUM_INSCRICAO': return str_pad(substr($value, 0, 14), 14, '0', STR_PAD_LEFT); break;
            case 'ZEROS_1': return str_pad(substr($value, 0, 3), 3, '0', STR_PAD_LEFT); break;
            case 'BENEFICIARIA': return str_pad(substr($value, 0, 17), 17, $pad_replace, STR_PAD_RIGHT); break;
            case 'NUM_PARTICIPANTE': return str_pad(substr($value, 0, 25), 25, $pad_replace, STR_PAD_RIGHT); break;
            case 'ZEROS_2': return str_pad(substr($value, 0, 8), 8, '0', STR_PAD_LEFT); break;
            case 'NOSSO_NUM': return str_pad(substr($value, 0, 11), 11, '0', STR_PAD_LEFT); break;
            case 'NOSSO_NUM_DV': return str_pad(substr($value, 0, 1), 1, '0', STR_PAD_LEFT); break;
            case 'BANCO_1': return str_pad(substr($value, 0, 10), 10, '0', STR_PAD_LEFT); break;
            case 'BANCO_2': return str_pad(substr($value, 0, 12), 12, '0', STR_PAD_LEFT); break;
            case 'RATEIO': return str_pad(substr($value, 0, 1), 1,  '0', STR_PAD_RIGHT); break;
            case 'PAGAMENTO_PARCIAL': return str_pad(substr($value, 0, 2), 2, '0', STR_PAD_LEFT); break;
            case 'CARTEIRA': return str_pad(substr($value, 0, 1), 1, '0', STR_PAD_LEFT); break;
            case 'OCORRENCIA': return str_pad(substr($value, 0, 2), 2, '0', STR_PAD_LEFT); break;
            case 'DATA_OCORRENCIA': return str_pad(substr($value, 0, 6), 6, '0', STR_PAD_LEFT); break;
            case 'NUM_DOCUMENTO': return str_pad(substr($value, 0, 10), 10, $pad_replace, STR_PAD_RIGHT); break;
            case 'TITULO': return str_pad(substr($value, 0, 20), 20, '0', STR_PAD_LEFT); break;
            case 'VENCIMENTO': return str_pad(substr($value, 0, 6), 6, '0', STR_PAD_LEFT); break;
            case 'VALOR_TITULO_CENTAVOS': return str_pad(substr($value, 0, 13), 13, '0', STR_PAD_LEFT); break;
            case 'BANCO_COBRADOR': return str_pad(substr($value, 0, 3), 3, '0', STR_PAD_LEFT); break;
            case 'AGENCIA_COBRADORA': return str_pad(substr($value, 0, 5), 5, '0', STR_PAD_LEFT); break;
            case 'ESPECIE': return str_pad(substr($value, 0, 2), 2, $pad_replace, STR_PAD_RIGHT); break;
            case 'DESPESAS_1_CENTAVOS': return str_pad(substr($value, 0, 13), 13, '0', STR_PAD_LEFT); break;
            case 'DESPESAS_2_CENTAVOS': return str_pad(substr($value, 0, 13), 13, '0', STR_PAD_LEFT); break;
            case 'JUROS_CENTAVOS': return str_pad(substr($value, 0, 13), 13, '0', STR_PAD_LEFT); break;
            case 'IOF_CENTAVOS': return str_pad(substr($value, 0, 13), 13, '0', STR_PAD_LEFT); break;
            case 'ABATIMENTO_CENTAVOS': return str_pad(substr($value, 0, 13), 13, '0', STR_PAD_LEFT); break;
            case 'DESCONTO_CENTAVOS': return str_pad(substr($value, 0, 13), 13, '0', STR_PAD_LEFT); break;
            case 'VALOR_PAGO_CENTAVOS': return str_pad(substr($value, 0, 13), 13, '0', STR_PAD_LEFT); break;
            case 'JUROS_MORA_CENTAVOS': return str_pad(substr($value, 0, 13), 13, '0', STR_PAD_LEFT); break;
            case 'OUTROS_CREDITOS_CENTAVOS': return str_pad(substr($value, 0, 13), 13, '0', STR_PAD_LEFT); break;
            case 'BRANCOS_1': return str_pad(substr($value, 0, 2), 2, $pad_replace, STR_PAD_RIGHT); break;
            case 'MOTIVO_OCORRENCIA': return str_pad(substr($value, 0, 1), 1, $pad_replace, STR_PAD_RIGHT); break;
            case 'DATA_CREDITO':return str_pad(substr($value, 0, 6), 6, '0', STR_PAD_LEFT); break;
            case 'ORIGEM_PAGAMENTO': return str_pad(substr($value, 0, 3), 3, '0', STR_PAD_LEFT); break;
            case 'BRANCOS_2': return str_pad(substr($value, 0, 10), 10, $pad_replace, STR_PAD_RIGHT); break;
            case 'CHEQUE_BRADESCO': return str_pad(substr($value, 0, 4), 4, '0', STR_PAD_LEFT); break;
            case 'MOTIVO_REJEICAO': return str_pad(substr($value, 0, 10), 10, '0', STR_PAD_LEFT); break;
            case 'BRANCOS_3': return str_pad(substr($value, 0, 40), 40, $pad_replace, STR_PAD_RIGHT); break;
            case 'NUM_CARTORIO': return str_pad(substr($value, 0, 2), 2, '0', STR_PAD_LEFT); break;
            case 'NUM_PROTOCOLO': return str_pad(substr($value, 0, 10), 10, $pad_replace, STR_PAD_RIGHT); break;
            case 'BRANCOS_4': return str_pad(substr($value, 0, 14), 14, $pad_replace, STR_PAD_RIGHT); break;
            case 'SEQUENCIAL': return str_pad(substr($value, 0, 6), 6, '0', STR_PAD_LEFT); break;
            default: return 'Coluna não aceita no extract remessa data: ' . $data;
        }
    }

    public function transaction1TranslateOcorrencia($ocorrencia)
    {
        switch($ocorrencia){
            case '02': return 'Entrada Confirmada (verificar motivo nas posições 319 a 328)';
            case '03': return 'Entrada Rejeitada (verificar motivo nas posições 319 a 328)';
            case '06': return 'Liquidação Normal (sem motivo)';
            case '07': return 'Conf. Exc. Cadastro Pagador Débito (verificar motivos nas posições 319 a 328)';
            case '08': return 'Rej. Ped. Exc. Cadastro de Pagador Débito (verificar motivos nas posições 319 a 328)';
            case '09': return 'Baixado Automat. via Arquivo (verificar motivo posições 319 a 328)';
            case '10': return 'Baixado conforme instruções da Agência (verificar motivo Pos.319 a 328)';
            case '11': return 'Em Ser - Arquivo de Títulos Pendentes';
            case '12': return 'Abatimento Concedido';
            case '13': return 'Abatimento Cancelado';
            case '14': return 'Vencimento Alterado';
            case '15': return 'Liquidação em Cartório (sem motivo)';
            case '16': return 'Título Pago em Cheque - Vinculado';
            case '17': return 'Liquidação após Baixa ou Título não Registrado (verificar motivo nas posições 319 a 328)';
            case '18': return 'Acerto de Depositária';
            case '19': return 'Confirmação Receb. Inst. de Protesto (verificar motivo pos.295 a 295)';
            case '20': return 'Confirmação Recebimento Instrução Sustação de Protesto';
            case '21': return 'Acerto do Controle do Participante';
            case '22': return 'Título com Pagamento Cancelado';
            case '23': return 'Entrada do Título em Cartório';
            case '24': return 'Entrada Rejeitada por CEP Irregular (verificar motivo pos.319 a 328)';
            case '25': return 'Confirmação Receb.Inst.de Protesto Falimentar (verificar pos.295 a 295)';
            case '27': return 'Baixa Rejeitada (verificar motivo posições 319 a 328)';
            case '28': return 'Débito de Tarifas/Custas (verificar motivo nas posições 319 a 328)';
            case '29': return 'Ocorrências do Pagador (verificar motivo nas posições 319 a 328)';
            case '30': return 'Alteração de Outros Dados Rejeitados (verificar motivo Pos.319 a 328)';
            case '31': return 'Confirmado Inclusão Cadastro Pagador';
            case '32': return 'Instrução Rejeitada (verificar motivo posições 319 a 328)';
            case '33': return 'Confirmação Pedido Alteração Outros Dados';
            case '34': return 'Retirado de Cartório e Manutenção Carteira';
            case '35': return 'Cancelamento do Agendamento do Débito Automático (verificar motivos pos. 319 a 328)';
            case '37': return 'Rejeitado Inclusão Cadastro Pagador (verificar motivos nas posições 319 a 328)';
            case '38': return 'Confirmado Alteração Pagador';
            case '39': return 'Rejeitado Alteração Cadastro Pagador (verificar motivos nas posições 319 a 328)';
            case '40': return 'Estorno de Pagamento';
            case '55': return 'Sustado Judicial';
            case '68': return 'Acerto dos Dados do Rateio de Crédito (verificar motivo posição de status do registro Tipo 3)';
            case '69': return 'Cancelamento de Rateio (verificar motivo posição de status do registro Tipo 3)';
            case '73': return 'Confirmação Receb. Pedido de Negativação';
            case '74': return 'Confir Pedido de Excl de Negat (com ou sem baixa)';
            default: return 'Ocorrência inválida: ' . $ocorrencia;
        }
    }

    public function transaction1TranslateMotivoRejeicao($ocorrencia,$rejeicao)
    {

        if($ocorrencia === '02'){
            switch($rejeicao){
                case '00': return 'Ocorrência Aceita';
                case '01': return 'Código do Banco Inválido';
                case '02': return ' Pendente de Autorização (Autorização Débito Automático)';
                case '03': return 'Pendente de Ação do Pagador (Autorização Débito Automático - Data Vencimento)';
                case '04': return 'Código do Movimento não Permitido para a Carteira';
                case '15': return 'Características da Cobrança Incompatíveis';
                case '17': return 'Data de Vencimento Anterior à Data de Emissão';
                case '21': return 'Espécie do Título Inválido';
                case '24': return 'Data da Emissão Inválida';
                case '27': return 'Valor/Taxa de Juros Mora Inválido';
                case '38': return 'Prazo para Protesto/Negativação Inválido';
                case '39': return 'Pedido para Protesto/Negativação não Permitido para o Título';
                case '43': return 'Prazo para Baixa e Devolução Inválido';
                case '45': return 'Nome do Pagador Inválido';
                case '46': return 'Tipo/Num. de Inscrição do Pagador Inválidos';
                case '47': return 'Endereço do Pagador não Informado';
                case '48': return 'CEP Inválido';
                case '50': return 'CEP referente a Banco Correspondente';
                case '53': return 'Nº de Inscrição do Pagador/Avalista Inválidos (CPF/CNPJ)';
                case '54': return 'Beneficiário Final não Informado';
                case '67': return 'Débito Automático Agendado';
                case '68': return 'Débito não Agendado - Erro nos Dados de Remessa';
                case '69': return 'Débito não Agendado - Pagador não Consta no Cadastro de Autorizante';
                case '70': return 'Débito não Agendado - Beneficiário não Autorizado pelo Pagador';
                case '71': return 'Débito não Agendado - Beneficiário não Participa da Modalidade de Déb.Automático';
                case '72': return 'Débito não Agendado - Código de Moeda Diferente de R$';
                case '73': return 'Débito não Agendado - Data de Vencimento Inválida/Vencida';
                case '75': return 'Débito não Agendado - Tipo do Número de Inscrição do Pagador Debitado Inválido';
                case '76': return 'Pagador Eletrônico DDA';
                case '86': return 'Seu Número do Documento Inválido';
                case '87': return 'Título Baixado por Coobrigação e Devolvido para Carteira';
                case '89': return 'Email Pagador não Enviado - Título com Débito Automático';
                case '90': return 'Email Pagador não Enviado - Título de Cobrança sem Registro';
                default: return 'Rejeição não encontrada: ' . $rejeicao;
            }
        }

        if($ocorrencia === '03'){
            switch($rejeicao){
                case '00': return 'Ocorrência Aceita';
                case '02': return 'Código do Registro Detalhe Inválido';
                case '03': return 'Código da Ocorrência Inválida';
                case '04': return 'Código de Ocorrência não Permitida para a Carteira';
                case '05': return 'Código de Ocorrência não Numérico';
                case '07': return 'Agência/Conta/Dígito Inválido';
                case '08': return 'Nosso Número Inválido';
                case '09': return 'Nosso Número Duplicado';
                case '10': return 'Carteira Inválida';
                case '13': return 'Identificação da Emissão do Bloqueto Inválida';
                case '16': return 'Data de Vencimento Inválida';
                case '18': return 'Vencimento fora do Prazo de Operação';
                case '20': return 'Valor do Título Inválido';
                case '21': return 'Espécie do Título Inválida';
                case '22': return 'Espécie não Permitida para a Carteira';
                case '23': return 'Tipo Pagamento não Contratado';
                case '24': return 'Data de Emissão Inválida';
                case '27': return 'Valor/Taxa de Juros Mora Inválido';
                case '28': return 'Código do Desconto Inválido';
                case '29': return 'Valor Desconto > ou = Valor Título';
                case '32': return 'Valor do IOF Inválido';
                case '34': return 'Valor do Abatimento Maior ou Igual ao Valor do Título';
                case '38': return 'Prazo para Protesto/Negativação Inválido';
                case '39': return 'Pedido de Protesto/Negativação não Permitida para o Título';
                case '44': return 'Código da Moeda Inválido';
                case '45': return 'Nome do Pagador não Informado';
                case '46': return 'Tipo/Número de Inscrição do Pagador Inválidos';
                case '47': return 'Endereço do Pagador não Informado';
                case '48': return 'CEP Inválido';
                case '49': return 'CEP sem Praça de Cobrança';
                case '50': return 'CEP Irregular - Banco Correspondente';
                case '53': return 'Tipo/Número de Inscrição do Beneficiário Final Inválido';
                case '54': return 'Sacador/Avalista (Beneficiário Final) não Informado';
                case '59': return 'Valor/Percentual da Multa Inválido';
                case '63': return 'Entrada para Título já Cadastrado';
                case '65': return 'Limite Excedido';
                case '66': return 'Número Autorização Inexistente';
                case '68': return 'Débito não Agendado - Erro nos Dados de Remessa';
                case '69': return 'Débito não Agendado - Pagador não Consta no Cadastro de Autorizante';
                case '70': return 'Débito não Agendado - Beneficiário não Autorizado pelo Pagador';
                case '71': return 'Débito não Agendado - Beneficiário não Participa do Débito Automático';
                case '72': return 'Débito não Agendado - Código de Moeda Diferente de R$';
                case '73': return 'Débito não Agendado - Data de Vencimento Inválida/Cadastro Vencido';
                case '74': return 'Débito não Agendado - Conforme seu Pedido, Título não Registrado';
                case '75': return 'Débito não Agendado - Tipo de Número de Inscrição do Debitado Inválido';
                case '79': return 'Data de Juros de Mora Inválida';
                case '80': return 'Data do Desconto Inválida';
                case '86': return 'Seu Número Inválido';
                case 'A3': return 'Benef. Final/ Sacador/Pagador Devem ser Iguais';
                case 'A6': return 'Esp. BDP/Depósito e Aporte, não Aceita Pgto Parcial';
                default: return 'Rejeição não encontrada: ' . $rejeicao;
            }
        }

        if($ocorrencia === '06'){
            switch($rejeicao){
                case '00': return 'Crédito Disponível';
                case '15': return 'Crédito Indisponível';
                case '18': return 'Pagamento Parcial';
                case '42': return 'Rateio não Efetuado, Cód. Cálculo 2 (VLR. Registro)';
                default: return 'Rejeição não encontrada: ' . $rejeicao;
            }
        }

        if($ocorrencia === '07'){
            switch($rejeicao){
                case 'A0': return 'Cadastro Excluído pelo Beneficiário';
                case 'A1': return 'Cadastro Excluído pelo Pagador ';
                default: return 'Rejeição não encontrada: ' . $rejeicao;
            }
        }

        if($ocorrencia === '08'){
            switch($rejeicao){
                case 'C0': return 'Informações do Tipo 6 Inválidas';
                case 'B9': return 'Cadastro Pagador não Localizado';
                default: return 'Rejeição não encontrada: ' . $rejeicao;
            }
        }
        
        if($ocorrencia === '09'){
            switch($rejeicao){
                case '00': return 'Ocorrência Aceita';
                case '10': return 'Baixa Comandada pelo Cliente';
                case '18': return 'Pagador não Aceitou o Débito (Autorização Débito Automático)';
                case '19': return 'Pendente de Ação do Pagador (Autorização Débito Automático)';
                default: return 'Rejeição não encontrada: ' . $rejeicao;
            }
        }
        
        if($ocorrencia === '10'){
            switch($rejeicao){
                case '00': return 'Baixado Conforme Instruções da Agência';
                case '14': return 'Título Protestado';
                case '16': return 'Título Baixado pelo Banco por Decurso Prazo';
                case '20': return 'Titulo Baixado e Transferido para Desconto';
                default: return 'Rejeição não encontrada: ' . $rejeicao;
            }
        }
        
        if($ocorrencia === '15'){
            switch($rejeicao){
                case '00': return 'Crédito Disponível';
                case '15': return 'Crédito Indisponível';
                default: return 'Rejeição não encontrada: ' . $rejeicao;
            }
        }
        
        if($ocorrencia === '17'){
            switch($rejeicao){
                case '00': return 'Crédito Disponível';
                case '15': return 'Crédito Indisponível';
                default: return 'Rejeição não encontrada: ' . $rejeicao;
            }
        }
        
        if($ocorrencia === '24'){
            switch($rejeicao){
                case '00': return 'Ocorrência Aceita';
                case '48': return 'CEP Inválido';
                case '49': return 'CEP sem Praça de Cobrança';
                default: return 'Rejeição não encontrada: ' . $rejeicao;
            }
        }
        
        if($ocorrencia === '27'){
            switch($rejeicao){
                case '00': return 'Ocorrência Aceita';
                case '02': return 'Código do Registro Detalhe Inválido';
                case '04': return 'Código de Ocorrência não Permitido para a Carteira';
                case '07': return 'Agência/Conta/Dígito Inválidos';
                case '08': return 'Nosso Número Inválido';
                case '09': return 'Nosso Número Duplicado';
                case '10': return 'Carteira Inválida';
                case '15': return 'Carteira/Agência/Conta/Nosso Número Inválidos';
                case '16': return 'Data Vencimento Inválida';
                case '18': return 'Vencimento Fora do Prazo de Operação';
                case '20': return 'Valor Título Inválido';
                case '40': return 'Título com Ordem de Protesto Emitido';
                case '42': return 'Código para Baixa/Devolução Inválido';
                case '45': return 'Nome do Sacado não Informado ou Inválido';
                case '46': return 'Tipo/Número de Inscrição do Sacado Inválido';
                case '47': return 'Endereço do Sacado não Informado';
                case '48': return 'CEP Inválido';
                case '60': return 'Movimento para Título não Cadastrado';
                case '77': return 'Transferência para Desconto não Permitido para a Carteira';
                case '85': return 'Título com Pagamento Vinculado';
                case '86': return 'Seu Número Inválido';
                default: return 'Rejeição não encontrada: ' . $rejeicao;
            }
        }

        if($ocorrencia === '28'){
            switch($rejeicao){
                case '02': return 'Tarifa de Permanência Título Cadastrado (*)';
                case '03': return 'Tarifa de Sustação/Excl Negativação (*)';
                case '04': return 'Tarifa de Protesto/Incl Negativação (*)';
                case '08': return 'Custas de Protesto';
                case '12': return 'Tarifa de Registro (*)';
                case '13': return 'Tarifa Título Pago no Bradesco (*)';
                case '14': return 'Tarifa Título Pago Compensação (*)';
                case '15': return 'Tarifa Título Baixado não Pago (*)';
                case '16': return 'Tarifa Alteração de Vencimento (*)';
                case '17': return 'Tarifa Concessão Abatimento (*)';
                case '18': return 'Tarifa Cancelamento de Abatimento (*)';
                case '19': return 'Tarifa Concessão Desconto (*)';
                case '20': return 'Tarifa Cancelamento Desconto (*)';
                case '21': return 'Tarifa Título Pago CICS (*)';
                case '22': return 'Tarifa Título Pago Internet (*)';
                case '23': return 'Tarifa Título Pago Term. Gerencial Serviços (*)';
                case '24': return 'Tarifa Título Pago Pag-Contas (*)';
                case '25': return 'Tarifa Título Pago Fone Fácil (*)';
                case '26': return 'Tarifa Título Déb. Postagem (*)';
                case '28': return 'Tarifa Título Pago BDN (*)';
                case '29': return 'Tarifa Título Pago Term. Multi Função (*)';
                case '32': return 'Tarifa Título Pago PagFor (*)';
                case '33': return 'Tarifa Reg/Pgto - Guichê Caixa (*)';
                case '34': return 'Tarifa Título Pago Retaguarda (*)';
                case '35': return 'Tarifa Título Pago Subcentro (*)';
                case '36': return 'Tarifa Título Pago Cartão de Crédito (*)';
                case '37': return 'Tarifa Título Pago Comp Eletrônica (*)';
                case '38': return 'Tarifa Título Baix. Pg. Cartório (*)';
                case '39': return 'Tarifa Título Baixado Acerto Bco (*)';
                case '40': return 'Baixa Registro em Duplicidade (*)';
                case '41': return 'Tarifa Título Baixado Decurso Prazo (*)';
                case '42': return 'Tarifa Título Baixado Judicialmente (*)';
                case '43': return 'Tarifa Título Baixado via Remessa (*)';
                case '44': return 'Tarifa Título Baixado Rastreamento (*)';
                case '45': return 'Tarifa Título Baixado Conf. Pedido (*)';
                case '46': return 'Tarifa Título Baixado Protestado (*)';
                case '47': return 'Tarifa Título Baixado p/ Devolução (*)';
                case '48': return 'Tarifa Título Baixado Franco Pagto (*)';
                case '49': return 'Tarifa Título Baixado Sust/Ret/Cartório (*)';
                case '50': return 'Tarifa Título Baixado Sus/Sem/Rem/Cartório (*)';
                case '51': return 'Tarifa Título Transferido Desconto (*)';
                case '54': return 'Tarifa Baixa por Contabilidade (*)';
                case '55': return 'Tr. Tentativa Cons Déb Aut';
                case '56': return 'Tr. Crédito On-Line';
                case '57': return 'Tarifa Reg/Pagto Bradesco Expresso';
                case '58': return 'Tarifa Emissão Papeleta';
                case '78': return 'Tarifa Cadastro Cartela Instrução Permanente (*)';
                case '80': return 'Tarifa Parcial Pagamento Compensação (*)';
                case '81': return 'Tarifa Reapresentação Automática Título (*)';
                case '82': return 'Tarifa Registro Título Déb. Automático (*)';
                case '83': return 'Tarifa Rateio de Crédito (*)';
                case '89': return 'Tarifa Parcial Pagamento Bradesco (*)';
                case '96': return 'Tarifa Reg. Pagto Outras Mídias (*)';
                case '97': return 'Tarifa Reg/Pagto - Net Empresa (*)';
                case '98': return 'Tarifa Título Pago Vencido (*)';
                case '99': return 'Tr.Tít. Baixado por Decurso Prazo (*)';
                default: return 'Rejeição não encontrada: ' . $rejeicao;
            }
        }

        if($ocorrencia === '29'){
            switch($rejeicao){
                case '78': return 'Pagador Alega que Faturamento é Indevido (*)';
                case '95': return 'Pagador Aceita/Reconhece Faturamento (*)';
                default: return 'Rejeição não encontrada: ' . $rejeicao;
            }
        }
        
        if($ocorrencia === '30'){
            switch($rejeicao){
                case '00': return 'Ocorrência Aceita';
                case '01': return 'Código do Banco Inválido';
                case '04': return 'Código de Ocorrência não Permitido para a Carteira';
                case '05': return 'Código da Ocorrência não Numérico';
                case '08': return 'Nosso Número Inválido';
                case '15': return 'Característica da Cobrança Incompatível';
                case '16': return 'Data de Vencimento Inválido';
                case '17': return 'Data de Vencimento Anterior à Data de Emissão';
                case '18': return 'Vencimento Fora do Prazo de Operação';
                case '20': return 'Valor Título Inválido';
                case '21': return 'Espécie Título Inválida';
                case '22': return 'Espécie não Permitida para a Carteira';
                case '23': return 'Tipo Pagamento não Contratado';
                case '24': return 'Data de Emissão Inválida';
                case '26': return 'Código de Juros de Mora Inválido (*)';
                case '27': return 'Valor/Taxa de Juros de Mora Inválido';
                case '28': return 'Código de Desconto Inválido';
                case '29': return 'Valor do Desconto Maior/Igual ao Valor do Título';
                case '30': return 'Desconto a Conceder não Confere';
                case '31': return 'Concessão de Desconto já Existente ( Desconto Anterior )';
                case '32': return 'Valor do IOF Inválido';
                case '33': return 'Valor do Abatimento Inválido';
                case '34': return 'Valor do Abatimento Maior/Igual ao Valor do Título';
                case '36': return 'Concessão Abatimento';
                case '38': return 'Prazo para Protesto/ Negativação Inválido';
                case '39': return 'Pedido para Protesto/ Negativação não Permitido para o Título';
                case '40': return 'Título com Ordem/Pedido de Protesto/Negativação Emitido';
                case '42': return 'Código para Baixa/Devolução Inválido';
                case '43': return 'Prazo para Baixa/Devolução Inválido';
                case '46': return 'Tipo/Número de Inscrição do Pagador Inválidos';
                case '48': return 'CEP Inválido';
                case '53': return 'Tipo/Número de Inscrição do Pagador/Avalista Inválidos';
                case '54': return 'Pagador/Avalista não Informado';
                case '57': return 'Código da Multa Inválido';
                case '58': return 'Data da Multa Inválida';
                case '60': return 'Movimento para Título não Cadastrado';
                case '79': return 'Data de Juros de Mora Inválida';
                case '80': return 'Data do Desconto Inválida';
                case '85': return 'Título com Pagamento Vinculado.';
                case '88': return 'E-mail Pagador não Lido no Prazo 5 Dias';
                case '91': return 'E-mail Pagador não Recebido';
                case 'C0': return 'Informações do Tipo 6 Inválidas';
                case 'C1': return 'Informações do Tipo 6 Divergentes do Cadastro';
                default: return 'Rejeição não encontrada: ' . $rejeicao;
            }
        }

        if($ocorrencia === '32'){
            switch($rejeicao){
                case '00': return 'Ocorrência Aceita';
                case '01': return 'Código do Banco Inválido';
                case '02': return 'Código Registro Detalhe Inválido';
                case '04': return 'Código de Ocorrência não Permitido para a Carteira';
                case '05': return 'Código de Ocorrência não Numérico';
                case '06': return 'Espécie BDP, não Aceita Pagamento Parcial';
                case '07': return 'Agência/Conta/Dígito Inválidos';
                case '08': return 'Nosso Número Inválido';
                case '10': return 'Carteira Inválida';
                case '15': return 'Características da Cobrança Incompatíveis';
                case '16': return 'Data de Vencimento Inválida';
                case '17': return 'Data de Vencimento Anterior à Data de Emissão';
                case '18': return 'Vencimento Fora do Prazo de Operação';
                case '20': return 'Valor do Título Inválido';
                case '21': return 'Espécie do Título Inválida';
                case '22': return 'Espécie não Permitida para a Carteira';
                case '23': return 'Tipo Pagamento não Contratado';
                case '24': return 'Data de Emissão Inválida';
                case '26': return 'Código Juros Mora Inválido';
                case '27': return 'Valor/Taxa Juros Mira Inválido';
                case '28': return 'Código de Desconto Inválido';
                case '29': return 'Valor do Desconto Maior/Igual ao Valor do Título';
                case '30': return 'Desconto a Conceder não Confere';
                case '31': return 'Concessão de Desconto - Já Existe Desconto Anterior';
                case '33': return 'Valor do Abatimento Inválido';
                case '34': return 'Valor do Abatimento Maior/Igual ao Valor do Título';
                case '36': return 'Concessão Abatimento - Já Existe Abatimento Anterior';
                case '38': return 'Prazo para Protesto/Negativação Inválido';
                case '39': return 'Pedido para Protesto/Negativação não Permitido para o Título';
                case '40': return 'Título com Ordem/Pedido de Protesto/Negativação Emitido';
                case '41': return 'Pedido de Sustação/Excl p/ Título sem Instrução de Protesto/Negativação';
                case '45': return 'Nome do Pagador não Informado';
                case '46': return 'Tipo/Número de Inscrição do Pagador Inválidos';
                case '47': return 'Endereço do Pagador não Informado';
                case '48': return 'CEP Inválido';
                case '50': return 'CEP referente a um Banco Correspondente';
                case '52': return 'Unidade da Federação Inválida';
                case '53': return 'Tipo de Inscrição do Pagador Avalista Inválidos';
                case '60': return 'Movimento para Título não Cadastrado';
                case '65': return 'Limite Excedido';
                case '66': return 'Número Autorização Inexistente';
                case '85': return 'Título com Pagamento Vinculado';
                case '86': return 'Seu Número Inválido';
                case '94': return 'Título Cessão Fiduciária - Instrução Não Liberada pela Agência';
                case '97': return 'Instrução não Permitida Título Negativado';
                case '98': return 'Inclusão Bloqueada face à Determinação Judicial';
                case '99': return 'Telefone Beneficiário não Informado / Inconsistente';
                default: return 'Rejeição não encontrada: ' . $rejeicao;
            }
        }
        
        if($ocorrencia === '35'){
            switch($rejeicao){
                case '81': return 'Tentativas Esgotadas, Baixado';
                case '82': return 'Tentativas Esgotadas, Pendente';
                case '83': return 'Cancelado pelo Pagador e Mantido Pendente, Conforme Negociação (*)';
                case '84': return 'Cancelado pelo Pagador e Baixado, Conforme Negociação (*)';
                default: return 'Rejeição não encontrada: ' . $rejeicao;
            }
        }
    }

}