<?php 

namespace QuataInvestimentos;
date_default_timezone_set('America/Sao_Paulo');

trait QtsIndexer 
{

    public static function getCDI($date=null) {
        
        if(!$date){ $date = date('Ymd', strtotime('yesterday')); }
        $date = date('Ymd', strtotime($date));

        try {
            
            $cdi = file_get_contents("ftp://ftp.cetip.com.br/MediaCDI/20230623.txt");
        
        } catch (\Exception $e) {

            return (object)[
                'status' => 422,
                'data' => $e->getMessage()
            ];

        }

        $cdi = (int)$cdi;
        $daily = round( ((( pow((($cdi / 10000) + 1), (1 / 252))) - 1) * 100), 8);
        $monthly = round( ((( pow((($cdi / 10000) + 1), (1 / 12))) - 1) * 100), 8);

        return (object)[
            'status' => 200,
            'data' => (object)[
                'cdi' => (float)number_format($cdi/100,2), 
                'daily' => $daily, 
                'monthy' => $monthly
            ]
        ];
        
    }

}