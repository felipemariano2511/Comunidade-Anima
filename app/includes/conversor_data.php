<?php

    $data_inicial = explode("-", $tableData['data_inicial']);
    $data_final = explode("-", $tableData['data_final']);

    $ano = $data_inicial[0];
    $mes = $data_inicial[1];
    $dia = $data_inicial[2];

    for($i = 0; $i < 2; $i++){
        switch ($mes){
            case '01':
                $mes_formatado = 'Jan';
                break;

            case '02':
                $mes_formatado = 'Fev';
                break;

            case '03':
                $mes_formatado = 'Mar';
                break;
             
            case '04':
                $mes_formatado = 'Abr';
                break;

            case '05':
                $mes_formatado = 'Mai';
                break;
            
            case '06':
                $mes_formatado = 'Jun';
                break;

            case '07':
                $mes_formatado = 'Jul';
                break;

            case '08':
                $mes_formatado = 'Aug';
                break;

            case '09':
                $mes_formatado = 'Set';
                break;

            case '10':
                $mes_formatado = 'Out';
                break;

            case '11':
                $mes_formatado = 'Nov';
                break;

            case '12':
                $mes_formatado = 'Dez';
                break;
        }
        if($i == 0){
            $data_inicial_formatada = $dia.'/'.$mes_formatado.'/'.$ano;

            $dia_inicial = $dia;
            $mes_inicial = $mes_formatado;
            $ano = $data_final[0];
            $mes = $data_final[1];
            $dia = $data_final[2];
        }else{
            $data_final_formatada = $dia.'/'.$mes_formatado.'/'.$ano;
            if($mes_inicial != $mes_formatado){
                $meses_formatados = $dia_inicial.'/'.$mes_inicial.' até '.$dia.'/'.$mes_formatado.' de '.$ano;
            }else{
                $meses_formatados = NULL;
            }
        }
    }

?>