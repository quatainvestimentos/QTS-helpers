<?php 

namespace QuataInvestimentos;

class QTS 
{

    public static function translateEnums(String $string, Bool $get_badge=false)
    {

        switch(strtoupper($string)){
            /** Fileserver */
            case 'VAN':
                $string = 'Van Bancária';
                $badge = 'warning';
                break;

            case 'JSON_API':
                $string = 'Via API em JSON';
                $badge = 'warning';
                break;

            case 'ACCESS_STAGE':
                $string = 'AccessStage';
                $badge = 'danger';
                break;

            /** Status */
            case 'RECEIVED':
                $string = 'Recebido';
                $badge = 'success';
                break;

            /** Default */
            default:
                $string = 'Não encontrado: ' . $string;
                $badge = 'info';
        }

        if($get_badge){ return $badge; }
        return $string;

    }

    public static function date(String $datetime, String $format='d/m/Y H:i')
    {

        return date($format, strtotime($datetime));

    }

}