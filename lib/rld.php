<?php
/**
 * PaQuRe RELATIONSHIP OF LAYOUT TO DOM ELEMENT
 * @package   paqure
 * @version   0.0.1
 * @author    Roderic Linguri
 * @copyright Copyright (c) 2015, Linguri Technology
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace paqure;

/**
 * Class Rel-Lyt-Dom Object
 */
class RldObj extends Obj
{

    protected $oid;
    protected $lyt;
    protected $par;
    protected $chi;

    /**
     * new Rel-Lyt-Dom Object
     */
    public function __construct()
    {


    } // ./constructor

} // ./Rel-Lyt-Dom Object


/**
 * Class Rel-Lyt-Dom Model
 */
class RldMdl extends Mdl
{

    /**
     * @param $lyt
     * @param $par
     * @param $chi
     * @param $typ
     */
    public static function addRec($lyt,$par,$chi)
    {
        $dbs = AppDbs::dbs();

        $sql = 'INSERT INTO rld (oid,lyt,par,chi) VALUES (NULL';

        $sql .= ', '.$lyt;

        $sql .= ', '.$par;

        $sql .= ', '.$chi;

        $sql .= ');';

        echo $sql.N;

        // insRec returns lastInsertId
        return $dbs->insRec($sql);

    }

    public static function lytStr($lyt,$par)
    {

        $arr = [];

        $dbs = AppDbs::dbs();

        $sql = 'SELECT * FROM rld WHERE lyt = '.$lyt.' AND par = '.$par.';';

        if ($res = $dbs->ftcArr($sql)) {

            foreach ($res as $rec) {


                if ($chi = RldMdl::lytStr($lyt,$rec['chi'])) {

                    // shuffle the child into the parent position
                    $rec['par'] = $rec['chi'];

                    // put the new child into the child position
                    $rec['chi'] = $chi;

                } else {

                $rec['par'] = $rec['chi'];

                $rec['chi'] = null;

                }

                // add it back to the array with any content
                $arr[] = $rec;

            }

        }

        return $arr;
    }

    public static function recFromLP($lyt,$par)
    {

        $dbs = AppDbs::dbs();

        $sql = 'SELECT * FROM rld WHERE lyt = '.$lyt.' AND par = '.$par.';';

        if($res=$dbs->ftcArr($sql)) {

            return $res;

        } else {

            return false;
        }

    }

} // ./Rel-Lyt-Dom Model

class RldCtl extends Ctl
{

    /**
     * constructs a nested array of dom elements according to
     * @param $lyt
     * @param $par
     * @return array|bool
     */
    public function getDom($lyt,$par)
    {

        if (is_array(RldMdl::recFromLP($lyt,$par)))
        {

            foreach (RldMdl::recFromLP($lyt,$par) as $rec) {

                $elm = DomMdl::elmFromId($rec['chi']);

                if(isset($elm->cnt)) {

                    array_push($elm->cnt,$this->getDom($lyt,$rec['chi']));

                } else {

                    if ($cha = $this->getDom($lyt,$rec['chi'])) {

                        $elm->cnt = $cha;
                    }

                }

                $dea[] = $elm;

            }

            if (isset($dea)) {

                return $dea;

            } else {

                return false;
            }

        } else {

            return false;
        }

    }

} // ./Rel-Lyt-Dom Controller