<?php

namespace QuataInvestimentos\Bank;

trait Common {

    public static function cleanUp($string)
    {

        /**
         * Remove all "Non Break" chars
         */

        $string = preg_replace('/\xc2\xa0/', '', $string);

        /**
         * Remove all "Non Ascii" and octal chars
         */

        $string = preg_replace('/[\x00-\x1F\x80-\xFF]/', ' ', $string);
        $string = preg_replace('/[\000-\031\200-\377]/', ' ', $string);
        
        /**
         * Remove all "Non pritable" chars
         */

        $string = preg_replace('/[[:^print:]]/', " ", $string);

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
        $string = str_replace(array("\\"), '.', $string);
        $string = str_replace('?',' ', $string);
        $string = str_replace('\/','--', $string);
        # Não podemos remover / porque o sdocumento (titulo)
        # pode conter barras
        # $string = str_replace('/',' ', $string);
        $string = str_replace(array("\n", "\r"), '', $string);
        $string = strtoupper($string);

        $string = trim($string);

        return $string;

    }

    public static function removeExtraSpaces($string)
    {

        return preg_replace('/\s+/', ' ',$string);

    }

    public static function centsToFloat($cents)
    {
        return (float)number_format(($cents/100), 2, '.', '');
    }

    public static function floatToCents($float)
    {
        return str_replace('.', '', sprintf('%.2f', $float));
    }

    public static function calculateSettlements($discharge_public_url)
    {

        $handle = fopen($discharge_public_url, "r");

        $total_settlements = 0;

        while (($line = fgets($handle)) !== false) {

            if($line[0] === '1'){

                $settlement = Common::centsToFloat((int)substr($line, 254, 12));
                $occurrence = substr($line, 108, 2);

                /**
                 * 06 - liquidação normal
                 * 15 - liquidação em cartório
                 * 17 - liquidação após baixa
                */
                
                switch($occurrence){
                    case '06':
                    case '15':
                    case '17':
                        $total_settlements += $settlement;
                        break;
                }

            }
        }

        return $total_settlements;

    }
    
}