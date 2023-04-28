<?php 

namespace QuataInvestimentos;
date_default_timezone_set('America/Sao_Paulo');

trait QtsIndexer 
{

    public static function getCDI($date = null) {
        if(!$date){ $date = date('Y-m-d'); }

        $date = date('Ymd', strtotime($date));

        try {
            $taxa = file_get_contents("ftp://ftp.cetip.com.br/MediaCDI/$date.txt");
        } catch (\Exception $e) {
            return (object)[
                'status' => 422,
                'data' => $e->getMessage()
            ];
        }
 
        $taxa = str_replace(' ', '', (string)$taxa);
        $taxa = str_replace('\n', '', (string)$taxa);
        if(ctype_digit($taxa)){
            return (object)[
                'status' => 422,
                'data' => $taxa.' (API Cetip retornou valor inesperado)'
            ];
        }
        $taxa = floatval($taxa);
        $dailyCdi = round( ((( pow((($taxa / 10000) + 1), (1 / 252))) - 1) * 100), 8);
        $monthlyCdi = round( ((( pow((($taxa / 10000) + 1), (1 / 12))) - 1) * 100), 8);
        $taxa = (float)number_format($taxa/100,2);
        return (object)[
            'status' => 200,
            'data' => ['taxa' => $taxa, 'daily' => $dailyCdi, 'monthy' => $monthlyCdi]
        ];
    }

}