<?
namespace Cheope_ppp_ns\grammar_rule_gen;

require_once("Grammar_rule_gen.php");
require_once("grammar_rule_gen_def.php");

$itemStr = "A = alfa ac as bs alfa | GUP | beta F" ;
$lex = new \Cheope_ppp_ns\src\Lexer_3("",$itemStr);
$lex->setRules($rules);
$lex->setLogEnabled(true);
$lex->setEnableLogOnFile(true);
$parser = new \Cheope_ppp_ns\src\Parser($lex);
$parser->setLogEnabled(true);
$parser->setEnableLogOnFile(true);
$parser->setGrammarRulesContainer($grRules);

$grammarRuleGen = new Grammar_rule_gen(0);
$grammarRuleGen->setPrjName("Example");
$grammarRuleGen->setParser($parser);
$phpClassGen = new Php_class_gen(STRING_NULL,0);
$phpClassGen->setFileName("example.txt");
$grammarRuleGen->setPhpClassGen($phpClassGen);
$tokensContainer = new \Cheope_ppp_ns\src\Tokens_container();
$grammarRuleGen->setTokensContainer($tokensContainer);

$grammarRuleGen->exec(0);
echo "<br/>";
$lex->dumpSymTable();
echo "<br/>";

$itemStr = "GUP = Alfa term Alfa" ;
$lex = new \Cheope_ppp_ns\src\Lexer_3("",$itemStr);
$lex->setRules($rules);
$parser = new \Cheope_ppp_ns\src\Parser($lex);
$parser->setLogEnabled(true);
$parser->setEnableLogOnFile(true);
$parser->setGrammarRulesContainer($grRules);
$grRule = &$grRules->getElement(0);
$grRule->init();
$grammarRuleGen->setParser($parser);

$grammarRuleGen->exec(1);

$grammarRuleGen->putData();

echo "<br/><br/>";
$lex->dumpSymTable();

echo "<br/>Terminals:<br/>";

$terms = $parser->getListOfTokenVal(TOKEN_VAL_TERMINALE);
foreach($terms as $term)
{
	$termName = $term->getLexema();
	echo $termName . "<br/>";
}

echo "<br/>Not terminals:<br/>";
$nonTerms = $parser->getListOfTokenVal(TOKEN_VAL_NONTERMINALE);
foreach($nonTerms as $nonTerm)
{
	$nonTermName = $nonTerm->getLexema();
	echo $nonTermName . "<br/>";
}

?>