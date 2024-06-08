<?php

$query = "SELECT * FROM eventos WHERE situacao = 'ativo' ORDER BY data_final ASC";
$result = mysqli_query($con, $query);

if ($result) {
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    $data_atual = date('Y-m-d');
    $horario_atual = date('H:i:s'); 

    foreach ($data as $evento) {
        if ($evento['data_final'] <= $data_atual) {
            if ($evento['horario_final'] <= $horario_atual) {
                $query = "UPDATE eventos 
                          SET situacao = 'arquivado', justificativa = 'O evento foi arquivado, pois a data final do evento expirou!' 
                          WHERE id = " . $evento['id'];
                mysqli_query($con, $query);
            }
        }
    }
}
?>
