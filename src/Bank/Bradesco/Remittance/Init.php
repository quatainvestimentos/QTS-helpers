<?php

namespace QuataInvestimentos\Bank\Bradesco\Remittance;

trait Init {

    public static function extractFrom($type='HEADER',$line,$data,$pad=true)
    {

        switch(strtoupper($type)){
            case 'HEADER': return Header::extractHeaderFrom($line,$data,$pad); break;
            case 'TRANSACTION1': return Transaction1::extractTransaction1From($line,$data,$pad); break;
            case 'TRANSACTION2': return Transaction2::extractTransaction2From($line,$data,$pad); break;
            case 'TRANSACTION3': return Transaction3::extractTransaction3From($line,$data,$pad); break;
            case 'TRANSACTION6': return Transaction6::extractTransaction6From($line,$data,$pad); break;
            case 'TRANSACTION7': return Transaction7::extractTransaction7From($line,$data,$pad); break;
            case 'FOOTER': return Footer::extractFooterFrom($line,$data,$pad); break;
            default: return 'Tipo de linha/transação de CNAB inválido: ' . $type;
        }        

    }

    public static function help($type='HEADER')
    {

        switch(strtoupper($type)){
            case 'HEADER': return Header::headerHelp(); break;
            case 'TRANSACTION1': return Transaction1::transaction1Help(); break;
            case 'TRANSACTION2': return Transaction2::transaction2Help(); break;
            case 'TRANSACTION3': return Transaction3::transaction3Help(); break;
            case 'TRANSACTION6': return Transaction6::transaction6Help(); break;
            case 'TRANSACTION7': return Transaction7::transaction7Help(); break;
            case 'FOOTER': return Footer::footerHelp(); break;
            default: return 'Tipo de linha/transação de CNAB inválido: ' . $type;
        }
        
    }

    public static function replaceOn($type='HEADER',$line,$data,$new_value)
    {
        switch(strtoupper($type)){
            case 'HEADER': return Header::headerReplaceOn($line,$data,$new_value); break;
            case 'TRANSACTION1': return Transaction1::transaction1ReplaceOn($line,$data,$new_value); break;
            case 'TRANSACTION2': return Transaction2::transaction2ReplaceOn($line,$data,$new_value); break;
            case 'TRANSACTION3': return Transaction3::transaction3ReplaceOn($line,$data,$new_value); break;
            case 'TRANSACTION6': return Transaction6::transaction6ReplaceOn($line,$data,$new_value); break;
            case 'TRANSACTION7': return Transaction7::transaction7ReplaceOn($line,$data,$new_value); break;
            case 'FOOTER': return Footer::footerReplaceOn($line,$data,$new_value); break;
            default: return 'Tipo de linha/transação de CNAB inválido: ' . $type;
        }
        

    }

    public static function padLine($type='HEADER',$data,$value)
    {

        switch(strtoupper($type)){
            case 'HEADER': return Header::headerPadLine($data,$value); break;
            case 'TRANSACTION1': return Transaction1::transaction1PadLine($data,$value); break;
            case 'TRANSACTION2': return Transaction2::transaction2PadLine($data,$value); break;
            case 'TRANSACTION3': return Transaction3::transaction3PadLine($data,$value); break;
            case 'TRANSACTION6': return Transaction6::transaction6PadLine($data,$value); break;
            case 'TRANSACTION7': return Transaction7::transaction7PadLine($data,$value); break;
            case 'FOOTER': return Footer::footerPadLine($data,$value); break;
            default: return 'Tipo de linha/transação de CNAB inválido: ' . $type;
        }
        
    }
    
}