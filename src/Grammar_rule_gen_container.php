<?
namespace Cheope_ppp_ns\src;

require_once("Container.php");
require_once("Iiterator.php");
require_once("Grammar_rule_gen.php");

class Grammar_rule_gen_container extends Container
{
	function __construct($actName="")
	{
   parent::__construct($actName);		
	}
	
 function setGrammarRuleGens($actNodes)
 {
  parent::setContents($actNodes);
 }
 
 function &getGrammarRuleGens()
 {
 	$contents = &parent::getContents();
  return $contents;
 }

 function createIterator()
 {
 	return new Grammar_rule_gens_iterator($this);
 }
 
 function setElement($actGrammarRuleGen,$actPos)
 {
 	$grammarRuleGens = &$this->getGrammarRuleGens();
 	if(($actPos < count($grammarRuleGens)) && ($actPos>=0))
 	{
 	 $grammarRuleGens[$actPos] = $actGrammarRuleGen;
 	 return true;
 	}
 	else
 	 return false;
 }
 
 function &getElement($actPos)
 {
 	$grammarRuleGens = &$this->getGrammarRuleGens();
 	if(($actPos < count($grammarRuleGens)) && ($actPos>=0))
 	{
 	 return $grammarRuleGens[$actPos];
 	}
 	else
 	{
 	 $grammarRuleGen = false;
 	 return $grammarRuleGen;
  }
 }
 
 function add($actGrammarRuleGen)
 {
  $grammarRuleGens = &$this->getGrammarRuleGens();
	$grammarRuleGens[] = $actGrammarRuleGen;
 }

 function deleteItem($actPos)
 {
  $grammarRuleGens = &$this->getGrammarRuleGens();
  $num = count($grammarRuleGens);
  if(($actPos <= $num-1)&&($actPos>=0))
  {
	 unset($grammarRuleGens[$actPos]);
	 for($i=$actPos;$i<=$num-1;$i++)
	 {
	  $j=$i+1;
	  if($j<=$num-1)
	   $grammarRuleGens[$i]=$grammarRuleGens[$j];
	  else
	   unset($grammarRuleGens[$i]);
	 }
	 return true;
	}
	else
	 return false;
 }

 function &getGrammarRuleGen($actGrammarRuleGenId)
 {
  $grammarRuleGens = &$this->getGrammarRuleGens();
  foreach($grammarRuleGens as $grammarRuleGen)
  {
   if($grammarRuleGen->getInterfaceId()==$actGrammarRuleGenId)
   {
  	return $grammarRuleGen;
   }
  }
  $grammarRuleGen = NULL;
  return $grammarRuleGen; 	
 }	
	
}


class Grammar_rule_gens_iterator extends Iiterator
{
  function __construct($actObj)
 	{
 	  parent::__construct($actObj);
 	}
 	 
 	function &next()
	{
	 $obj = &$this->getObj();
   $grammarRuleGens = &$obj->getGrammarRuleGens();
	 if (count($grammarRuleGens)>0)
	 {
	  $nextGrammarRuleGen = next($grammarRuleGens);
	  if ($nextGrammarRuleGen) 
	   return $nextGrammarRuleGen; 
   } 
   $grammarRuleGen = NULL;
	 return $grammarRuleGen;
	}
	
	function reset()
	{
	 $obj = &$this->getObj();
   $grammarRuleGens = &$obj->getGrammarRuleGens();
	 if (count($grammarRuleGens)>0)
	 {
	  reset($grammarRuleGens);
	  return true;
	 }
	 else
	  return false;
	}
	
	function &current()
	{
	 $obj = &$this->getObj();
   $grammarRuleGens = &$obj->getGrammarRuleGens();
	 if (count($grammarRuleGens)>0)
	 { 
	  $curGrammarRuleGen = current($grammarRuleGens);
	  if ($curGrammarRuleGen)
	   return $curGrammarRuleGen; 
   } 
   $curGrammarRuleGen = NULL;
	 return NULL;  
	}
	
	function hasMore()
	{
		$obj = &$this->getObj();
		$grammarRuleGens = &$obj->getGrammarRuleGens();
	  $nextGrammarRuleGen = current($grammarRuleGens);
	  if ($nextGrammarRuleGen) 
	  {
	   return true;
	  }
	  else
	   return false; 
	}		
}

?>