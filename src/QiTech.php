<?php 

namespace QuataInvestimentos;

trait QiTech 
{

    public static function qiFetch($method='GET',$endpoint,$payload=[])
    {

        /**
         * Replace Client API Key
         */

        $endpoint = str_replace('{CLIENT-API-KEY}', env('QI_CLIENT_API_KEY'), $endpoint);

        /**
         * Body
         */

        // Qts::debug('Body da Request',$payload);

        $encoded_body = Qts::jwtEncrypt('BODY','','',$payload);
        if(!isset($encoded_body->status) || $encoded_body->status !== 200){
            return (object)[
                'status' => 404,
                'data' => $encoded_body->data
            ];
        }

        // Qts::debug('Body encodado em JWT para a Request',$encoded_body->data);
        // Qts::debug('MD5 do Body tokenizado', md5($encoded_body->data));

        /**
         * Header
         */

        $encrypt_header = (isset($payload) && $payload ? $encoded_body->data : []);
        $encoded_header = Qts::jwtEncrypt('HEADER',$method,$endpoint,$encrypt_header);

        if(!isset($encoded_header->status) || $encoded_header->status !== 200){
            return (object)[
                'status' => 404,
                'data' => $encoded_header->data
            ];
        }

        /**
         * Montar os headers
         */

        $params = [
            'debug'   => false,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'AUTHORIZATION' => "QIT ".env('QI_CLIENT_API_KEY').":" . $encoded_header->data,
                'API-CLIENT-KEY' => env('QI_CLIENT_API_KEY')
            ],
            'timeout' => 10
        ];

        try {

            $client = new \GuzzleHttp\Client();

            switch(strtoupper($method)){
                case 'GET':
                    $params += (isset($payload) && $payload ? ['query' => ['encoded_body' => $encoded_body->data]] : []);
                    $request = $client->get( env('QI_DOMAIN') . $endpoint, $params );
                    break;
                
                case 'POST':
                    $params += [\GuzzleHttp\RequestOptions::JSON => ['encoded_body' => $encoded_body->data]];
                    $request = $client->post( env('QI_DOMAIN') . $endpoint, $params );
                    break;
                
                case 'PUT': 
                    $params += [\GuzzleHttp\RequestOptions::JSON => ['encoded_body' => $encoded_body->data]];
                    $request = $client->put( env('QI_DOMAIN') . $endpoint, $params );
                    break;
                
                case 'DELETE': 
                    $params += (isset($payload) && $payload ? ['query' => ['encoded_body' => $encoded_body->data]] : []);
                    $request = $client->delete( env('QI_DOMAIN') . $endpoint, $params );
                    break;
            }
            
            $response = $request->getBody()->getContents();

        } catch (\Exception $e){

            
            $exception = ($e->getMessage() ? $e->getMessage() : null);
            $data = ($exception ? $exception : json_decode($e->getResponse()->getBody()->getContents(), true));

            // Qts::debug('ERRO',$data);

            return (object)[
                'status' => 401,
                'data' => $data
            ];
            
        }

        return Qts::decrypt($response);

    }

    public static function qiCurl($endpoint,$file)
    {

        /**
         * Disponíveis somente 'upload' e 'multibank_cnab'
         */

        switch(strtoupper($endpoint)){
            case 'MULTIBANK_CNAB':
                $endpoint = strtolower($endpoint);
                break;
            default:
                $endpoint = 'upload';
        }

        /**
         * Header
         * Uploads utilizam-se somente de token do header
         */

        $encoded_header = Qts::jwtEncrypt('HEADER','POST',$endpoint,$file->md5);

        if(!isset($encoded_header->status) || $encoded_header->status !== 200){
            return (object)[
                'status' => 404,
                'data' => $encoded_header->data
            ];
        }

        // print_r($file);
        // exit;

        try {

            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => env('QI_DOMAIN') . $endpoint,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => [
                    'file' => new \CurlFile(
                        $file->name,
                        $file->mime,
                        $file->postname
                    )
                ],
                CURLOPT_HTTPHEADER => [
                    'AUTHORIZATION: QIT '.env('QI_CLIENT_API_KEY').':' . $encoded_header->data,
                    'API-CLIENT-KEY: ' . env('QI_CLIENT_API_KEY')
                ]
            ]);

            $response = curl_exec($curl);
            curl_close($curl);

        } catch (\Exception $e){

            $data = ($e->getMessage() ? $e->getMessage() : null);
            // Qts::debug('Houve um erro ao fazer a chamada na API',$data);
            return (object)['status' => 500,'data' => $data]; 

        }

        if(strpos($file->name, 'storage/app/temp') !== false){
            @unlink($file->name);
        }

        return Qts::decrypt($response);

    }

    public static function qiHasError($data)
    {
        
        $title = (isset($data['title']) && $data['title'] ? $data['title'] : null);

        switch($title){
            case 'Bad Request - CNAB ERROR':
            case 'Internal Error':
            case 'Unprocessable Entity':
            case 'Permission Validator Error':
            case 'Schema Validator Error':
            case 'External API Error (Rest Connector)':
            case 'PSTI Translation Error':
            case 'Unauthorized':
            case 'Locked':
            case 'Bad Request':
            case 'Not Found':
            case 'Pub Sub Ocurrence Error':
            case 'Invalid FileName':
            case 'Gateway Time-Out':
            case 'Service Unavailable':
            case 'Invalid or empty token':
            case 'Payment Required':
            case 'Conflict':
            case 'Syntax Error':
            case 'Not Implemented':
            case 'Search Params Error':
                return true;
                break;
        }

        return false;
    }

    public static function qiMapError($data)
    {

        $error_msg = '';
        foreach($data['extra_fields'] as $key => $value):

            switch(strtoupper($key)){
                case 'DETAILS_BR':
                case 'CNAB_FILENAME':
                    $error_msg .= " {$value}";
                    break;
                case 'REASONS':
                    $error_msg .= Qts::qiGetReasons($value);
                    break;
            }

        endforeach;

        if(isset($data['translation']) && $data['translation']){
            $error_msg .= " " . $data['translation'];
        }

        if(isset($data['code']) && $data['code']){
            $error_msg .= " " . $data['code'];
        }

        return trim($error_msg);

    }

    public static function qiTranslateSourceSubtype($string)
    {

        switch(strtolower($string)){
            case 'operation_disbursement': $string = 'Desembolso da Operação'; break;
            case 'protest_expense': $string = 'Despesas de Protesto'; break;
            case 'automatic_integrated_payment': $string = 'Pagamento Automático Integrado'; break;
            case 'tax': $string = 'Impostos'; break;
            case 'electronic_funds_fee': $string = 'Tarifa de TED'; break;
            case 'credit_operation_fee': $string = 'Tarifa de Abertura de Crédito'; break;
            case 'internal_funds_transfer': $string = 'Transferência Interna'; break;
            case 'incoming_funds_transfer': $string = 'Transferência de Entrada'; break;
            case 'outgoing_funds_transfer': $string = 'TED'; break;
            case 'deposit': $string = 'Depósito'; break;
            case 'withdrawal': $string = 'Transferência'; break;
            case 'withdrawal_reversal': $string = 'Estorno de Transferência'; break;
            case 'trade_funds_transfer': $string = 'Transferência de Pagamento de Cessão'; break;
            case 'settlement_funds_transfer': $string = 'Transferência para Liquidação'; break;
            case 'bank_slip_fee': $string = 'Tarifa de Boleto'; break;
            case 'bank_slip_settlement': $string = 'Liquidação de Boleto'; break;
            case 'outgoing_funds_transfer_reversal': $string = 'Estorno de TED'; break;
            case 'incoming_funds_transfer_refusal': $string = 'Transferência Negada'; break;
            case 'electronic_funds_fee_reversal': $string = 'Estorno de Tarifa de TED'; break;
            case 'slb_payment': $string = 'Pagamento de SLB'; break;
            case 'repo_profit': $string = 'Rendimento de Compromissada'; break;
            case 'repo_expense': $string = 'Despesa de Compromissada'; break;
            case 'monthly_account_fee': $string = 'Tarifa de Manutenção de Conta'; break;
            case 'operation_settling': $string = 'Pagamento de Operação'; break;
            case 'cetip_settling': $string = 'Pagamento CETIP'; break;
            case 'monthly_account_fee_reversal': $string = 'Estorno de Tarifa de Manutenção de Conta'; break;
            case 'cetip_expense': $string = 'Tarifa CETIP'; break;
            case 'bank_slip_fee_reversal': $string = 'Estorno de Tarifa de Boleto'; break;
            case 'cetip_assignment': $string = 'Cessão de Título da Cetip'; break;
            case 'correspondent_bank_transfer': $string = 'Repasse de Correspondente Bancário'; break;
            case 'rebate': $string = 'Rebate'; break;
            case 'credit_analysis_fee': $string = 'Tarifa de Análise de Crédito'; break;
            case 'credit_operation_fee_reversal': $string = 'Estorno de Tarifa de Abertura de Crédito'; break;
            case 'internal_funds_transfer_reversal': $string = 'Estorno de Transferência Interna'; break;
            case 'financial_investments_income': $string = 'Renda de Aplicação Financeira'; break;
            case 'bank_slip_settlement_incoming': $string = 'Recebimento de Liquidação de Boleto'; break;
            case 'bank_slip_settlement_expense': $string = 'Tarifa de liquidação de Boleto'; break;
            case 'cip_expense': $string = 'Tarifa da CIP'; break;
            case 'doc_expense': $string = 'Tarifa de DOC'; break;
            case 'incoming_doc': $string = 'Entrada de DOC'; break;
            case 'outgoing_doc': $string = 'Saída de DOC'; break;
            case 'siloc_incoming_funds': $string = 'Transferência de entrada do Siloc'; break;
            case 'siloc_outgoing_funds': $string = 'Transferência de saída do Siloc'; break;
            case 'bank_slip_settlement_reversal': $string = 'Estorno de Liquidação de Boleto'; break;
            case 'bank_slip_settlement_expense_reversal': $string = 'Estorno de Tarifa de liquidação de Boleto'; break;
            case 'bank_slip_settlement_incoming_reversal': $string = 'Estorno de Recebimento de Liquidação de Boleto'; break;
            case 'correspondent_bank_transfer_reversal': $string = 'Estrono de Repasse de Correspondente Bancário'; break;
            case 'credit_analysis_fee_reversal': $string = 'Estorno de Tarifa de Análise de Crédito'; break;
            case 'doc_expense_reversal': $string = 'Estorno de Tarifa de DOC'; break;
            case 'incoming_doc_reversal': $string = 'Estorno de Entrada de DOC'; break;
            case 'operation_disbursement_reversal': $string = 'Estorno de Desembolso da Operação'; break;
            case 'operation_settling_reversal': $string = 'Estorno de Pagamento de Operação'; break;
            case 'outgoing_doc_reversal': $string = 'Estorno de Saída de DOC'; break;
            case 'rebate_reversal': $string = 'Estorno de Rebate'; break;
            case 'settlement_funds_transfer_reversal': $string = 'Estorno de Transferência para Liquidação'; break;
            case 'siloc_incoming_funds_reversal': $string = 'Estorno de Transferência de entrada do Siloc'; break;
            case 'siloc_outgoing_funds_reversal': $string = 'Estorno de Transferência de saída do Siloc'; break;
            case 'tax_reversal': $string = 'Estorno de Impostos'; break;
            case 'trade_funds_transfer_reversal': $string = 'Estorno de Transferência de Pagamento de Cessão'; break;
            case 'bank_slip_permanency_fee': $string = 'Tarifa de Permanência do Título'; break;
            case 'bank_slip_cancel_protest_fee': $string = 'Tarifa de Sustação'; break;
            case 'bank_slip_protest_fee': $string = 'Tarifa de Pedido de Protesto'; break;
            case 'bank_slip_notary_office_fee': $string = 'Custas de Protesto'; break;
            case 'bank_slip_registration_fee': $string = 'Tarifa de Registro'; break;
            case 'bank_slip_extension_fee': $string = 'Tarifa de Prorrogação'; break;
            case 'bank_slip_rebate_fee': $string = 'Tarifa de Abatimento'; break;
            case 'bank_slip_discount_fee': $string = 'Tarifa de Desconto'; break;
            case 'bank_slip_settlement_fee': $string = 'Tarifa de Liquidação'; break;
            case 'bank_slip_write_off_term_fee': $string = 'Tarifa de Baixa por Decurso de Prazo'; break;
            case 'bank_slip_write_off_fee': $string = 'Tarifa de Baixa'; break;
            case 'bank_slip_cancel_protest_write_off_fee': $string = 'Tarifa de Sustação de Protesto com Baixa'; break;
            case 'bank_slip_notary_office_settlement_fee': $string = 'Tarifa de Liquidação em Cartório'; break;
            case 'rebate_tax_free': $string = 'Repasse por Conta e Ordem'; break;
            case 'rebate_tax_free_reversal': $string = 'Estorno de Repasse por Conta e Ordem'; break;
            case 'incoming_funds_transfer_reversal': $string = 'Estorno de Transferência Interna'; break;
            case 'bank_slip_payment': $string = 'Pagamento de Boleto'; break;
            case 'bank_slip_payment_reversal': $string = 'Estorno de Pagamento de Boleto'; break;
            case 'warranty_analysis_fee': $string = 'Tarifa de Análise de Garantia'; break;
            case 'bank_slip_settlement_deposit': $string = 'Liquidação de Boleto'; break;
            case 'bank_slip_payment_withdrawal': $string = 'Pagamento de Boleto'; break;
            case 'structuring_fee': $string = '-'; break;
            case 'incoming_anticipation_of_receivable': $string = 'Entrada de Antecipação de Recebível'; break;
            case 'incoming_anticipation_of_receivable_settlement': $string = 'Liquidação de antecipação de recebíveis de cartão de crédito'; break;
            case 'incoming_anticipation_of_receivable_reversal': $string = 'Estorno de Entrada de Antecipação de Recebível'; break;
            case 'incoming_liquidation_cycle_receivable': $string = 'Entrada do Ciclo Liquidação de Recebíveis'; break;
            case 'incoming_liquidation_cycle_receivable_reversal': $string = 'Estorno de Entrada do Ciclo Liquidação de Recebíveis'; break;
            case 'incoming_credit_card_settlement': $string = 'Liquidação de cartão de crédito'; break;
            case 'incoming_debit_card_settlement': $string = 'Liquidação de cartão de débito'; break;
            case 'bank_slip_agreement_letter_fee': $string = 'Tarifa de Emissão de Carta de Anuência'; break;
            case 'bank_slip_payment_withdrawal_reversal': $string = 'Estorno de Pagamento de Boleto'; break;
            case 'deposit_percentage_fee': $string = 'Tarifa de Manutenção - Percentual de Depósito'; break;
            case 'deposit_percentage_fee_reversal': $string = 'Estorno de Tarifa de Manutenção - Percentual de Depósito'; break;
            case 'account_setup_fee': $string = 'Tarifa de Abertura de Conta'; break;
            case 'account_setup_fee_reversal': $string = 'Estorno de Tarifa de Abertura de Conta'; break;
            case 'cra_expense_reversal': $string = 'Estorno de tarifa paga à CRA'; break;
            case 'cra_expense': $string = 'Tarifa paga à CRA'; break;
            case 'warranty_analysis_fee_reversal': $string = 'Estorno de Tarifa Análise de Garantia'; break;
            case 'registry_fee': $string = 'Tarifa de Registro'; break;
            case 'registry_fee_reversal': $string = 'Estorno de Tarifa de Registro'; break;
            case 'card_purchase': $string = 'Compra com Cartão'; break;
            case 'card_purchase_reversal': $string = 'Estorno de Compra com Cartão'; break;
            case 'card_withdrawal': $string = 'Saque com Cartão'; break;
            case 'card_withdrawal_reversal': $string = 'Estorno de Saque com Cartão'; break;
            case 'card_transfer': $string = 'Transferência com Cartão'; break;
            case 'card_transfer_reversal': $string = 'Estorno de Transferência com Cartão'; break;
            case 'card_chargeback': $string = 'Estorno de Transação com Cartão'; break;
            case 'card_chargeback_reversal': $string = 'Cancelamento de Estorno de Transação com Cartão'; break;
            case 'portability_settlement': $string = 'Liquidação de Portabilidade'; break;
            case 'outgoing_portability_settlement': $string = 'Saída Liquidação de Portabilidade'; break;
            case 'assignment_automatic_transfer': $string = 'Débito de Cessão Automática'; break;
            case 'assignment_automatic_transfer_reversal': $string = 'Estorno de Débito de Cessão Automática'; break;
            case 'pix_fee': $string = 'Tarifa de PIX'; break;
            case 'incoming_pix_transfer': $string = 'Entrada de PIX'; break;
            case 'outgoing_pix_transfer': $string = 'Saída de PIX'; break;
            case 'pix_fee_reversal': $string = 'Estorno de Tarifa de PIX'; break;
            case 'incoming_pix_transfer_reversal': $string = 'Estorno de entrada de PIX'; break;
            case 'outgoing_pix_transfer_reversal': $string = 'Estorno de saída de PIX'; break;
            case 'pix_deposit': $string = 'Depósito de PIX'; break;
            case 'pix_withdrawal': $string = 'Transferência de PIX'; break;
            case 'pix_withdrawal_reversal': $string = 'Estorno de transferência de PIX'; break;
            case 'pix_chargeback_withdrawal': $string = 'Envio de devolução PIX'; break;
            case 'outgoing_pix_chargeback': $string = 'Saída de PIX por devolução'; break;
            case 'incoming_pix_chargeback': $string = 'Recebimento de devolução PIX'; break;
            case 'pix_chargeback_deposit': $string = 'Entrada de PIX por devolução'; break;
            case 'pix_chargeback_withdrawal_reversal': $string = 'Estorno de envio de devolução PIX'; break;
            case 'outgoing_pix_chargeback_reversal': $string = 'Estorno de saída de PIX por devolução'; break;
            case 'incoming_pix_chargeback_reversal': $string = 'Estorno de recebimento de devolução PIX'; break;
            case 'automatic_integrated_payment_reversal': $string = 'Estorno de Pagamento Automático Integrado'; break;
            case 'portability_settlement_reversal': $string = 'Estorno de Liquidação de Portabilidade'; break;
            case 'operation_pix_disbursement': $string = 'Desembolso PIX da Operação'; break;
            case 'operation_pix_disbursement_reversal': $string = 'Estorno de Desembolso PIX da Operação'; break;
            case 'receivables_inquiry_fee': $string = 'Tarifa de Consulta de Agenda de Recebíveis'; break;
            case 'pix_deposit_reversal': $string = 'Estorno de Depósito de PIX'; break;
            case 'internal_pix_transfer': $string = 'Transferência de PIX'; break;
            case 'assignment_reversal': $string = 'Estorno de Cessão'; break;
            case 'credit_operation_fee_spread': $string = 'Tarifa de Abertura de Crédito (Via Spread)'; break;
            case 'credit_operation_fee_spread_reversal': $string = 'Estorno de Tarifa de Abertura de Crédito (Via Spread)'; break;
            case 'electronic_funds_fee_spread': $string = 'Tarifa de TED (Via Spread)'; break;
            case 'electronic_funds_fee_spread_reversal': $string = 'Estorno de Tarifa de TED (Via Spread)'; break;
            case 'rebate_tax_free_spread': $string = 'Repasse por Conta e Ordem (Via Spread)'; break;
            case 'rebate_tax_free_spread_reversal': $string = 'Estorno de Repasse por Conta e Ordem (Via Spread)'; break;
            case 'birthday_withdraw_fgts_cef_settlement': $string = 'Pagamento CEF - Saque Aniversário FGTS'; break;
            case 'birthday_withdraw_fgts_automatic_payment': $string = 'Pagamento Automático de parcela do Saque Aniversário FGTS'; break;
            case 'birthday_withdraw_fgts_cef_fee': $string = 'Taxa de Serviço CEF - Saque Aniversário FGTS'; break;
            case 'birthday_withdraw_fgts_cef_settlement_reversal': $string = 'Devolução de Pagamento CEF - Saque Aniversário FGTS'; break;
            case 'birthday_withdraw_fgts_automatic_payment_reversal': $string = 'Estorno de Pagamento Automático de parcela do Saque Aniversário FGTS'; break;
            case 'birthday_withdraw_fgts_cef_fee_reversal': $string = 'Devolução de Taxa de Serviço CEF - Saque Aniversário FGTS'; break;
            case 'monthly_minimal': $string = 'Mínimo Mensal Contratual de Bancarização'; break;
            case 'pix_chargeback_deposit_reversal': $string = 'Estorno de Entrada de PIX por devolução'; break;
            case 'bank_slip_covenant_payment': $string = 'Pagamento de Boleto de Convênio'; break;
            case 'bank_slip_covenant_payment_reversal': $string = 'Estorno de Pagamento de Boleto de Convênio'; break;
            case 'repo_bond': $string = 'Rendimento de Titulo Definitivo'; break;
            case 'birthday_withdraw_fgts_extraordinary_transfer': $string = 'Repasse FGTS Extraordinário'; break;
            case 'incoming_portability_settlement': $string = 'Entrada de liquidação de portabilidade'; break;
            case 'pi_profit': $string = 'Rendimento de Saldo Conta PI'; break;
            case 'investment_deposit': $string = 'Depósito de Investimento'; break;
            case 'gross_yield': $string = 'Rendimento Bruto'; break;
            case 'investment_withdraw': $string = 'Retirada de Investimento'; break;
            case 'investment_iof_payment': $string = 'Pagamento de IOF de investimento'; break;
            case 'investment_ir_payment': $string = 'Pagamento de IR de investimento'; break;
            case 'automatic_funds_routing': $string = 'Roteamento Automático de Recursos'; break;
            case 'incoming_c3_assignment_settlement': $string = 'Cessão por liquidação via C3'; break;
            case 'c3_assignment_settlement': $string = 'Transferência de liquidação via C3'; break;
            case 'available_yield': $string = 'Depósito de Investimento Liquido'; break;
            default:
                $string = "Não encontrado: {$string}";
        }

        return $string;
    }

    protected static function qiGetReasons($reasons_array)
    {
        $error = '';
        foreach($reasons_array as $reason):
            $error .= " {$reason['description']}";
        endforeach;
        return $error;
    }

}