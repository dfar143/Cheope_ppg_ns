<?
namespace Cheope_ppp_ns\src;

require_once("Parser.php");

abstract class Parser_grammar_rule
{
	private $name;
	private $parser=null;
  
	function __construct($actName)
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
	
	function &getParser()
	{
		return $this->parser;
	}
	
	function setParser($actParser)
	{
		$this->parser = $actParser;
  }
		
	abstract function exec();
}





?>