<?
namespace Cheope_ppp_ns\grammar_rule_gen;

require_once("Grammar_rules_gen.php");
require_once("grammar_rule_gen_def.php");
require_once("grammar_rules_gen_def.php");
require_once("Parser_def_gen.php");

define('DEFAULT_LOG_FILE',"log.txt");

if (isset ($_SERVER['SESSIONNAME'])) 
$options = getOpt("l::");

if(isset($options["l"]))
 $logFileName = $options["l"];
else
 $logFileName = DEFAULT_LOG_FILE;

$grRulesGen = new Grammar_rules_gen(0);
$grRuleGen = new Grammar_rule_gen(0);
$grRulesGen->setPrjName($prjName);
$grRulesGen->setGrammarRuleGen($grRuleGen);
$grRulesGen->setGrRules($grRules);
$grRulesGen->setGrammarDefs($grDefs);
$grRulesGen->setLexRules($rules);
$grRulesGen->setLogEnabled(true);
$grRulesGen->setLogFileName($logFileName);
$i=0;
$num = count($grDefs);
foreach($grDefs as $ind=>$grDef)
{
 $grRulesGen->exec($i);
 if($i==0)
 {
  $grRuleGen->setPhpOpenTagEnabled(true);
  $grRuleGen->setPhpCloseTagEnabled(false);
 }
 elseif($i==$num-1)
 {
 	$grRuleGen->setPhpOpenTagEnabled(false);
  $grRuleGen->setPhpCloseTagEnabled(true);
 }
 $phpClassGen = &$grRuleGen->getPhpClassGen();
 if($i == 0)
 {
  $phpClassGen->setRequireOnces(array("__DIR__ . /../src/" . ucFirst(Grammar_rule_gen::RULE_SUFFIX) 
  . STRING_POINT . "php"));  
 }
 else
  $phpClassGen->setRequireOnces(array());   
 $i++;
 $grRulesGen->putData(); 
}

$parserDefGen = new Parser_def_gen(0);
$phpClassGen = &Grammar_rules_gen::createPhpClassGen(STRING_NULL,0);
$phpClassGen->setFileName($prjName . VAR_SEP . 
"def" . STRING_POINT . "php");
$parserDefGen->setPhpClassGen($phpClassGen);
$parserDefGen->setGrammarDefs($grDefs);
$parserDefGen->setPrjName($prjName);
$parserDefGen->putData();

echo "Execution ok.";

?>