<?php

namespace QuataInvestimentos\Bank\Bradesco\Discharge;
use QuataInvestimentos\Bank\Bradesco\Discharge;
use QuataInvestimentos\Bank\Common;

trait Transaction1 {

    public function extractFrom($line,$data,$pad=true)
    {

        switch(strtoupper($data)){
            case 'REGISTRO': $value = substr($line, 0, 1); break;
            case 'TIPO_INSCRICAO': $value = substr($line, 1, 2); break;
            case 'NUM_INSCRICAO': $value = substr($line, 3, 14); break;
            case 'ZEROS_1': $value = substr($line, 17, 3); break;
            case 'IDENTIFICACAO_EMPRESA': $value = substr($line, 20, 17); break;
            case 'NUM_PARTICIPANTE': $value = substr($line, 37, 25); break;
            case 'ZEROS_2': $value = substr($line, 62, 8); break;
            case 'NOSSO_NUM': $value = substr($line, 70, 12); break;
            case 'BANCO_1': $value = substr($line, 82, 10); break;
            case 'BANCO_2': $value = substr($line, 92, 12); break;
            case 'RATEIO': $value = substr($line, 104, 1); break;
            case 'PAGAMENTO_PARCIAL': $value = substr($line, 105, 2); break;
            case 'CARTEIRA': $value = substr($line, 107, 1); break;
            case 'IDENTIFICACAO_OCORRENCIA': $value = substr($line, 108, 2); break;
            case 'DATA_OCORRENCIA': $value = substr($line, 110, 6); break;
            case 'NUM_DOCUMENTO': $value = substr($line, 116, 10); break;
            case 'TITULO': $value = substr($line, 126, 20); break;
            case 'VENCIMENTO': $value = substr($line, 146, 6); break;
            case 'VALOR_TITULO': $value = substr($line, 152, 13); break;
            case 'BANCO_COBRADOR': $value = substr($line, 165, 3); break;
            case 'AGENCIA_COBRADORA': $value = substr($line, 168, 5); break;
            case 'ESPECIE': $value = substr($line, 173, 2); break;
            case 'DESPESAS_1': $value = substr($line, 175, 13); break;
            case 'DESPESAS_2': $value = substr($line, 188, 13); break;
            case 'JUROS': $value = substr($line, 201, 13); break;
            case 'IOF': $value = substr($line, 214, 13); break;
            case 'ABATIMENTO': $value = substr($line, 227, 13); break;
            case 'DESCONTO': $value = substr($line, 240, 13); break;
            case 'VALOR_PAGO': $value = substr($line, 253, 13); break;
            case 'JUROS_MORA': $value = substr($line, 266, 13); break;
            case 'OUTROS_CREDITOS': $value = substr($line, 279, 13); break;
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
        $identificacao_empresa = Discharge::extractFrom($type,$line,'identificacao_empresa',$pad);
        $num_participante = Discharge::extractFrom($type,$line,'num_participante',$pad);
        $zeros_2 = Discharge::extractFrom($type,$line,'zeros_2',$pad);
        $nosso_num = Discharge::extractFrom($type,$line,'nosso_num',$pad);
        $banco_1 = Discharge::extractFrom($type,$line,'banco_1',$pad);
        $banco_2 = Discharge::extractFrom($type,$line,'banco_2',$pad);
        $rateio = Discharge::extractFrom($type,$line,'rateio',$pad);
        $pagamento_parcial = Discharge::extractFrom($type,$line,'pagamento_parcial',$pad);
        $carteira = Discharge::extractFrom($type,$line,'carteira',$pad);
        $identificacao_ocorrencia = Discharge::extractFrom($type,$line,'identificacao_ocorrencia',$pad);
        $data_ocorrencia = Discharge::extractFrom($type,$line,'data_ocorrencia',$pad);
        $num_documento = Discharge::extractFrom($type,$line,'num_documento',$pad);
        $titulo = Discharge::extractFrom($type,$line,'titulo',$pad);
        $vencimento = Discharge::extractFrom($type,$line,'vencimento',$pad);
        $valor_titulo = Discharge::extractFrom($type,$line,'valor_titulo',$pad);
        $banco_cobrador = Discharge::extractFrom($type,$line,'banco_cobrador',$pad);
        $agencia_cobradora = Discharge::extractFrom($type,$line,'agencia_cobradora',$pad);
        $especie = Discharge::extractFrom($type,$line,'especie',$pad);
        $despesas_1 = Discharge::extractFrom($type,$line,'despesas_1',$pad);
        $despesas_2 = Discharge::extractFrom($type,$line,'despesas_2',$pad);
        $juros = Discharge::extractFrom($type,$line,'juros',$pad);
        $iof = Discharge::extractFrom($type,$line,'iof',$pad);
        $abatimento = Discharge::extractFrom($type,$line,'abatimento',$pad);
        $desconto = Discharge::extractFrom($type,$line,'desconto',$pad);
        $valor_pago = Discharge::extractFrom($type,$line,'valor_pago',$pad);
        $juros_mora = Discharge::extractFrom($type,$line,'juros_mora',$pad);
        $outros_creditos = Discharge::extractFrom($type,$line,'outros_creditos',$pad);
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
        $identificacao_empresa . 
        $num_participante . 
        $zeros_2 . 
        $nosso_num . 
        $banco_1 . 
        $banco_2 . 
        $rateio . 
        $pagamento_parcial . 
        $carteira . 
        $identificacao_ocorrencia . 
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

    public function help()
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
            ],
            'NUM_INSCRICAO' => [ 
                'position_from' => '004',
                'position_to' => '017',
                'size' => '014',
                'content' => 'CNPJ/CPF, Número, Filial, Controle do Sacado',
                'type' => 'Numérico',
            ],
            'ZEROS_1' => [ 
                'position_from' => '018',
                'position_to' => '020',
                'size' => '003',
                'content' => 'Zeros',
                'type' => 'Numérico',
            ],
            'IDENTIFICACAO_EMPRESA' => [ 
                'position_from' => '021',
                'position_to' => '037',
                'size' => '017',
                'content' => 'Zero, Carteira, Agência, Conta Corrente (convênio)',
                'type' => 'Alfanumérico',
            ],
            'NUM_PARTICIPANTE' => [ 
                'position_from' => '038',
                'position_to' => '062',
                'size' => '025',
                'content' => 'Uso da Empresa',
                'type' => 'Alfanumérico',
                'content' => 'Sdocumento no banco de dados',
            ],
            'ZEROS_2' => [ 
                'position_from' => '063',
                'position_to' => '070',
                'size' => '008',
                'content' => 'Zeros',
                'type' => 'Numérico',
            ],
            'NOSSO_NUM' => [ 
                'position_from' => '071',
                'position_to' => '082',
                'size' => '012',
                'content' => 'Nº Banco',
                'type' => 'Numérico',
            ],
            'BANCO_1' => [ 
                'position_from' => '083',
                'position_to' => '092',
                'size' => '010',
                'content' => 'Zeros',
                'type' => 'Numérico',
            ],
            'BANCO_2' => [ 
                'position_from' => '093',
                'position_to' => '104',
                'size' => '012',
                'content' => 'Zeros',
                'type' => 'Numérico',
            ],
            'RATEIO' => [ 
                'position_from' => '105',
                'position_to' => '105',
                'size' => '001',
                'content' => 'R',
                'type' => 'Alfanumérico',
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
            ],
            'CARTEIRA' => [ 
                'position_from' => '108',
                'position_to' => '108',
                'size' => '001',
                'content' => 'Carteira',
                'type' => 'Numérico',
            ],
            'IDENTIFICACAO_OCORRENCIA' => [ 
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
            ],
            'DATA_OCORRENCIA' => [ 
                'position_from' => '111',
                'position_to' => '116',
                'size' => '006',
                'content' => 'DDMMAA',
                'type' => 'Numérico',
            ],
            'NUM_DOCUMENTO' => [ 
                'position_from' => '117',
                'position_to' => '126',
                'size' => '010',
                'content' => 'Nº do Documento',
                'type' => 'Alfanumérico',
            ],
            'TITULO' => [ 
                'position_from' => '127',
                'position_to' => '146',
                'size' => '020',
                'content' => 'Nº Banco',
                'type' => 'Numérico',
                'content' => [
                    'title' => 'Normalmente utilizamos o nosso número + dígito verificador'
                ]
            ],
            'VENCIMENTO' => [ 
                'position_from' => '147',
                'position_to' => '152',
                'size' => '006',
                'content' => 'DDMMAA',
                'type' => 'Numérico',
            ],
            'VALOR_TITULO' => [ 
                'position_from' => '153',
                'position_to' => '165',
                'size' => '013',
                'content' => 'Valor do Título',
                'type' => 'Numérico',
            ],
            'BANCO_COBRADOR' => [ 
                'position_from' => '166',
                'position_to' => '168',
                'size' => '003',
                'content' => 'Código do Banco Câmara de Compensação',
                'type' => 'Numérico',
            ],
            'AGENCIA_COBRADORA' => [ 
                'position_from' => '169',
                'position_to' => '173',
                'size' => '005',
                'content' => 'Código da Agência do Banco Cobrador',
                'type' => 'Numérico',
            ],
            'ESPECIE' => [ 
                'position_from' => '174',
                'position_to' => '175',
                'size' => '002',
                'content' => 'Branco',
                'type' => 'Alfanumérico',
            ],
            'DESPESAS_1' => [ 
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
            ],
            'DESPESAS_2' => [ 
                'position_from' => '189',
                'position_to' => '201',
                'size' => '013',
                'content' => 'Valor outras despesas custas de Protesto',
                'type' => 'Numérico',
            ],
            'JUROS' => [ 
                'position_from' => '202',
                'position_to' => '214',
                'size' => '013',
                'content' => 'Será informado  Com zeros',
                'type' => 'Numérico',
            ],
            'IOF' => [ 
                'position_from' => '215',
                'position_to' => '227',
                'size' => '013',
                'content' => 'Valor do IOF',
                'type' => 'Numérico',
            ],
            'ABATIMENTO' => [ 
                'position_from' => '228',
                'position_to' => '240',
                'size' => '013',
                'content' => 'Valor abatimento concedido',
                'type' => 'Numérico',
            ],
            'DESCONTO' => [ 
                'position_from' => '241',
                'position_to' => '253',
                'size' => '013',
                'content' => 'Valor desconto concedido',
                'type' => 'Numérico',
            ],
            'VALOR_PAGO' => [ 
                'position_from' => '254',
                'position_to' => '266',
                'size' => '013',
                'content' => 'Valor Pago',
                'type' => 'Numérico',
            ],
            'JUROS_MORA' => [ 
                'position_from' => '267',
                'position_to' => '279',
                'size' => '013',
                'content' => 'Juros de Mora',
                'type' => 'Numérico',
            ],
            'OUTROS_CREDITOS' => [ 
                'position_from' => '280',
                'position_to' => '292',
                'size' => '013',
                'content' => 'Sera informado com zeros',
                'type' => 'Numérico',
            ],
            'BRANCOS_1' => [ 
                'position_from' => '293',
                'position_to' => '294',
                'size' => '002',
                'content' => 'Brancos',
                'type' => 'Alfanumérico',
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
            ],
            'DATA_CREDITO' => [ 
                'position_from' => '296',
                'position_to' => '301',
                'size' => '006',
                'content' => 'DDMMAA',
                'type' => 'Numérico',
            ],
            'ORIGEM_PAGAMENTO' => [ 
                'position_from' => '302',
                'position_to' => '304',
                'size' => '03',
                'content' => 'Origem',
                'type' => 'Numérico',
            ],
            'BRANCOS_2' => [ 
                'position_from' => '305',
                'position_to' => '314',
                'size' => '010',
                'content' => 'Brancos',
                'type' => 'Alfanumérico',
            ],
            'CHEQUE_BRADESCO' => [ 
                'position_from' => '315',
                'position_to' => '318',
                'size' => '004',
                'content' => 'Codigo do Banco',
                'type' => 'Numérico',
            ],
            'MOTIVO_REJEICAO' => [ 
                'position_from' => '319',
                'position_to' => '328',
                'size' => '010',
                'content' => 'Motivos das Rejeições para os Códigos de Ocorrência da Posição 109 a 110',
                'type' => 'Alfanumérico',
            ],
            'BRANCOS_3' => [ 
                'position_from' => '329',
                'position_to' => '368',
                'size' => '040',
                'content' => 'Brancos',
                'type' => 'Alfanumérico',
            ],
            'NUM_CARTORIO' => [ 
                'position_from' => '369',
                'position_to' => '370',
                'size' => '002',
                'content' => 'Número do Cartório',
                'type' => 'Numérico',
            ],
            'NUM_PROTOCOLO' => [ 
                'position_from' => '371',
                'position_to' => '380',
                'size' => '010',
                'content' => 'Número do Protocolo',
                'type' => 'Alfanumérico',
            ],
            'BRANCOS_4' => [ 
                'position_from' => '381',
                'position_to' => '394',
                'size' => '014',
                'content' => 'Brancos',
                'type' => 'Numérico',
            ],
            'SEQUENCIAL' => [ 
                'position_from' => '395',
                'position_to' => '400',
                'size' => '006',
                'content' => 'Nº Sequencial do Registro',
                'type' => 'Numérico',
            ]
        ];

        return $data;
    }

    public function replaceOn($line,$data,$new_value)
    {

        switch(strtoupper($data)){
            case 'REGISTRO': return substr_replace($line, $new_value, 0, 1); break;
            case 'TIPO_INSCRICAO': return substr_replace($line, $new_value, 1, 2); break;
            case 'NUM_INSCRICAO': return substr_replace($line, $new_value, 3, 14); break;
            case 'ZEROS_1': return substr_replace($line, $new_value, 17, 3); break;
            case 'IDENTIFICACAO_EMPRESA': return substr_replace($line, $new_value, 20, 17); break;
            case 'NUM_PARTICIPANTE': return substr_replace($line, $new_value, 37, 25); break;
            case 'ZEROS_2': return substr_replace($line, $new_value, 62, 8); break;
            case 'NOSSO_NUM': return substr_replace($line, $new_value, 70, 12); break;
            case 'BANCO_1': return substr_replace($line, $new_value, 82, 10); break;
            case 'BANCO_2': return substr_replace($line, $new_value, 92, 12); break;
            case 'RATEIO': return substr_replace($line, $new_value, 104, 1); break;
            case 'PAGAMENTO_PARCIAL': return substr_replace($line, $new_value, 105, 2); break;
            case 'CARTEIRA': return substr_replace($line, $new_value, 107, 1); break;
            case 'IDENTIFICACAO_OCORRENCIA': return substr_replace($line, $new_value, 108, 2); break;
            case 'DATA_OCORRENCIA': return substr_replace($line, $new_value, 110, 6); break;
            case 'NUM_DOCUMENTO': return substr_replace($line, $new_value, 116, 10); break;
            case 'TITULO': return substr_replace($line, $new_value, 126, 20); break;
            case 'VENCIMENTO': return substr_replace($line, $new_value, 146, 6); break;
            case 'VALOR_TITULO': return substr_replace($line, $new_value, 152, 13); break;
            case 'BANCO_COBRADOR': return substr_replace($line, $new_value, 165, 3); break;
            case 'AGENCIA_COBRADORA': return substr_replace($line, $new_value, 168, 5); break;
            case 'ESPECIE': return substr_replace($line, $new_value, 173, 2); break;
            case 'DESPESAS_1': return substr_replace($line, $new_value, 175, 13); break;
            case 'DESPESAS_2': return substr_replace($line, $new_value, 188, 13); break;
            case 'JUROS': return substr_replace($line, $new_value, 201, 13); break;
            case 'IOF': return substr_replace($line, $new_value, 214, 13); break;
            case 'ABATIMENTO': return substr_replace($line, $new_value, 227, 13); break;
            case 'DESCONTO': return substr_replace($line, $new_value, 240, 13); break;
            case 'VALOR_PAGO': return substr_replace($line, $new_value, 253, 13); break;
            case 'JUROS_MORA': return substr_replace($line, $new_value, 266, 13); break;
            case 'OUTROS_CREDITOS': return substr_replace($line, $new_value, 279, 13); break;
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

    public function padLine($data,$value)
    {

        $value = Common::cleanUp($value);
        $value = Common::removeExtraSpaces($value);

        $pad_replace = ' ';

        switch(strtoupper($data)){
            case 'REGISTRO': return str_pad(substr($value, 0, 1), 1, '0', STR_PAD_LEFT); break;
            case 'TIPO_INSCRICAO': return str_pad(substr($value, 0, 2), 2, '0', STR_PAD_LEFT); break;
            case 'NUM_INSCRICAO': return str_pad(substr($value, 0, 14), 14, '0', STR_PAD_LEFT); break;
            case 'ZEROS_1': return str_pad(substr($value, 0, 3), 3, '0', STR_PAD_LEFT); break;
            case 'IDENTIFICACAO_EMPRESA': return str_pad(substr($value, 0, 17), 17, ' ', STR_PAD_RIGHT); break;
            case 'NUM_PARTICIPANTE': return str_pad(substr($value, 0, 25), 25, ' ', STR_PAD_RIGHT); break;
            case 'ZEROS_2': return str_pad(substr($value, 0, 8), 8, '0', STR_PAD_LEFT); break;
            case 'NOSSO_NUM': return str_pad(substr($value, 0, 12), 12, '0', STR_PAD_LEFT); break;
            case 'BANCO_1': return str_pad(substr($value, 0, 10), 10, '0', STR_PAD_LEFT); break;
            case 'BANCO_2': return str_pad(substr($value, 0, 12), 12, '0', STR_PAD_LEFT); break;
            case 'RATEIO': return str_pad(substr($value, 0, 1), 1,  '0', STR_PAD_RIGHT); break;
            case 'PAGAMENTO_PARCIAL': return str_pad(substr($value, 0, 2), 2, '0', STR_PAD_LEFT); break;
            case 'CARTEIRA': return str_pad(substr($value, 0, 1), 1, '0', STR_PAD_LEFT); break;
            case 'IDENTIFICACAO_OCORRENCIA': return str_pad(substr($value, 0, 2), 2, '0', STR_PAD_LEFT); break;
            case 'DATA_OCORRENCIA': return str_pad(substr($value, 0, 6), 6, '0', STR_PAD_LEFT); break;
            case 'NUM_DOCUMENTO': return str_pad(substr($value, 0, 10), 10, ' ', STR_PAD_RIGHT); break;
            case 'TITULO': return str_pad(substr($value, 0, 20), 20, '0', STR_PAD_LEFT); break;
            case 'VENCIMENTO': return str_pad(substr($value, 0, 6), 6, '0', STR_PAD_LEFT); break;
            case 'VALOR_TITULO': return str_pad(substr($value, 0, 13), 13, '0', STR_PAD_LEFT); break;
            case 'BANCO_COBRADOR': return str_pad(substr($value, 0, 3), 3, '0', STR_PAD_LEFT); break;
            case 'AGENCIA_COBRADORA': return str_pad(substr($value, 0, 5), 5, '0', STR_PAD_LEFT); break;
            case 'ESPECIE': return str_pad(substr($value, 0, 2), 2, ' ', STR_PAD_RIGHT); break;
            case 'DESPESAS_1': return str_pad(substr($value, 0, 13), 13, '0', STR_PAD_LEFT); break;
            case 'DESPESAS_2': return str_pad(substr($value, 0, 13), 13, '0', STR_PAD_LEFT); break;
            case 'JUROS': return str_pad(substr($value, 0, 13), 13, '0', STR_PAD_LEFT); break;
            case 'IOF': return str_pad(substr($value, 0, 13), 13, '0', STR_PAD_LEFT); break;
            case 'ABATIMENTO': return str_pad(substr($value, 0, 13), 13, '0', STR_PAD_LEFT); break;
            case 'DESCONTO': return str_pad(substr($value, 0, 13), 13, '0', STR_PAD_LEFT); break;
            case 'VALOR_PAGO': return str_pad(substr($value, 0, 13), 13, '0', STR_PAD_LEFT); break;
            case 'JUROS_MORA': return str_pad(substr($value, 0, 13), 13, '0', STR_PAD_LEFT); break;
            case 'OUTROS_CREDITOS': return str_pad(substr($value, 0, 13), 13, '0', STR_PAD_LEFT); break;
            case 'BRANCOS_1': return str_pad(substr($value, 0, 2), 2, ' ', STR_PAD_RIGHT); break;
            case 'MOTIVO_OCORRENCIA': return str_pad(substr($value, 0, 1), 1, ' ', STR_PAD_RIGHT); break;
            case 'DATA_CREDITO':return str_pad(substr($value, 0, 6), 6, '0', STR_PAD_LEFT); break;
            case 'ORIGEM_PAGAMENTO': return str_pad(substr($value, 0, 3), 3, '0', STR_PAD_LEFT); break;
            case 'BRANCOS_2': return str_pad(substr($value, 0, 10), 10, ' ', STR_PAD_RIGHT); break;
            case 'CHEQUE_BRADESCO': return str_pad(substr($value, 0, 4), 4, '0', STR_PAD_LEFT); break;
            case 'MOTIVO_REJEICAO': return str_pad(substr($value, 0, 10), 10, '0', STR_PAD_LEFT); break;
            case 'BRANCOS_3': return str_pad(substr($value, 0, 40), 40, ' ', STR_PAD_RIGHT); break;
            case 'NUM_CARTORIO': return str_pad(substr($value, 0, 2), 2, '0', STR_PAD_LEFT); break;
            case 'NUM_PROTOCOLO': return str_pad(substr($value, 0, 10), 10, ' ', STR_PAD_RIGHT); break;
            case 'BRANCOS_4': return str_pad(substr($value, 0, 14), 14, '0', STR_PAD_LEFT); break;
            case 'SEQUENCIAL': return str_pad(substr($value, 0, 6), 6, '0', STR_PAD_LEFT); break;
            default: return 'Coluna não aceita no extract remessa data: ' . $data;
        }
    }

}