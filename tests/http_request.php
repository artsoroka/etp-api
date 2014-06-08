<?php 

require('../lib/etp.php'); 

$etp = new ETP; 

$data = $etp->getProcedures(); 

print_r($data); 