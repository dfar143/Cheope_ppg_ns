<?
class Profiler
{
 var $startTime;
 var $endTime;
 var $totTimeSec;

 function Profiler()
 {
 }
 
 function getmicrotime()
 { 
  list($usec, $sec) = explode(" ",microtime()); 
  return ((float)$usec + (float)$sec); 
 }
 
 function start()
 {
 	$this->startTime = $this->getmicrotime();
 }
 
 function end()
 {
 	$this->endTime = $this->getmicrotime();
 	$this->totTimeSec = $this->totTimeSec + 
 	($this->endTime - $this->startTime);
 }
 
 function reset()
 {
 	$this->totTimeSec = 0.0;
 }
 
 function print_profile()
 {
 	
 	echo "<BR/>";
 	echo "Tempo:$this->totTimeSec<BR/>";
  echo "<BR/>";
  
 }
 
}

?>