<?php 

$lib_path = __DIR__ . '/../lib/etp.php'; 

require($lib_path);  

$etp = new ETP; 

$list = $etp->getCompanyList();
print_r($list); 
print_r($list->company[1]->date_accept->attributes()); 