<?
namespace Cheope_ppp_ns\grammar_rule_gen;

require_once(__DIR__ . "/../src/Generic_interface.php");
require_once("Php_class_gen.php");

class Parser_def_gen extends \Cheope_ppp_ns\src\Generic_interface
{
 private $prjName = STRING_NULL;
 private $isAlone=false;
 private $phpClassGen;
 private $grammarDefs=array();

 function __construct($actNum)
 {
  parent::__construct(STRING_NULL,INT_PARSER_DEF_GEN,$actNum);
 }

 function setPrjName($actPrjName)
 {
 	$this->prjName = $actPrjName;
 } 
 
 function getPrjName()
 {
 	return $this->prjName;
 }
 
 function setIsAlone($actIsAlone)
 {
 	$this->isAlone = $actIsAlone;
 }
 
 function getIsAlone()
 {
 	return $this->isAlone;
 }
 
 function setPhpClassGen($actPhpClassGen)
 {
 	$this->phpClassGen = $actPhpClassGen;
 }
 
 function &getPhpClassGen()
 {
 	return $this->phpClassGen;
 }
  
 function setGrammarDefs($actGrammarDefs)
 {
 	$this->grammarDefs = $actGrammarDefs;
 }
 
 function getGrammarDefs()
 {
 	return $this->grammarDefs;
 }
 
 function isMultiple($actTokenVal)
 {
 	$grDefs = $this->getGrammarDefs();
 	$ct=0;
  foreach($grDefs as $grRulesName=>$grDef)
  { 	
   $tokensVals = $grDef['TokensVals'];
   if(in_array($actTokenVal,$tokensVals))
    $ct++;
  }
  if($ct>1)
   return true;
  else
   return false;
 }
 
 function putData()
 {
 	$prjName = $this->getPrjName(); 
 	$phpClassGen = &$this->getPhpClassGen();	
 	$fileName = $phpClassGen->getFileName();
 	
 	$handle = fopen($fileName,"a");
 	$phpClassGen->setFileHandle($handle);
 	$phpClassGen->puts(PHP_OPEN_TAG);
 	$grDefs = $this->getGrammarDefs(); 	 
  
  $phpClassGen->puts($phpClassGen->EOL());
  $phpClassGen->putFunctionCall("require_once",array("\"__DIR__ . /../src/Lex_rules_container.php\"")); 
  $phpClassGen->putFunctionCall("require_once",array("\"__DIR__ . /../src/Parser_grammar_rules_container.php\""));
  $phpClassGen->putFunctionCall("require_once",array("\"" . ucFirst($prjName) . 
  STRING_UNDERSCORE . "parser_grammar_rules.php\""));
  $phpClassGen->puts($phpClassGen->EOL());
  
  $i=0;
  foreach($grDefs as $grRulesName=>$grDef)
  {
   $tokensVals = $grDef['TokensVals'];
   $tokensTypes = $grDef['TokensTypes'];
   $tokensAttributes = $grDef['TokensAttributes'];
   $tokensRegexps = $grDef['TokensRegexps'];
   
   foreach($tokensVals as $tokenVal)
   {
   	if($this->isMultiple($tokenVal))
   	{
   	 if($i==0)
   	  $phpClassGen->putFunctionCall("define",array("'" . strToUpper($prjName) . 
    STRING_UNDERSCORE . "TOKEN_VAL" . STRING_UNDERSCORE . strToUpper($tokenVal) . "'",
    "\"" . $tokenVal . "\""));
    }
    else
   	  $phpClassGen->putFunctionCall("define",array("'" . strToUpper($prjName) . 
    STRING_UNDERSCORE . "TOKEN_VAL" . STRING_UNDERSCORE . strToUpper($tokenVal) . "'",
    "\"" . $tokenVal . "\""));    
   }
   $phpClassGen->puts($phpClassGen->EOL());   
   foreach($tokensAttributes as $tokenAttr)
   {
   	$phpClassGen->putFunctionCall("define",array("'" . strToUpper($prjName) . 
    STRING_UNDERSCORE . "TOKEN_ATTR" . STRING_UNDERSCORE . strToUpper($tokenAttr) . "'",
    "\"" . $tokenAttr . "\""));
   }
   $phpClassGen->puts($phpClassGen->EOL()); 

   if($i==0)
    $phpClassGen->putFunctionCall("define",array("'" . strToUpper($prjName) . 
    STRING_UNDERSCORE . "RULE_NAME_SUFFIX" . "'","\"rule\""));         
   $phpClassGen->puts($phpClassGen->EOL());

   foreach($tokensVals as $tokenVal)
   {
   	if($this->isMultiple($tokenVal))
   	{
   	 if($i==0)
   	$phpClassGen->putFunctionCall("define",array("'" . strToUpper($prjName) . 
    STRING_UNDERSCORE . strToUpper($tokenVal) . STRING_UNDERSCORE . "RULE'",
    strToUpper($prjName) . 
    STRING_UNDERSCORE . "TOKEN_VAL" . STRING_UNDERSCORE . strToUpper($tokenVal) . 
    STRING_SPACE . "." . STRING_SPACE . 
    strToUpper($prjName) . 
    STRING_UNDERSCORE . "RULE_NAME_SUFFIX"));
    }
    else
   	$phpClassGen->putFunctionCall("define",array("'" . strToUpper($prjName) . 
    STRING_UNDERSCORE . strToUpper($tokenVal) . STRING_UNDERSCORE . "RULE'",
    strToUpper($prjName) . 
    STRING_UNDERSCORE . "TOKEN_VAL" . STRING_UNDERSCORE . strToUpper($tokenVal) . 
    STRING_SPACE . "." . STRING_SPACE . 
    strToUpper($prjName) . 
    STRING_UNDERSCORE . "RULE_NAME_SUFFIX"));    
   }
   $phpClassGen->puts($phpClassGen->EOL());

   $prjName1 = $prjName;
   $prjNameItems = explode(STRING_UNDERSCORE,$prjName1);
   foreach($prjNameItems as $ind=>$val)
   {
   	if($ind > 0)
    $prjNameItems[$ind] = ucFirst($val);
   }
   $prjName1=implode($prjNameItems);
      
   $j=0;
   foreach($tokensVals as $tokenVal)
   {
    $phpClassGen->putAssignment("\$" . $prjName1 . "Rule" . $j . 
    (($i>0)?('_' . $i):('')),
    $phpClassGen->constructorCall("\\Cheope_ppp_ns\\src\\Lex_rule",array("\"regola" . $j . "\"")));
    $j++;
   }      
   $phpClassGen->puts($phpClassGen->EOL());
   
   $j=0;
   foreach($tokensRegexps as $regexp)
   {
   	$phpClassGen->putMethodCall("\$"  . $prjName1 .  "Rule" . $j . (($i>0)?('_' . $i):(''))
   	,"setRegexp",array("\"" . trim($regexp) . "\""));
   	$phpClassGen->putMethodCall("\$"  . $prjName1 .  "Rule" . $j . (($i>0)?('_' . $i):(''))
   	,"setTokenType",array("\\Cheope_ppp_ns\\src\\Token::TYPE" . 
   	STRING_UNDERSCORE . strToUpper($tokensTypes[$j])));
   	$phpClassGen->putMethodCall("\$"  . $prjName1 . "Rule" . $j . (($i>0)?('_' . $i):(''))
   	,"setTokenVal",array(strToUpper($prjName) . 
    STRING_UNDERSCORE . "TOKEN_VAL" . STRING_UNDERSCORE . strToUpper($tokensVals[$j])));
    $phpClassGen->puts($phpClassGen->EOL());
   	$j++;
   }  

   $phpClassGen->putFunctionCall("define",array("'" . strToUpper($prjName) . 
    STRING_UNDERSCORE . "LEX_RULE_CONTAINER" . STRING_UNDERSCORE . $i . "'",
    "\"Contenitore_regole_$i\""));  
   $phpClassGen->puts($phpClassGen->EOL());

   $phpClassGen->putAssignment("\$" . $prjName1 . "DefRules" . 
   (($i==0)?(STRING_NULL):($i)),$phpClassGen->constructorCall("Lex_rules_container",
   array(strToUpper($prjName) . 
    STRING_UNDERSCORE . "LEX_RULE_CONTAINER" . STRING_UNDERSCORE . $i)));
   
   $j=0;
   foreach($tokensVals as $tokenVal)
   {
    $phpClassGen->putMethodCall("\$" . $prjName1 . "DefRules" .
   (($i==0)?(STRING_NULL):($i)),"add",array("\$"  . $prjName1 . "Rule" . $j . 
   (($i>0)?('_' . $i):(''))));
    $j++;
   }      
   $phpClassGen->puts($phpClassGen->EOL());
   
   if($i==0)
    $phpClassGen->putAssignment("\$" . $prjName1 . "RulesArray",
    $phpClassGen->functionCall("array",array("\$" . $prjName1 . "DefRules")));
   else
    $phpClassGen->putAssignment("\$" . $prjName1 . "RulesArray[]",
    "\$" . $prjName1 . "DefRules" .
    $i);
   $phpClassGen->puts($phpClassGen->EOL());   

   if($i==0) 
   $phpClassGen->putFunctionCall("define",array("'" . strToUpper($prjName) . 
    STRING_UNDERSCORE . "PARSER_GRAMMAR_RULE_CONTAINER" . STRING_UNDERSCORE . "1" . "'",
    "\"Contenitore_regole_grammaticali_1\""));  
   $phpClassGen->puts($phpClassGen->EOL()); 
   
   $phpClassGen->putAssignment("\$" . $prjName1 . "DefGrRule" . $i,
    $phpClassGen->constructorCall("Parser_grammar_rule" . 
    STRING_UNDERSCORE . str_replace("'","",$grRulesName),
    array())); 
   $phpClassGen->puts($phpClassGen->EOL());
      
   if($i==0)
    $phpClassGen->putAssignment("\$" . $prjName1 . "DefGrRules",
    $phpClassGen->constructorCall("\\Cheope_ppp_ns\\src\\Parser_grammar_rules_container",
    array(strToUpper($prjName) . 
    STRING_UNDERSCORE . "PARSER_GRAMMAR_RULE_CONTAINER" . STRING_UNDERSCORE . "1")));     
   
          
   $phpClassGen->putMethodCall("\$" . $prjName1 . "DefGrRules","add",
   array("\$" . $prjName1 . "DefGrRule" . $i));   
   $phpClassGen->puts($phpClassGen->EOL());
            
   $i++;
  }
 
  
 	$phpClassGen->puts(PHP_CLOSE_TAG);
 	fclose($handle);	 	  	 
 }
 
}


?>