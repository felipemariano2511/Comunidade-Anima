<?php

    $query = "SELECT * FROM eventos ORDER BY data_final ASC";
    $result = mysqli_query($con, $query);

    if ($result) {
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        $data_atual = date('Y-m-d');
        $horario_atual = date('H:i:s'); 

        foreach ($data as $evento) {
            if ($evento['data_final'] < $data_atual) {
                $id = $evento['id'];
                $query = "UPDATE eventos 
                        SET situacao = 'recusado', justificativa = 'O evento foi arquivado, pois a data final do evento expirou!'
                        WHERE id = '$id'";
                mysqli_query($con, $query);

            }elseif($evento['data_final'] == $data_atual){
                if ($evento['horario_final'] <= $horario_atual) {
                    $id = $evento['id'];
                    $query = "UPDATE eventos 
                            SET situacao = 'recusado', justificativa = 'O evento foi arquivado, pois a data final do evento expirou!'
                            WHERE id = '$id'";
                    mysqli_query($con, $query);
                }
            }
        }
    }
?>
