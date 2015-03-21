# PaQuRe #

_PHP Web Application Framework_

PaQuRe is a framework for web application development and deployment on LAMP servers supporting PHP 5.4 or later.

This project is in initial development. Please contact if you would like to contribute or help improve the code.

### SETUP INSTRUCTIONS ###

The framework uses the namespace **paqure**. To implement, include **./conf/def.php**.

###### EXAMPLE ######
```php
use paqure\AppCtl;

 require_once('/<#path#>/<#to#>/<#includes#>/paqure/conf/def.php');

 $app = new AppCtl();
```

The framework will automatically include any files you place in the **'app'** folder.