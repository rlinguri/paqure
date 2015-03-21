<?php
/**
 * PaQuRe ABSTRACT CLASSES
 * @package   paqure
 * @version   0.0.1
 * @author    Roderic Linguri
 * @copyright Copyright (c) 2015, Linguri Technology
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace paqure;

/**
 * Include
 */
class Inc
{

    /**
     * Require Once
     */
    public static function req($pth,$dir) {

        $inc = $pth.S.$dir;

        foreach(scandir($inc) as $fil) {

            // omit hidden files
            if (substr($fil, 0, 1)!='.') {

                require_once($inc.S.$fil);

            }

        }

    } // ./inc()

}
// to load a file, place it in one of the directories required here

Inc::req(PQR_LIB,'conf');

Inc::req(PQR_LIB,'lib');

Inc::req(PQR_LIB,'app');

