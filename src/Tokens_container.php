<?
namespace Cheope_ppp_ns\src;

require_once("Iiterator.php");
require_once("Container.php");
require_once("Token.php");

class Tokens_container extends Container
{	
	
	function __construct($actName=STRING_NULL)
	{
		parent::__construct($actName);
	}
	
	function setTokens($actFields)
	{
		parent::setContents($actFields);
	}
	
	function &getTokens()
	{
 	 $contents = &parent::getContents();
   return $contents;
	}
	
	function createIterator()
	{
		$tokenIter = new Tokens_iterator($this);
		return $tokenIter;
	}
	
	function setElement($actToken,$actPos)
	{
 	 $tokens = &$this->getTokens();
 	 if(($actPos < count($tokens)) && ($actPos>=0))
 	 {
 	  $tokens[$actPos] = $actToken;
 	  return true;
 	 }
 	 else
 	  return false;
	}
	
	function &getElement($actPos)
	{
 	 $tokens = &$this->getTokens();
 	 if(($actPos < count($tokens)) && ($actPos>=0))
 	 {
 	  return $tokens[$actPos];
 	 }
 	 else
 	  return false;
	}
	
  function add($actToken)
  {
   $tokens = &$this->getTokens();
	 $tokens[] = $actToken;
  }
  
  
  function deleteItem($actPos)
  {
   $tokens = &$this->getTokens();
   $num = count($tokens);
   if(($actPos <= $num-1)&&($actPos>=0))
   {
	  unset($tokens[$actPos]);
	  for($i=$actPos;$i<=$num-1;$i++)
	  {
	   $j=$i+1;
	   if($j<=$num-1)
	    $tokens[$i]=$ints[$j];
	   else
	    unset($tokens[$i]);
	  }
	 }
	 else
	  return false;
  }  
  
  function &getToken($actTokenName)
  {
  	$tokens = &$this->getTokens();
  	foreach($tokens as $token)
  	{
  		if($token->getName()==$actTokenName)
  		{
  			return $token;
  		}
  	}
  	return NULL;
  }
  	
}


class Tokens_iterator extends Iiterator
{
  function __construct($actObj)
 	{
 	  parent::__construct($actObj);
 	}
 	
 	function pos()
 	{
 	 $obj = &$this->getObj();
 	 $tokens = &$obj->getTokens();
 	 return key($tokens);
 	}
 	
 	function end()
 	{
 	 $obj = &$this->getObj();
   $tokens = &$obj->getTokens();
	 if (count($tokens)>0)
	 {
	  end($tokens);
	  return true;
	 }
	 else
	  return false;
 	}
 	 
 	function &next()
	{
	 $obj = &$this->getObj();
   $tokens = &$obj->getTokens();
	 if (count($tokens)>0)
	 {
	  $nextToken = next($tokens);
	  if ($nextToken) 
	   return $nextToken; 
   } 
   $token = NULL;
	 return $token;
	}
	
	function &previous()
 	{
	 $obj = &$this->getObj();
   $tokens = &$obj->getTokens();
	 if (count($tokens)>0)
	 {
	  $nextToken = prev($tokens);
	  if ($nextToken) 
	   return $nextToken; 
   } 
   $token = NULL;
	 return $token;
 	}
	
	function reset()
	{
	 $obj = &$this->getObj();
   $tokens = &$obj->getTokens();
	 if (count($tokens)>0)
	 {
	  reset($tokens);
	  return true;
	 }
	 else
	  return false;
	}
	
	function &current()
	{
	 $obj = &$this->getObj();
   $tokens = &$obj->getTokens();
	 if (count($tokens)>0)
	 { 
	  $curToken = current($tokens);
	  if ($curToken)
	   return $curToken; 
   } 
   $token = NULL;
	 return $token;  
	}
	
	function hasMore()
	{
		$obj = &$this->getObj();
		$tokens = &$obj->getTokens();
	  $nextToken = current($tokens);
	  if ($nextToken) 
	  {
	   return true;
	  }
	  else
	   return false; 
	}		
}

?>