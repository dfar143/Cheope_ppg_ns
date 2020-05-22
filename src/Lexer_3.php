<?
namespace Cheope_ppp_ns\src;

require_once("generic_const.php");
require_once("Lex_rules_container.php");
require_once("Token.php");

class Lexer_3
{
 const NO_ERROR=STRING_NULL;
 const ERROR_0="End of buffer.";
 const ERROR_1="Lexical error.";
 const ERROR_2="Rules not set.";
 const ERROR_3="Error in Lexer.setBuf: the argument must be an array.";
 const ERROR_4="Error in Lexer.init:Cannot load data.";
 const LOG_FILE = "Log.txt";
 
 var $fileName;
 var $itemStr;
 var $matchedStr;
 var $matchingStr;
 var $fres;
 var $gBuf = array();
 var $symTable = array();
 // Rules container array. 
 var $rules=null;
 var $currentRule=null;
 var $currentError;
 var $logEnabled = false;
// Log file.
 var $logFileName=self::LOG_FILE;
 var $enableLogOnFile=false;
 
 // Execution sequence: 
 // $lex->setRules($rules);
 // $lex->init();
 // $lex->exec();
 
 function __construct($actFileName=STRING_NULL,$actItemStr=STRING_NULL)
 {
 	$this->setFileName($actFileName);
 	$this->setItemStr($actItemStr);
 }
 
 static function &createToken($actType=STRING_NULL,$actVal=STRING_NULL)
 {
 	$tok = new Token($actType,$actVal);
 	return $tok;
 }
 
 function setLogEnabled($actLogEnabled)
 {
 	$this->logEnabled =$actLogEnabled;
 }
 
 function getLogEnabled()
 {
 	return $this->logEnabled;
 }

 function setLogFileName($actLogFileName)
 {
 	$this->logFileName = $actLogFileName;
 }
 
 function getLogFileName()
 {
 	return $this->logFileName;
 }
 
 function setEnableLogOnFile($actEnableLogOnFile)
 {
 	$this->enableLogOnFile = $actEnableLogOnFile;
 }
 
 function getEnableLogOnFile()
 {
 	return $this->enableLogOnFile;
 }
 
 
 function putLog($actLogInfo)
 {
 	$logEnabled = $this->getLogEnabled();
 	if($logEnabled)
 	{
 	 $logOnFileEnabled = $this->getEnableLogOnFile();
 	 if($logOnFileEnabled)
 	 {
 	  $logFileName = $this->getLogFileName();
 	  if(isset($logFileName))
 	  {
 	   $handle = fopen($logFileName,"a+");
     fwrite($handle,$actLogInfo);
	   fwrite($handle,STRING_RETURN);
	   fwrite($handle,STRING_LINE_FEED);
 	   fclose($handle);
    }
   }
   else
    echo $actLogInfo . "<br/>";
  }
 }
 
 
 function getItemStr()
 {
 	return $this->itemStr;
 }
 
 function setItemStr($actItemStr)
 {
 	$this->itemStr = $actItemStr;
 }
 
 function getMatchedStr()
 {
 	return $this->matchedStr;
 }
 
 function setMatchedStr($actMatchedStr)
 {
 	$this->matchedStr = $actMatchedStr;
 }
 
 function getMatchingStr()
 {
 	return $this->matchingStr;
 }
 
 function setMatchingStr($actMatchingStr)
 {
 	$this->matchingStr = $actMatchingStr;
 }
 
 function setFileName($actFileName)
 {
 	 $this->fileName = $actFileName;
 }
 
 function getFileName()
 {
 	return $this->fileName;
 }
 
 function setBuf($actBuf)
 {
 	if(is_array($actBuf))
 	 $this->gBuf = $actBuf;
 	else
 	 die(self::ERROR_3);
 }
 
 function getBuf()
 {
 	return $this->gBuf;
 }
 
 function setRules($actRules)
 {
 	$this->rules = $actRules;
 }
 
 function &getRules()
 {
 	return $this->rules;
 }
 
 function setCurrentRule(&$actRule)
 {
 	$this->currentRule = $actRule;
 }
 
 function &getCurrentRule()
 {
 	return $this->currentRule;
 }
 
 function setCurrentError($actError)
 {
 	$this->currentError = $actError;
 }
 
 function getCurrentError()
 {
 	return $this->currentError;
 }
 
 function loadReservedWords($actReservedWords)
 {
 	foreach($actReservedWords as $reservedWord)
 	{
 	 $token = new Token(Token::TYPE_RESERVED_WORD,$reservedWord);
 	 $token->setLexema(strtolower($reservedWord));
 	 $this->installToken($token);
  }
 }
 
 function loadSpecialItems($actSpecialItems)
 {
 	foreach($actSpecialItems as $specialItem)
 	{
 	 $token = new Token(Token::TYPE_SPECIAL_ITEM,$specialItem);
 	 $token->setLexema(strtolower($specialItem));
 	 $this->installToken($token);
  }
 }
 
 function init()
 {
 	 $fileName = $this->getFileName();
 	 if ($fileName != STRING_NULL)
 	 {
 	 	$gBuf = file($fileName);
 	  if(! $gBuf)
 	  {
     die(self::ERROR_4);
    }
    else
     $this->setBuf($gBuf);
   }
   else
   {
   	$gBuf = array($this->getItemStr());
   	$this->setBuf($gBuf);
   }
   $this->setMatchedStr(STRING_NULL);
   $gBuf = $this->getBuf();
   $this->setMatchingStr(implode('',$gBuf));
   $this->setCurrentError(STRING_NULL);
 }
 
 function &getSymTable()
 {
 	return $this->symTable;
 }
 
 function setSymTable($actSymTable)
 {
 	$this->symTable = $actSymTable;
 }
 
 function dumpSymTable()
 {
 	$symTable = $this->getSymTable();
 	foreach($symTable as $ind => $token)
 	{
 		echo $ind . ":" . $token->type . " " . $token->val . 
 		" " . $token->getAttribute() . " " . $token->lexema . "<br/>";
 	}
 }
 
 function flushSymTable()
 {
 	$this->setSymTable(array());
 }
 
 function installToken($actToken)
 {
 	$tokenActLexema = $actToken->getLexema();
 	$tokenActVal = $actToken->getVal();
 	$tokenActType = $actToken->getType();
 	foreach($this->symTable as $ind => $token)
 	{
 	 $tokenLexema = $token->getLexema();
 	 $tokenVal = $token->getVal(); 
 	 
 	 if(($tokenActType == Token::TYPE_RESERVED_WORD) 
 	 || ($tokenActType == Token::TYPE_SPECIAL_ITEM)
 	 || ($tokenActType == Token::TYPE_DELIM))
 	 {
 	  if($tokenVal==$tokenActVal)
 	   return $ind;
 	 } 
 	 else
 	  if (($tokenVal==$tokenActVal)&&($tokenActLexema==$tokenLexema))
 	   return $ind;
 	}
 	$this->pushToken($actToken);
 }
 
 function pushToken($actToken)
 {
 	$this->symTable[] = $actToken;
 }
 
 function popToken()
 {
 	return array_pop($this->symTable);
 }
 
 function getToken($actTokenVal)
 {
 	foreach($symTable as $token)
 	{
 		if($token->val==$actTokenVal)
 		 return $token;
  }
  return false;
 }
 
 function getTokenByLexema($actTokenLexema)
 {
 	$symTable = &$this->getSymTable();
 	foreach($symTable as $token)
 	{
 		if($token->getLexema()==$actTokenLexema)
 		 return $token;
 	}
 	return false;
 }
 
 function nextToken()
 {
 	$rules = &$this->getRules();
 	$rules_iter = $rules->createIterator();
 	$rules_iter->reset();
 	$rule = &$rules_iter->current();
 	$this->setCurrentRule($rule);
 	$this->putLog("Rule:" . $rule->getName());
 	if($rules_iter->hasMore())
 	{	  	 
 	 while(true)
 	 {
 	 	$matchedStr = $this->getMatchedStr();
 	 	$this->putLog("Matched string:" . $matchedStr);
 	  $matchingStr = $this->getMatchingStr();
 	  $this->putLog("Matching string:" . $matchingStr);
 	  while(($matchingStr=str_right($matchingStr,strlen($matchingStr)-strlen($matchedStr)))!==false)
 	  {
 	 	 $this->setMatchingStr($matchingStr); 	 	  	   
 	 	 while($rules_iter->hasMore())
 	 	 { 	    
 	 	  if((($matchedStr = $rule->execMatch($matchingStr))!==false)?true:false)
 	 	  {
 	 	   $this->setMatchedStr($matchedStr);
 	 	   $disp = strlen($matchedStr);
 	 	   $this->putLog("Matched string:" . $matchedStr);
 	 	 	 $this->installToken($rule->getCurrentToken());
 	 	   return true;
 	 	  }
 	 	  $rule = &$rules_iter->next();
 	 	  if($rules_iter->hasMore())
 	 	  {
 	 	   $this->setCurrentRule($rule);
 	     $this->putLog("Rule:" . $rule->getName());
 	 	  }
 	 	 }
 	   $this->setCurrentError(self::ERROR_1);
 	   return false; 	 	 
 	 	}
 	  if(strlen($matchingStr)==0)
 	  {
 	   $this->setCurrentError(self::ERROR_0);
 	   return false;
 	  }
 	 }  	
 	}
  else
  {
 	 $this->setCurrentError(self::ERROR_2);
 	 return false;
  }
 }
 
 function exec()
 {
  $this->putlog("Start.");
 	while($this->nextToken())
 	{}
  $this->putlog("End.");
  $this->dumpSymTable();
 }
 
} 


?>