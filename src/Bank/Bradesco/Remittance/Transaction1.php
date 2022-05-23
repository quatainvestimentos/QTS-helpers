<?php

namespace QuataInvestimentos\Bank\Bradesco\Remittance;

trait Transaction1 {

    public function extractFrom($line,$data,$pad=true)
    {

        switch(strtoupper($data)){
            case 'REGISTRO': $value = substr($line, 0, 1); break;
            case 'AGENCIA': $value = substr($line, 1, 5); break;
            case 'AGENCIA_DV': $value = substr($line, 6, 1); break;
            case 'RAZAO_CONTA': $value = substr($line, 7, 5); break;
            case 'CONTA_CORRENTE': $value = substr($line, 11, 7); break;
            case 'CONTA_CORRENTE_DV': $value = substr($line, 19, 1); break;
            case 'BENEFICIARIA': $value = substr($line, 20, 17); break;
            case 'SEU_NUM': $value = substr($line, 37, 25); break;
            case 'COD_BANCO': $value = substr($line, 62, 3); break;
            case 'MULTA': $value = substr($line, 65, 1); break;
            case 'PERCENTUAL_MULTA': $value = substr($line, 66, 4); break;
            case 'NOSSO_NUM': $value = substr($line, 70, 11); break;
            case 'NOSSO_NUM_DV': $value = substr($line, 81, 1); break;
            case 'DESCONTO_DIA': $value = substr($line, 82, 10); break;
            case 'TIPO_EMISSAO': $value = substr($line, 92, 1); break;
            case 'DEBITO_AUTOMATICO': $value = substr($line, 93, 1); break;
            case 'OPERACAO_BANCO': $value = substr($line, 94, 10); break;
            case 'RATEIO': $value = substr($line, 104, 1); break;
            case 'AVISO_DEBITO': $value = substr($line, 105, 1); break;
            case 'QTD_PAGAMENTOS': $value = substr($line, 106, 2); break;
            case 'INSTRUCAO': $value = substr($line, 108, 2); break;
            case 'S_DOCUMENTO': $value = substr($line, 110, 10); break;
            case 'VENCIMENTO': $value = substr($line, 120, 6); break;
            case 'VALOR': $value = substr($line, 126, 13); break;
            case 'BANCO_COBRANCA': $value = substr($line, 139, 3); break;
            case 'AGENCIA_DEPOSITARIA': $value = substr($line, 142, 5); break;
            case 'ESPECIE_TITULO': $value = substr($line, 147, 2); break;
            case 'IDENTIFICACAO': $value = substr($line, 149, 1); break;
            case 'EMISSAO': $value = substr($line, 150, 6); break;
            case 'INSTRUCAO_1': $value = substr($line, 156, 2); break;
            case 'INSTRUCAO_2': $value = substr($line, 158, 2); break;
            case 'VALOR_DIA_ATRASO': $value = substr($line, 160, 13); break;
            case 'DATA_LIMITE_DESCONTO': $value = substr($line, 173, 6); break;
            case 'VALOR_DESCONTO': $value = substr($line, 179, 13); break;
            case 'VALOR_IOF': $value = substr($line, 192, 13); break;
            case 'VALOR_ABATIMENTO': $value = substr($line, 205, 13); break;
            case 'TIPO_INSCRICAO': $value = substr($line, 218, 2); break;
            case 'SACADO_INSCRICAO': $value = substr($line, 220, 14); break;
            case 'SACADO_NOME': $value = substr($line, 234, 40); break;
            case 'SACADO_ENDERECO': $value = substr($line, 274, 40); break;
            case 'MENSAGEM_1': $value = substr($line, 314, 12); break;
            case 'SACADO_CEP_PREFIXO': $value = substr($line, 326, 5); break;
            case 'SACADO_CEP_SUFIXO': $value = substr($line, 331, 3); break;
            case 'MENSAGEM_2': $value = substr($line, 334, 60); break;
            case 'SEQUENCIAL': $value = substr($line, 394, 6); break;
            case 'NFE': $value = substr($line, 400, 44); break;
            default: return 'Coluna não aceita no extract remessa data: '. $data;
        }

        if($pad){ return $this->padLine($data, $value); }
        return $value;

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
            'AGENCIA' => [ 
                'position_from' => '002',
                'position_to' => '006',
                'size' => '005',
                'content' => 'Código da agência do pagador, exclusivo para Débito em Conta',
                'type' => 'Numérico',
            ],
            'AGENCIA_DV' => [ 
                'position_from' => '007',
                'position_to' => '007',
                'size' => '001',
                'content' => 'Dígito da agência do pagador',
                'type' => 'Alfanumérico',
            ],
            'RAZAO_CONTA' => [ 
                'position_from' => '008',
                'position_to' => '012',
                'size' => '005',
                'content' => 'Razão da Conta do Pagador',
                'type' => 'Numérico',
            ],
            'CONTA_CORRENTE' => [ 
                'position_from' => '013',
                'position_to' => '019',
                'size' => '007',
                'content' => 'Número da Conta do Pagador',
                'type' => 'Numérico',
            ],
            'CONTA_CORRENTE_DV' => [ 
                'position_from' => '020',
                'position_to' => '020',
                'size' => '001',
                'content' => 'Dígito da Conta do Pagador',
                'type' => 'Alfanumérico',
            ],
            'BENEFICIARIA' => [ 
                'position_from' => '021',
                'position_to' => '037',
                'size' => '017',
                'content' => 'Deverá ser preenchido da esquerda para a direita da seguinte maneira: 21 a 21 Zero, 22 a 24 Codigos da Carteira, 25 a 29 Códigos da Agência Beneficiários sem o Dígito, 30 a 36 Contas Corrente, 37 a 37 Dígitos da Conta.',
                'type' => 'Alfanumérico',
            ],
            'SEU_NUM' => [ 
                'position_from' => '038',
                'position_to' => '062',
                'size' => '025',
                'content' => 'Uso da Empresa',
                'type' => 'Alfanumérico',
            ],
            'COD_BANCO' => [ 
                'position_from' => '063',
                'position_to' => '065',
                'size' => '003',
                'content' => 'Nº do Banco “237”',
                'type' => 'Numérico',
            ],
            'MULTA' => [ 
                'position_from' => '066',
                'position_to' => '066',
                'size' => '001',
                'content' => 'Se = 2 considerar percentual de multa. Se = 0, sem multa',
                'type' => 'Numérico',
            ],
            'PERCENTUAL_MULTA' => [ 
                'position_from' => '067',
                'position_to' => '070',
                'size' => '004',
                'content' => 'Percentual de multa a ser considerado',
                'type' => 'Numérico',
            ],
            'NOSSO_NUM' => [ 
                'position_from' => '071',
                'position_to' => '081',
                'size' => '011',
                'content' => 'Número Bancário para Cobrança Com e Sem Registro',
                'type' => 'Numérico',
            ],
            'NOSSO_NUM_DV' => [ 
                'position_from' => '082',
                'position_to' => '082',
                'size' => '001',
                'content' => 'Digito N/N',
                'type' => 'Alfanumérico',
            ],
            'DESCONTO_DIA' => [ 
                'position_from' => '083',
                'position_to' => '092',
                'size' => '010',
                'content' => 'Valor do desconto bonif./dia.',
                'type' => 'Numérico',
            ],
            'TIPO_EMISSAO' => [ 
                'position_from' => '093',
                'position_to' => '093',
                'size' => '001',
                'content' => '1 = Banco emite e processa o registro. 2 = Cliente emite e o Banco somente processa o registro',
                'type' => 'Numérico',
            ],
            'DEBITO_AUTOMATICO' => [ 
                'position_from' => '094',
                'position_to' => '094',
                'size' => '001',
                'content' => 'N= Não registra na cobrança. Diferente de N registra e emite Boleto.',
                'type' => 'Alfanumérico',
            ],
            'OPERACAO_BANCO' => [ 
                'position_from' => '095',
                'position_to' => '104',
                'size' => '010',
                'content' => 'BRANCOS',
                'type' => 'Alfanumérico',
            ],
            'RATEIO' => [ 
                'position_from' => '105',
                'position_to' => '105',
                'size' => '001',
                'content' => 'Somente deverá ser preenchido com a Letra “R” se a empresa contratou o serviço de rateio de crédito; caso não tenha contratado, informar Branco.',
                'type' => 'Alfanumérico',
            ],
            'AVISO_DEBITO' => [ 
                'position_from' => '106',
                'position_to' => '106',
                'size' => '001',
                'content' => '1 = emite aviso, e assume o endereço do pagador constante do arquivo-remessa. 2 = não emite aviso. diferente de 1 ou 2 = emite e assume o endereço do cliente debitado, constante do cadastro do Banco.',
                'type' => 'Numérico',
            ],
            'QTD_PAGAMENTOS' => [ 
                'position_from' => '107',
                'position_to' => '108',
                'size' => '002',
                'content' => 'Somente deverá ser preenchido com a quantidade de parcelas para pagamento se a empresa contratou o serviço Pagamento Parcial; caso não tenha contratado, informar Branco. Quantidade mínima de parcelas = 02, Quantidade máxima de parcelas = 99.',
                'type' => 'Alfanumérico',
            ],
            'INSTRUCAO' => [ 
                'position_from' => '109',
                'position_to' => '110',
                'size' => '002',
                'content' => 'Códigos de Ocorrência',
                'type' => 'Numérico',
                'more_info' => [
                    'accepted_info' => [
                        '01: Remessa',
                        '02: Pedido de Baixa',
                        '03: Pedido de Protesto Falimentar',
                        '04: Concessão de Abatimento',
                        '05: Cancelamento de Abatimento Concedido',
                        '06: Alteração de Vencimento',
                        '07: Alteração do Controle do Participante',
                        '08: Alteração de seu Número',
                        '09: Pedido de Protesto',
                        '12: Ped. Exc. de Cadastro Pagador Débito',
                        '13: Inclusão de Cadastro Pagador',
                        '14: Alteração Cadastro Pagador',
                        '18: Sustar Protesto e Baixar Título',
                        '19: Sustar Protesto e Manter em Carteira',
                        '20: lteração de Valor*',
                        '21: lteração de Valor com Emissão de Boleto (quando a emissão é pelo Banco)*',
                        '22: Transferência Cessão Crédito ID. Prod.10',
                        '23: Transferência entre Carteiras',
                        '24: Dev. Transferência entre Carteiras',
                        '31: Alteração de Outros Dados',
                        '32: Instrução de Negativação',
                        '45: Pedido de Negativação',
                        '46: Excluir Negativação com Baixa',
                        '47: Excluir Negativação e Manter Pendente',
                        '68: Acerto nos Dados do Rateio de Crédito',
                        '69: Cancelamento do Rateio de Crédito',
                    ]
                ]
            ],
            'S_DOCUMENTO' => [ 
                'position_from' => '111',
                'position_to' => '120',
                'size' => '010',
                'content' => 'Documento',
                'type' => 'Alfanumérico',
            ],
            'VENCIMENTO' => [ 
                'position_from' => '121',
                'position_to' => '126',
                'size' => '006',
                'content' => 'DDMMAA',
                'type' => 'Numérico',
            ],
            'VALOR' => [ 
                'position_from' => '127',
                'position_to' => '139',
                'size' => '013',
                'content' => 'Valor do Título (preencher sem ponto e sem vírgula)',
                'type' => 'Numérico',
            ],
            'BANCO_COBRANCA' => [ 
                'position_from' => '140',
                'position_to' => '142',
                'size' => '003',
                'content' => 'Preencher com zeros',
                'type' => 'Numérico',
            ],
            'AGENCIA_DEPOSITARIA' => [ 
                'position_from' => '143',
                'position_to' => '147',
                'size' => '005',
                'content' => 'Preencher com zeros',
                'type' => 'Numérico',
            ],
            'ESPECIE_TITULO' => [ 
                'position_from' => '148',
                'position_to' => '149',
                'size' => '002',
                'content' => 'Informar código da espécie de título',
                'type' => 'Numérico',
                'more_info' => [
                    'accepted_info' => [
                        '01: Duplicata',
                        '02: Nota Promissória',
                        '03: Nota de Seguro',
                        '05: Recibo',
                        '10: Letras de Câmbio',
                        '11: Nota de Débito',
                        '12: Duplicata de Serv.',
                        '31: Cartão de Crédito',
                        '32: Boleto de Proposta',
                        '33:  Depósito e Aporte',
                        '99: Outros',
                    ]
                ]
            ],
            'IDENTIFICACAO' => [ 
                'position_from' => '150',
                'position_to' => '150',
                'size' => '001',
                'content' => 'Sempre = N',
                'type' => 'Alfanumérico',
            ],
            'EMISSAO' => [ 
                'position_from' => '151',
                'position_to' => '156',
                'size' => '006',
                'content' => 'DDMMAA',
                'type' => 'Numérico',
            ],
            'INSTRUCAO_1' => [ 
                'position_from' => '157',
                'position_to' => '158',
                'size' => '002',
                'content' => 'Campo destinado para pré-determinar o protesto do título ou a baixa por decurso de prazo, quando do registro. Não havendo interesse, preencher com zeros',
                'type' => 'Numérico',
            ],
            'INSTRUCAO_2' => [ 
                'position_from' => '159',
                'position_to' => '160',
                'size' => '002',
                'content' => 'Campo destinado para pré-determinar o protesto do título ou a baixa por decurso de prazo, quando do registro. Não havendo interesse, preencher com zeros',
                'type' => 'Numérico',
            ],
            'VALOR_DIA_ATRASO' => [ 
                'position_from' => '161',
                'position_to' => '173',
                'size' => '013',
                'content' => 'Mora por Dia de Atraso',
                'type' => 'Numérico',
            ],
            'DATA_LIMITE_DESCONTO' => [ 
                'position_from' => '174',
                'position_to' => '179',
                'size' => '006',
                'content' => 'DDMMAA',
                'type' => 'Numérico',
            ],
            'VALOR_DESCONTO' => [ 
                'position_from' => '180',
                'position_to' => '192',
                'size' => '013',
                'content' => 'Valor Desconto',
                'type' => 'Numérico',
            ],
            'VALOR_IOF' => [ 
                'position_from' => '193',
                'position_to' => '205',
                'size' => '013',
                'content' => 'Valor Desconto',
                'type' => 'Numérico',
            ],
            'VALOR_ABATIMENTO' => [ 
                'position_from' => '206',
                'position_to' => '218',
                'size' => '013',
                'content' => 'Valor abatimento',
                'type' => 'Numérico',
            ],
            'TIPO_INSCRICAO' => [ 
                'position_from' => '219',
                'position_to' => '220',
                'size' => '002',
                'content' => '01-CPf, 02-CNPJ',
                'type' => 'Numérico',
            ],
            'SACADO_INSCRICAO' => [ 
                'position_from' => '221',
                'position_to' => '234',
                'size' => '014',
                'content' => 'CNPJ/ CPF',
                'type' => 'Numérico',
            ],
            'SACADO_NOME' => [ 
                'position_from' => '235',
                'position_to' => '274',
                'size' => '040',
                'content' => 'Nome do Pagador',
                'type' => 'AlfaNumérico',
            ],
            'SACADO_ENDERECO' => [ 
                'position_from' => '275',
                'position_to' => '314',
                'size' => '040',
                'content' => 'Endereço do Pagador',
                'type' => 'Alfanumérico',
            ],
            'MENSAGEM_1' => [ 
                'position_from' => '315',
                'position_to' => '326',
                'size' => '012',
                'content' => 'Endereço do Pagador',
                'type' => 'Alfanumérico',
            ],
            'SACADO_CEP_PREFIXO' => [ 
                'position_from' => '327',
                'position_to' => '331',
                'size' => '005',
                'content' => 'CEP do Pagador',
                'type' => 'Numérico',
            ],
            'SACADO_CEP_SUFIXO' => [ 
                'position_from' => '332',
                'position_to' => '334',
                'size' => '003',
                'content' => 'Sufixo',
                'type' => 'Numérico',
            ],
            'MENSAGEM_2' => [ 
                'position_from' => '335',
                'position_to' => '394',
                'size' => '003',
                'content' => 'Somente Beneficiário Final ou somente Mensagem.',
                'type' => 'Alfanumérico',
            ],
            'SEQUENCIAL' => [ 
                'position_from' => '395',
                'position_to' => '400',
                'size' => '006',
                'content' => 'Nº Sequencial do Registro',
                'type' => 'Numérico',
            ],
            'NFE' => [ 
                'position_from' => '401',
                'position_to' => '444',
                'size' => '044',
                'content' => 'Chave da Nota Fiscal para CNABS 444',
                'type' => 'Numérico',
            ]
        ];

        return $data;
    }

    public function replaceOn($line,$data,$new_value)
    {

        switch(strtoupper($data)){
            case 'REGISTRO': return substr_replace($line, $new_value, 0, 1); break;
            case 'AGENCIA': return substr_replace($line, $new_value, 1, 5); break;
            case 'AGENCIA_DV': return substr_replace($line, $new_value, 6, 1); break;
            case 'RAZAO_CONTA': return substr_replace($line, $new_value, 7, 5); break;
            case 'CONTA_CORRENTE': return substr_replace($line, $new_value, 11, 7); break;
            case 'CONTA_CORRENTE_DV': return substr_replace($line, $new_value, 19, 1); break;
            case 'BENEFICIARIA': return substr_replace($line, $new_value, 20, 17); break;
            case 'SEU_NUM': return substr_replace($line, $new_value, 37, 25); break;
            case 'COD_BANCO': return substr_replace($line, $new_value, 62, 3); break;
            case 'MULTA': return substr_replace($line, $new_value, 65, 1); break;
            case 'PERCENTUAL_MULTA': return substr_replace($line, $new_value, 66, 4); break;
            case 'NOSSO_NUM': return substr_replace($line, $new_value, 70, 11); break;
            case 'NOSSO_NUM_DV': return substr_replace($line, $new_value, 81, 1); break;
            case 'DESCONTO_DIA': return substr_replace($line, $new_value, 82, 10); break;
            case 'TIPO_EMISSAO': return substr_replace($line, $new_value, 92, 1); break;
            case 'DEBITO_AUTOMATICO': return substr_replace($line, $new_value, 93, 1); break;
            case 'OPERACAO_BANCO': return substr_replace($line, $new_value, 94, 10); break;
            case 'RATEIO': return substr_replace($line, $new_value, 104, 1); break;
            case 'AVISO_DEBITO': return substr_replace($line, $new_value, 105, 1); break;
            case 'QTD_PAGAMENTOS': return substr_replace($line, $new_value, 106, 2); break;
            case 'INSTRUCAO': return substr_replace($line, $new_value, 108, 2); break;
            case 'S_DOCUMENTO': return substr_replace($line, $new_value, 110, 10); break;
            case 'VENCIMENTO': return substr_replace($line, $new_value, 120, 6); break;
            case 'VALOR': return substr_replace($line, $new_value, 126, 13); break;
            case 'BANCO_COBRANCA': return substr_replace($line, $new_value, 139, 3); break;
            case 'AGENCIA_DEPOSITARIA': return substr_replace($line, $new_value, 142, 5); break;
            case 'ESPECIE_TITULO': return substr_replace($line, $new_value, 147, 2); break;
            case 'IDENTIFICACAO': return substr_replace($line, $new_value, 149, 1); break;
            case 'EMISSAO': return substr_replace($line, $new_value, 150, 6); break;
            case 'INSTRUCAO_1': return substr_replace($line, $new_value, 156, 2); break;
            case 'INSTRUCAO_2': return substr_replace($line, $new_value, 158, 2); break;
            case 'VALOR_DIA_ATRASO': return substr_replace($line, $new_value, 160, 13); break;
            case 'DATA_LIMITE_DESCONTO': return substr_replace($line, $new_value, 173, 6); break;
            case 'VALOR_DESCONTO': return substr_replace($line, $new_value, 179, 13); break;
            case 'VALOR_IOF': return substr_replace($line, $new_value, 192, 13); break;
            case 'VALOR_ABATIMENTO': return substr_replace($line, $new_value, 205, 13); break;
            case 'TIPO_INSCRICAO': return substr_replace($line, $new_value, 218, 2); break;
            case 'SACADO_INSCRICAO': return substr_replace($line, $new_value, 220, 14); break;
            case 'SACADO_NOME': return substr_replace($line, $new_value, 234, 40); break;
            case 'SACADO_ENDERECO': return substr_replace($line, $new_value, 274, 40); break;
            case 'MENSAGEM_1': return substr_replace($line, $new_value, 314, 12); break;
            case 'SACADO_CEP_PREFIXO': return substr_replace($line, $new_value, 326, 5); break;
            case 'SACADO_CEP_SUFIXO': return substr_replace($line, $new_value, 331, 3); break;
            case 'MENSAGEM_2': return substr_replace($line, $new_value, 334, 60); break;
            case 'SEQUENCIAL': return substr_replace($line, $new_value, 394, 6); break;
            case 'NFE': return substr_replace($line, $new_value, 400, 44); break;
            default: return 'Coluna não aceita no replace remessa data: ' . $data;
        }

    }

    public function padLine($data,$value)
    {

        $value = $this->cleanUp($value);
        $value = $this->removeExtraSpaces($value);

        $pad_replace = ' ';

        switch(strtoupper($data)){
            case 'REGISTRO': return str_pad($value, 1, '1', STR_PAD_LEFT); break;
            case 'AGENCIA': return str_pad($value, 5, $pad_replace, STR_PAD_RIGHT); break;
            case 'AGENCIA_DV': return str_pad($value, 1, $pad_replace, STR_PAD_RIGHT); break;
            case 'RAZAO_CONTA': return str_pad($value, 5, $pad_replace, STR_PAD_RIGHT); break;
            case 'CONTA_CORRENTE': return str_pad($value, 7, $pad_replace, STR_PAD_RIGHT); break;
            case 'CONTA_CORRENTE_DV': return str_pad($value, 1, $pad_replace, STR_PAD_RIGHT); break;
            case 'BENEFICIARIA': return str_pad($value, 17, $pad_replace, STR_PAD_RIGHT); break;
            case 'SEU_NUM': return str_pad($value, 25, $pad_replace, STR_PAD_RIGHT); break;
            case 'COD_BANCO': return str_pad($value, 3, $pad_replace, STR_PAD_RIGHT); break;
            case 'MULTA': return str_pad($value, 1, '0', STR_PAD_RIGHT); break;
            case 'PERCENTUAL_MULTA': return str_pad($value, 4, '0', STR_PAD_LEFT); break;
            case 'NOSSO_NUM': return str_pad($value, 11, '0', STR_PAD_LEFT); break;
            case 'NOSSO_NUM_DV': return str_pad($value, 1, '0', STR_PAD_LEFT); break;
            case 'DESCONTO_DIA': return str_pad($value, 10, '0', STR_PAD_LEFT); break;
            case 'TIPO_EMISSAO': return str_pad($value, 1, '1', STR_PAD_LEFT); break;
            case 'DEBITO_AUTOMATICO': return str_pad($value, 1, '1', STR_PAD_LEFT); break;
            case 'OPERACAO_BANCO': return str_pad($value, 10, $pad_replace, STR_PAD_RIGHT); break;
            case 'RATEIO': return str_pad($value, 1, $pad_replace, STR_PAD_RIGHT); break;
            case 'AVISO_DEBITO': return str_pad($value, 1, $pad_replace, STR_PAD_RIGHT); break;
            case 'QTD_PAGAMENTOS': return str_pad($value, 2, $pad_replace, STR_PAD_RIGHT); break;
            case 'INSTRUCAO': return str_pad($value, 2, '0', STR_PAD_LEFT); break;
            case 'S_DOCUMENTO': return str_pad($value, 10, '0', STR_PAD_LEFT); break;
            case 'VENCIMENTO': return str_pad($value, 6, '0', STR_PAD_LEFT); break;
            case 'VALOR': return str_pad($value, 13, '0', STR_PAD_LEFT); break;
            case 'BANCO_COBRANCA': return str_pad($value, 3, '0', STR_PAD_LEFT); break;
            case 'AGENCIA_DEPOSITARIA': return str_pad($value, 5, '0', STR_PAD_LEFT); break;
            case 'ESPECIE_TITULO': return str_pad($value, 2, '0', STR_PAD_LEFT); break;
            case 'IDENTIFICACAO': return str_pad($value, 1, 'N', STR_PAD_LEFT); break;
            case 'EMISSAO': return str_pad($value, 6, '0', STR_PAD_LEFT); break;
            case 'INSTRUCAO_1': return str_pad($value, 2, '0', STR_PAD_LEFT); break;
            case 'INSTRUCAO_2': return str_pad($value, 2, '0', STR_PAD_LEFT); break;
            case 'VALOR_DIA_ATRASO': return str_pad($value, 13, '0', STR_PAD_LEFT); break;
            case 'DATA_LIMITE_DESCONTO': return str_pad($value, 6, '0', STR_PAD_LEFT); break;
            case 'VALOR_DESCONTO': return str_pad($value, 13, '0', STR_PAD_LEFT); break;
            case 'VALOR_IOF': return str_pad($value, 13, '0', STR_PAD_LEFT); break;
            case 'VALOR_ABATIMENTO': return str_pad($value, 13, '0', STR_PAD_LEFT); break;
            case 'TIPO_INSCRICAO': return str_pad($value, 2, '0', STR_PAD_LEFT); break;
            case 'SACADO_INSCRICAO': return str_pad($value, 14, $pad_replace, STR_PAD_RIGHT); break;
            case 'SACADO_NOME': return str_pad($value, 40, $pad_replace, STR_PAD_RIGHT); break;
            case 'SACADO_ENDERECO': return str_pad($value, 40, $pad_replace, STR_PAD_RIGHT); break;
            case 'MENSAGEM_1': return str_pad($value, 12, $pad_replace, STR_PAD_RIGHT); break;
            case 'SACADO_CEP_PREFIXO': return str_pad($value, 5, '0', STR_PAD_LEFT); break;
            case 'SACADO_CEP_SUFIXO': return str_pad($value, 3, '0', STR_PAD_LEFT); break;
            case 'MENSAGEM_2': return str_pad($value, 60, $pad_replace, STR_PAD_RIGHT); break;
            case 'SEQUENCIAL': return str_pad($value, 6, '0', STR_PAD_LEFT); break;
            case 'NFE': return str_pad($value, 44, '0', STR_PAD_LEFT); break;
            default: return 'Coluna não aceita no extract remessa data: ' . $data;
        }
    }

}