<?
namespace Cheope_ppp_ns\src;

require_once("generic_const.php");

abstract class Iiterator
{
	var $obj;
	
	function __construct($actObj)
	{
		$this->obj = $actObj;
	}
	
	function &getObj()
	{
	 return $this->obj;
	}
	
	function setObj($actObj)
	{
		$this->obj = $actObj;
	}
	
abstract	function &next();
	
abstract	function reset();
	
abstract	function &current();
	
abstract	function hasMore();

}

?>