<?php 

require('../lib/etp.php'); 

$etp = new ETP; 

$list = $etp->getCompanyList();
print_r($list); 
print_r($list->company[1]->date_accept->attributes()); 