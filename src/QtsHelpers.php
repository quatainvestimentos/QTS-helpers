<?php 

namespace QuataInvestimentos;

trait QtsHelpers 
{

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
                

            /** Status */
            case 'RECEIVED':
                $string = 'Recebido';
                $badge = 'success';
                break;

            case 'PENDING':
                $string = 'Pendente';
                $badge = 'warning';
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

            /** Bancos */
            case 'BRADESCO':
                $string = 'Bradesco';
                $badge = 'primary';
                break;

            case 'QI_TECH':
                $string = 'Qi Tech';
                $badge = 'primary';
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
                'filename' => Qts::cleanUpString($remittance->getClientOriginalName()),
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
                            'filename' => Qts::cleanUpString($remittance['filename']),
                            'base64' => $remittance['base64'],
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

}