<?php
class lottoeight
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

    public function showWinning($arrWon = array())
    {
        $arrayOutput = array();
        $arrResults = $this->arrResults;
        $arrLength = count($arrResults) - 9;
        $arrCheck = array_slice($arrResults,-8 );
        $arrProcess = array();
        $arrOutput = array();
        $arrCount = array();
        foreach ($arrCheck as $eachrow)
        {
            $tempArray = array($eachrow["lottoNumber1"], $eachrow["lottoNumber2"], $eachrow["lottoNumber3"],$eachrow["lottoNumber4"], $eachrow["lottoNumber5"], $eachrow["lottoNumber6"] );
            $arrProcess = array();
            foreach($tempArray as $eachnumber) {
                    if (!in_array($eachnumber,$arrProcess )) {
                        $arrProcess[] = $eachnumber;
                   }
                   if (!array_key_exists($eachnumber,$arrCount)) {
                        $arrCount[$eachnumber] = 1; 
                   }
                   else {
                    $arrCount[$eachnumber] = $arrCount[$eachnumber] + 1; 
                   }
            }
        }
        echo "this is eight";
        var_dump($arrCount);
        return  array(
            "systemcode" => $arrProcess,
            "countOutput" => $arrCount
        );
    }
    
}
?>
