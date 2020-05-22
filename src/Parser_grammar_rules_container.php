<?
namespace Cheope_ppp_ns\src;

require_once("Container.php");
require_once("Iiterator.php");
require_once("Parser_grammar_rule.php");

class Parser_grammar_rules_container extends Container
{
	function __construct($actName=STRING_NULL)
	{
   parent::__construct($actName);		
	}
	
 function setParserGrammarRules($actNodes)
 {
  parent::setContents($actNodes);
 }
 
 function &getParserGrammarRules()
 {
 	$contents = &parent::getContents();
  return $contents;
 }

 function createIterator()
 {
 	return new Parser_grammar_rules_iterator($this);
 }
 
 function setElement($actParserGrammarRule,$actPos)
 {
 	$parserGrammarRules = &$this->getParserGrammarRules();
 	if(($actPos < count($parserGrammarRules)) && ($actPos>=0))
 	{
 	 $parserGrammarRules[$actPos] = $actParserGrammarRule;
 	 return true;
 	}
 	else
 	 return false;
 }
 
 function &getElement($actPos)
 {
 	$parserGrammarRules = &$this->getParserGrammarRules();
 	if(($actPos < count($parserGrammarRules)) && ($actPos>=0))
 	{
 	 return $parserGrammarRules[$actPos];
 	}
 	else
 	{
 	 $parserGrammarRule = false;
 	 return $parserGrammarRule;
  }
 }
 
 function add($actParserGrammarRules)
 {
  $parserGrammarRules = &$this->getParserGrammarRules();
	$parserGrammarRules[] = $actParserGrammarRules;
 }

 function deleteItem($actPos)
 {
  $parserGrammarRules = &$this->getParserGrammarRules();
  $num = count($parserGrammarRules);
  if(($actPos <= $num-1)&&($actPos>=0))
  {
	 unset($parserGrammarRules[$actPos]);
	 for($i=$actPos;$i<=$num-1;$i++)
	 {
	  $j=$i+1;
	  if($j<=$num-1)
	   $parserGrammarRules[$i]=$parserGrammarRules[$j];
	  else
	   unset($parserGrammarRules[$i]);
	 }
	 return true;
	}
	else
	 return false;
 }

 function &getParserGrammarRule($actParserGrammarRuleName)
 {
  $parserGrammarRules = &$this->getParserGrammarRules();
  foreach($parserGrammarRules as $parserGrammarRule)
  {
   if($parserGrammarRule->getName()==$actParserGrammarRuleName)
   {
  	return $parserGrammarRule;
   }
  }
  $parserGrammarRule = NULL;
  return $parserGrammarRule; 	
 }	
	
}


class Parser_grammar_rules_iterator extends Iiterator
{
  function __construct($actObj)
 	{
 	  parent::__construct($actObj);
 	}
 	 
 	function &next()
	{
	 $obj = &$this->getObj();
   $parserGrammarRules = &$obj->getParserGrammarRules();
	 if (count($parserGrammarRules)>0)
	 {
	  $nextParserGrammarRule = next($parserGrammarRules);
	  if ($nextParserGrammarRule) 
	   return $nextParserGrammarRule; 
   } 
   $parserGrammarRule = NULL;
	 return $parserGrammarRule;
	}
	
	function reset()
	{
	 $obj = &$this->getObj();
   $parserGrammarRules = &$obj->getParserGrammarRules();
	 if (count($parserGrammarRules)>0)
	 {
	  reset($parserGrammarRules);
	  return true;
	 }
	 else
	  return false;
	}
	
	function &current()
	{
	 $obj = &$this->getObj();
   $parserGrammarRules = &$obj->getParserGrammarRules();
	 if (count($parserGrammarRules)>0)
	 { 
	  $curParserGrammarRule = current($parserGrammarRules);
	  if ($curParserGrammarRule)
	   return $curParserGrammarRule; 
   } 
   $parserGrammarRule = NULL;
	 return NULL;  
	}
	
	function hasMore()
	{
		$obj = &$this->getObj();
		$parserGrammarRules = &$obj->getParserGrammarRules();
	  $nextParserGrammarRule = current($parserGrammarRules);
	  if ($nextParserGrammarRule) 
	  {
	   return true;
	  }
	  else
	   return false; 
	}		
}

?>