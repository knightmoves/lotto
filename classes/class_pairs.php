<?php
class pairs
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

    public $arrPairs = array();
    public $arrTriplets = array();

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

    public function processPairs()
    {
        $arrResults = $this->arrResults;

        foreach ($arrResults as $eachrow)
        {
            $this->setPairs($eachrow["lottoNumber1"],$eachrow["lottoNumber2"]);
            $this->setPairs($eachrow["lottoNumber1"],$eachrow["lottoNumber3"]);
            $this->setPairs($eachrow["lottoNumber1"],$eachrow["lottoNumber4"]);
            $this->setPairs($eachrow["lottoNumber1"],$eachrow["lottoNumber5"]);
            $this->setPairs($eachrow["lottoNumber1"],$eachrow["lottoNumber6"]);
            $this->setPairs($eachrow["lottoNumber2"],$eachrow["lottoNumber3"]);
            $this->setPairs($eachrow["lottoNumber2"],$eachrow["lottoNumber4"]);
            $this->setPairs($eachrow["lottoNumber2"],$eachrow["lottoNumber5"]);
            $this->setPairs($eachrow["lottoNumber2"],$eachrow["lottoNumber6"]);
            $this->setPairs($eachrow["lottoNumber3"],$eachrow["lottoNumber4"]);
            $this->setPairs($eachrow["lottoNumber3"],$eachrow["lottoNumber5"]);
            $this->setPairs($eachrow["lottoNumber3"],$eachrow["lottoNumber6"]);
            $this->setPairs($eachrow["lottoNumber4"],$eachrow["lottoNumber5"]);
            $this->setPairs($eachrow["lottoNumber4"],$eachrow["lottoNumber6"]);
            $this->setPairs($eachrow["lottoNumber5"],$eachrow["lottoNumber6"]);
        }
        arsort($this->arrPairs);
      //  var_dump($this->arrPairs);
        $x = 0;
        foreach ($this->arrPairs as $key => $value)
        {
            $x++;
            if ($x < 25)
            {
                //var_dump($key , $value);
            }

        }
        return  $this->arrPairs ;
    }


    public function processTriplets()
    {
        $arrResults = $this->arrResults;
        foreach ($arrResults as $eachrow)
        {
            $this->setTriplets($eachrow["lottoNumber1"],$eachrow["lottoNumber2"],$eachrow["lottoNumber3"]);
            $this->setTriplets($eachrow["lottoNumber1"],$eachrow["lottoNumber2"],$eachrow["lottoNumber4"]);
            $this->setTriplets($eachrow["lottoNumber1"],$eachrow["lottoNumber2"],$eachrow["lottoNumber5"]);
            $this->setTriplets($eachrow["lottoNumber1"],$eachrow["lottoNumber2"],$eachrow["lottoNumber6"]);
            $this->setTriplets($eachrow["lottoNumber2"],$eachrow["lottoNumber3"],$eachrow["lottoNumber4"]);
            $this->setTriplets($eachrow["lottoNumber2"],$eachrow["lottoNumber3"],$eachrow["lottoNumber5"]);
            $this->setTriplets($eachrow["lottoNumber2"],$eachrow["lottoNumber3"],$eachrow["lottoNumber6"]);
            $this->setTriplets($eachrow["lottoNumber3"],$eachrow["lottoNumber4"],$eachrow["lottoNumber5"]);
            $this->setTriplets($eachrow["lottoNumber3"],$eachrow["lottoNumber4"],$eachrow["lottoNumber6"]);
            $this->setTriplets($eachrow["lottoNumber4"],$eachrow["lottoNumber5"],$eachrow["lottoNumber6"]);
        }
        arsort($this->arrTriplets);
        return  $this->arrTriplets ;
    }



    public function showPairs($arrWon = array()) {
        $this->processPairs();
        $arrShow = array();
        $arrTemp = array();
        foreach ($this->arrPairs as $key => $value ) {
            if (sizeof($arrTemp) >= 6)
            {
                $arrShow[] = $arrTemp;
                $arrTemp = array();
            }
            $arrTemp2 = explode("-",$key);
            foreach ($arrTemp2 as $key2 => $value2 ) {
                if (!in_array($value2,$arrTemp ) ){
                    $arrTemp[] = $value2;
                }
            }
        }
        $row = 0;
        echo "<br>";
        foreach ($this->arrPairs as $key =>$value)
        {
          if ($row <= 20)
          {
            if (!empty($arrWon)) {
                $show = "";
                $temp = explode("-", $key);
                if (in_array($temp[0],  array( $arrWon["lottoNumber1"],  $arrWon["lottoNumber2"],
                        $arrWon["lottoNumber3"],  $arrWon["lottoNumber4"],
                            $arrWon["lottoNumber5"], $arrWon["lottoNumber6"]) ) )
                {
                    $show .= "<span style='" .  "background-color:#00FF00;" . "' > " . $temp[0]  . "</span>";
                }
                else {
                    $show .= "<span " .   "> " . $temp[0]  . "</span>";

                }
                if (in_array( $temp[1], array( $arrWon["lottoNumber1"],  $arrWon["lottoNumber2"],
                        $arrWon["lottoNumber3"],  $arrWon["lottoNumber4"],
                            $arrWon["lottoNumber5"], $arrWon["lottoNumber6"])))
                {
                    $show .= "<span style='" .  "background-color:#00FF00;" . "' > " . $temp[1]  . "</span>";
                }
                else {
                    $show .= "<span " .   "> " . $temp[1]  . "</span>";
                }


                echo $show  . " : " . $value . "<br>";

            }
            else {
                echo $key  . " : " . $value . "<br>";
            }    
          }
          $row++;
        }

        return $arrShow;
    }


    public function showTriplets($arrWon = array()) {
        $this->processTriplets();
        $arrShow = array();
        $arrTemp = array();
       arsort($this->arrTriplets);
       $this->arrTriplets = array_reverse($this->arrTriplets);
//       var_dump($this->arrTriplets);
//        var_dump($this->arrTriplets);
        foreach ($this->arrTriplets as $key => $value ) {
            if (sizeof($arrTemp) >= 6)
            {
                $arrShow[] = $arrTemp;
                $arrTemp = array();
            }
            $arrTemp2 = explode("-",$key);
            foreach ($arrTemp2 as $key2 => $value2 ) {
                if (!in_array($value2,$arrTemp ) ){
                    $arrTemp[] = $value2;
                }
            }
        }
        $row = 0;
        foreach ($this->arrTriplets as $key => $value) {
          if ($row <=10) {
            if (!empty($arrWon)) {
                $show = "";
                $temp = explode("-", $key);
                if (in_array($temp[0],  array( $arrWon["lottoNumber1"],  $arrWon["lottoNumber2"],
                        $arrWon["lottoNumber3"],  $arrWon["lottoNumber4"],
                            $arrWon["lottoNumber5"], $arrWon["lottoNumber6"]) ) )
                {
                    $show .= "<span style='" .  "background-color:#00FF00;" . "' > " . $temp[0]  . "</span>";
                }
                else {
                    $show .= "<span " .   "> " . $temp[0]  . "</span>";

                }
                if (in_array( $temp[1], array( $arrWon["lottoNumber1"],  $arrWon["lottoNumber2"],
                        $arrWon["lottoNumber3"],  $arrWon["lottoNumber4"],
                            $arrWon["lottoNumber5"], $arrWon["lottoNumber6"])))
                {
                    $show .= "<span style='" .  "background-color:#00FF00;" . "' > " . $temp[1]  . "</span>";
                }
                else {
                    $show .= "<span " .   "> " . $temp[1]  . "</span>";
                }
                if (in_array( $temp[2], array( $arrWon["lottoNumber1"],  $arrWon["lottoNumber2"],
                        $arrWon["lottoNumber3"],  $arrWon["lottoNumber4"],
                            $arrWon["lottoNumber5"], $arrWon["lottoNumber6"])))
                {
                    $show .= "<span style='" .  "background-color:#00FF00;" . "' > " . $temp[2]  . "</span>";
                }
                else {
                    $show .= "<span " .   "> " . $temp[2]  . "</span>";
                }
                echo $show  . " : " . $value . "<br>";

            }
            else {
                echo $key  . " : " . $value . "<br>";
            }    
        }
          $row++;
        }
        echo "-------------------------------------------------------------------------------";
        return $arrShow;
    }

    public function setPairs($firstElement, $secondElement) {
        $key1 = $firstElement  . "-" . $secondElement ;
        $key2 = $secondElement . "-" . $firstElement ;
        if ( array_key_exists($key1 , $this->arrPairs) )
        {
            $this->arrPairs[$key1] = $this->arrPairs[$key1] + 1;
        }
        elseif (array_key_exists($key2 , $this->arrPairs))
        {
            $this->arrPairs[$key2] = $this->arrPairs[$key2] + 1;
        }
        else {
            $this->arrPairs[$key1] = 1;
        }

    }


    public function setTriplets($firstElement, $secondElement, $thirdElement)
    {
        $key1 = $firstElement  . "-" . $secondElement .   "-"  . $thirdElement;
        $key2 = $secondElement . "-" . $firstElement . "-"  . $thirdElement;
        $key3 = $thirdElement . "-" . $firstElement . "-"  . $secondElement;
        $key4 = $firstElement  . "-" . $thirdElement .   "-"  . $secondElement;
        $key5 = $secondElement  . "-" . $thirdElement .   "-"  . $firstElement;
        $key6 = $thirdElement   . "-" . $secondElement .   "-"  . $firstElement;
        if ( array_key_exists($key1 , $this->arrTriplets) )
        {
            $this->arrTriplets[$key1] = $this->arrTriplets[$key1] + 1;
        }
        elseif (array_key_exists($key2 , $this->arrTriplets))
        {
            $this->arrTriplets[$key2] = $this->arrTriplets[$key2] + 1;
        }
        elseif (array_key_exists($key3 , $this->arrTriplets))
        {
            $this->arrTriplets[$key3] = $this->arrTriplets[$key3] + 1;
        }
        elseif (array_key_exists($key4 , $this->arrTriplets))
        {
            $this->arrTriplets[$key4] = $this->arrTriplets[$key4] + 1;
        }
        elseif (array_key_exists($key5 , $this->arrTriplets))
        {
            $this->arrTriplets[$key5] = $this->arrTriplets[$key5] + 1;
        }
        elseif (array_key_exists($key6 , $this->arrTriplets))
        {
            $this->arrTriplets[$key6] = $this->arrTriplets[$key6] + 1;
        }
        else {
            $this->arrTriplets[$key1] = 1;
        }
    }


}
?>
