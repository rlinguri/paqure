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
 * TestView
 */
class TstVue extends Vue
{

    /**
     * just printing a var dump of the app object for testing
     */
    public function __construct()
    {

        $this->setXml('<pre>'.print_r(AppObj::obj(),true).'</pre>'.N);

    }
}

/**
 * Body View
 */
class BdyVue extends Vue
{

    public function __construct()
    {
        $this->tag = 'body';
        $this->atr = ['role'=>'document'];
        $this->cnt = [new TstVue()];
        $this->scl = 0;
    }

}

/**
 * Head View
 */
class HedVue extends Vue
{

    public function __construct()
    {
        $this->tag = 'head';
        $this->scl = 0;
    }

}

/**
 * Html View
 */
class HtmVue extends Vue
{

    public function __construct()
    {

        $this->tag = 'html';
        $this->atr = ['lang'=>'en'];
        $this->cnt = [new HedVue(),new BdyVue()];
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