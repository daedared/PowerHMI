<?php

exec("python py-bin/opc_get_values.py 2>&1", $output, $return_var);

$data = array();

$data['relay1_breaker'] = $output[0];
$data['relay1_load'] = $output[1];
$data['relay1_flow'] = $output[2];
$data['relay2_breaker'] = $output[3];
$data['relay2_load'] = $output[4];
$data['relay2_flow'] = $output[5];
$data['gen1_breaker'] = $output[6];
$data['gen1_generation'] = $output[7];
$data['gen2_breaker'] = $output[8];
$data['gen2_generation'] = $output[9];

header('Content-Type: application/json');
echo json_encode($data);
?>
