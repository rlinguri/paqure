<?php
/**
 * PaQuRe HTML VIEW CLASSES
 * @package   paqure
 * @version   0.0.1
 * @author    Roderic Linguri
 * @copyright Copyright (c) 2015, Linguri Technology
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace paqure;

/**
 * Html View
 */
class HtmVue extends Vue
{

    public function __construct()
    {
        $this->tag = 'html';
        $this->atr = ['lang'=>'en'];
        $this->scl = 0;
    }

}

/**
 * Doctype View
 */
class DctVue extends Vue
{

    public function __construct()
    {

        $this->setXml('<!DOCTYPE html>'.N);

    }
}