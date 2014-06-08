<?php 

$lib_path = __DIR__ . '/../lib/etp.php'; 

require($lib_path);  

$etp = new ETP; 

$data = $etp->getProcedures(); 

print_r($data); 