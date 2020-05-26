<?
namespace Cheope_ppp_ns\grammar_rule_gen;

require_once(__DIR__ . "/../src/Parser_grammar_rule.php");

define('PRODUZ_1_GRAMMAR_RULE',"Produz_1");


class Parser_grammar_rule_produz_1 extends \Cheope_ppp_ns\src\Parser_grammar_rule
{
	
 var $leftTerm;
 var $rightElements = array();
 var $rightPos=0;

 function __construct()
 {
 	parent::__construct(PRODUZ_1_GRAMMAR_RULE);
 }
 
 function init()
 {
 	$this->setRightPos(0);
  $this->setRightElements(array());
  $this->setLeftTerm(STRING_NULL);
 }
 
 function getLeftTerm()
 {
 	return $this->leftTerm;
 }
 
 function setLeftTerm($actLeftTerm)
 {
  $this->leftTerm = $actLeftTerm;
 }
 
 function &getRightElements()
 {
 	return $this->rightElements;
 }
 
 function setRightElements($actRightElements)
 {
 	$this->rightElements = $actRightElements;
 }
 
 function getRightPos()
 {
 	return $this->rightPos;
 }
 
 function setRightPos($actRightPos)
 {
 	$this->rightPos = $actRightPos; 
 }
 
 function getTokensBufferPointer()
 {
 	$parser = &$this->getParser();
 	$tokensBufferIter = &$parser->getTokensBufferIterator();
 	
 	return ($tokensBufferIter->pos());
 }
 
 function backtrack($actTokensBufferPointer)
 {
 	$parser = &$this->getParser();
 	$tokensBufferIter = &$parser->getTokensBufferIterator();
 	$tokensBufferIter->reset();
 	$i=0;
 	
 	while($i <= $actTokensBufferPointer-1)
 	{
 	 $tokensBufferIter->next();
 	 $i++;
 	}
 }
 
 //
 // It is possible to stack up to ten equal items...after
 // then it fails.
 //
 function pushRightElement($actEl,$actRightPos)
 {
 	$rightElements = &$this->getRightElements();
 	$buf = array();
 	$ct=0;
 	foreach($rightElements as $ind=>$rightElement)
 	{
 	 if(($ind==$actEl)||(((strpos($ind,$actEl)===0)) && (strlen($ind)==strlen($actEl)+3)))
 	 {
 	  $newInd = $actEl . "(" . $ct++ . ")";
 	 }
 	 else
 	  $newInd = $ind;
 	 $buf[$newInd] = $rightElement;
 	}
 	$buf[$actEl] = $actRightPos;
 	$this->setRightElements($buf);
 }
 
 
 // Entry point for the rule.
 //
 function exec()
 {	
 	$parser = &$this->getParser();
 	$lex = &$parser->getLex();
 	$localTokensBufferPointer = $this->getTokensBufferPointer();
 		
 	$res11=false;
 	$res12=false;
 	$res13=false;
 	$res14=false;

 	$res11 = $this->produzLeft();
 	
 	if (! $res11)
 	{
 	 $this->backtrack($localTokensBufferPointer);
 	}
 	else 
 	{
 	 $res12 = $parser->match(\Cheope_ppp_ns\src\Token::TYPE_SPECIAL_ITEM,TOKEN_VAL_EQUAL);
 	 if(! $res12)
 	 {
 	 	$this->backtrack($localTokensBufferPointer);
 	 }
 	 else
 	 {
 	  $res13 = $this->produzRight();
 	 }
 	}
 	
 	
 	$res1 = $res11 && $res12 && $res13;
 	
 	$res = $res1;
 	
 	if (! $res)
 	 return false;
 	
 	return true;
 }
 
 function space()
 {
 	$parser = &$this->getParser();
  
  $localTokensBufferPointer = $this->getTokensBufferPointer();
  
  $res1 = $parser->match(\Cheope_ppp_ns\src\Token::TYPE_DELIM,TOKEN_VAL_WS);
  if(! $res1)
   $this->backtrack($localTokensBufferPointer);
   
  $res2 = true;
  
  $res = $res1 || $res2;
  
 	if (! $res)
 	 return false; 		
  
  return true; 
 }
 
 function produzLeft()
 {
 	$parser = &$this->getParser();
  $lex = &$parser->getLex();
  
  $localTokensBufferPointer = $this->getTokensBufferPointer();
  
  $res11 = false;
  $res12 = false;
  $res13 = false;
  
  $res11 = $this->space();
  if(! $res11)
  {
   $this->backtrack($localTokensBufferPointer);
  }
  else
  {
   $tok = &$parser->getCurrentToken();
   $res12 = $parser->match(\Cheope_ppp_ns\src\Token::TYPE_LEXICAL_ELEMENT,TOKEN_VAL_NONTERMINALE);
   if(! $res12)
   {
    $this->backtrack($localTokensBufferPointer);
   }
   else
   {
   	$this->setLeftTerm($tok->getLexema());
   	$res13 = $this->space();
    if(! $res13)
    {
     $this->backtrack($localTokensBufferPointer);
    }
   }
  }
  
  $res1 = $res11 && $res12 && $res13;
  
  $res = $res1;
   
 	if (! $res)
 	 return false; 		
  
  return true; 
 }
 
 function produzRight()
 {
 	$parser = &$this->getParser();
 	$lex = &$parser->getLex();

  $localTokensBufferPointer = $this->getTokensBufferPointer();
  
  $res11 = false;
  $res12 = false;
  $res13 = false;
  
  $res11 = $this->space();
  
  if(!$res11)
  {
   $this->backtrack($localTokensBufferPointer);
  }
  else
  {
   $res12 = $this->produzRight1();
   if(!$res12)
   {
   	$this->backtrack($localTokensBufferPointer);
   }
   else
   {
   	$res13 = $this->space();
    if(! $res13)
    {
     $this->backtrack($localTokensBufferPointer);
    }
   }
  }
  
  $res1 = $res11 && $res12 && $res13;

  $res = $res1;
   
 	if (! $res)
 	 return false; 		
  
  return true;
 }
 
 function produzRight1()
 {
 	$parser = &$this->getParser();
 	$lex = &$parser->getLex();

  $localTokensBufferPointer = $this->getTokensBufferPointer();
  
  $res11 = false;
  $res12 = false;
  $res13 = false;
  
  $res21 = false;
  $res22 = false;
  $res23 = false;
  
  $tok = &$parser->getCurrentToken();
  $res11 = $parser->match(\Cheope_ppp_ns\src\Token::TYPE_LEXICAL_ELEMENT,TOKEN_VAL_TERMINALE); 
  if(! $res11)
  {
   $this->backtrack($localTokensBufferPointer);
  }
  else
  {
   $rightPos = $this->getRightPos();
   $this->pushRightElement($tok->getLexema(),$rightPos);   
   $res12 = $this->space();
   if(! $res12)
   {
    $this->backtrack($localTokensBufferPointer);
   }
   else
   {
   	$res13 = $this->produzRight2();
   	if(! $res13)
   	 $this->backtrack($localTokensBufferPointer);
   }
  }
  
  $res1 = $res11 && $res12 && $res13;
  
  if(! $res1)
  {
   $tok = &$parser->getCurrentToken();
   $res21 = $parser->match(\Cheope_ppp_ns\src\Token::TYPE_LEXICAL_ELEMENT,TOKEN_VAL_NONTERMINALE);
   if(! $res21)
   {
   	$this->backtrack($localTokensBufferPointer);
   }
   else
   {
    $rightPos = $this->getRightPos();
    $this->pushRightElement($tok->getLexema(),$rightPos);
   	$res22 = $this->space();
    if(! $res22)
    {
     $this->backtrack($localTokensBufferPointer);
    }
    else
    {
     $res23 = $this->produzRight2();
     if(! $res23)
      $this->backtrack($localTokensBufferPointer);
    }
   }
  
   $res2 = $res21 && $res22 && $res23;
  }
        
       
  $res = $res1 || $res2;
   
 	if (! $res)
 	 return false; 		
  
  return true;
 }
 
 function produzRight2()
 {
 	$parser = &$this->getParser();
 	$lex = &$parser->getLex();

  $localTokensBufferPointer = $this->getTokensBufferPointer();
  
  $res11 = false;
  
  $res21 = false;
  $res22 = false;
  $res23 = false;
  
  $res11 = $this->produzRight1();
  if(! $res11)
   $this->backtrack($localTokensBufferPointer);
   
  $res1 = $res11;
  
  if(! $res1)
  {
   $res21 = $parser->match(\Cheope_ppp_ns\src\Token::TYPE_SPECIAL_ITEM,TOKEN_VAL_OR);
   if(! $res21)
   {
    $this->backtrack($localTokensBufferPointer);
   }
   else
   {
    $rightPos = $this->getRightPos();
    $rightPos++;
    $this->setRightPos($rightPos);
   	$res22 = $this->space();
   	if(! $res22)
   	{
   	 $this->backtrack($localTokensBufferPointer);
   	}
   	else
   	{
     $res23 = $this->produzRight1();
     if(! $res23)
     {
      $this->backtrack($localTokensBufferPointer);
     }
    }
   }
  }
  
  $res2 = $res21 && $res22 && $res23;
  
  $res3 = true;
       
  $res = $res1 || $res2 || $res3;
   
 	if (! $res)
 	 return false; 		
  
  return true;
 }

}




?>