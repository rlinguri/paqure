# PaQuRe #

_PHP Web Application Framework_

PaQuRe is a framework for web application development and deployment on LAMP servers supporting PHP 5.4 or later.

This project is in initial development. Please contact if you would like to contribute or help improve the code.

### SETUP INSTRUCTIONS ###

Define the time zone constant in **./app/cfg.php**. You can also set preferences to load optional classes, which can be stored in the **./opt** directory. You can include any external libraries or custom classes you create by adding the following command to the **cfg.php** file:

```php
Inc::req('path/to/parent/','directory_name');
```
__Note that your path will need to be split up into the parent directory and the directory that you wish to scan.__ The framework will automatically include any files you place in the **'./app'** folder.
---

The framework uses the namespace **paqure**. To implement, include **./conf/def.php**.

###### EXAMPLE ######
```php
use paqure\AppCtl;

 require_once('/<#path#>/<#to#>/<#includes#>/paqure/conf/def.php');

 $app = new AppCtl();
```

---
### PRODUCTION NOTES ###

This is my first PHP project utilizing namespaces and as such I am exploring the implementation of class, property and function names with a three-letter naming convention. As I am fairly old-school, I have missed the 1970's convention of tiny variable names and attempting to see if that standard can be revived with the implementation of namespaces. It's the way I started, and when I'm roughing out code, it's the way I work. Though I comment my code extensively to explain what the abbreviations stand for, I still usually have to go in and expand the names to make my code readable to youngsters. Sorry I'm old. I welcome your comments.
