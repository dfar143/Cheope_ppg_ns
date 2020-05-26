<?
namespace Cheope_ppp_ns\grammar_rule_gen;

require_once(__DIR__ .  "/../src/html_const.php");
require_once(__DIR__ . "/../src/Generic_interface.php");
require_once("Php_class_gen.php");
require_once(__DIR__ . "/../src/Parser.php");
require_once(__DIR__ . "/../src/Tokens_container.php");

class Grammar_rule_gen extends \Cheope_ppp_ns\src\Generic_interface
{
 const VAR_RES="res";
 const ERROR_1="Parser non presente.";	
 const RULE_SUFFIX="parser_grammar_rule";

 private $parser;
 private $phpClassGen;
 private $tokensContainer;
 private $phpOpenTagEnabled=false;
 private $phpCloseTagEnabled=false;
 private $prjName;

 function __construct($actNum)
 {
 	parent::__construct(STRING_NULL,INT_GRAMMAR_RULE_GEN,$actNum);
 }
 
 function setPrjName($actPrjName)
 {
 	$this->prjName = $actPrjName;
 } 
 
 function getPrjName()
 {
 	return $this->prjName;
 }
 
 function setPhpOpenTagEnabled($actPhpOpenTagEnabled)
 {
 	$this->phpOpenTagEnabled = $actPhpOpenTagEnabled;
 }
 
 function getPhpOpenTagEnabled()
 {
 	return $this->phpOpenTagEnabled ;
 }
 
 function setPhpCloseTagEnabled($actPhpCloseTagEnabled)
 {
 	$this->phpCloseTagEnabled = $actPhpCloseTagEnabled;
 }
 
 function getPhpCloseTagEnabled()
 {
 	return $this->phpCloseTagEnabled ;
 }
 
 function setPhpClassGen($actPhpClassGen)
 {
 	$this->phpClassGen = $actPhpClassGen;
 }
 
 function &getPhpClassGen()
 {
 	return $this->phpClassGen;
 }
 
 function &getTokensContainer()
 {
 	return $this->tokensContainer;
 }
 
 function setTokensContainer($actTokenContainer)
 {
 	$this->tokensContainer = $actTokenContainer;
 }
 
 function getTokenByLexema($actLexema)
 {
 	$tokensContainer = $this->getTokensContainer();
 	$tokensContIter = $tokensContainer->createIterator();
 	$tokensContIter->reset();
  while($tokensContIter->hasMore())
  {
   $tok = &$tokensContIter->current();
   $lexema = $tok->getLexema();
   $lexema = trim($lexema);
 	 if($lexema==$actLexema)
 	 {
 	  return $tok;  	
 	 }
 	 $tokensContIter->next();
  }
  return false;
 }
 
 function &getParser()
 {
 	return $this->parser;
 }
 
 function setParser($actParser)
 {
 	$this->parser = $actParser;
 }
 
 // The argument of this method contains the right elements array of the production.
 // The method has as index the name of the element (terminal or not terminal) 
 // and as value the position in the succession
 // of terminals and not terminals 
 // divided by OR
 // Example: Prod = ab ac ad | gh ab | ab
 // $actRightElements = array('ab(0)'=>0,'ac'=>0,'ad'=>0,'gh'=>1,'ab(1)'=>1,'ab'=>2)
 //
private function decompRightElements($actRightElements)
 {
 	$composedRightElements = array();
 	$composedRightElement = array();
 	$ct1=0;
 	$ct2=0;
 	$aRightVal = 0;
 	foreach($actRightElements as $ind=>$val)
 	{
 		if($val == $aRightVal)
 		{
 		 $composedRightElement[$ct2++] = $ind;
 		}
 		else
    {
 		 $aRightVal = $val;
 		 $composedRightElements[$ct1++] = $composedRightElement;
 		 $composedRightElement = array();
 		 $ct2=0;
 		 $composedRightElement[$ct2++] = $ind;
 		} 
 	}
 	
 	$composedRightElements[$ct1] = $composedRightElement;
 	return $composedRightElements;
 }
 
// 
// Generate the succession of 'if-else' branches in the not terminal method body.
// Is called by 'genMethodBodyBody' method.
//
private function genMethodBodyBodyInside($actRightElement,$actCt1,$actCt2)
 {
 	$parser = &$this->getParser();
 	$lex = &$parser->getLex();
 	$phpClassGen = &$this->getPhpClassGen();
 	$bodyInside = STRING_NULL;
 	if(isset($actRightElement[$actCt2]))
 	{
 	 $bodyInside .= $phpClassGen->EOL() . 'if(!' . '$' .  self::VAR_RES . ($actCt1) . ($actCt2+1) . ')';
 	 $bodyInside .= $phpClassGen->EOL() . '{';
 	 $bodyInside .= $phpClassGen->EOL() . '$this->backtrack($localTokensBufferPointer);';
 	 $bodyInside .= $phpClassGen->EOL() . '}';
 	 $bodyInside .= $phpClassGen->EOL() . 'else';
 	 $bodyInside .= $phpClassGen->EOL() . '{';

 	 $actCt2++;
 	 if(isset($actRightElement[$actCt2]))
 	 {
 	  $bodyInside .= $phpClassGen->EOL() . '$' .  self::VAR_RES . ($actCt1) . ($actCt2+1) . STRING_EQUAL . 
 	  $this->getCodeFromTransientLexema($actRightElement[$actCt2]) . ";";
 	  $bodyInside .= $phpClassGen->EOL() . $this->genMethodBodyBodyInside($actRightElement,$actCt1,$actCt2);
    $bodyInside .= $phpClassGen->EOL() . '}' . $phpClassGen->EOL();
   }
   else
   $bodyInside .= $phpClassGen->EOL() . '}' . $phpClassGen->EOL();
  }
  else
   $bodyInside=STRING_NULL;
  return $bodyInside;
 }
 
// 
// Used by the the method 'genMethodBodyBody'.
// Search the token in the symbols table
// using the lexema passed as argument.
// The method returns a string that is a parser 'match' call if the argument is a terminal 
// or a call to a teminal method if the argument is a non terminal.
//
private function getCodeFromTransientLexema($actComposedRightElement)
 { 
 	$prjName = $this->getPrjName();
 	$items = preg_split("/\(/",$actComposedRightElement);	
 	$actComposedRightElement = $items[0];
 	$body = '';
 	$phpClassGen = &$this->getPhpClassGen();
 	$parser = &$this->getParser();
 	$lex = &$parser->getLex(); 	
 	$tok1 = $lex->getTokenByLexema($actComposedRightElement);
 	$tok2 = $this->getTokenByLexema($actComposedRightElement);
 	if($tok2 != false)
 	 $tok3 = $tok2;
 	else
 	 $tok3 = $tok1;
 	$tokVal = $tok1->getVal();
 	$tokType = $tok1->getType();
 	if($tokVal == TOKEN_VAL_TERMINALE)
 	{
 	 $body .= '$parser->match(' . "\\Cheope_ppp_ns\\src\\Token::" . \Cheope_ppp_ns\src\Token::TYPE_SUFFIX . 
 	 STRING_UNDERSCORE . strtoupper($tok3->getType()) . 
 	 STRING_COMMA . strtoupper($prjName) . STRING_UNDERSCORE . "TOKEN" . 
 	 STRING_UNDERSCORE . \Cheope_ppp_ns\src\Token::VAL_SUFFIX . STRING_UNDERSCORE . strtoupper($tok3->getVal()) . 
 	 ')';
 	}
 	else
 	{
 	 $body .= '$this->' . $actComposedRightElement . '()'; 	 
  }
  return $body;
 }
 
//
//
// Returns the number of OR branches
// in the right elements array
// 
private function getNumOfOrBranches($actRightElements)
 {
 	$ct=0;
 	$num = count($actRightElements);
 	if($num>0)
 	{
 	 $ct=1;
 	 $itemVal = current($actRightElements);
   foreach($actRightElements as $ind=>$val)
 	 {
 		$newItemVal = $actRightElements[$ind];
 		if($itemVal != $newItemVal)
 		{
 			$ct++;
 			$itemVal = $newItemVal;
 		}
 	 }
 	}
 	return $ct;
 }
 
//
// Generate the body of the terminal method.
//
private function genMethodBodyBody($actRightElements)
 {
 	$phpClassGen = &$this->getPhpClassGen();
 	$parser = &$this->getParser();
 	$lex = &$parser->getLex();
 	$composedRightElements = $this->decompRightElements($actRightElements);
 	$ct = 0;
 	$body = STRING_NULL;
 	foreach($composedRightElements as $ind=>$val)
 	{
   if(($ct==0)&&($composedRightElements[$ct][0] != 'epsilon'))
   {
 	  $num = $this->getNumOfOrBranches($actRightElements);
 	  for ($i=1;$i<=$num;$i++)
 	   $body .= $phpClassGen->EOL() . '$' .  self::VAR_RES . $i . '=true' . ';';
   	$num = count($composedRightElements[$ct]);
   	for($i=1;$i<=$num;$i++)
   	{
   		$body .= $phpClassGen->EOL() . '$' .  self::VAR_RES . ($ct+1) . $i . '=false' . ';';
   	}
   	$body .= $phpClassGen->EOL() . $phpClassGen->EOL() ;	
   	$body .= '$' .  self::VAR_RES . ($ct+1) . "1" . STRING_EQUAL . 
   	$this->getCodeFromTransientLexema($composedRightElements[$ct][0]) . ";";
   	$body .= $phpClassGen->EOL() . $this->genMethodBodyBodyInside($composedRightElements[$ct],$ct+1,0);
    $str1 = '$' . self::VAR_RES . ($ct+1) . STRING_EQUAL ;
    for($i=1;$i<=$num;$i++)
   	{
   		if($i<$num)
   		 $str1 .= '$' .  self::VAR_RES . ($ct+1) . $i . ' && ';
   	  else
   	   $str1 .= '$' .  self::VAR_RES . ($ct+1) . $i . ';';
   	}
   	$body .= $phpClassGen->EOL() . $str1;
   }
   elseif($composedRightElements[$ct][0] == 'epsilon')
   {
   	$body .= $phpClassGen->EOL() . '$' .  self::VAR_RES . ($ct+1) . '=true' . ';';
   }
   else
   {
    $body .= $phpClassGen->EOL(); 
   	$body .= $phpClassGen->EOL() . 'if(!' . '$' . self::VAR_RES . ($ct) . ')';
    $body .= $phpClassGen->EOL() . '{' ;
   	$num = count($composedRightElements[$ct]);
   	for($i=1;$i<=$num;$i++)
   	{
      $body .= $phpClassGen->EOL() . '$' .  self::VAR_RES . ($ct+1) . $i . '=false' . ';';
   	}
    $body .= $phpClassGen->EOL() . $phpClassGen->EOL() . '$' . self::VAR_RES . ($ct+1) . "1" . STRING_EQUAL . 
   	$this->getCodeFromTransientLexema($composedRightElements[$ct][0]) . ";";
    $body .= $phpClassGen->EOL() . $this->genMethodBodyBodyInside($composedRightElements[$ct],$ct+1,0);
    $str1 = '$' . self::VAR_RES . ($ct+1) . STRING_EQUAL ;
    for($i=1;$i<=$num;$i++)
   	{
   		if($i<$num)
   		 $str1 .= '$' .  self::VAR_RES . ($ct+1) . $i . ' && ';
   	  else
   	   $str1 .= '$' .  self::VAR_RES . ($ct+1) . $i . ';';
   	}
   	$body .= $phpClassGen->EOL() . $str1;
   	$body .= $phpClassGen->EOL() . '}' . $phpClassGen->EOL();
   }
	 $ct++;
 	}
 	$body .= $phpClassGen->EOL() . '$' . self::VAR_RES . STRING_EQUAL ;
 	for($i=0;$i<=$ct-2;$i++)
 	 $body .= '$' .  self::VAR_RES . ($i+1) . ' | ';
 	$body .= '$' .  self::VAR_RES . ($i+1) . ';';
 	$body .= $phpClassGen->EOL();
 	return $body . $phpClassGen->EOL();
 }

//
// Entry point for the grammar rule generator.
// Is called as many times as the number of productions in the grammar.
// It fills the phpClassGen instance buffer.
// Typically the call to this method is followed by a call to 'putData'
// 
 function exec($actCt=0)
 {
 	$prjName = $this->getPrjName();
 	$parser = &$this->getParser();
 	if(isset($parser))
 	{
 	 $lex = &$parser->getLex();
 	 if (! $parser->exec())
    die ($parser->getCurrentError());
   $grRules = &$parser->getGrammarRulesContainer();
   $grRule = &$grRules->getElement(0);
   
   $grRuleName = strtolower($grRule->getName());
   $rightElements = &$grRule->getRightElements();
   $leftTerm = $grRule->getLeftTerm();
   $phpClassGen = &$this->getPhpClassGen();
   $phpClassGenMethodsNames = &$phpClassGen->getMethodsNames();
   $phpClassGenMethodsArgs = &$phpClassGen->getMethodsArgs(); 
   $phpClassGenMethodsBodies = &$phpClassGen->getMethodsBodies();
   
   $defineItem = strToUpper($grRuleName . VAR_SEP . "grammar_rule");
   $phpClassGen->setDefines(array($defineItem=>$grRuleName));
   $phpClassGen->setClassName(ucFirst(self::RULE_SUFFIX) . STRING_UNDERSCORE . $grRuleName);
   $phpClassGen->setConstructorArgs(array());
   $phpClassGen->setConstructorBody("parent::__construct(" . $defineItem . ");");
   
   $phpClassProps=array();
   $phpClassGen->setPublicProps($phpClassProps);
    
   $phpClassGenMethodsNames[0] ='init';
   $phpClassGen->setMethodsNames($phpClassGenMethodsNames);  
   $phpClassGenMethodsArgs[$phpClassGenMethodsNames[0]] = array();
   $phpClassGen->setMethodsArgs($phpClassGenMethodsArgs);
   $methodBody = '';
   $phpClassGenMethodsBodies[$phpClassGenMethodsNames[0]] = $methodBody;   
   $phpClassGen->setMethodsBodies($phpClassGenMethodsBodies);   

   $phpClassGenMethodsNames[1] ='getTokensBufferPointer';
   $phpClassGen->setMethodsNames($phpClassGenMethodsNames);  
   $phpClassGenMethodsArgs[$phpClassGenMethodsNames[1]] = array();
   $phpClassGen->setMethodsArgs($phpClassGenMethodsArgs);
   $methodBody = '$parser = &$this->getParser();' . $phpClassGen->EOL();
   $methodBody .= '$tokensBufferIter = &$parser->getTokensBufferIterator();' . $phpClassGen->EOL();
   $methodBody .= 'return ($tokensBufferIter->pos());' . $phpClassGen->EOL();
   $phpClassGenMethodsBodies[$phpClassGenMethodsNames[1]] = $methodBody;   
   $phpClassGen->setMethodsBodies($phpClassGenMethodsBodies);

   $phpClassGenMethodsNames[2] ='backtrack';
   $phpClassGen->setMethodsNames($phpClassGenMethodsNames);  
   $phpClassGenMethodsArgs[$phpClassGenMethodsNames[2]] = array('$actTokensBufferPointer');
   $phpClassGen->setMethodsArgs($phpClassGenMethodsArgs);
   $methodBody = '$parser = &$this->getParser();' . $phpClassGen->EOL();
   $methodBody .= '$tokensBufferIter = &$parser->getTokensBufferIterator();' . $phpClassGen->EOL();
   $methodBody .= '$tokensBufferIter->reset();' . $phpClassGen->EOL();
   $methodBody .= '$i=0;' . $phpClassGen->EOL();
   $methodBody .= 'while($i <= $actTokensBufferPointer-1)' . $phpClassGen->EOL();
   $methodBody .= '{' . $phpClassGen->EOL();
   $methodBody .= '$tokensBufferIter->next();' . $phpClassGen->EOL();
   $methodBody .= '$i++;' . $phpClassGen->EOL();
   $methodBody .= '}' . $phpClassGen->EOL();
   $phpClassGenMethodsBodies[$phpClassGenMethodsNames[2]] = $methodBody;   
   $phpClassGen->setMethodsBodies($phpClassGenMethodsBodies);

   $phpClassGenMethodsNames[3] ='space';
   $phpClassGen->setMethodsNames($phpClassGenMethodsNames);  
   $phpClassGenMethodsArgs[$phpClassGenMethodsNames[3]] = array('');
   $phpClassGen->setMethodsArgs($phpClassGenMethodsArgs);
   $methodBody = '$parser = &$this->getParser();' . $phpClassGen->EOL();
   $methodBody .= '$localTokensBufferPointer = $this->getTokensBufferPointer();' . $phpClassGen->EOL();
   $methodBody .= '$res1 = $parser->match(\\Cheope_ppp_ns\\src\\Token::TYPE_DELIM,' . strtoupper($prjName) . STRING_UNDERSCORE . "TOKEN" . 
 	 STRING_UNDERSCORE . \Cheope_ppp_ns\src\Token::VAL_SUFFIX . STRING_UNDERSCORE . 'WS);' . $phpClassGen->EOL();
   $methodBody .= 'if(! $res1)' . $phpClassGen->EOL();
   $methodBody .= '$this->backtrack($localTokensBufferPointer);' . $phpClassGen->EOL();
   $methodBody .= '$res2 = true;' . $phpClassGen->EOL();
   $methodBody .= '$res = $res1 || $res2;' . $phpClassGen->EOL();
   $methodBody .= 'if(! $res)' . $phpClassGen->EOL();
   $methodBody .= 'return false;' . $phpClassGen->EOL();
   $methodBody .= 'return true;' . $phpClassGen->EOL();
   $phpClassGenMethodsBodies[$phpClassGenMethodsNames[3]] = $methodBody;   
   $phpClassGen->setMethodsBodies($phpClassGenMethodsBodies); 
   
   if($actCt==0)
   {
    $phpClassGenMethodsNames[4] = "exec";
    $phpClassGen->setMethodsNames($phpClassGenMethodsNames);
    $phpClassGenMethodsArgs[$phpClassGenMethodsNames[4]] = array();
    $phpClassGen->setMethodsArgs($phpClassGenMethodsArgs);
    $methodBodyHead = 
    '$parser = &$this->getParser();' . $phpClassGen->EOL() .
    '$lex = &$parser->getLex();' . $phpClassGen->EOL() .
    '$localTokensBufferPointer = $this->getTokensBufferPointer();' . 
    $phpClassGen->EOL();
    
    $methodBodyBody = $this->genMethodBodyBody($rightElements);
    
    $methodBodyFoot = 'if (! $res)' . $phpClassGen->EOL() .
    'return false;' . $phpClassGen->EOL() . "return true;";
    
    $methodBody = $methodBodyHead . $methodBodyBody . $methodBodyFoot;
 
    $phpClassGenMethodsBodies[$phpClassGenMethodsNames[4]] = $methodBody;  
    
    $phpClassGen->setMethodsBodies($phpClassGenMethodsBodies);     	
   }
   else
   {
    $phpClassGenMethodsNames[4+$actCt] = $leftTerm;
    $phpClassGen->setMethodsNames($phpClassGenMethodsNames);
    $phpClassGenMethodsArgs[$phpClassGenMethodsNames[4+$actCt]] = array('');
    $phpClassGen->setMethodsArgs($phpClassGenMethodsArgs);
    $methodBodyHead = '$parser = &$this->getParser();' . $phpClassGen->EOL() .
    '$lex = &$parser->getLex();' . $phpClassGen->EOL() .
    '$localTokensBufferPointer = $this->getTokensBufferPointer();' . 
    $phpClassGen->EOL();
    
    $methodBodyBody = $this->genMethodBodyBody($rightElements);
    
    $methodBodyFoot = 'if (! $res)' . $phpClassGen->EOL() .
    'return false;'  . $phpClassGen->EOL() .
    'return true;';
    
    $methodBody = $methodBodyHead . $methodBodyBody . $methodBodyFoot;
 
    $phpClassGenMethodsBodies[$phpClassGenMethodsNames[4+$actCt]] = $methodBody;  
    
    $phpClassGen->setMethodsBodies($phpClassGenMethodsBodies);     	
   }
 	}
 	else
 	 die (self::ERROR_1);
 	
 }

//
// Call a PhpClassGen instance 'putData' method to output the data collected by 'exec'.
//
 function putData()
 {
 	$phpOpenTagEnabled = $this->getPhpOpenTagEnabled();
 	$phpCloseTagEnabled = $this->getPhpCloseTagEnabled();
 	$phpClassGen = &$this->getPhpClassGen(); 
 	
 	if($phpOpenTagEnabled)
 	{
 	 $fileName = $phpClassGen->getFileName();
 	 $handle = fopen($fileName,"a");
 	 fwrite($handle,PHP_OPEN_TAG);
 	 fclose($handle);	
 	}
 	
 	$phpClassGen->putData();
 	
 	if($phpCloseTagEnabled)
 	{
 	 $fileName = $phpClassGen->getFileName();
 	 $handle = fopen($fileName,"a");
 	 fwrite($handle,PHP_CLOSE_TAG);
 	 fclose($handle);	
 	}
 }

}

?>