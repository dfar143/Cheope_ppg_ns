<?
namespace Cheope_ppp_ns\grammar_rule_gen;

require_once("../src/Generic_interface.php");

class Grammar_defs_xml_reader extends \Cheope_ppp_ns\src\Generic_interface
{
	private $fileName;
	private $grammarDefs=array();
	
	function __construct($actNum)
	{
		parent::__construct(STRING_NULL,INT_GRAMMAR_DEFS_XML_READER,$actNum);
	}
	
	function setFileName($actFileName)
	{
		$this->fileName = $actFileName;
	}
	
	function getFileName()
	{
		return $this->fileName;
  }
  
  function getGrammarDefs()
  {
  	return $this->grammarDefs;
  }
  
  function setGrammarDefs($actGrammarDefs)
  {
  	$this->grammarDefs = $actGrammarDefs;
  }
  
  function exec()
  {
  	$fileName = $this->getFileName();
  	if($fileName != STRING_NULL)
  	{
  	 $xmlEl = simplexml_load_file($fileName);
  	 $grammarDefis = array();
  	 foreach($xmlEl->grammar_rule as $grammarRule)
  	 {
  		$defs = array();
  		$tokensDef = $grammarRule->tokens_def;
  		$tokensAttrs = $grammarRule->tokens_attributes;
  		$grammarRuleTokensDef = $tokensDef->token;
  		$grammarRuleTokensAttrs = $tokensAttrs->Attr;
  		$productions = $grammarRule->productions;
  		$grammarRuleProductions = $productions->production;
      $tokensVals = array();
      $tokensRegexps = array();
      $tokensTypes = array();
      $i=0;
      foreach($grammarRuleTokensDef as $token)
      {
      	$tokensVals[$i] = (string)$token['val'];
      	$tokensRegexps[$i] =(string)$token;
      	$tokensTypes[$i] = (string)$token['type'];
      	$i++; 
      }
      $defs['TokensVals'] = $tokensVals;
      $defs['TokensRegexps'] = $tokensRegexps;
      $defs['TokensTypes'] = $tokensTypes;
      $tokensAttributes = array();
      $k=0;
      foreach($grammarRuleTokensAttrs as $attr)
      {
      	$tokensAttributes[$k++] = (string)$attr;
      }
      $defs['TokensAttributes'] = $tokensAttributes;
      $productions = array();
      $j=0;
      foreach($grammarRuleProductions as $production)
      {
      $productions[$j] = $production;
      $j++;
      }
      $defs['Productions'] = $productions;
      $grammarDefis["'" . $grammarRule['name'] . "'"] = $defs;
     }
     $this->setGrammarDefs($grammarDefis);
   }
  }
  
  function putData()
  {
  	$this->exec();
  }
	
}


?>