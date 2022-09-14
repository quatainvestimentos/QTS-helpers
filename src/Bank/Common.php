<?php

namespace QuataInvestimentos\Bank;

trait Common {

    public static function cleanUp($string)
    {

        /**
         * Remove all "Non Break" chars
         */

        $string = preg_replace('/\xc2\xa0/', '', $string);
        $string = preg_replace('/[[:^print:]]/', '', $string);

        /**
         * Translate and sanitize string
         */

        try {

            $string = iconv(mb_detect_encoding($string), 'ISO-8859-1//TRANSLIT', $string);

        } catch(\Exception $e){

            $string = utf8_encode($string);

            // echo $e->getMessage() . PHP_EOL . 
            // 'Encoding atual: ' . mb_detect_encoding($string) . 
            // 'Erro para detectar o encoding da string: ' . $string;
            
            // exit;

        }
        
        $string = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/","/(ç)/","/(Ç)/"),explode(" ","a A e E i I o O u U n N c C"),$string);
        $string = preg_replace("/[^A-Za-z0-9 ]-/", ' ', $string);
        $string = str_replace('\\', '.', $string);
        $string = str_replace('/', '.', $string);
        $string = str_replace('?',' ', $string);
        $string = strtoupper($string);
        $string = str_replace(array("\n", "\r"), '', $string);
        $string = trim($string);

        return $string;

    }

    public static function removeExtraSpaces($string)
    {

        return preg_replace('/\s+/', ' ',$string);

    }
    
}