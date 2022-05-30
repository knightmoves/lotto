<?php
class lotto_structure
{
	protected $connection;

	protected $dateStart;

	protected $dateEnd;

	protected $dayName;

	protected $testmode = false;

	protected $lastDate;

	protected $nextDate;

	protected $currentList = array();

	public $lottoArrayBlank = array(
			"01" => 0, "02" => 0, "03" => 0, "04" => 0, "05" => 0, "06" => 0, "07" => 0, "08" => 0, "09" => 0, "10" => 0,
			"11" => 0, "12" => 0, "13" => 0, "14" => 0,	"15" => 0, "16" => 0, "17" => 0, "18" => 0, "19" => 0, "20" => 0,
			"21" => 0, "22" => 0, "23" => 0, "24" => 0,	"25" => 0, "26" => 0, "27" => 0, "28" => 0, "29" => 0, "30" => 0,
			"31" => 0, "32" => 0, "33" => 0, "34" => 0,	"35" => 0, "36" => 0, "37" => 0, "38" => 0, "39" => 0, "40" => 0,
			"41" => 0, "42" => 0
		);

	public $lottoContainer =  array(
			"01" => array(), "02" => array(), "03" => array(), "04" => array(), "05" => array(), "06" => array(), "07" => array(), "08" => array(), "09" => array(), "10" => array(),
			"11" => array(), "12" => array(), "13" => array(), "14" => array(),	"15" => array(), "16" => array(), "17" => array(), "18" => array(), "19" => array(), "20" => array(),
			"21" => array(), "22" => array(), "23" => array(), "24" => array(),	"25" => array(), "26" => array(), "27" => array(), "28" => array(), "29" => array(), "30" => array(),
			"31" => array(), "32" => array(), "33" => array(), "34" => array(),	"35" => array(), "36" => array(), "37" => array(), "38" => array(), "39" => array(), "40" => array(),
			"41" => array(), "42" => array()
		);

	/**
	 * Constructor.
	 */
	public function __construct($connection) {
			$this->setConnection($connection);
	}

	public function setConnection($connection)
	{
		$this->connection = $connection;
	}

	public function setDateStart($dateStart)
	{
		$this->dateStart = $dateStart;
	}

	public function setDateEnd($dateEnd)
	{
		$this->dateEnd = $dateEnd;
	}

	public function setDayName($dayName)
	{
		$this->dayName = $dayName;
	}

	public function setTestMode($testmode)
	{
	    $this->testmode = $testmode;
	}


	public function getList()
	{
		$arrWhere = array();
		if (!empty($this->dateStart))
		{
			$arrWhere[] = ' date >= "' . $this->dateStart . '"';
		}
		if (!empty($this->dateEnd))
		{
			$arrWhere[] = ' date <= "' . $this->dateEnd . '"';
		}
		if (!empty($this->dayName))
		{
			$arrWhere[] = ' DAYNAME(date) = "' . $this->dayName. '"';
		}
		$where = "";
		if (!empty($arrWhere))
		{
			$where = " WHERE " . implode(" AND ", $arrWhere);
		}
		$arrResults = array();
		$sqlresult =  mysqli_query($this->connection, "SELECT * FROM lottodetails $where ORDER BY date ASC");
		$arrResults = array();
		while ($row = mysqli_fetch_assoc($sqlresult))
		{
			$arrResults[] = $row;
			$this->lastDate = $row["date"];
		}
		$this->currentList = $arrResults;
		return $arrResults;
	}

	public function getNextResult()
	{
	    $arrWhere = array();
	    if (!empty($this->dateEnd))
	    {
	        $arrWhere[] = ' date > "' . $this->dateEnd . '"';
	    }
	    if (!empty($this->dayName))
	    {
	        $arrWhere[] = ' DAYNAME(date) = "' . $this->dayName. '"';
	    }
	    $where = "";
	    if (!empty($arrWhere))
	    {
	        $where = " WHERE " . implode(" AND ", $arrWhere);
	    }
	    $arrResults = array();
	    $sqlresult =  mysqli_query($this->connection, "SELECT * FROM lottodetails $where ORDER BY date ASC LIMIT 1 ");
	    $arrResults = array();
	    while ($row = mysqli_fetch_assoc($sqlresult))
	    {
	        $arrResults = $row;
	    }
	    return $arrResults;
	}


	public function getPreviousResult()
	{

	    $output = array_slice($this->currentList,-2);
	    /*
	    return array(
	        $output[0]["lottoNumber1"],
	        $output[0]["lottoNumber2"],
	        $output[0]["lottoNumber3"],
	        $output[0]["lottoNumber4"],
	        $output[0]["lottoNumber5"],
	        $output[0]["lottoNumber6"]
	    );
	    */
	    return $output[1];

	}


	public function getCurrentResult()
	{

	    $output = array_slice($this->currentList,-2);
	    /*
	     return array(
	     $output[0]["lottoNumber1"],
	     $output[0]["lottoNumber2"],
	     $output[0]["lottoNumber3"],
	     $output[0]["lottoNumber4"],
	     $output[0]["lottoNumber5"],
	     $output[0]["lottoNumber6"]
	     );
	     */
	    return $output[0];

	}



	public function printNextResult()
	{
	    $arrTest = $this->getNextResult();
	    echo "<table border=1>";
	    echo "<tr>";
	    foreach ($arrTest as $key => $value) {
	        if ($key != "id" and $key != "Price"  and $key != "Winner"  and $key != "lottoGameType"  )
	        {
	            echo "<td>" .  $key .   "</td>";
	        }
	    }
	    echo "</tr>";
	    echo "<tr>";
	    foreach ($arrTest as $key => $value) {
	        if ($key != "id" and $key != "Price"  and $key != "Winner"  and $key != "lottoGameType"  )
	        {
	            echo "<td>" .  $value .   "</td>";
	        }
	    }
	    echo "</tr>";
	    echo "</table>";

	}

	public function getHighest()
	{
		$arrNumbers = $this->lottoArrayBlank;
		$arrResults = $this->getList();
		foreach ($arrResults as $eachrow)
		{
			$keynumber = str_pad(trim($eachrow["lottoNumber1"]), 2, "0", STR_PAD_LEFT);
			$arrNumbers[$keynumber] = $arrNumbers[$keynumber] + 1;

			$keynumber = str_pad(trim($eachrow["lottoNumber2"]), 2, "0", STR_PAD_LEFT);
			$arrNumbers[$keynumber] = $arrNumbers[$keynumber] + 1;

			$keynumber = str_pad(trim($eachrow["lottoNumber3"]), 2, "0", STR_PAD_LEFT);
			$arrNumbers[$keynumber] = $arrNumbers[$keynumber] + 1;

			$keynumber = str_pad(trim($eachrow["lottoNumber4"]), 2, "0", STR_PAD_LEFT);
			$arrNumbers[$keynumber] = $arrNumbers[$keynumber] + 1;

			$keynumber = str_pad(trim($eachrow["lottoNumber5"]), 2, "0", STR_PAD_LEFT);
			$arrNumbers[$keynumber] = $arrNumbers[$keynumber] + 1;

			$keynumber = str_pad(trim($eachrow["lottoNumber6"]), 2, "0", STR_PAD_LEFT);
			$arrNumbers[$keynumber] = $arrNumbers[$keynumber] + 1;

		}
		asort($arrNumbers);
		$arrReturn = array();
		$ctr = 0;
		foreach ($arrNumbers as $key => $value)
		{
			$ctr++;
			if ($ctr < 23)
			{
				$arrReturn[] = $key;
			}
		}
		return $arrReturn;
	}

	public function getAllHighest()
	{
	    $arrNumbers = $this->lottoArrayBlank;
	    $arrResults = $this->getList();
	    foreach ($arrResults as $eachrow)
	    {
	        $keynumber = str_pad(trim($eachrow["lottoNumber1"]), 2, "0", STR_PAD_LEFT);
	        $arrNumbers[$keynumber] = $arrNumbers[$keynumber] + 1;

	        $keynumber = str_pad(trim($eachrow["lottoNumber2"]), 2, "0", STR_PAD_LEFT);
	        $arrNumbers[$keynumber] = $arrNumbers[$keynumber] + 1;

	        $keynumber = str_pad(trim($eachrow["lottoNumber3"]), 2, "0", STR_PAD_LEFT);
	        $arrNumbers[$keynumber] = $arrNumbers[$keynumber] + 1;

	        $keynumber = str_pad(trim($eachrow["lottoNumber4"]), 2, "0", STR_PAD_LEFT);
	        $arrNumbers[$keynumber] = $arrNumbers[$keynumber] + 1;

	        $keynumber = str_pad(trim($eachrow["lottoNumber5"]), 2, "0", STR_PAD_LEFT);
	        $arrNumbers[$keynumber] = $arrNumbers[$keynumber] + 1;

	        $keynumber = str_pad(trim($eachrow["lottoNumber6"]), 2, "0", STR_PAD_LEFT);
	        $arrNumbers[$keynumber] = $arrNumbers[$keynumber] + 1;

	    }
	    asort($arrNumbers);
	    $arrReturn = array();
	    $ctr = 0;
	    foreach ($arrNumbers as $key => $value)
	    {
	            $arrReturn[] = $key;
	    }
	    return $arrNumbers;
	}

	public function getAllHighestWthParam($variable = 0, $showall = true)
	{
	    $arrNumbers = $this->lottoArrayBlank;
		$arrResults = $this->getList();
		$counter = 0;
		
		$maximum = count($arrResults) - $variable;
	    foreach ($arrResults as $eachrow)
	    {
			$counter++;
            if ($counter == $maximum + 1 ) {
                $arrWon = $eachrow;
            }
			if ($counter <= $maximum) 
			{
				$keynumber = str_pad(trim($eachrow["lottoNumber1"]), 2, "0", STR_PAD_LEFT);
				$arrNumbers[$keynumber] = $arrNumbers[$keynumber] + 1;

				$keynumber = str_pad(trim($eachrow["lottoNumber2"]), 2, "0", STR_PAD_LEFT);
				$arrNumbers[$keynumber] = $arrNumbers[$keynumber] + 1;

				$keynumber = str_pad(trim($eachrow["lottoNumber3"]), 2, "0", STR_PAD_LEFT);
				$arrNumbers[$keynumber] = $arrNumbers[$keynumber] + 1;

				$keynumber = str_pad(trim($eachrow["lottoNumber4"]), 2, "0", STR_PAD_LEFT);
				$arrNumbers[$keynumber] = $arrNumbers[$keynumber] + 1;

				$keynumber = str_pad(trim($eachrow["lottoNumber5"]), 2, "0", STR_PAD_LEFT);
				$arrNumbers[$keynumber] = $arrNumbers[$keynumber] + 1;

				$keynumber = str_pad(trim($eachrow["lottoNumber6"]), 2, "0", STR_PAD_LEFT);
				$arrNumbers[$keynumber] = $arrNumbers[$keynumber] + 1;
			}		
	    }
	    asort($arrNumbers);
	    $arrReturn = array();
	    $ctr = 0;
	    foreach ($arrNumbers as $key => $value)
	    {
	        $arrReturn[] = $key;
	    }
	    return array ( "numbers" => $arrNumbers, "winning" =>  $arrWon);
	}




	public function showHighestByRanks($variable = 0, $showall = true) {
        $arrMostLikely = array();
		$arrNum  = $this->getAllHighestWthParam($variable,true);
		$arrNumbers = $arrNum["numbers"];
		$arrWon = array();
 
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


	public function getHighestThree()
	{
		$arrNumbers = $this->lottoArrayBlank;
		$arrResults = $this->getList();
		foreach ($arrResults as $eachrow)
		{
			$arrTemp = array();

		}
	}

	public function getGroup($groupNumber = 3)
	{
		$arrNumbers = $this->lottoArrayBlank;
		$arrResults = $this->getList();
        $arrMain = array();
		$arrGroup = array();
		$sqlresult =  mysqli_query($this->connection, "TRUNCATE TABLE processnumbers ");
		foreach ($arrResults as $eachrow)
		{
			$arrTemp = array("lottoNumber1" => $eachrow["lottoNumber1"],
			                 "lottoNumber2" => $eachrow["lottoNumber2"],
			                 "lottoNumber3" => $eachrow["lottoNumber3"],
			                 "lottoNumber4" => $eachrow["lottoNumber4"],
			                 "lottoNumber5" => $eachrow["lottoNumber5"],
			                 "lottoNumber6" => $eachrow["lottoNumber6"]  );
			$arrTempContainer = $this->arrangeArray($arrTemp, $groupNumber);
			foreach ($arrTempContainer as $value)
			{
			    $number_group = implode("_",$value[0]);
			    $sqlresult =  mysqli_query($this->connection, "SELECT number_group, number_count FROM  processnumbers WHERE number_group ='" . $number_group . "'");
			    $row = mysqli_fetch_assoc($sqlresult);
			    if (is_array($row) ) {
			         $position = $row["number_count"] + 1;
			         $sqlresult =  mysqli_query($this->connection, "UPDATE processnumbers SET number_count = " . $position . " WHERE number_group='" . $number_group . "'");
			    }
			    else {
			        $sqlresult =  mysqli_query($this->connection, "INSERT INTO processnumbers ( number_group, number_count )   VALUES   ( '" . $number_group . "' ,  1 )");
			    }
			}
		}
	}

	public function num_combination($eachrow, $number = 3)
	{
	    $arrContainer = array();
	    $arContainerOld = array();
	    if ($number == 3) {
	        $arrContainerOld[] =  array($eachrow["lottoNumber1"], $eachrow["lottoNumber2"], $eachrow["lottoNumber3"]);
	        $arrContainerOld[] =  array($eachrow["lottoNumber1"], $eachrow["lottoNumber2"], $eachrow["lottoNumber4"]);
	        $arrContainerOld[] =  array($eachrow["lottoNumber1"], $eachrow["lottoNumber2"], $eachrow["lottoNumber5"]);
	        $arrContainerOld[] =  array($eachrow["lottoNumber1"], $eachrow["lottoNumber2"], $eachrow["lottoNumber6"]);
	        $arrContainerOld[] =  array($eachrow["lottoNumber1"], $eachrow["lottoNumber3"], $eachrow["lottoNumber4"]);
	        $arrContainerOld[] =  array($eachrow["lottoNumber1"], $eachrow["lottoNumber3"], $eachrow["lottoNumber5"]);
	        $arrContainerOld[] =  array($eachrow["lottoNumber1"], $eachrow["lottoNumber3"], $eachrow["lottoNumber6"]);
	        $arrContainerOld[] =  array($eachrow["lottoNumber1"], $eachrow["lottoNumber4"], $eachrow["lottoNumber5"]);
	        $arrContainerOld[] =  array($eachrow["lottoNumber1"], $eachrow["lottoNumber4"], $eachrow["lottoNumber6"]);
	        $arrContainerOld[] =  array($eachrow["lottoNumber1"], $eachrow["lottoNumber5"], $eachrow["lottoNumber6"]);
	        $arrContainerOld[] =  array($eachrow["lottoNumber2"], $eachrow["lottoNumber3"], $eachrow["lottoNumber4"]);
	        $arrContainerOld[] =  array($eachrow["lottoNumber2"], $eachrow["lottoNumber3"], $eachrow["lottoNumber5"]);
	        $arrContainerOld[] =  array($eachrow["lottoNumber2"], $eachrow["lottoNumber3"], $eachrow["lottoNumber6"]);
	        $arrContainerOld[] =  array($eachrow["lottoNumber2"], $eachrow["lottoNumber4"], $eachrow["lottoNumber5"]);
	        $arrContainerOld[] =  array($eachrow["lottoNumber2"], $eachrow["lottoNumber4"], $eachrow["lottoNumber6"]);
	        $arrContainerOld[] =  array($eachrow["lottoNumber2"], $eachrow["lottoNumber5"], $eachrow["lottoNumber6"]);
	        $arrContainerOld[] =  array($eachrow["lottoNumber3"], $eachrow["lottoNumber4"], $eachrow["lottoNumber5"]);
	        $arrContainerOld[] =  array($eachrow["lottoNumber3"], $eachrow["lottoNumber4"], $eachrow["lottoNumber6"]);
	        $arrContainerOld[] =  array($eachrow["lottoNumber4"], $eachrow["lottoNumber5"], $eachrow["lottoNumber6"]);
	    }
	    else {
	        $arrContainerOld[] =  array($eachrow["lottoNumber1"], $eachrow["lottoNumber2"]);
	        $arrContainerOld[] =  array($eachrow["lottoNumber1"], $eachrow["lottoNumber3"]);
	        $arrContainerOld[] =  array($eachrow["lottoNumber1"], $eachrow["lottoNumber4"]);
	        $arrContainerOld[] =  array($eachrow["lottoNumber1"], $eachrow["lottoNumber5"]);
	        $arrContainerOld[] =  array($eachrow["lottoNumber1"], $eachrow["lottoNumber6"]);
	        $arrContainerOld[] =  array($eachrow["lottoNumber2"], $eachrow["lottoNumber3"]);
	        $arrContainerOld[] =  array($eachrow["lottoNumber2"], $eachrow["lottoNumber4"]);
	        $arrContainerOld[] =  array($eachrow["lottoNumber2"], $eachrow["lottoNumber5"]);
	        $arrContainerOld[] =  array($eachrow["lottoNumber2"], $eachrow["lottoNumber6"]);
	        $arrContainerOld[] =  array($eachrow["lottoNumber3"], $eachrow["lottoNumber4"]);
	        $arrContainerOld[] =  array($eachrow["lottoNumber3"], $eachrow["lottoNumber6"]);
	        $arrContainerOld[] =  array($eachrow["lottoNumber4"], $eachrow["lottoNumber5"]);
	        $arrContainerOld[] =  array($eachrow["lottoNumber4"], $eachrow["lottoNumber6"]);
	        $arrContainerOld[] =  array($eachrow["lottoNumber5"], $eachrow["lottoNumber6"]);
	    }
	    foreach ($arrContainerOld as $checkarray)
	    {
	        sort($checkarray);
	        $arrContainer[] = $checkarray;
	    }
	    return $arrContainer;

	}


	public function arrangeArray($eachrow,$groupNumber) {
	    $arrMain = array();
	    $newRecord = array();
	    $arrContainer = $this->num_combination($eachrow, $groupNumber);
	    foreach ($arrContainer as $checkarray)
	    {
	         $counter = 0;
	         $position = 0;
	         $found = false;
	         foreach($arrMain as $eacharray)
	         {
	             $result = array_intersect($eacharray[0], $checkarray);
	             if (count($result) == 3) {
	                $found = true;
	                $position = $counter;
	             }
	             else {

	             }
	             $counter++;
	         }
	         if ($found)
	         {
	             $arrMain[$position][1] = $arrMain[$position][1] + 1;
	         }
	         else {
	             $arrMain[] = array( $checkarray, 1 );
	         }
	     }
	     return $arrMain;
	}

    public function createBet()
    {
        $arrMain = array();

        $sqlresult =  mysqli_query($this->connection, "SELECT number_group, number_count FROM  processnumbers  ORDER BY number_count DESC ");
        while ($row = mysqli_fetch_assoc($sqlresult))
        {
            $number_group = explode("_",$row["number_group"]);
            $add = true;
            foreach($arrMain as $eacharray)
            {
                $temparr =  array_intersect($eacharray,$number_group);
                if (count($temparr) > 0)
                {
                    $add = false;
                }
            }
            if ($add)
            {
                $newrow = true;
                $position = 0;
                $location = 0;
                foreach($arrMain as $eacharray)
                {
                    if (count($eacharray) < 6)
                    {
                        $location = $position;
                        $newrow = false;
                    }
                    $position++;
                }
                if ($newrow)
                {
                    $arrMain[] = $number_group;
                }
                else {
                    foreach($number_group as $tt)
                    {
                        $arrMain[$location][] = $tt;
                    }
                }
            }
        }
        echo "<p><table border='1'>";
        foreach ($arrMain as $key => $value)
        {
            echo "<tr>";
            foreach($value as $col)
            {
                echo "<td>" . $col . "</td>";
            }
            echo "</tr>";
        }
        echo "</table></p>";

    }


}
?>
