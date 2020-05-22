<?
namespace Cheope_ppp_ns\src;

require_once("Container.php");
require_once("Iiterator.php");
require_once("Lex_rule.php");

class Lex_rules_container extends Container
{
	function __construct($actName=STRING_NULL)
	{
   parent::__construct($actName);		
	}
	
 function setLexRules($actRules)
 {
  parent::setContents($actRules);
 }
 
 function &getLexRules()
 {
 	$contents = &parent::getContents();
  return $contents;
 }

 function createIterator()
 {
 	$iter = new Lex_rules_iterator($this);
 	return $iter;
 }
 
 function setElement($actRule,$actPos)
 {
 	$rules = &$this->getLexRules();
 	if(($actPos < count($rules)) && ($actPos>=0))
 	{
 	 $rules[$actPos] = $actRule;
 	 return true;
 	}
 	else
 	 return false;
 }
 
 function &getElement($actPos)
 {
 	$rules = &$this->getLexRules();
 	if(($actPos < count($rules)) && ($actPos>=0))
 	{
 	 return $rules[$actPos];
 	}
 	else
 	 return false;
 }
 
 function add($actRule)
 {
  $rules = &$this->getLexRules();
	$rules[] = $actRule;
 }

 function deleteItem($actPos)
 {
  $rules = &$this->getLexRules();
  $num = count($rules);
  if(($actPos <= $num-1)&&($actPos>=0))
  {
	 unset($rules[$actPos]);
	 for($i=$actPos;$i<=$num-1;$i++)
	 {
	  $j=$i+1;
	  if($j<=$num-1)
	   $rules[$i]=$rules[$j];
	  else
	   unset($rules[$i]);
	 }
	}
	else
	 return false;
 }

 function &getLexRule($actRuleName)
 {
  $rules = &$this->getLexRules();
  foreach($rules as $rule)
  {
   if($rule->getName()==$actRuleName)
   {
  	return $rule;
   }
  }
  return NULL; 	
 }	
	
}


class Lex_rules_iterator extends Iiterator
{
  function __construct($actObj)
 	{
 	  parent::__construct($actObj);
 	}
 	 
 	function &next()
	{
	 $obj = &$this->getObj();
   $rules = &$obj->getLexRules();
	 if (count($rules)>0)
	 {
	  $nextRule = next($rules);
	  if ($nextRule) 
	   return $nextRule; 
   } 
   $rule = NULL;
	 return $rule;
	}
	
	function reset()
	{
	 $obj = &$this->getObj();
   $rules = &$obj->getLexRules();
	 if (count($rules)>0)
	 {
	  reset($rules);
	  return true;
	 }
	 else
	  return false;
	}
	
	function &current()
	{
	 $obj = &$this->getObj();
   $rules = &$obj->getLexRules();
	 if (count($rules)>0)
	 { 
	  $curRule = current($rules);
	  if ($curRule)
	   return $curRule; 
   } 
   $rule = NULL;
	 return $rule;  
	}
	
	function hasMore()
	{
		$obj = &$this->getObj();
		$rules = &$obj->getLexRules();
	  $nextRule = current($rules);
	  if ($nextRule) 
	  {
	   return true;
	  }
	  else
	   return false; 
	}		
}

?>