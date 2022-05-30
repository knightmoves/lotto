<?php
class repeater
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

    /**
     * Constructor.
     */
    public function __construct($lottoContainer) {
        $this->setResult($lottoContainer);
    }


    protected function setResult($lottoContainer)
    {
        $this->arrResults = $lottoContainer;
    }

    public function showRepeats($arrWon = array())
    {
        $arrNumbers = $this->lottoArrayBlank;
        $arrStats = $this->lottoContainer;
        $arrResults = $this->arrResults;
        $arrTemp = array();
        foreach ($arrResults as $eachrow)
        {
            $currentList = array(
                $eachrow["lottoNumber1"],
                $eachrow["lottoNumber2"],
                $eachrow["lottoNumber3"],
                $eachrow["lottoNumber4"],
                $eachrow["lottoNumber5"],
                $eachrow["lottoNumber6"]

            );
            if (sizeof($arrTemp) > 0)
            {
                if (in_array($arrTemp["lottoNumber1"], $currentList))
                {
                    $arrNumbers[$arrTemp["lottoNumber1"]] = $arrNumbers[$arrTemp["lottoNumber1"]] + 1;
                }
                if (in_array($arrTemp["lottoNumber2"], $currentList))
                {
                    $arrNumbers[$arrTemp["lottoNumber2"]] = $arrNumbers[$arrTemp["lottoNumber2"]] + 1;
                }
                if (in_array($arrTemp["lottoNumber3"], $currentList))
                {
                    $arrNumbers[$arrTemp["lottoNumber3"]] = $arrNumbers[$arrTemp["lottoNumber3"]] + 1;
                }
                if (in_array($arrTemp["lottoNumber4"], $currentList))
                {
                    $arrNumbers[$arrTemp["lottoNumber4"]] = $arrNumbers[$arrTemp["lottoNumber4"]] + 1;
                }
                if (in_array($arrTemp["lottoNumber5"], $currentList))
                {
                    $arrNumbers[$arrTemp["lottoNumber5"]] = $arrNumbers[$arrTemp["lottoNumber5"]] + 1;
                }
                if (in_array($arrTemp["lottoNumber6"], $currentList))
                {
                    $arrNumbers[$arrTemp["lottoNumber6"]] = $arrNumbers[$arrTemp["lottoNumber6"]] + 1;
                }

            }
            $arrTemp = $eachrow;
        }
        arsort($arrNumbers);
        $arrOutput = array();
        $counter = 0;
        foreach($arrNumbers as $key => $value)
        {
            if (in_array($key, $arrWon))
            {
                if ($counter < 19)
                {
                    $arrOutput[] = $key;
                }
            }    
            $counter ++;
        }
        return $arrOutput;
    }


}
?>
