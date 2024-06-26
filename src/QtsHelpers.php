<?php 

namespace QuataInvestimentos;
date_default_timezone_set('America/Sao_Paulo');

trait QtsHelpers 
{

    public static function publicUrl($env='LOCAL')
    {

        switch(strtoupper($env)){
            case 'LOCAL': 
                return 'http://local-qts.quatainvestimentos.com.br:4000/';
            case 'TESTING': 
                return 'https://dev-qts.quatainvestimentos.com.br/';
            case 'PRODUCTION': 
                return 'https://qts.quatainvestimentos.com.br/';
        }

    }

    public static function debug($label,$debug)
    {
        $header = <<<EOD
 
        -------------------
        DEBUG: {$label}


        EOD;

        $debug = (isset($debug) && is_array($debug) ? $debug : json_encode($debug));

        $footer = <<<EOD


        EOD;
        
        echo strtoupper($header);
        print_r($debug);
        echo $footer;
        
    }

    public static function translateEnums(String $string, Bool $get_badge=false)
    {

        switch(strtoupper($string)){
            /** Assets */

            case 'QUATA_INVESTIMENTOS':
                $string = 'Quatá Investimentos';
                $badge = 'warning';
                break;

            case 'SOMA_ASSET':
                $string = 'Soma Asset';
                $badge = 'warning';
                break;

            case 'GRUPO_ARCEL':
                $string = 'Grupo Arcel';
                $badge = 'warning';
                break;

            /** Fileserver */
            case 'VAN':
                $string = 'Van Bancária';
                $badge = 'warning';
                break;

            case 'JSON_API':
            case 'API':
                $string = 'Via API em JSON';
                $badge = 'warning';
                break;

            case 'INPUT':
                $string = 'Inclusão manual';
                $badge = 'warning';
                break;

            case 'CSV':
                $string = 'Arquivo CSV';
                $badge = 'warning';
                break;

            case 'CNAB':
                $string = 'CNAB (.REM)';
                $badge = 'warning';
                break;

            case 'XML':
                $string = 'NF-e (XML)';
                $badge = 'warning';
                break;

            case 'PIPE':
                $string = 'E-mail';
                $badge = 'warning';
                break;

            case 'ACCESSTAGE':
                $string = 'Accesstage';
                $badge = 'danger';
                break;

            case 'FINNET':
                $string = 'Finnet';
                $badge = 'danger';
                break;
            
            case 'CREDTEM':
                $string = 'Credtem Capital';
                $badge = 'danger';
                break;

            case 'QTS':
                $string = 'QTS';
                $badge = 'primary';
                break;

            /** Operational */
            case 'BANK':
                $string = 'Banco Cobrador';
                $badge = '';
                break;
        
            case 'ASSIGNOR':
                $string = 'Cedente';
                $badge = '';
                break;

            case 'DISCOUNT':
                $string = 'Desconto';
                $badge = '';
                break;

            case 'WARRANTY':
                $string = 'Garantia';
                $badge = '';
                break;

            case 'REAL_STATE':
                $string = 'Operações Imobiliárias';
                $badge = '';
                break;

            case 'CONFIRMING':
                $string = 'Confirming';
                $badge = '';
                break;
            
            case 'DEVELOPMENT':
                $string = 'Fomento';
                $badge = '';
                break;

            case 'SIMPLE_CHARGE':
                $string = 'Cobrança Simples';
                $badge = '';
                break;
            
            case 'WORKING_CAPITAL':
                $string = 'Capital de Giro';
                $badge = '';
                break;

            case 'MARKET_DEBT':
                $string = 'Dívida - mercado secundário';
                $badge = '';
                break;

            case 'NOT_APPLICABLE':
                $string = 'Não aplicável';
                $badge = '';
                break;

            case 'PULVERIZED':
                $string = 'Pulverizada';
                $badge = '';
                break;

            case 'INTERCOMPANY':
                $string = 'Intercompany';
                $badge = '';
                break;

            case 'CONFIDENTIAL_FACTORING':
                $string = 'Comissária';
                $badge = '';
                break;

            case 'DUPLICATAS':
                $string = 'Duplicatas';
                $badge = '';
                break;
        
            case 'ESCROW':
                $string = 'Conta Escrow';
                $badge = '';
                break;

            case 'CHECKING_ACCOUNT':
                $string = 'Conta Livre Movimentação';
                $badge = '';
                break;

            case 'CNAB_444':
                $string = 'CNAB 444 - Oficial';
                $badge = '';
                break;

            case 'CNAB_400':
                $string = 'CNAB 400 - Necessita aprovação';
                $badge = '';
                break;
            
            case 'CNAB_XML':
                $string = 'XML - Apenas emissão banco cobrador';
                $badge = '';
                break;

            case 'QI_TECH_SCHEME':
                $string = 'Boletos Qi Tech';
                $badge = '';
                break;

            case 'QI_TECH_BRADESCO_SCHEME':
                $string = 'Boletos Bradesco, mas homologado na conta escrow Qi Tech';
                $badge = '';
                break;

            case 'BRADESCO_SCHEME':
                $string = 'Boletos Bradesco, não aceita Qi Tech de forma alguma. Sujeito a aprovação';
                $badge = '';
                break;

            /** Status */

            case 'WAITING_FOR_APPROVAL':
                $string = 'Aguardando aprovação';
                $badge = 'warning';
                break;

            case 'ONGOING':
                $string = 'Em andamento';
                $badge = 'success';
                break;
            
            case 'CANCELED':
                $string = 'Cancelado';
                $badge = 'danger';
                break;

            case 'FINISHED':
                $string = 'Finalizado';
                $badge = 'success';
                break;

            case 'RECEIVED':
                $string = 'Recebido';
                $badge = 'success';
                break;

            case 'PENDING':
                $string = 'Pendente';
                $badge = 'warning';
                break;

            case 'VALID':
                $string = 'Válido';
                $badge = 'success';
                break;

            case 'INVALID':
                $string = 'Inválido';
                $badge = 'danger';
                break;

            case 'ACCEPTED':
                $string = 'Aceito';
                $badge = 'primary';
                break;

            case 'PROCESSED':
                $string = 'Processado';
                $badge = 'success';
                break;

            case 'FAIL':
                $string = 'Falha';
                $badge = 'danger';
                break;

            case 'STORED':
                $string = 'Armazenado';
                $badge = 'primary';
                break;

            case 'READ':
                $string = 'Lido';
                $badge = 'success';
                break;

            case 'UNREAD':
                $string = 'Não lido';
                $badge = 'success';
                break;

            case 'WARNING':
                $string = 'Alertas';
                $badge = 'warning';
                break;

            case 'DEBUG':
                $string = 'Debug do sistema';
                $badge = 'info';
                break;

            case 'ERROR':
                $string = 'Erro';
                $badge = 'danger';
                break;

            case 'ACTIVE':
                $string = 'Ativo';
                $badge = 'primary';
                break;
            
            case 'INACTIVE':
                $string = 'Inativo';
                $badge = 'danger';
                break;

            case 'PRODUCTION':
                $string = 'Produção';
                $badge = 'success';
                break;

            case 'STAGING':
                $string = 'Homologação';
                $badge = 'warning';
                break;

            case 'SUCCESS':
                $string = 'Sucesso';
                $badge = 'success';
                break;

            case 'CONSOLIDATED':
                $string = 'Consolidado';
                $badge = 'secondary';
                break;

            case 'OPENED':
                $string = 'Aberta/ativa';
                $badge = 'success';
                break;

            case 'OPEN':
                $string = 'Em aberto';
                $badge = 'warning';
                break;

            case 'SENT':
                $string = 'Enviado';
                $badge = 'success';
                break;

            case 'WAITING_FOR_SUPPORT':
                $string = 'Aguardando Suporte';
                $badge = 'warning';
                break;

            case 'WAITING_FOR_OWNER':
                $string = 'Aguardando Usuário(a)';
                $badge = 'warning';
                break;

            case 'CLOSED':
                $string = 'Encerrado';
                $badge = 'success';
                break;

            case 'AUTO_CLOSED':
                $string = 'Encerrado por Inatividade';
                $badge = 'secondary';
                break;

            case 'URGENT':
                $string = 'Urgente';
                $badge = 'danger';
                break;

            case 'HIGH':
                $string = 'Alta';
                $badge = 'warning';
                break;

            case 'STANDARD':
                $string = 'Média';
                $badge = 'secondary';
                break;

            case 'LOW':
                $string = 'Baixa';
                $badge = 'info';
                break;

            case 'APPROVED':
                $string = 'Aprovado/homologado';
                $badge = 'primary';
                break;

            /** Fundos */
            case 'MULTISETORIAL':
                $string = 'Multisetorial';
                $badge = 'primary';
                break;

            case 'PRASS_II':
                $string = 'Prass II';
                $badge = 'primary';
                break;

            case 'QUATA_NX':
                $string = 'Quatá NX';
                $badge = 'primary';
                break;

            case 'UNIQUE_AAA':
                $string = 'Unique AAA';
                $badge = 'primary';
                break;

            case 'QT_UNIQUE':
                $string = 'QT Unique';
                $badge = 'primary';
                break;

            case 'QT_UNIQUE_PRIME':
                $string = 'QT Unique Prime';
                $badge = 'primary';
                break;

            case 'QB1_FIM_HY_CP':
                $string = 'QB1 FIM HY CP';
                $badge = 'primary';
                break;

            case 'SELECT_REFERENCIADO_DI':
                $string = 'Select Referenciado DI';
                $badge = 'primary';
                break;

            case 'SELECT_LIGHT_FIRF_CP':
                $string = 'Select Light FIRF CP';
                $badge = 'primary';
                break;

            case 'QW1_CP_FIM':
                $string = 'QW1 CP FIM';
                $badge = 'primary';
                break;

            case 'SELECT_FI_RF_CP':
                $string = 'Select FI RF CP';
                $badge = 'primary';
                break;

            case 'QI_PLUS':
                $string = 'Qi Plus';
                $badge = 'primary';
                break;

            case 'QUATA_CLO':
                $string = 'Quatá CLO';
                $badge = 'primary';
                break;

            case 'QUATA_ARCEL':
                $string = 'Quatá Arcel';
                $badge = 'primary';
                break;

            case 'QI_QUATA':
                $string = 'Qi Quatá';
                $badge = 'primary';
                break;

            /** Bancos */
            case 'BRADESCO':
                $string = 'Bradesco';
                $badge = 'primary';
                break;

            case 'QI_TECH':
                $string = 'Qi Tech';
                $badge = 'primary';
                break;

            /** Transações */
            case 'UNDERPAYMENT_BANK_SLIPS':
                $string = 'Débito referente a Títulos com Pagamento a Menor';
                $badge = 'primary';
                break;

            case 'CONTRACT_REGISTRY_OFFICE':
                $string = 'Débito referente a Registro de Contratos / Cartório';
                $badge = 'primary';
                break;

            case 'NONCOMPLIANCE_GUARANTEE_FEE':
                $string = 'Débito referente a Multa por Desenquadramento de Garantia';
                $badge = 'primary';
                break;

            case 'SERASA_FEE':
                $string = 'Débito referente a Consulta Serasa';
                $badge = 'primary';
                break;

            case 'BUILD_OPERATION_FEE':
                $string = 'Débito referente a Fee Estruturação';
                $badge = 'primary';
                break;

            case 'REFUND_RELEASE':
                $string = 'Estorno de Lançamento';
                $badge = 'primary';
                break;

            case 'CONTRACTUAL_FINE':
                $string = 'Débito referente a Multa Contratual';
                $badge = 'primary';
                break;

            case 'PMT_AMORTISATION':
                $string = 'Débito referente a Amortização de PMT';
                $badge = 'primary';
                break;

            case 'SIMPLE_CHARGE_TRANSFER':
                $string = 'Débito referente a Transferência e Cobrança Simples';
                $badge = 'primary';
                break;

            case 'AMOUNT_TRANSFER_TO_FUND':
                $string = 'Débito referente a Transferência de Valor para o Fundo';
                $badge = 'primary';
                break;

            /** Reports/Roles */
            
            case 'ADMIN':
                $string = 'Administrador(a)';
                $badge = 'primary';
                break;

            case 'ACQUISITION':
                $string = 'Captação';
                $badge = 'primary';
                break;

            case 'CUSTOMER':
                $string = 'Cliente';
                $badge = 'primary';
                break;

            case 'DEVELOPER':
                $string = 'Tecnologia';
                $badge = 'primary';
                break;

            case 'COMMERCIAL':
                $string = 'Comercial';
                $badge = 'primary';
                break;

            case 'MIDDLE':
                $string = 'Middle Office';
                $badge = 'primary';
                break;

            case 'MOP':
                $string = 'Mesa de Operações';
                $badge = 'primary';
                break;

            case 'STRUCTURING':
                $string = 'Estruturação';
                $badge = 'primary';
                break;

            case 'GRO':
                $string = 'GRO';
                $badge = 'primary';
                break;

            case 'CHECKING':
                $string = 'Checagem';
                $badge = 'primary';
                break;

            case 'BACKOFFICE':
                $string = 'Backoffice';
                $badge = 'primary';
                break;

            case 'CREDIT':
                $string = 'Crédito';
                $badge = 'primary';
                break;

            case 'DIGITAL':
                $string = 'Digital';
                $badge = 'primary';
                break;
            
            case 'FINANCIAL':
                $string = 'Financeiro';
                $badge = 'primary';
                break;

            case 'LEGAL':
                $string = 'Jurídico';
                $badge = 'primary';
                break;
            
            case 'HUMAN_RESOURCES':
                $string = 'Pessoas e Cultura';
                $badge = 'primary';
                break;

            case 'OTHER':
                $string = 'Outros';
                $badge = 'primary';
                break;

            case 'LEADER':
                $string = 'Líder/gestor(a)';
                $badge = 'primary';
                break;

            case 'ASSISTANT':
                $string = 'Assistente';
                $badge = 'primary';
                break;
        
            case 'COORDINATOR':
                $string = 'Coordenador(a)';
                $badge = 'primary';
                break;

            case 'MANAGER':
                $string = 'Gerente';
                $badge = 'primary';
                break;

            case 'OPERATOR':
                $string = 'Operador(a)';
                $badge = 'primary';
                break;

            /**
             * Heritage
             */

            case 'FACILITIES': 
                $string = 'Equipamentos/instalações';
                $badge = 'primary';
                break;

            case 'FURNITURE':
                $string = 'Mobiliário';
                $badge = 'primary';
                break;

            case 'PRINTERS':
                $string = 'Impressoras';
                $badge = 'primary';
                break;
                
            case 'UTENSILS':
                $string = 'Utensílios';
                $badge = 'primary';
                break;

            case 'TOOLS': 
                $string = 'Ferramentas';
                $badge = 'primary';
                break;

            case 'COMMUNICATION':
                $string = 'Comunicações';
                $badge = 'primary';
                break;

            case 'COMPUTERS_AND_PERIPHERAL':
                $string = 'Computadores e periféricos';
                $badge = 'primary';
                break;

            case 'ELECTRONICS':
                $string = 'Eletrônicos';
                $badge = 'primary';
                break;

            /**
             * Quality
             */

            case 'EXCELENT':
                $string = 'Excelente/novo';
                $badge = 'primary';
                break;

            case 'GOOD':
                $string = 'Bom estado';
                $badge = 'primary';
                break;

            case 'REGULAR':
                $string = 'Normal';
                $badge = 'warning';
                break;

            case 'POOR':
                $string = 'Ruim';
                $badge = 'secondary';
                break;

            case 'DAMAGED':
                $string = 'Danificado';
                $badge = 'danger';
                break;
            
            /**
             * Report Outputs
             */
                
            case 'TABLE':
                $string = 'Tabela';
                $badge = 'primary';
                break;

            case 'DOWNLOAD':
                $string = 'Download';
                $badge = 'success';
                break;

            case 'LAMBDA':
                $string = 'AWS Lambda';
                $badge = 'success';
                break;

            case 'LINE_CHART':
                $string = 'Gráfico de Linha';
                $badge = 'danger';
                break;

            case 'BAR_CHART':
                $string = 'Gráfico de Barras';
                $badge = 'danger';
                break;

            case 'GROUPED_BAR_CHART':
                $string = 'Gráfico de Barras Agrupadas';
                $badge = 'danger';
                break;

            case 'HISTOGRAM_CHART':
                $string = 'Histograma';
                $badge = 'danger';
                break;

            case 'PIE_CHART':
                $string = 'Gráfico de Pizza';
                $badge = 'danger';
                break;

            case 'SCREEN_DATA_CHART':
                $string = 'Painel (Label + Total)';
                $badge = 'danger';
                break;

            /** Default */
            default:
                $string = 'Não encontrado: ' . $string;
                $badge = 'info';
        }

        if($get_badge){ return $badge; }
        return $string;

    }

    public static function translateBankSlipEnums(String $string, Bool $get_badge=false)
    {

        switch(strtoupper($string)){

            case 'WAITING_PAYMENT':
                $string = 'Aguardando Pagamento';
                $badge = 'warning';
                break;

            case 'PAID':
                $string = 'Parcela Paga';
                $badge = 'warning';
                break;

            case 'WRITTEN_OFF':
                $string = 'Baixado';
                $badge = 'warning';
                break;

            /** Default */
            default:
                $string = 'Não encontrado: ' . $string;
                $badge = 'info';
        }

        if($get_badge){ return $badge; }
        return $string;

    }

    public static function translateUserEnums(String $string, Bool $get_badge=false)
    {

        switch(strtoupper($string)){

            case 'VAN_STATUS':
                $string = 'Status de VANs bancárias';
                $badge = 'warning';
                break;

            case 'TODAYS_DEBT':
                $string = 'PMTs vencendo hoje';
                $badge = 'warning';
                break;

            case 'HOMOLOGATION':
                $string = 'Status das homologações';
                $badge = 'warning';
                break;
            
            case 'ALL':
                $string = 'Todos os alertas disponíveis';
                $badge = 'warning';
                break;

            case 'OTHER':
                $string = 'Assuntos genéricos';
                $badge = 'warning';
                break;

            /** Default */
            default:
                $string = 'Não encontrado: ' . $string;
                $badge = 'info';
        }

        if($get_badge){ return $badge; }
        return $string;

    }

    public static function translateDocsAndLogsEnums(String $string, Bool $get_badge=false)
    {

        switch(strtoupper($string)){

            case 'NOT_APPLICABLE':
                $string = 'Não se aplica';
                $badge = 'warning';
                break;

            case 'T1':
                $string = 'Tier 1';
                $badge = 'warning';
                break;

            case 'T2':
                $string = 'Tier 2';
                $badge = 'warning';
                break;

            case 'T3':
                $string = 'Tier 3';
                $badge = 'warning';
                break;

            case 'T4':
                $string = 'Tier 4';
                $badge = 'warning';
                break;

            case 'T5':
                $string = 'Tier 5';
                $badge = 'warning';
                break;

            case 'GENERAL':
                $string = 'Gerais';
                $badge = 'warning';
                break;

            case 'SUPPORT_BOX':
                $string = 'Notificação de Issue V02';
                $badge = 'warning';
                break;

            case 'AUTO':
                $string = 'Automáticos do QTS';
                $badge = 'warning';
                break;

            /** Default */
            default:
                $string = 'Não encontrado: ' . $string;
                $badge = 'info';
        }

        if($get_badge){ return $badge; }
        return $string;

    }

    public static function translateDtvmEnums(String $string, Bool $get_badge=false)
    {

        switch(strtoupper($string)){

            case 'FACTORING':
                $string = 'Fomento Mercantil';
                $badge = 'info';
                break;

            case 'ASSIGNOR_RISK':
                $string = 'Risco Cedente';
                $badge = 'info';
                break;

            case 'DEBTOR_RISK':
                $string = 'Risco Sacado';
                $badge = 'info';
                break;

            case 'LIMITED_ISSUER_RISK':
                $string = 'Risco Sacado Limitado';
                $badge = 'info';
                break;

            case 'MALE':
                $string = 'Masculino';
                $badge = 'warning';
                break;

            case 'FEMALE':
                $string = 'Feminino';
                $badge = 'warning';
                break;

            case 'PENDING_REGISTRY':
                $string = 'Registro pendente';
                $badge = 'warning';
                break;

            case 'REGISTERED':
                $string = 'Registrado';
                $badge = 'success';
                break;

            case 'PENDING_DOCUMENTS':
                $string = 'Documentação pendente';
                $badge = 'warning';
                break;

            case 'SENT_TO_ANALYSIS':
                $string = 'Enviado para Análise';
                $badge = 'warning';
                break;

            case 'IN_MANUAL_ANALYSIS':
                $string = 'Em Análise Manual';
                $badge = 'warning';
                break;

            case 'APPROVED':
                $string = 'Aprovado';
                $badge = 'success';
                break;

            case 'REPROVED':
                $string = 'Reprovado';
                $badge = 'danger';
                break;

            case 'PRESIDENT':
                $string = 'Presidente';
                $badge = 'warning';
                break;

            case 'PARTNER':
                $string = 'Sócio(a)';
                $badge = 'warning';
                break;

            case 'ADMINISTRATOR':
                $string = 'Administrador(a)';
                $badge = 'warning';
                break;

            case 'DIRECTOR':
                $string = 'Diretor(a)';
                $badge = 'warning';
                break;

            case 'MANAGER':
                $string = 'Gestor(a)';
                $badge = 'warning';
                break;

            case 'ATTORNEY':
                $string = 'Procurador(a)';
                $badge = 'warning';
                break;

            /** Default */
            default:
                $string = 'Não encontrado: ' . $string;
                $badge = 'info';
        }

        if($get_badge){ return $badge; }
        return $string;

    }

    public static function translateDocument(String $string)
    {

        if(strpos($string, '/')!==false){
            $sanitize = explode('/', $string);
            $string = $sanitize[(count($sanitize)-1)];
            list($string, $extension) = explode('.', $string);
        }

        switch(strtoupper($string)){
            case 'ULTIMO_BALANCO_PATRIMONIAL':
                $string = 'Último Balanço Patrimonial';
                break;
            case 'CARTAO_CNPJ':
                $string = 'Cartão CNPJ';
                break;
            case 'DOCUMENTOS_PESSOAIS_ACIONISTAS':
                $string = 'Documentos Pessoais dos(as) Acionistas';
                break;
            case 'CERTIDAO_NEGATIVA_DEBITOS':
                $string = 'Certidão Negativa de Débitos';
                break;
            case 'CERTIFICADO_REGULARIDADE_FGTS_CRF':
                $string = 'Certificado de Regularidade do FGTS/CRF';
                break;
            case 'DOCUMENTOS_SOCIETARIOS_ATUALIZADOS':
                $string = 'Documentos Societários Atualizados';
                break;
            case 'POLITICA_DILIGENCIA_FORNECEDORES':
                $string = 'Política de Diligência dos Fornecedores';
                break;
            case 'DOCUMENTO_REPRESENTANTES_ASSINATURA_DIGITAL':
                $string = 'Documento(s) do(s) Representante(s) com assinatura digital';
                break;
            case 'CERTIDAO_JUSTICA_TRABALHO':
                $string = 'Certidão da Justiça do Trabalho';
                break;
            case 'ATA_ELEICAO_JUCESP':
                $string = 'Ata de Eleição da JUCESP';
                break;
            case 'CONTRATO_SOCIAL':
                $string = 'Contrato Social';
                break;
            case 'PROCURACAO':
                $string = 'Procuração';
                break;
            case 'ULTIMA_ALTERACAO_CONTRATUAL_JUCESP':  
                $string = 'Última Alteração Contratual na JUCESP';
                break;
            case 'DEVEDOR_SOLIDARIO_PJ':
                $string = 'Devedor Solidário PJ';
                break;
            case 'DEVEDOR_SOLIDARIO_PF':
                $string = 'Devedor Solidário PF';
                break;
            case 'DOCUMENTO_SOCIO_PJ':
                $string = 'Documento Sócio(a) PJ';
                break;
            case 'CONTRATO_SOCIAL_3_ANOS': 
                $string = 'Contrato Social (mais de 3 anos)';
                break;
            case 'CPF': 
                $string = 'CPF';
                break;
            case 'RG': 
                $string = 'RG';
                break;
            case 'CNH': 
                $string = 'Habilitação (CNH)';
                break;
            case 'COMPROVANTE_RESIDENCIA': 
                $string = 'Comprovante de Residência';
                break;
            case 'DOCUMENTOS_PESSOAIS': 
                $string = 'Documentos Pessoais (geral)';
                break;
            case 'DECLARACAO_SIMPLIFICADA': 
                $string = 'Declaração Simplificada';
                break;
            case 'CERTIDAO_ESTADO_CIVIL': 
                $string = 'Certidão de Estado Civil';
                break;
            case 'DRE': 
                $string = 'DRE';
                break;

            default: 
                $string = 'Desconhecido: ' . $string;
        }

        return $string;

    }

    public static function floatToBrl($float)
    {
        return 'R$ ' . number_format($float, '2', ',', '.');
    }

    public static function centsToFloat($amount_in_cents, $prefix = null)
    {
        $formatted= number_format($amount_in_cents / 100, 2, '.', '');
        if ($prefix === true) {
           return "{$prefix} {$formatted}";
        }
        return $formatted;
    }

    public static function date(String $datetime, String $format='d/m/Y H:i')
    {

        return date($format, strtotime($datetime));

    }

    public static function cleanSpecialChars($string) {
  
        $string = str_replace( array( '\'', '"', ',' , ';', '<', '>' ), '', $string);
        $string = trim($string);

        return $string;
    }

    public static function convertToBase64($request, $input_name, $create_hash=false)
    {

        if( !$request->hasFile($input_name) ){ return []; }

        $converted = [];            
        foreach($request->file($input_name) as $file):

            $file_info = finfo_open();
            $content = file_get_contents($file);

            $filename = Qts::cleanUpString($file->getClientOriginalName());
            
            if(isset($create_hash) && $create_hash){
                $original_filename = explode('.', $file->getClientOriginalName());
                $count = count($original_filename);
                $extension = $original_filename[ $count - 1];

                switch(strtoupper($create_hash)){
                    case 'MD5': 
                        $filename = md5($file->getClientOriginalName()) . '.' . $extension;
                        break;

                    case 'UUID': 
                        $filename = (string)\Str::uuid() . '.' . $extension;
                        break;

                    default:
                        $filename = md5($file->getClientOriginalName()) . '.' . $extension;
                        
                }

                
            }

            $converted[] = (object)[
                'filename' => $filename,
                'base64' => base64_encode($content),
                'mimetype' => $file->getClientMimeType()
            ];

        endforeach;

        return $converted;

    }

    public static function extractBase64($request, $input_name, $create_hash=false)
    {

        if(!$request->has($input_name)){ return []; }

        $converted = [];

        foreach($request->all() as $key => $value):
            if($key === $input_name):

                foreach($value as $file):

                    if(isset($file['filename']) && isset($file['base64'])){
        
                        $file_info = finfo_open();

                        $filename = Qts::cleanUpString($file['filename']);
            
                        if(isset($create_hash) && $create_hash){
                            $original_filename = explode('.', $file['filename']);
                            $count = count($original_filename);
                            $extension = $original_filename[ $count - 1];

                            switch(strtoupper($create_hash)){
                                case 'MD5': 
                                    $filename = md5(Qts::cleanUpString($file['filename'])) . '.' . $extension;
                                    break;
            
                                case 'UUID': 
                                    $filename = (string)\Str::uuid() . '.' . $extension;
                                    break;
            
                                default:
                                    $filename = md5(Qts::cleanUpString($file['filename'])) . '.' . $extension;
                                    
                            }

                        }

                        $converted[] = (object)[
                            'filename' => $filename,
                            'base64' => $file['base64'],
                            'mimetype' =>finfo_buffer($file_info, base64_decode($file['base64']), FILEINFO_MIME_TYPE)
                        ];     
        
                    }
        
                endforeach;

            endif;
        endforeach;

        return $converted;
        
    }

    public static function convertToBinary($request, $input_name)
    {

        if( !$request->hasFile($input_name) ){ return []; }

        $converted = [];            
        foreach($request->file($input_name) as $file):

            $data = fopen($file,'rb');
            $contents = fread($data, filesize($file));
            fclose ($data);

            $converted[] = (object)[
                'md5' => md5($contents),
                'name' => $file->getPathName(),
                'mime' => $file->getMimeType(),
                'postname' => $file->getClientOriginalName()
            ];

        endforeach;

        return $converted;

    }

    public static function extractBinary($request, $input_name)
    {

        if(!$request->has($input_name)){ return []; }

        $converted = [];

        foreach($request->all() as $key => $value):
            if($key === $input_name):

                foreach($value as $file):

                    /**
                     * Check integrity
                     */

                    $valid = true;
                    $valid = (!isset($file['base64']) ? false : true);
                    $valid = (!isset($file['filename']) ? false : true);

                    if($valid){

                        try {
                            
                            \Storage::disk('local')->put('temp/' . $file['filename'], base64_decode($file['base64']));
                            $path = '../storage/app/temp/' . $file['filename'];

                            $data = fopen($path,'rb');
                            $contents = fread($data, filesize($path));
                            fclose ($data);
                    
                            $converted[] = (object)[
                                'md5' => md5($contents),
                                'name' => $path,
                                'mime' => mime_content_type($path),
                                'postname' => $file['filename']
                            ];

                        } catch(\Exception $e){

                            echo $e->getMessage();
                            exit;

                            $converted[] = null;

                        }
        
                    }
        
                endforeach;

            endif;
        endforeach;

        return $converted;
        
    }

    public static function mask($val, $mask){
        $masked = '';
        $k = 0;
        for($i = 0; $i<=strlen($mask)-1; $i++){
            if($mask[$i] == '#'){
            if(isset($val[$k]))
            $masked .= $val[$k++];
        } else {
            if(isset($mask[$i]))
            $masked .= $mask[$i];
        }}
        
        return $masked;
    }

    public static function translate_complete_phone_mask($value,$pad=19){
        $value = preg_replace( '/[\W]/', '', $value); 
        return str_pad(Qts::mask($value,'+## (##) #####-####'), $pad, "0", STR_PAD_LEFT);
    }
    
    public static function translate_phone_mask($value,$pad=10){
        return str_pad(Qts::mask($value,'#####-####'), $pad, "0", STR_PAD_LEFT);
    }

    public static function mask_identification_type($type,$value){
        switch($type){
            case 'TAXPAYER_ID': return Qts::mask($value,'###.###.###-##'); break;
            case 'EIN': return Qts::mask($value,'##.###.###/####-##'); break;
            default: return 'Desconhecido: ' . $value;
        }
    }

    public static function translate_barcode($value){
        return Qts::mask($value,'#####.#####  #####.######  #####.######  #  ##############');
    }

    function translate_zipcode($value){
        if(strlen($value)===8){
            return Qts::mask($value,'#####-###');
        }

        return $value;
    }

    public static function translate_month($int){
        switch($int){
            case 1: return 'janeiro'; break;
            case 2: return 'fevereiro'; break;
            case 3: return 'março'; break;
            case 4: return 'abril'; break;
            case 5: return 'maio'; break;
            case 6: return 'junho'; break;
            case 7: return 'julho'; break;
            case 8: return 'agosto'; break;
            case 9: return 'setembro'; break;
            case 10: return 'outubro'; break;
            case 11: return 'novembro'; break;
            case 12: return 'dezembro'; break;
            default: return 'desconhecido: ' . $int;
        }
    }

    public static function translate_weekday($int){
        switch($int){
            case 1: return 'segunda feira'; break;
            case 2: return 'terça feira'; break;
            case 3: return 'quarta feira'; break;
            case 4: return 'quinta feira'; break;
            case 5: return 'sexta feira'; break;
            case 6: return 'sábado'; break;
            case 0: return 'domingo'; break;
            default: return 'desconhecido: ' . $int;
        }
    }

    public static function translate_crons($value){
        list($minute,$hour,$month_day,$month,$weekday) = explode(' ', $value);
        
        $clock_minute = false;
        
        if($minute === '*'){
            
            $minute = 'De minuto em minuto';
       
        } else {

            if(strpos($minute,'*/') !== false ){
                list($every,$minute) = explode('/', $minute);
                $minute = "A cada {$minute} minuto(s)";
            }

            if(strpos($minute,'-') !== false ){
                list($from,$to) = explode('-', $minute);
                $minute = "Todo minuto no intervalo de {$from} a {$to} minuto(s)";
            }

            if((int)$minute >= 0){
                $clock_minute = true;
            }

        }

        $clock_hour = false;

        if($hour === '*'){

            $hour = 'de hora em hora,';

        } else {

            if(strpos($hour,'*/') !== false ){
                list($every,$hour) = explode('/', $hour);
                $hour = "às {$hour} hora(s),";
            }

            if(strpos($hour,'-') !== false ){
                list($from,$to) = explode('-', $hour);
                $hour = "das {$from} a {$to} hora(s),";
            }

            if((int)$hour >= 0){
                $clock_hour = true;
            }

        }

        if($month_day === '*'){

            $month_day = 'todos os dias,';

        } else {

            if(strpos($month_day,'*/') !== false ){
                list($every,$month_day) = explode('/', $month_day);
                $month_day = "somente no {$month_day}º dia do mês,";
            }

            if(strpos($month_day,'-') !== false ){
                list($from,$to) = explode('-', $month_day);
                $month_day = "do {$from}º ao {$to}º dia do mês,";
            }

        }

        if($month === '*'){

            $month = 'o ano todo';

        } else {

            if(strpos($month,'*/') !== false ){
                list($every,$month) = explode('/', $month);
                $month = "somente no mês de " . Qts::translate_month($month);
            }

            if(strpos($month,'-') !== false ){
                list($from,$to) = explode('-', $month);
                $month = "de " . Qts::translate_month($from) . " a " . Qts::translate_month($to);
            }

        }

        if($weekday === '*'){

            $weekday = 'e em todos os dias da semana';

        } else {

            if(strpos($weekday,'*/') !== false ){
                list($every,$weekday) = explode('/', $weekday);
                $weekday = "somente de " . Qts::translate_weekday($weekday);
            }

            if(strpos($weekday,'-') !== false ){
                list($from,$to) = explode('-', $weekday);
                $weekday = "no intervalo de " . Qts::translate_weekday($from) . " a " . Qts::translate_weekday($to);
            }

        }

        if($clock_hour && $clock_minute){
            $minute = "{$hour}h:{$minute}m";
            $hour = '';
        }

        return "{$minute} {$hour} {$month_day} {$month} {$weekday}.";
    }

    public static function translate_countable($countable, $none='nenhum', $singular='resultado', $plural='resultados')
    {

        $total = (is_array($countable) ? count($countable) : $countable);
        $result = (isset($total) && $total === 0) ? $none : null;
        
        if(!$result){
            $result = ($total === 1) ? $singular : $plural;
            $result = $total . ' ' . $result;
        }

        return $result;

    }

    public static function extractUserData($json,$data='ALL')
    {

        $json = json_decode($json, true);
        if(strtoupper($data) === 'ALL'){ return $json; }

        foreach($json as $key => $value):
            if(strtoupper($key) === strtoupper($data)){
                return $value;
            }
        endforeach;

        return null;
    }

    public static function bytesToHuman($bytes)
    {
        $units = ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    public static function extractAgreementFromFilename($path)
    {

        $path = explode('/', $path);
        $total_folders = count($path);

        $filename = $path[($total_folders - 1)];
        list($agreement, $filename) = explode('__', $filename);

        return (isset($agreement) && $agreement ? $agreement : null);

    }

    public static function keyValueMessage($array)
    {

        $key_value_message = [];
        $count = 1;

        foreach($array as $value):

            if(is_array($value)){

                foreach($value as $v):

                    if(is_array($v)){ $v = json_encode($v); }

                    $key_value_message += ['mensagem ' . $count => $v];
                    $count++;
                endforeach;
            
            } else {

                $key_value_message += ['mensagem ' . $count => $value];
                $count++;

            }

        endforeach;

        return $key_value_message;
        
    }

    public static function cleanArray($array=[]){
        $new_array = [];
        foreach($array as $a):
            if($a && !in_array($a, $new_array)){ $new_array[] = $a; }
        endforeach;
        return $new_array;
    }

    public static function outboxRenaming($filename, $sequential)
    {

        $filename = str_replace('AA',date('y'),$filename);
        $filename = str_replace('MM',date('m'),$filename);
        $filename = str_replace('DD',date('d'),$filename);
        $filename = str_replace('HH',date('H'),$filename);
        $filename = str_replace('MM',date('i'),$filename);
        $filename = str_replace('SS',date('s'),$filename);
        $filename = str_replace('SEQ3',str_pad($sequential, 3, 0, STR_PAD_LEFT),$filename);

        return $filename;

    }

    public static function cleanUpString($string)
    {
        $string = str_replace('(', '', $string);
        $string = str_replace(')', '', $string);
        $string = str_replace(' ', '_', $string);
        $string = str_replace('%20', '_', $string);
        return $string;
    }

    public static function getBase64SizeInMb($files)
    {

        $total_size_in_mb = 0;

        foreach($files as $file):

            try{
                $size_in_bytes = (int) (strlen(rtrim($file->base64, '=')) * 3 / 4);
                $size_in_kb    = $size_in_bytes / 1024;
                $size_in_mb    = $size_in_kb / 1024;
        
                $total_size_in_mb += $size_in_mb;
            
            } catch(Exception $e){ return 0; }

        endforeach;

        return $total_size_in_mb;
        
    }

    public static function getExcept($data, $except_array)
    {

        $except_array = array_map(fn ($str) => strtoupper(trim($str)), $except_array);

        $new_data = [];
        foreach($data as $key => $value):
            if(!in_array(strtoupper($key), $except_array)){
                $new_data += [strtolower($key) => $value];
            }
        endforeach;
        $data = (object)$new_data;
        return $data;
    }

    public static function getOnly($data, $only_array)
    {

        $only_array = array_map(fn ($str) => strtoupper(trim($str)), $only_array);

        $new_data = [];
        foreach($data as $key => $value):
            if(in_array(strtoupper($key), $only_array)){
                $new_data += [strtolower($key) => $value];
            }
        endforeach;
        $data = (object)$new_data;
        return $data;
    }

    public static function extractNumbers($string) {

        return preg_replace('/[^0-9]/', '', $string);
    
    }

    public static function getApiResults($data)
    {

        return json_decode($data->getContent(), false)->results;

    }

    public static function newlineToArray($string)
    {

        $string = str_replace("\\r\\n", PHP_EOL, $string);
        $string = str_replace("\\r", PHP_EOL, $string);
        $string = str_replace("\\n", PHP_EOL, $string);
        $string = str_replace(',', PHP_EOL, $string);
        $string = str_replace(PHP_EOL, ';', $string);
        
        $data = explode(';', $string);

        $new_data = [];
        foreach($data as $d):

            $d = preg_replace('/\s+/', '', $d);
            $d = preg_replace('/[^A-Za-z0-9@._-]/', '', $d);

            if($d){
                $new_data[] = trim(strtolower($d));
            }

        endforeach;

        return $new_data;

    }

    public static function cleanUpHtml($string)
    {
        return preg_replace('/\s{2,}/', ' ', $string);
    }

    public static function platformsToArray($data)
    {

        $new_data = [];
        foreach($data as $d):
            $usu_ids = explode(',',$d);

            if(!is_array($usu_ids)){
                $new_data[] = (int)$d;
                continue;
            }

            foreach($usu_ids as $usu_id):
                $new_data[] = (int)$usu_id;
            endforeach;
        endforeach;
        return $new_data;

    }

    public static function strToUpper($string)
    {

        $current_encoding = mb_internal_encoding();
        mb_internal_encoding("UTF-8");
        $upper = mb_strtoupper($string, "UTF-8");
        mb_internal_encoding($current_encoding);
        return $upper;

    }

    public static function getCommercialUsersArray($data)
    {

        $new_data = [];
        foreach($data as $d):
            $qts_commercial_ids = str_replace('"', '', $d['qts_commercial_ids']);
            $qts_commercial_ids = explode(',', $qts_commercial_ids);

            foreach($qts_commercial_ids as $id):
                if(!in_array((int)$id, $new_data)){
                    $new_data[] = (int)$id;
                }
            endforeach;
        endforeach;

        return $new_data;

    }
    

}