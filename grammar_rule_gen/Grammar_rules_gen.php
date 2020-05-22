<?
namespace Cheope_ppp_ns\grammar_rule_gen;

require_once("Grammar_rule_gen.php");

class Grammar_rules_gen extends \Cheope_ppp_ns\src\Generic_interface
{
 private $grammarRuleGen;
 private $grammarDefs;
 private $grRules;
 private $lexRules;
 private $prjName=STRING_NULL;
 private $logEnabled=false;
 private $logFileName=STRING_NULL;
 	
 function __construct($actNum)
 {
 	parent::__construct(STRING_NULL,INT_GRAMMAR_RULES_GEN,$actNum);
 }
 
 function setLogEnabled($actLogEnabled)
 {
 	$this->logEnabled = $actLogEnabled;
 }
 
 function getLogEnabled()
 {
 	return $this->logEnabled;
 }
 
 function setLogFileName($actLogFile)
 {
 	$this->logFileName = $actLogFile;
 }
 
 function getLogFileName()
 {
 	return $this->logFileName;
 } 
 
 function setGrammarRuleGen($actGrammarRuleGen)
 {
 	$this->grammarRuleGen = $actGrammarRuleGen;
 }
 
 function &getGrammarRuleGen()
 {
 	return $this->grammarRuleGen;
 }
 
 function setGrammarDefs($actGrammarDefs)
 {
 	$this->grammarDefs = $actGrammarDefs;
 }
 
 function &getGrammarDefs()
 {
 	return $this->grammarDefs;
 }
 
 function setGrRules($actGrRules)
 {
 	$this->grRules = $actGrRules;
 }
 
 function &getGrRules()
 {
 	return $this->grRules;
 }
 
 function setPrjName($actPrjName)
 {
 	$this->prjName = $actPrjName;
 }
 
 function getPrjName()
 {
 	return $this->prjName;
 }
 
 function setLexRules($actLexRules)
 {
 	$this->lexRules = $actLexRules;
 }
 
 function &getLexRules()
 {
 	return $this->lexRules;
 }
 
 static function &createLexer($actStr,$actFileName)
 {
 	$lex = new \Cheope_ppp_ns\src\Lexer_3($actStr,$actFileName);
 	return $lex;
 }
 
 static function &createParser($actLex)
 {
 	$parser = new \Cheope_ppp_ns\src\Parser($actLex);
 	return $parser;
 }
 
static function &createPhpClassGen($actClass,$actNum)
 {
 	$phpClassGen = new Php_class_gen($actClass,$actNum);
 	return $phpClassGen;
 }
 
static function &createTokensContainer()
 {
 	$tokensCont = new \Cheope_ppp_ns\src\Tokens_container();
 	return $tokensCont;
 }
 
static function &createToken()
 {
 	$token = new \Cheope_ppp_ns\src\Token();
 	return $token;
 }
 
 function exec($actCt=0)
 {
 	$prjName = $this->getPrjName();
  $tokens = array();
  $productions = array();
  $grRulesNames = array();
  $grDefs = &$this->getGrammarDefs();
  $grRules = &$this->getGrRules();
  $rules = &$this->getLexRules();
  $grammarRuleGen = &$this->getGrammarRuleGen();
  $i=0;
  foreach($grDefs as $grRulesName=>$grDef)
  {
   $tokensVals[$i] = $grDef['TokensVals'];
   $tokensTypes [$i] =$grDef['TokensTypes'];
   $tokensAttributes[$i] = $grDef['TokensAttributes'];
   $productions[$i] = $grDef['Productions'];
   $grRulesNames[$i] = $grRulesName;
   $i++;
  }
  $j = $actCt;
  $grRulesNames[$j] = str_replace("'","",$grRulesNames[$j]);
  $grRule = &$grRules->getElement(0);
  $grRule->setName($grRulesNames[$j]);
  $tokensContainer = &self::createTokensContainer();
  $tokenVals = $tokensVals[$j];
  $tokenTypes = $tokensTypes[$j];
  foreach($tokensVals[$j] as $ind=>$tokenVal)
  {
   $tokenType = $tokensTypes[$j][$ind];
 	 $tok1 = &$this->createToken();
   $tok1->setType($tokenType);
   $tok1->setVal($tokenVal);
   $tok1->setLexema($tokenVal);
   $tokensContainer->add($tok1);
  }
  $k=0;
  foreach($productions[$j] as $production)
  {
 	 if($k==0)
 	 {
 	 	$prodXmlStr = $production;
    $itemStr = trim($prodXmlStr);
    $lex = &self::createLexer("",$itemStr);
    $lex->setRules($rules);
    $parser = &self::createParser($lex);
    if($this->getLogEnabled())
    {
     $parser->setLogEnabled(true);
     $logFile = $this->getLogFileName();
     if($logFile!=STRING_NULL)
     {
     	$parser->setEnableLogOnFile(true);
     	$parser->setLogFileName($logFile);
     }
    }
    $parser->setGrammarRulesContainer($grRules);
    $grRule = &$grRules->getElement(0);
    $grRule->init();
    $grammarRuleGen->setParser($parser);
    $grammarRuleGen->setPrjName($prjName);
    $phpClassGen = &self::createPhpClassGen(STRING_NULL,0);
    $phpClassGen->setFileName(ucFirst($prjName) . VAR_SEP . 
    Grammar_rule_gen::RULE_SUFFIX . "s" .
    STRING_POINT . "php");
    $grammarRuleGen->setPhpClassGen($phpClassGen);
    $grammarRuleGen->setTokensContainer($tokensContainer);
   }
   else
   {
 	 	$prodXmlStr = $production;
    $itemStr = trim($prodXmlStr);
    $lex->setItemStr($itemStr);
    $parser = &self::createParser($lex);
    if($this->getLogEnabled())
    {
     $parser->setLogEnabled(true);
     $logFile = $this->getLogFileName();
     if($logFile!=STRING_NULL)
     {
     	$parser->setEnableLogOnFile(true);
     	$parser->setLogFileName($logFile);
     }
    }
    $parser->setGrammarRulesContainer($grRules);
    $grRule = &$grRules->getElement(0);
    $grRule->init();
    $grammarRuleGen->setParser($parser);
    $grammarRuleGen->setPrjName($prjName);
   } 
   $grammarRuleGen->exec($k);
   $k++;
  }
 }
 
 function putData()
 {
  $grammarRuleGen = &$this->getGrammarRuleGen();
  $grammarRuleGen->putData(); 
 }
 
}


?>