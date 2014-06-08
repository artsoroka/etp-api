etb-api
=======

API http://etp.gpb.ru  

```php

require('/path/to/etp/lib/etp.php');  

$etp = new ETP(); 

$company_list = $etp->getCompanyList(); 

$producers 	  = $etp->getProducers();  

```