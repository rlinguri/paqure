<?php
/**
 * PaQuRe LAYOUT CLASS-SET
 * @package   paqure
 * @version   0.0.1
 * @author    Roderic Linguri
 * @copyright Copyright (c) 2015, Linguri Technology
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace paqure;

/**
 * Class Layout Object
 */
class LytObj extends Obj
{

    public $oid;

    public $nam;

    public $str;

} // ./Layout Object


/**
 * Class Layout Model
 */
class LytMdl extends Mdl
{

    /* @property dbs imported singleton */
    // protected $dbs;

    /* @property mdl table name */
    // protected $tbl;

    /* @property mdl parent object identifier */
    // protected $poi;


    /**
     * new Layout Model
     */
    public function __construct()
    {
        $this->dbs = AppDbs::dbs();

        $this->tbl = 'lyt';

    } // ./constructor

    public function addLyt($nam,$arr)
    {

        $str = Enc::enc($arr);

        $sql = 'INSERT INTO '.$this->tbl.' (oid,nam,str) VALUES (NULL,"'.$nam.'","'.$str.'");';

        echo $sql;

        // $this->dbs->insRec($sql);

    }

    public function recFromId($oid)
    {

        $sql = 'SELECT * FROM lyt WHERE oid = '.$oid.';';

        return $this->dbs->ftcRec($sql);

    }

} // ./Layout Model


/**
 * Layout Controller
 */
class LytCtl extends Ctl
{

    /**
     * @param int (layout number)
     * @param int (the parent - use 0 to get full structure)
     * @return array|bool
     */
    public function getDOM($lyt,$par)
    {

        // rld refers to Relationship of Lyt to Dom
        $rld = new RldCtl();

        // nested view objects
        return $rld->getDom($lyt,$par);

    }

} // ./Layout Controller

