<?php
class prediction
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

    public function showWinning()
    {
        $arrayOutput = array();
        $arrResults = $this->arrResults;
        $arrLength = count($arrResults) - 1;
        $arrCheck = array_slice($arrResults,$arrLength );
        $arrProcess = array();
        foreach ($arrCheck as $eachrow)
        {
            $tempArray = array($eachrow["lottoNumber1"], $eachrow["lottoNumber2"], $eachrow["lottoNumber3"],$eachrow["lottoNumber4"], $eachrow["lottoNumber5"], $eachrow["lottoNumber6"] );
            sort($tempArray);
            $arrProcess[] = $tempArray; 
        }
        foreach($arrProcess as $checkarray) {
            $arrOutput[] = $this->showWiningNumbers($checkarray);
    
        }
        return  $arrOutput;
    }
    
    public function showWiningNumbers($arrInput) {
        $arrWin = array();
        var_dump($arrInput);

        $arrStage1 = array();
        $arrStage1[0] = $arrInput[0];

        $arrStage1[1] = intval($arrInput[1]) - intval($arrInput[0]) ;
        $arrStage1[2] = intval($arrInput[2]) - intval($arrInput[1]) ;
        $arrStage1[3] = intval($arrInput[3]) - intval($arrInput[2]) ;
        $arrStage1[4] = intval($arrInput[4]) - intval($arrInput[3]) ;
        $arrStage1[5] = intval($arrInput[5]) - intval($arrInput[4]) ;
        sort($arrStage1);
        var_dump($arrStage1);
        $arrStage2 = array();
        $arrStage2[0] = $arrStage1[0] + 3;
        $arrStage2[1] = $arrStage1[1] + 3;
        $arrStage2[2] = $arrStage1[2] + 3;
        $arrStage2[3] = $arrStage1[3] + 3;
        $arrStage2[4] = $arrStage1[4] + 3;
        $arrStage2[5] = $arrStage1[5] + 3;
        $arrWin[] = $arrStage2;

        $arrStage3 = array();
        $arrStage3[0] = $arrStage2[0] + 3;
        $arrStage3[1] = $arrStage2[1] + 3;
        $arrStage3[2] = $arrStage2[2] + 3;
        $arrStage3[3] = $arrStage2[3] + 3;
        $arrStage3[4] = $arrStage2[4] + 3;
        $arrStage3[5] = $arrStage2[5] + 3;
        $arrWin[] = $arrStage3;

        return $arrWin;
    }

}
?>
