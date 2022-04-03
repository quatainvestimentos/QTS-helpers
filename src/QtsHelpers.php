<?php 

namespace QuataInvestimentos;

class QtsHelpers 
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

            case 'QTS':
                $string = 'QTS';
                $badge = 'primary';
                break;

            case 'CNAB':
                $string = 'Arquivo CNAB';
                $badge = 'primary';
                break;

            /** Status */
            case 'RECEIVED':
                $string = 'Recebido';
                $badge = 'success';
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

    public static function cleanSpecialChars($string) {
  
        $string = str_replace( array( '\'', '"', ',' , ';', '<', '>' ), '', $string);
        $string = trim($string);

        return $string;
    }

    public static function convertToBase64($request, $input_name)
    {

        if( !$request->hasFile($input_name) ){ return []; }

        $converted = [];            
        foreach($request->file($input_name) as $remittance):

            $converted[] = (object)[
                'filename' => date('His-') . $remittance->getClientOriginalName(),
                'base64' => base64_encode(file_get_contents($remittance))
            ];

        endforeach;

        return $converted;

    }

    public static function extractBase64($request, $input_name)
    {

        if(!$request->has($input_name)){ return []; }

        $converted = [];

        foreach($request->all() as $key => $value):
            if($key === $input_name):

                foreach($value as $remittance):

                    if(isset($remittance['filename']) && isset($remittance['base64'])){
        
                        $converted[] = (object)[
                            'filename' => date('His-') . $remittance['filename'],
                            'base64' => $remittance['base64'],
                        ];     
        
                    }
        
                endforeach;

            endif;
        endforeach;

        return $converted;
        
    }

}