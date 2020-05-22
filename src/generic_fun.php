<?
namespace Cheope_ppp_ns\src;

require_once("generic_const.php");

function is_id_char($actAsciiVal)
{
		return ((($actAsciiVal>=97) && ($actAsciiVal<=122))||
		(($actAsciiVal>=65)&&($actAsciiVal<=90)) || 
		($actAsciiVal==95));
}

function is_alpha($actAsciiVal)
{
		return ((($actAsciiVal>=97) && ($actAsciiVal<=122))||
		(($actAsciiVal>=65)&&($actAsciiVal<=90)) || 
		(($actAsciiVal>=48) && ($actAsciiVal<=57)) ||
		($actAsciiVal==95));
}

function is_char_uppercased($actAsciiVal)
{
	return (($actAsciiVal>=65)&&($actAsciiVal<=90));
}

function is_digit($actAsciiVal)
{
 return (($actAsciiVal>=48) && ($actAsciiVal<=57)); 
}

function convertPointToComma($actValue)
{
	return str_replace(STRING_POINT,STRING_COMMA,$actValue);
}

function matrix_getColumnByName($actMatrix,$actFieldName)
{
 $retVal = array();
 $i=0;
 foreach($actMatrix as $row)
 {
 	$retVal[$i++] = $row[$actFieldName];
 }
 return $retVal;
}

function getGgMmAa()
{
	$date = getDate();
  $day = $date['mday'];
  $month = $date['mon'];
  $year = $date['year'];
  $year = substr($year,strlen($year)-2,2);
  return $day . STRING_SLASH . $month . STRING_SLASH . $year;
}

function getGgMmAaaa()
{
	$date = getDate();
  $day = $date['mday'];
  $month = $date['mon'];
  $year = $date['year'];
  return $day . STRING_SLASH . $month . STRING_SLASH . $year;
}


function array_getDistinctValues($actRow)
{
	$newRow = array();
	$i=0;
	foreach($actRow as $ind=>$val)
	{
		if(! in_array($actRow[$ind],$newRow))
		{
		 $newRow[$i] = $actRow[$ind];
	   $i++;
	  }
	}
	return $newRow;
}

// Adds so many characters $actChar to the argument string $actStr to arrive 
// to the value of the argument $actLenght.
function strComplete($actStr,$actChar,$actLength)
{
 $strLength = strlen($actStr);
 if(($actLength - $strLength)>0)
  for($i=0;$i<=($actLength - $strLength);$i++)
  {
   $actStr = $actStr . $actChar;	
  }
 return $actStr;
}

// It searches the element $actItem in the matrix $actMat
// If the element is found it returns true, otherwise it returns false.
//
function in_matrix($actItem,$actMat)
{
	foreach($actMat as $ind => $val)
	{
		if(is_array($val))
		{
		 if(in_matrix($actItem,$val))
		  return true;
	  }
	  else
	  {
	  	if($val==$actItem)
	  	 return true;
	  }
	}
 return false;
}

function isWholeAlpha($actStr)
{
 if (! preg_match("/^[a-zA-Z]*$/",$actStr))
	return false;
 return true;
}

function timeDiff($actInitTime,$actEndTime)
{	
	$initTimeItems = explode(STRING_COLON,$actInitTime);
	$endTimeItems = explode(STRING_COLON,$actEndTime);
	
	$initSec = $initTimeItems[2];
	$endSec = $endTimeItems[2];

	$initMin = $initTimeItems[1];
	$endMin = $endTimeItems[1];

	$initHour = $initTimeItems[0]; 
	$endHour = $endTimeItems[0]; 

	$totInitSec = $initSec + $initMin * 60 + $initHour * 3600;
	$totEndSec = $endSec + $endMin * 60 + $endHour * 3600;
	$totDiffSec = $totEndSec - $totInitSec;
	
	return $totDiffSec; 
}

function str_right($actStr,$actNum)
{
	if($actNum>0)
	 return substr($actStr,strlen($actStr)-$actNum,$actNum);
  else
   return false;
}

function str_left($actStr,$actNum)
{
 if($actNum>0)
  return substr($actStr,0,$actNum);
 else
  return false;
}

function is_uppercased($actStr)
{
	$newUCStr = ucfirst($actStr);
	return ! strcmp($newUCStr,$actStr);
}

function fixSecurityOnSqlArg($actArg)
{
 $arg1 = str_replace(STRING_SINGLE_QUOTE,STRING_NULL,$actArg);
 $arg2 = str_replace(STRING_BACKSLASH,STRING_NULL,$arg1);
 return str_replace(STRING_DOUBLE_QUOTE,STRING_NULL,$arg2);
}


function isAnIpNumber($actVal)
{
 $actVal = trim($actVal);

 if (! preg_match("/^((([1|2])?([0-9])?[0-9])\.){1,3}(([1|2])?([0-9])?[0-9])?$/",$actVal))
	return false;

 $items = explode(".",$actVal);	
 $classa = $items[0] + 0;
 if(isset($items[1]))
  $classb = $items[1] + 0;
 else
  $classb=0;
 if (isset($items[2]))
  $classc = $items[2] + 0;
 else
  $classc=0;
 if (isset($items[3]))
  $classd = $items[3] + 0;
 else
  $classd=0;
	
 if (($classa>=0)&&($classa<=255))
  if(($classb>=0)&&($classb<=255))
	 if(($classc>=0)&&($classc<=255))
	  if(($classd>=0)&&($classd<=255))
		 return true;

 return false;
}

function isTypeDataValueNormalized($actVal)
{
 $actVal = trim($actVal);
 if (preg_match("/^([0|1|2|3]?[0-9])\/([0|1]?[0-9])\/([1|2][0|9][0-9][0-9])$/",$actVal))
  return true;
 else
  return false;
}


//
// The argument must be in the format gg/mm/aaaa
//
function convertToMySqlDataType($actFieldValue)
{
 $items = explode(STRING_SLASH,$actFieldValue);
 $day = $items[0];
 $month = $items[1];
 $year = $items[2];
 $newValue = $year . DATA_ITEMS_SEP . $month . DATA_ITEMS_SEP . $day;
 return $newValue;
}

function item_in_array_keys($actKey,$actArray)
{
 foreach($actArray as $key=>$val)
 {
  if ($actKey === $key)
	{
	 return true;
  }
 }
 return false;
}

function array_stretch($actArray)
{
 $newArray = array();
 $num = count($actArray);
 $j=0;
 for($i=0;$i<=$num-1;$i++)
 {
  if(is_array($actArray[$i]))
	{
	 $innerArray = $actArray[$i];
	 $num1 = count($innerArray);	 
	 for($k=0;$k<=$num1-1;$k++)
	  $newArray[$j++] = $innerArray[$k];
	}
	else
	  $newArray[$j++] = $actArray[$i];
 }
 return $newArray;
}

function array_join_string_to_all($actArray,$actString)
{
 $num = count($actArray);
 for($i=0;$i<=$num-1;$i++)
 {
  $actArray[$i] = $actArray[$i] . $actString;
 }
 return $actArray;
 
}

function array_deleteItemByKey($actRow,$actKey)
{
 $newRow = array();
 foreach($actRow as $key => $value)
 {
  if($key !== $actKey)
	 $newRow[$key] = $value;
 }
 return $newRow;
}

function array_getKey($actRow,$actVal)
{
 foreach($actRow as $key => $value)
 {
  if($value === $actVal)
	{
    return $key;
  }
 }
}

function array_deleteItem($actRow,$actVal)
{
 $newRow = array();
 foreach($actRow as $key => $value)
 {
  if($value != $actVal)
	 $newRow[$key] = $value;
 }
 return $newRow;
}

function array_addItemAtFirst($actRow,$actKey,$actVal)
{
 $newRow = array();
 $newRow[$actKey] = $actVal;
 foreach($actRow as $key => $value)
  $newRow[$key] = $value;
 return $newRow;
}

function array_addItemAtLast($actRow,$actKey,$actVal)
{
 $newRow = array();
 foreach($actRow as $key => $value)
  $newRow[$key] = $value;
  $newRow[$actKey] = $actVal;
 return $newRow;
}

function array_addBlankItemAtFirst($actRow)
{
 $newRow = array();
 $newRow[STRING_NULL] = STRING_NULL;
 foreach($actRow as $key => $value)
  $newRow[$key] = $value;
 return $newRow;
}

function array_addBlankItemAtLast($actRow)
{
 $newRow = array();
 foreach($actRow as $key => $value)
  $newRow[$key] = $value;
 $newRow[STRING_NULL] = STRING_NULL; 
 return $newRow;
}

function array_copy($actBuf,$actArray)
{
 $num = count($actArray);
 foreach($actArray as $key => $val)
  $actBuf[$key] = $val;
 
 return $actBuf;
}

// It concats two arrays considering them
// as associative
function array_assoc_concat($actArray1,$actArray2)
{
 foreach($actArray2 as $key => $value)
 {
  $actArray1[$key] = $value;
 }
 return $actArray1;
}

// It concats two arrays considering them
// as normal
function array_concat($actArray1,$actArray2)
{
 $num2 = count($actArray2);
 for($i=0;$i<=$num2-1;$i++)
 {
  $actArray1[] = $actArray2[$i];
 }
 
 return $actArray1;
}

// it returns an array obtained using the elements of the first argument array
// as keys and the elements of second argument array
// as values.
function array_assoc($actArray1,$actArray2)
{
 $num = count($actArray1);
 $retArray = array();
 for($i=0;$i<=$num -1;$i++)
 {
  $retArray[$actArray1[$i]] = $actArray2[$i];
 }
 return $retArray;
}

function getMaxElementsLength($actArray)
{
 $num = count($actArray);
 $max=0;
 for($i=0;$i<=$num-1;$i++)
 {
  if (is_string($actArray[$i]))
  {
	 $actLength = strlen($actArray[$i]);
   if ($actLength > $max)
	  $max = $actLength;
	}
 }
 return $max;
}

?>
