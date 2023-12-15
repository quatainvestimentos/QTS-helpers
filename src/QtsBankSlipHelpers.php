<?php 

namespace QuataInvestimentos;
date_default_timezone_set('America/Sao_Paulo');

trait QtsBankSlipHelpers 
{

    public static function translateReceiptEnums(String $string, Bool $get_badge=false)
    {

        switch(strtoupper($string)){

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

            case 'ADMINISTRATIVE_EXPENSES':
                $string = 'Débito referente a despesas administrativas';
                $badge = 'primary';
                break;

            default:
                $string = 'Não encontrado: ' . $string;
                $badge = 'info';
        }

        if($get_badge){ return $badge; }
        return $string;

    }


    public static function translateProductEnums(String $string, Bool $get_badge=false)
    {

        switch(strtoupper($string)){
            case 'CCB':
                $string = 'CCB: Cédula de Crédito Bancário';
                $badge = 'primary';
                break;
            case 'CCE':
                $string = 'CCE: Cédula de Crédito à Exportação';
                $badge = 'primary';
                break;
            case 'CCBI':
                $string = 'CCBI: Cédula de Crédito Bancário Habitacional';
                $badge = 'primary';
                break;
            case 'DISCOUNT':
                $string = 'Desconto';
                $badge = 'primary';
                break;
            case 'NCE':
                $string = 'Nota de Crédito à Exportação';
                $badge = 'primary';
                break;
            case 'PROMISSORY_NOTE':
                $string = 'Nota Promissória';
                $badge = 'primary';
                break;
            case 'COMMERCIAL_NOTE':
                $string = 'Nota Comercial';
                $badge = 'primary';
                break;
            case 'DRAWN_RISK':
                $string = 'Risco Sacado';
                $badge = 'primary';
                break;
            case 'CDI_PLUS':
                $string = 'CDI+';
                $badge = 'primary';
                break;
            case 'PRE':
                $string = 'Pré';
                $badge = 'primary';
                break;

            default:
                $string = 'Não encontrado: ' . $string;
                $badge = 'info';
        }

        if($get_badge){ return $badge; }
        return $string;

    }
    

}