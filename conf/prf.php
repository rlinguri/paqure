<?php
/**
 * PaQuRe PREFERENCES
 * @package   paqure
 * @version   0.0.1
 * @author    Roderic Linguri
 * @copyright Copyright (c) 2015, Linguri Technology
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace paqure;

/**
 * Preference
 */
class Prf
{

    /**
     * Optional Include
     * @param file name
     * @param boolean
     */
    public static function opt($fil,$bln)
    {

        if($bln==true) {

            require_once(SITE_ROOT.S.'opt'.S.$fil.'.php');



        } // ./if

    } // ./construct

}
