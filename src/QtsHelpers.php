<?php 

namespace QuataInvestimentos;

trait QtsHelpers 
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
            case 0: return 'segunda feira'; break;
            case 1: return 'terça feira'; break;
            case 2: return 'quarta feira'; break;
            case 3: return 'quinta feira'; break;
            case 4: return 'sexta feira'; break;
            case 5: return 'sábado'; break;
            case 6: return 'domingo'; break;
            default: return 'desconhecido: ' . $int;
        }
    }

    public static function translate_crons($value){
        list($minute,$hour,$month_day,$month,$weekday) = explode(' ', $value);
        
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

        }

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
                $month = "somente no mês de " . QtsHelpers::translate_month($month);
            }

            if(strpos($month,'-') !== false ){
                list($from,$to) = explode('-', $month);
                $month = "de " . QtsHelpers::translate_month($from) . " a " . QtsHelpers::translate_month($to);
            }

        }

        if($weekday === '*'){

            $weekday = 'e em todos os dias da semana';

        } else {

            if(strpos($weekday,'*/') !== false ){
                list($every,$weekday) = explode('/', $weekday);
                $weekday = "somente de " . QtsHelpers::translate_weekday($weekday);
            }

            if(strpos($weekday,'-') !== false ){
                list($from,$to) = explode('-', $weekday);
                $weekday = "no intervalo de " . QtsHelpers::translate_weekday($from) . " a " . QtsHelpers::translate_weekday($to);
            }

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

}