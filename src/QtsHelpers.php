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

            case 'FINNET':
                $string = 'Finnet';
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

            case 'PENDING':
                $string = 'Pendente';
                $badge = 'warning';
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
                'filename' => $remittance->getClientOriginalName(),
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
                            'filename' => $remittance['filename'],
                            'base64' => $remittance['base64'],
                        ];     
        
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
        return str_pad(QtsHelpers::mask($value,'+## (##) #####-####'), $pad, "0", STR_PAD_LEFT);
    }
    
    public static function translate_phone_mask($value,$pad=10){
        return str_pad(QtsHelpers::mask($value,'#####-####'), $pad, "0", STR_PAD_LEFT);
    }

    public static function mask_identification_type($type,$value){
        switch($type){
            case 'TAXPAYER_ID': return QtsHelpers::mask($value,'###.###.###-##'); break;
            case 'EIN': return QtsHelpers::mask($value,'##.###.###/####-##'); break;
            default: return 'Desconhecido: ' . $value;
        }
    }

    public static function translate_barcode($value){
        return QtsHelpers::mask($value,'#####.#####  #####.######  #####.######  #  ##############');
    }

    function translate_zipcode($value){
        if(strlen($value)===8){
            return QtsHelpers::mask($value,'#####-###');
        }

        return $value;
    }

}