<?php
/**
 * PaQuRe APPLICATION CLASS-SET
 * @package   paqure
 * @version   0.0.1
 * @author    Roderic Linguri
 * @copyright Copyright (c) 2015, Linguri Technology
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace paqure;

/**
 * Application Object
 */
class AppObj extends Obj
{

    private static $obj;

    protected $oid;
    protected $tim;

    public $prs;
    public $qry;
    public $rpl;

    /**
     * Initialize Object
     * @param $oid
     * @param $tim
     */
    public function ini($arg)
    {

        $this->oid = $arg[0];
        $this->tim = $arg[1];

    }

    /**
     * GETTER:  app object singleton
     * @return  object
     */
    public static function obj()
    {
        if (!isset(self::$obj)) {

            self::$obj = new self();
        }

        return self::$obj;

    } //

    /**
     * GETTER:  object-set id
     * @return  int
     */
    public function oid()
    {

        return $this->oid;

    } // ./GETTER: object id

    /**
     * GETTER:  time
     * @return  int (UTC time)
     */
    public function tim()
    {

        return $this->tim;

    } // ./GETTER: time

} // ./Application Object

/**
 * Application Database
 */
class AppDbs extends Dbs
{

    /* @property dbs singleton */
    // protected static $dbs;

    /* @property \pdo connection handle */
    // protected $pch;

    /* @property dbs message */
    // protected $msg = [];

    /**
     * construct new Application Database
     */
    public function __construct()
    {

        $this->pch = new \PDO('sqlite:'.PQR_LIB.'/db/app.db');

    } // ./constructor

    /**
     * GETTER:  database singleton
     * @return  object
     */
    public static function dbs()
    {
        if (!isset(self::$dbs)) {

            self::$dbs = new self();
        }

        return self::$dbs;
    } // ,

} // ./AppDbs

/**
 * Application Model
 */
class AppMdl extends Mdl
{

    /* @property dbs imported singleton */
    // protected $dbs;

    /* @property mdl table name */
    // protected $tbl;

    /* @property mdl parent object identifier */
    // protected $poi;

    /**
     * construct new Application Model
     */
    public function __construct()
    {

        // import database singleton
        $this->dbs = AppDbs::dbs();

        // could be set dynamically
        $this->tbl = 'app';

    } // ./construct


    /**
     * GETTER:  parent object identifier
     * @return int object id
     */
    public function poi()
    {

        return $this->poi;

    } // ./GETTER: object id

    /**
     * new Record
     * @return int object id
     */
    public function newRec()
    {

        // set the time
        $tim = intval(date('U'));

        // compose sql
        $sql = 'INSERT INTO '.$this->tbl.' (oid,tim) VALUES (NULL,'.$tim.')';

        // set the parent object identifier to lastInsertId
        $this->poi = $this->dbs->insRec($sql);

        // provide the controller with the data needed to initialize the App Object
        return [$this->poi,$tim];

    } // ./newRec()

} // ./Application Model

/**
 * Application View
 */
class AppVueCtl extends VueCtl
{

    /* @property vue object array */
    // protected $voa = [];

    /**
     * construct Application View
     */
    public function __construct()
    {

        $lyt = new LytCtl();

        foreach($lyt->getDOM(1,0) as $vue) {

           // output the html
           echo $vue->htm();

        }

    }

}

/**
 * Application Controller
 */
class AppCtl extends Ctl
{

    /* @property ctl object-set identifier */
    // protected $osi;

    /* @property ctl object-set model */
    // protected $mdl;

    /* @property ctl object-set view */
    // protected $vue;

    /**
     * construct new Application Controller
     */
    public function __construct()
    {

        date_default_timezone_set(TIME_ZONE);

        // the model will create a new record in the app database and spawn an App Object Singleton
        $this->mdl = new AppMdl();

        $obj = AppObj::obj();

        $obj->ini($this->mdl->newRec());

        // @todo Parse and Cue for Query or Reply

        // call a view controller
        $this->vue = new AppVueCtl();

    } // ./construct

}

