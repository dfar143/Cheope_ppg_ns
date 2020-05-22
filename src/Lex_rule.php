<?
namespace Cheope_ppp_ns\src;

require_once("generic_fun.php");
require_once("Token.php");

class Lex_rule
{
	var $name;
	var $regexp;
	var $currentToken;
	var $tokenType;
	var $tokenVal;
	var $currentLexema;

	function __construct($actName)
	{
		$this->setName($actName);
	}
	
	function setName($actName)
	{
		$this->name = $actName;
	}
	
	function getName()
	{
		return $this->name;
	}
	
	function setRegexp($actRegexp)
	{
		$this->regexp = $actRegexp;
	}
	
	function getRegexp()
	{
		return $this->regexp;
	}
	
	function getTokenType()
	{
		return $this->tokenType;
	}
	
	function setTokenType($actTokenType)
	{
		$this->tokenType = $actTokenType;
	}
	
	function getTokenVal()
	{
		return $this->tokenVal;
	}
	
	function setTokenVal($actTokenVal)
	{
		$this->tokenVal = $actTokenVal;
	}
	
	function getCurrentToken()
	{
		return $this->currentToken;
	}
	
	function setCurrentToken($actToken)
	{
		$this->currentToken = $actToken;
	}
		
	function getCurrentLexema()
	{
		return $this->currentLexema;
	}
	
	function setCurrentLexema($actLexema)
	{
		$this->currentLexema = $actLexema;
	}
	
	function execMatch($actStr)
	{
		$regexp = $this->getRegexp();
		$this->setCurrentLexema($actStr);
		$arrayOfMatches = array();
		if ($matchedStr = preg_match($regexp,$actStr,$arrayOfMatches))
		{
			$token = new Token();
			$type = $this->getTokenType();
			$token->setType($type); 
		  $val = $this->getTokenVal();
			$token->setVal($val);
			$token->setLexema($arrayOfMatches[0]);
			$this->setCurrentToken($token);
			return $arrayOfMatches[0];			
		}
		else
		 return false;
	}	
}

?>