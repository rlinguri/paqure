<?php
/**
 * PaQuRe DEFINITIONS
 * @package   paqure
 * @version   0.0.1
 * @author    Roderic Linguri
 * @copyright Copyright (c) 2015, Linguri Technology
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace paqure;

/**
 * Define
 */
class Def
{

    public static function con($key,$val) {

        if(!defined($key)) {

            define($key, $val);

        }

    } // ./con()

} // ./Define

// slash or directory separator
Def::con('S',DIRECTORY_SEPARATOR);

// newline
Def::con('N',PHP_EOL);

// root directory of library
Def::con('PQR_LIB',substr(__FILE__,0,strlen(__FILE__)-13));


// now load in all the other includes
require_once(PQR_LIB.S.'conf'.S.'inc.php');

