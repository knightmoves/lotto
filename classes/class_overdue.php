<?php
//https://www.pcso.gov.ph/SearchLottoResult.aspx
class overdue
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

    public function showOverDue()
    {
        $arrNumbers = $this->lottoArrayBlank;
        $arrStats = $this->lottoContainer;
        $arrResults = $this->arrResults;
        foreach ($arrResults as $eachrow)
        {
            foreach ($arrNumbers as $key => $value)
            {
                if ($key != $eachrow["lottoNumber1"]
                    AND $key != $eachrow["lottoNumber2"]
                    AND $key != $eachrow["lottoNumber3"]
                    AND $key != $eachrow["lottoNumber4"]
                    AND $key != $eachrow["lottoNumber5"]
                    AND $key != $eachrow["lottoNumber6"]
                    )
                {
                    $arrNumbers[$key] = $arrNumbers[$key] + 1;
                }
                else {
                    $arrStats[$key][] = $arrNumbers[$key];
                    $arrNumbers[$key] = 0;
                }
            }
        }
        return array("overdue" => $arrNumbers,"stats" => $arrStats) ;
    }

    public function showOverDueWithDate($variable = 0)
    {
        $arrNumbers = $this->lottoArrayBlank;
        $arrStats = $this->lottoContainer;
        $arrResults = $this->arrResults;
        $arrWon = array();
        $counter = 0;
        $maximum = count($arrResults) - $variable;
        foreach ($arrResults as $eachrow)
        {
            $counter++;
            if ($counter == $maximum + 1 ) {
                $arrWon = $eachrow;
            }
            if ( $counter <= $maximum  )
            {
                foreach ($arrNumbers as $key => $value)
                {
                    if ($key != $eachrow["lottoNumber1"]
                        AND $key != $eachrow["lottoNumber2"]
                        AND $key != $eachrow["lottoNumber3"]
                        AND $key != $eachrow["lottoNumber4"]
                        AND $key != $eachrow["lottoNumber5"]
                        AND $key != $eachrow["lottoNumber6"]
                        )
                    {
                        $arrNumbers[$key] = $arrNumbers[$key] + 1;
                    }
                    else {
                        $arrStats[$key][] = $arrNumbers[$key];
                        $arrNumbers[$key] = 0;
                    }
                }
            }   
        }
        return array("overdue" => $arrNumbers,"stats" => $arrStats, "winning" =>  $arrWon) ;
    }

    public function showStatsOverdue($arrWon = array())
    {
        $arrOverdue = $this->showOverDue();
        $arrStats = $arrOverdue["stats"];
        echo "<br>";
        foreach ($arrStats as $key => $value ) {
            $arrTemp = array();
            foreach ($value as $presence) {
                if (array_key_exists($presence, $arrTemp)) {
                    $arrTemp[$presence] = $arrTemp[$presence] +  1;
                }
                else {
                       $arrTemp[$presence] =   1;
                }                    
            }
            $temp = implode("-", $value);
            $lastnum = array_key_last($arrTemp);
                asort($arrTemp);
            array_key_last($arrTemp); 
            if (in_array($key,$arrWon) ) {
                echo "<span style='background-color:#00FF00;'>" . $key  . "</span><span> is "  .  $temp  .   "   "  .  array_key_last($arrTemp)  .   " appeared "  .  end($arrTemp)   .     "</span><br>";
            }
            else {
                echo "<span>" . $key  . "</span><span> is "  . $temp  .  "   "  .  array_key_last($arrTemp)  .    " appeared "  .  end($arrTemp)   .    "</span><br>";
            }    
        }
    }


    public function getUsualOverdue()
    {
        $arrMostLikely = array();
        $arrOverDueUsual = array();
        $arrOverdue = $this->showOverDue();
        $arrNumbers = $arrOverdue["overdue"];
        $arrStats = $arrOverdue["stats"];
        foreach ($arrStats as $key1 => $value1)
        {
            foreach($value1 as $key => $value)
            {
                if (array_key_exists($value,$arrOverDueUsual))
                {
                    $arrOverDueUsual[$value] = $arrOverDueUsual[$value]  + 1;
                }
                else {
                    $arrOverDueUsual[$value] = 1;
                }
            }
        }
        arsort($arrOverDueUsual);
        foreach ($arrNumbers as $key => $value)
        {
            if (array_key_exists($value,$arrOverDueUsual))
            {
//                if ($arrOverDueUsual[$value] >= 30)
                if ($arrOverDueUsual[$value] >= 15 )
                {
                    $arrMostLikely[]  = $key;
                }
            }
        }
        return $arrMostLikely;
    }


    public function showTheOverdue($variable = 0, $showall = true)
    {
        $arrMostLikely = array();
        $arrOverdue = $this->showOverDueWithDate($variable);
        $arrNumbers = $arrOverdue["overdue"];
        $arrWon = array();
        if (!empty( $arrOverdue["winning"]) )
        {
            $arrWon = array(
                            $arrOverdue["winning"]["lottoNumber1"],
                            $arrOverdue["winning"]["lottoNumber2"],
                            $arrOverdue["winning"]["lottoNumber3"],
                            $arrOverdue["winning"]["lottoNumber4"],
                            $arrOverdue["winning"]["lottoNumber5"],
                            $arrOverdue["winning"]["lottoNumber6"]
                    );
         }           
        arsort($arrNumbers);    
        $rank = 0;
        echo "<Br>";
        foreach ($arrNumbers as $key => $value)
        {
            $rank++;
            $color = "";
            $num = str_pad($key, 2, '0', STR_PAD_LEFT);
            if (in_array($num,$arrWon))
            {
                $color = "green";
            }
            if ($color == "green") {
                if ($showall ) {
                    echo "<span style='background-color:#00FF00;'>" . $key  . "</span><span  style='margin-left: 10px'>$rank</span><br>";
                }
                $arrMostLikely[] = $rank;
            }
            else {
                if ($showall ) {
                    echo "<span>" . $key  . "</span><span style='margin-left: 10px'>$rank</span><br>";
                }    
             }
        }
        foreach ($arrMostLikely as $key => $value)
        {
            echo "<span style='margin-left: 10px'>" . $value  . "</span>";
        }    
        return $arrMostLikely;
    }



    public function getOverdueStats()
    {
        $arrOverdue = $this->showOverDue();
        $arrNumbers = $arrOverdue["overdue"];
        $arrStats = $arrOverdue["stats"];
        arsort($arrNumbers);
      //  print_r($arrStats);

        $arrAnalyze2 = array();
        $arrAnalyze = array();
        foreach ($arrNumbers as $key => $value)
        {
            $arrAnalyze2[$key] = $value;
            $arrAnalyze[$key] = array ($value, sizeof($arrStats[$key]));
        }
        asort($arrAnalyze2);
        $total = 0;
        foreach ($arrAnalyze as $key => $value)
        {
            $total = $total + $value[1];
        }
        $arrOverdue = array();
        $average = $total/42;
        foreach ($arrAnalyze as $key => $value)
        {
            if ( $average < $value[1])
            {

                $arrOverdue[] = array($key, $value[0],$value[1]) ;
            }
        }
        return $arrStats;
//        return array("stats" => $arrStats,  $arrOverdue);
    }


    public function getHighest()
    {
        $arrNumbers = $this->lottoArrayBlank;
        $arrResults = $this->arrResults;
        foreach ($arrResults as $eachrow)
        {
            foreach($eachrow as $key => $value) {

            }
        }
        return array("overdue" => $arrNumbers,"stats" => $arrStats) ;
    }
}
?>
