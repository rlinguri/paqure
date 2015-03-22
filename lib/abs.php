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
 * Object
 */
abstract class Obj
{

    // global properties and methods

}

/**
 * Database
 */
abstract class Dbs extends Obj
{

    /* @property dbs singleton */
    protected static $dbs;

    /* @property \pdo connection handle */
    protected $pch;

    /* @property dbs message */
    protected $msg = [];

    /**
     * GETTER:  message
     * @return  array
     */
    public function msg()
    {

        return $this->msg;

    }

    /**
     * executeSQL
     * @param   str (sql query string)
     * @return  int (affected rows)
     */
    public function exeSQL($arg)
    {

        try {

            // prepare statement
            $sth = $this->pch->prepare($arg);

            // execute statement
            $sth->execute();

            // return affected rows
            return $sth->rowCount();

        } catch(\Exception $e) {

            $this->msg[] = get_called_class($this).' exeSQL() '.$e->getMessage();

            return 0;

        } // ./try-catch

    } // ./exeSQL()

    /**
     * insert Record
     * @param   str (sql query string)
     * @return  int (lastInsertId)
     */
    public function insRec($arg)
    {

        try {

            // prepare statement
            $sth = $this->pch->prepare($arg);

            // execute statement
            $sth->execute();

            // return last insert id
            return $this->pch->lastInsertId();

        } catch(\Exception $e) {

            $this->msg[] = get_called_class($this).' insRec() '.$e->getMessage();

            return false;

        } // ./try-catch

    } // ./insRec()

    /**
     * insert Record
     * @param   str (sql query string)
     * @return  int (lastInsertId)
     */
    public function ftcRec($arg)
    {

        try {

            // prepare statement
            $sth = $this->pch->prepare($arg);

            // execute statement
            $sth->execute();

            // return last insert id
            return $this->pch->fetch(PDO::FETCH_ASSOC);

        } catch(\Exception $e) {

            $this->msg[] = get_called_class($this).' ftcRec() '.$e->getMessage();

            return false;

        } // ./try-catch

    } // ./insRec()

} // ./Dbs

/**
 * Model
 */
abstract class Mdl extends Obj
{

    /* @property dbs imported singleton */
    protected $dbs;

    /* @property mdl table name */
    protected $tbl;

    /* @property mdl parent object identifier */
    protected $poi;


    /**
     * getter: parent object identifier
     * @param   void
     * @return  int parent object identifier
     */
    public function poi()
    {

        return $this->poi;

    } // ./getter: parent object identifier

} // ./Model

/**
 * View
 */
abstract class Vue extends Obj
{

    /* @property vue html tag string */
    protected $tag;

    /* @property vue attribute array */
    protected $atr;

    /* @property vue self-closing bool */
    protected $scl;

    /* @property vue content object */
    protected $cnt;

    /* @property vue xml string */
    protected $xml;


    /**
     * setter:  xml string
     * @param   str
     * @return  void
     */
    public function setXml($arg)
    {

        // set the xml property
        $this->xml = $arg;

        // void all other parameters
        $this->tag = null;
        $this->atr = null;
        $this->scl = null;
        $this->cnt = null;

    } // ./setter

    /**
     * SETTER:  document object model
     * @param   assoc
     * @return  void
     */
    public function setDOM($arg)
    {

        foreach ($arg as $key=>$val) {

            $this->$key = $val;

        }

    }

    /**
     * GETTER:  composed html
     * @param   void
     * @return  string html
     */
    public function htm()
    {

        if (is_string($this->xml)) {

            return $this->xml;

        } else {

            return $this->DOM();

        }

    } // ./GETTER: composed html

    /**
     * GETTER:  composed attributes
     * @param   void
     * @return  string html
     */
    protected function atr()
    {

        // initialize html string
        $htm = '';

        // iterate through array of attributes
        foreach($this->atr as $key=>$val) {

            $htm .= ' '.$key.'="'.$val.'"';

        }

        return $htm;

    } // ./GETTER: composed attributes

    /**
     * GETTER:  DOM element
     * @param   void
     * @return  string html
     */
    protected function DOM()
    {

        // initialize html string
        $htm = '';

        // open the tag
        if (isset($this->tag)) {

            // opening bracket
            $htm = '<'.$this->tag;

            // add attributes
            if (isset($this->atr)) {

                $htm .= $this->atr();

            }

            // close bracket
            $htm .= '>'.PHP_EOL;

        }

        if (isset($this->cnt)) {

            foreach($this->cnt as $subVue) {

                $htm .= $subVue->htm();

            }

        }

        if ($this->scl!=1) {

            $htm .= '</'.$this->tag.'>'.N;

        }

        return $htm;

    } // ./

} // ./View

/**
 * Controller
 */
abstract class Ctl extends Obj
{

    /* @property ctl object-set identifier */
    protected $osi;

    /* @property ctl object-set model */
    protected $mdl;

    /* @property ctl object-set view */
    protected $vue;


} // ./Controller

/**
 * ViewController
 */
abstract class VueCtl extends Ctl
{

    /* @property vue object array */
    protected $voa = [];


    /**
     * SETTER: view object array element
     * @param   vue object
     * @return  void
     */
    public function addVue($arg)
    {

        $this->voa[] = $arg;

    } // ./SETTER: view object array element

    /**
     * GETTER: composed html
     * @param   void
     * @return  string html
     */
    public function htm()
    {

        $htm = '';

        foreach ($this->voa as $vue) {

            $htm .= $vue->htm();

        } // ./foreach

        return $htm;

    } // ./GETTER: composed html

} // ./ViewController

