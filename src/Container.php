<?
namespace Cheope_ppp_ns\src;

require_once("generic_const.php");

abstract class Container
{
	var $name;
	var $contents = array();
	
	function __construct($actName="")
	{
		$this->name = $actName;
	}
	
	function getName()
	{
		return $this->name;
	}
	
	function setName($actName)
	{
		$this->name = $actName;
	}
	
	function count()
	{
		return count($this->contents);
	}
	
	function setContents($actContents)
	{
		$this->contents = $actContents;
	}
	
	function &getContents()
	{
		return $this->contents;
	}
	

abstract	function setElement($actItem,$actPos);

abstract	function &getElement($actPos);
	
abstract	function add($actItem);
	
abstract	function deleteItem($actPos);
	
}


?>