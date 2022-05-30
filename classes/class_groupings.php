<?php
class groupings
{

    protected $arrResults;

    public $lottoContainer =  array(
        "01" => array(), "02" => array(), "03" => array(), "04" => array(), "05" => array(), "06" => array(), "07" => array(), "08" => array(), "09" => array(), "10" => array(),
        "11" => array(), "12" => array(), "13" => array(), "14" => array(),	"15" => array(), "16" => array(), "17" => array(), "18" => array(), "19" => array(), "20" => array(),
        "21" => array(), "22" => array(), "23" => array(), "24" => array(),	"25" => array(), "26" => array(), "27" => array(), "28" => array(), "29" => array(), "30" => array(),
        "31" => array(), "32" => array(), "33" => array(), "34" => array(),	"35" => array(), "36" => array(), "37" => array(), "38" => array(), "39" => array(), "40" => array(),
        "41" => array(), "42" => array()
    );

    public $lottoArrayBlank = array(
        "01" => 0, "02" => 0, "03" => 0, "04" => 0, "05" => 0, "06" => 0, "07" => 0, "08" => 0, "09" => 0, "10" => 0,
        "11" => 0, "12" => 0, "13" => 0, "14" => 0,	"15" => 0, "16" => 0, "17" => 0, "18" => 0, "19" => 0, "20" => 0,
        "21" => 0, "22" => 0, "23" => 0, "24" => 0,	"25" => 0, "26" => 0, "27" => 0, "28" => 0, "29" => 0, "30" => 0,
        "31" => 0, "32" => 0, "33" => 0, "34" => 0,	"35" => 0, "36" => 0, "37" => 0, "38" => 0, "39" => 0, "40" => 0,
        "41" => 0, "42" => 0
    );

    public $arrStats = array();
    public $arrTriplets = array();

    /**
     * Constructor.
     */
    public function __construct($lottoContainer) {
        $this->setResult($lottoContainer);
    }

    public function processReport()
    {
        $arrResults = $this->arrResults;
        $arrOutput = array();
        $arrTemp = array();
        $arrTemp["first"] = 0;
        $arrTemp["secone"] = 0;
        $arrTemp["third"] = 0;
        $arrTemp["fourth"] = 0;
        $arrTemp["fifth"] = 0;
        foreach ($arrResults as $eachrow)
        {
            foreach($eachrow as $eachelement) {
                $int_value = (int) $eachelement;
                switch ($int_value) {
                    case $int_value >= 1 AND $int_value <= 9 :
                        $arrTemp["first"] = $arrTemp["first"] + 1;   
                        break;
                     case $int_value >= 10 AND $int_value <= 19 :
                        $arrTemp["second"] = $arrTemp["second"] + 1;   
                        break;
                    case $int_value >= 20 AND $int_value <= 29 :
                        $arrTemp["third"] = $arrTemp["third"] + 1;   
                        break;
                    case $int_value >= 30 AND $int_value <= 39 :
                        $arrTemp["fourth"] = $arrTemp["fourth"] + 1;   
                        break;
                    case $int_value >= 40 AND $int_value <= 42 :
                        $arrTemp["fifth"] = $arrTemp["fifth"] + 1;   
                        break;
                  }                
            }
        }
        $this->$arrStats = $arrTemp;
        return  $arrTemp ;
    }

    public function getGroupings( $arrSetOfWinning) {
        $result = $this->processReport();
        

    }


}
?>
