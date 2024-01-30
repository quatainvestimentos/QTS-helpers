<?php

namespace QuataInvestimentos\Bank\Bradesco\Remittance;
use QuataInvestimentos\Bank\Bradesco\Remittance;
use QuataInvestimentos\Bank\Common;

trait Transaction4 {

    public function extractTransaction4From($line,$data,$pad=true)
    {

        switch(strtoupper($data)){
            case 'REGISTRO': $value = substr($line, 0, 1); break;
            case 'DESTINATARIO': $value = substr($line, 1, 100); break;
            case 'DOCUMENTO': $value = substr($line, 101, 14); break;
            case 'EMAIL': $value = substr($line, 115, 100); break;
            case 'COD_PAIS': $value = substr($line, 216, 2); break;
            case 'COD_AREA': $value = substr($line, 218, 2); break;
            case 'TELEFONE': $value = substr($line, 220, 8); break;
            case 'ENVIAR_SEGUNDA_VIA': $value = substr($line, 229, 1); break;
            case 'ENVIAR_ANTES_VENCIMENTO': $value = substr($line, 230, 1); break;
            case 'ENVIAR_DEPOIS_VENCIMENTO': $value = substr($line, 231, 1); break;
            case 'ENVIAR_AVISO_PROTESTO': $value = substr($line, 232, 1); break;
            case 'BRANCOS': $value = substr($line, 233, 162); break;
            case 'SEQUENCIAL': $value = substr($line, 395, 6); break;
            
            default: return 'Coluna não aceita no extract remessa data: '. $data;
        }

        if($pad){ return Remittance::padLine('TRANSACTION4', $data, $value); }
        return $value;

    }

    public static function extractAllFromTransaction4($line, $pad=true)
    {

        $type = 'TRANSACTION4';

        $registro = Remittance::extractFrom($type, $line, 'registro', $pad);
        $destinatario = Remittance::extractFrom($type, $line, 'destinatario', $pad);
        $documento = Remittance::extractFrom($type, $line, 'documento', $pad);
        $email = Remittance::extractFrom($type, $line, 'email', $pad);
        $cod_pais = Remittance::extractFrom($type, $line, 'cod_pais', $pad);
        $cod_area = Remittance::extractFrom($type, $line, 'cod_area', $pad);
        $telefone = Remittance::extractFrom($type, $line, 'telefone', $pad);
        $enviar_segunda_via = Remittance::extractFrom($type, $line, 'enviar_segunda_via', $pad);
        $enviar_antes_vencimento = Remittance::extractFrom($type, $line, 'enviar_antes_vencimento', $pad);
        $enviar_depois_vencimento = Remittance::extractFrom($type, $line, 'enviar_depois_vencimento', $pad);
        $enviar_aviso_protesto = Remittance::extractFrom($type, $line, 'enviar_aviso_protesto', $pad);
        $brancos = Remittance::extractFrom($type, $line, 'brancos', $pad);
        $sequencial = Remittance::extractFrom($type, $line, 'sequencial', $pad);

        return 
        $registro . 
        $destinatario . 
        $documento . 
        $email . 
        $cod_pais . 
        $cod_area . 
        $telefone . 
        $enviar_segunda_via . 
        $enviar_antes_vencimento . 
        $enviar_depois_vencimento . 
        $enviar_aviso_protesto . 
        $brancos . 
        $sequencial;

    }

    public function transaction4Help()
    {
        $data = [
            'CNAB' => 'BRADESCO',
            'TYPE' => 'TYPE4',
            'REGISTRO' => [ 
                'position_from' => '001',
                'position_to' => '001',
                'size' => '001',
                'content' => 'Fixo 6',
                'type' => 'Numérico',
            ],
            'DESTINATARIO' => [ 
                'position_from' => '002',
                'position_to' => '101',
                'size' => '100',
                'content' => 'Nome do Destinatário',
                'type' => 'Alfanumérico',
            ],
            'DOCUMENTO' => [ 
                'position_from' => '102',
                'position_to' => '115',
                'size' => '014',
                'content' => 'Número do Documento (CPF/CNPJ) do Destinatário',
                'type' => 'Numérico',
            ],
            'EMAIL' => [ 
                'position_from' => '116',
                'position_to' => '215',
                'size' => '100',
                'content' => 'E-mail do destinatário',
                'type' => 'Alfanumérico',
            ],
            'COD_PAIS' => [ 
                'position_from' => '216',
                'position_to' => '217',
                'size' => '002',
                'content' => '55',
                'type' => 'Numérico',
            ],
            'COD_AREA' => [ 
                'position_from' => '218',
                'position_to' => '219',
                'size' => '002',
                'content' => 'Código de área do telefone',
                'type' => 'Numérico',
            ],
            'TELEFONE' => [ 
                'position_from' => '220',
                'position_to' => '228',
                'size' => '009',
                'content' => 'Número de telefone do destinatário',
                'type' => 'Numérico',
            ],
            'ENVIAR_SEGUNDA_VIA' => [ 
                'position_from' => '229',
                'position_to' => '229',
                'size' => '001',
                'content' => '0 ou 1',
                'type' => 'Numérico',
            ],
            'ENVIAR_ANTES_VENCIMENTO' => [ 
                'position_from' => '230',
                'position_to' => '230',
                'size' => '001',
                'content' => '0 ou 1',
                'type' => 'Numérico',
            ],
            'ENVIAR_DEPOIS_VENCIMENTO' => [ 
                'position_from' => '231',
                'position_to' => '231',
                'size' => '001',
                'content' => '0 ou 1',
                'type' => 'Numérico',
            ],
            'ENVIAR_AVISO_PROTESTO' => [ 
                'position_from' => '232',
                'position_to' => '232',
                'size' => '001',
                'content' => '0 ou 1',
                'type' => 'Numérico',
            ],
            'BRANCOS' => [ 
                'position_from' => '233',
                'position_to' => '394',
                'size' => '162',
                'content' => 'Brancos',
                'type' => 'Alfanumérico',
            ],
            'SEQUENCIAL' => [ 
                'position_from' => '395',
                'position_to' => '400',
                'size' => '006',
                'content' => 'Número sequencial de registro',
                'type' => 'Numérico',
            ]
        ];

        return $data;
    }

    public function transaction4ReplaceOn($line,$data,$new_value)
    {

        switch(strtoupper($data)){
            case 'REGISTRO': return substr_replace($line, $new_value, 0, 1); break;
            case 'DESTINATARIO': return substr_replace($line, $new_value, 1, 100); break;
            case 'DOCUMENTO': return substr_replace($line, $new_value, 101, 14); break;
            case 'EMAIL': return substr_replace($line, $new_value, 115, 100); break;
            case 'COD_PAIS': return substr_replace($line, $new_value, 216, 2); break;
            case 'COD_AREA': return substr_replace($line, $new_value, 218, 2); break;
            case 'TELEFONE': return substr_replace($line, $new_value, 220, 8); break;
            case 'ENVIAR_SEGUNDA_VIA': return substr_replace($line, $new_value, 229, 1); break;
            case 'ENVIAR_ANTES_VENCIMENTO': return substr_replace($line, $new_value, 230, 1); break;
            case 'ENVIAR_DEPOIS_VENCIMENTO': return substr_replace($line, $new_value, 231, 1); break;
            case 'ENVIAR_AVISO_PROTESTO': return substr_replace($line, $new_value, 232, 1); break;
            case 'BRANCOS': return substr_replace($line, $new_value, 233, 162); break;
            case 'SEQUENCIAL': return substr_replace($line, $new_value, 395, 6); break;

            default: return 'Coluna não aceita no replace remessa data: ' . $data;
        }

    }

    public function transaction4PadLine($data,$value)
    {

        $value = Common::cleanUp($value);
        $value = Common::removeExtraSpaces($value);

        $pad_replace = ' ';

        switch(strtoupper($data)){
            case 'REGISTRO': return str_pad(substr($value, 0, 1), 1, '4', STR_PAD_LEFT); break;
            case 'DESTINATARIO': return str_pad(substr($value, 1, 100), 100, $pad_replace, STR_PAD_RIGHT); break;
            case 'DOCUMENTO': return str_pad(substr($value, 101, 14), 14, $pad_replace, STR_PAD_RIGHT); break;
            case 'EMAIL': return str_pad(substr($value, 115, 100), 100, $pad_replace, STR_PAD_RIGHT); break;
            case 'COD_PAIS': return str_pad(substr($value, 216, 2), 2, '55', STR_PAD_RIGHT); break;
            case 'COD_AREA': return str_pad(substr($value, 218, 2), 2, '0', STR_PAD_LEFT); break;
            case 'TELEFONE': return str_pad(substr($value, 220, 8), 8, '0', STR_PAD_LEFT); break;
            case 'ENVIAR_SEGUNDA_VIA': return str_pad(substr($value, 229, 1), 1, '0', STR_PAD_LEFT); break;
            case 'ENVIAR_ANTES_VENCIMENTO': return str_pad(substr($value, 230, 1), 1, '0', STR_PAD_LEFT); break;
            case 'ENVIAR_DEPOIS_VENCIMENTO': return str_pad(substr($value, 231, 1), 1, '0', STR_PAD_LEFT); break;
            case 'ENVIAR_AVISO_PROTESTO': return str_pad(substr($value, 232, 1), 1, '0', STR_PAD_LEFT); break;
            case 'BRANCOS': return str_pad(substr($value, 233, 162), 162, $pad_replace, STR_PAD_RIGHT); break;
            case 'SEQUENCIAL': return str_pad(substr($value, 395, 6), 6, '0', STR_PAD_LEFT); break;

            default: return 'Coluna não aceita no extract remessa data: ' . $data;
        }
    }

}