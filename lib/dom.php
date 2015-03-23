<?php
/**
 * PaQuRe CLASS-SET TEMPLATE
 * @package   paqure
 * @version   0.0.1
 * @author    Roderic Linguri
 * @copyright Copyright (c) 2015, Linguri Technology
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace paqure;

/**
 * Class DOM Object
 */
class DomObj extends Vue
{

    protected $oid;

    /**
     * new DOM Object
     */
    public function __construct()
    {


    } // ./constructor

    public function setAll($arr)
    {

        foreach($arr as $key=>$val) {

            $this->$key = $val;

        }

    }

    public function cnt()
    {
        return $this->cnt;
    }

    public function setCnt($arr)
    {
        $this->cnt = $arr;
    }

} // ./DOM Object


/**
 * Class DOM Model
 */
class DomMdl extends Mdl
{

    /* @property dbs imported singleton */
    // protected $dbs;

    /* @property mdl table name */
    // protected $tbl;

    /* @property mdl parent object identifier */
    // protected $poi;


    public static function addElm($typ,$tag,$atr,$scl,$cnt,$xml)
    {

        $sql = 'INSERT INTO dom (oid,typ,tag,atr,scl,cnt,xml) VALUES (NULL,';

        if ($typ==1) {

            // composed tag

            if (isset($atr)) {

                $str = '"'.Enc::enc($atr).'"';

            } else {

                $str = 'NULL';
            }

            if (isset($cnt)) {

                $cst = '"'.base64_encode($cnt).'"';

            } else {

                $cst = 'NULL';
            }

            $sql .= $typ .', "'.$tag.'",'. $str.','.$scl.','.$cst.',NULL';

        } elseif($typ==2) {

            // xml string

            $sql .= '2,NULL,NULL,NULL,NULL,"'.base64_encode($xml).'"';

        } else {

            // process of elimination, type must be 3-group
            if(isset($cnt)) {

                $sql .= '3,NULL,NULL,NULL,"'.Enc::enc($cnt).'",NULL';

            } else {

                $sql .= '3,NULL,NULL,NULL,NULL,NULL';

            }

        }

        $sql .= ');';

        echo $sql.N;

        // $dbs = AppDbs::dbs();

        // $dbs->insRec($sql);

    } // ./addElm

    public static function elmFromId($arg)
    {

        $sql = 'SELECT * FROM dom WHERE oid = '.$arg.';';

        $dbs = AppDbs::dbs();

        // only execute if records are found
        if ($arr = $dbs->ftcRec($sql)) {

            $elm = new DomObj();

            // Decode attributes array
            if(is_string($arr['atr'])) {

                $arr['atr'] = Enc::dec($arr['atr']);

            }

            // Decode content array
            if(is_string($arr['cnt'])) {

                // convert cnt array item to decoded array
                $arr['cnt'] = Enc::dec($arr['cnt']);

                // new element array
                $nea = [];

                // iterate through nested dom element ids
                foreach ($arr['cnt'] as $ndi) {

                    // add to new element array
                    $nea[] = DomMdl::elmFromId($ndi);

                }

                // finally replace the content array with dom elements
                $arr['cnt'] = $nea;

            }

            // Decode xml
            if(is_string($arr['xml'])) {

                $arr['xml'] = base64_decode($arr['xml']);

            }


            // echo '<pre></pre>elmFromId(): <br>'.print_r($arr,true).'<br></pre>';

            $elm->setAll($arr);

            return $elm;
        }

        return false;

    }

} // ./DOM Model


