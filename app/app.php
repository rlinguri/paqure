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

        // create a new record in app table to get an id
        $this->poi = $this->newRec();

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
    private function newRec()
    {

        $tim = intval(date('U'));

        // compose sql
        $sql = "INSERT INTO $this->tbl (oid,tim) VALUES (NULL,$tim)";

        // insRec returns lastInsertId
        return $this->dbs->insRec($sql);

    } // ./newRec()

} // ./Application Model

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

        // create model to handle database operations
        $this->mdl = new AppMdl();

        // test insertion
        echo $this->mdl->poi();

    } // ./construct

}

