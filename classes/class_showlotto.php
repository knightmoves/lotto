<?php
class show_lotto
{
    /**
     * Constructor.
     */
    public function __construct() {
    }

    public function printNextResult($arrTest, $title = "")
    {
      if (!empty($arrTest))
      {
        echo "<h5>"  .  $title  . "  " . $arrTest["date"] .  "</h5>";
      }
        foreach ($arrTest as $key => $value) {
            if ($key != "id" and $key != "Price"  and $key != "Winner"  and $key != "lottoGameType"  )
            {
                if ($key != "date")
                {
                    echo $this->printball($value);
                }
                else {

                }
            }
        }

    }

    public function showratio($text)
    {
        echo '<svg height="70" width="250">
        <ellipse cx="100" cy="40" rx="50" ry="25"
            style="fill:yellow;stroke:purple;stroke-width:2" />
<text x="63" y="45" fill="black">' . $text  . '</text>
            </svg>' ;
    }

    public function printball($text)
    {
        echo '<svg height="100" width="100">
  <circle cx="50" cy="50" r="40" stroke="black" stroke-width="3" fill="yellow" />
<text x="40" y="55" fill="black">' . $text  . '</text>
  Sorry, your browser does not support inline SVG.
</svg> ';

    }

    public function printmanyball($text, $color)
    {
      if (is_array($text)) {
          foreach($text as $value)
          {
            echo '<svg height="50" width="50">
            <circle cx="25" cy="25" r="20" stroke="black" stroke-width="3" fill="' . $color .  '" />
    <text x="18" y="29" fill="black">' . $value  . '</text>
            Sorry, your browser does not support inline SVG.
            </svg>';

          }
      }
      else {
        echo '<svg height="50" width="50">
        <circle cx="25" cy="25" r="20" stroke="black" stroke-width="3" fill="' . $color .  '" />
<text x="18" y="29" fill="black">' . $text  . '</text>
        Sorry, your browser does not support inline SVG.
        </svg>';
      }

    }


    public function  printResult($title, $arrMostLikely, $arrWon)
    {
        $lottoArrayBlank = array(
            "01" , "02" , "03" , "04" , "05" , "06" , "07" , "08" , "09" , "10" ,
            "11" , "12" , "13" , "14" ,	"15" , "16" , "17" , "18" , "19" , "20" ,
            "21" , "22" , "23" , "24" ,	"25" , "26" , "27" , "28" , "29" , "30" ,
            "31" , "32" , "33" , "34" ,	"35" , "36" , "37" , "38" , "39" , "40" ,
            "41" , "42"
        );

        $arrShowed = array();
        echo "<h5>" . $title .  "</h5>";
        $counter = 0;
        foreach ($arrMostLikely as $value) {
            if (in_array($value, $arrWon))
            {
                $counter++;
                echo  $this->printmanyball($value, "#00FF00") ;
            }
            else {
                echo  $this->printmanyball($value, "#3CB371") ;

            }
            $arrShowed[] = $value;
         }
         echo "<br>";
         if ( !is_array($lottoArrayBlank) or !is_array($arrShowed) )
         {
           $other = array();
         }
         else {
         $other = array_diff($lottoArrayBlank, $arrShowed );
         foreach ($other as $value) {
             if (in_array($value, $arrWon))
             {
                 echo  $this->printmanyball($value, "#00FF00") ;
             }
             else {
                 echo  $this->printmanyball($value, "#FFB6C1") ;

             }


         }
      }
        echo $this->showratio($counter . " out of  6");

    }

    public function  printResultSub($title, $arrMostLikely, $arrWon)
    {
        $lottoArrayBlank = array(
            "01" , "02" , "03" , "04" , "05" , "06" , "07" , "08" , "09" , "10" ,
            "11" , "12" , "13" , "14" ,	"15" , "16" , "17" , "18" , "19" , "20" ,
            "21" , "22" , "23" , "24" ,	"25" , "26" , "27" , "28" , "29" , "30" ,
            "31" , "32" , "33" , "34" ,	"35" , "36" , "37" , "38" , "39" , "40" ,
            "41" , "42"
        );

        $arrShowed = array();
        echo "<h5>" . $title .  "</h5>";
        $counter = 0;
        foreach ($arrMostLikely as $value1) {
            foreach($value1 as $value)
            {
                if (in_array($value, $arrWon))
                {
                    $counter++;
                    echo  $this->printmanyball($value, "#00FF00") ;
                }
                else {
                    echo  $this->printmanyball($value, "#3CB371") ;

                }
            }
            $arrShowed[] = $value;
         }
         echo "<br>";
         $other = array_diff($lottoArrayBlank, $arrShowed );
         foreach ($other as $value) {
             if (in_array($value, $arrWon))
             {
                 echo  $this->printmanyball($value, "#00FF00") ;
             }
             else {
                 echo  $this->printmanyball($value, "#FFB6C1") ;

             }


         }
        echo $this->showratio($counter . " out of  6");

    }





}
?>
