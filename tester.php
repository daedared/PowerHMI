<?php
exec("python opc_get_values.py 2>&1", $output, $return_var);

echo $output[2];
//foreach($output as $val){
//	echo $val;
//	echo "\n";
//}

?>
