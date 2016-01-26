<?php

$var = $_GET['var'];
$value = $_GET['value'];


if(!is_numeric($value))
	$value = 0;

exec("python py-bin/opc_put_values.py ".$var." ".$value." 2>&1", $output, $return_var);

?>
