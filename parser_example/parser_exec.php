<?
namespace dfar143\cheope_ppp_ns\parser_example;

require_once("example_1_def.php");
require_once(__DIR__ . "/../src/Parser.php");

if(isset($argv[1]))
 $inputFileName = $argv[1];
else
 $inputFileName = "example.txt";
 
$lex = new \Cheope_ppp_ns\src\Lexer_3($inputFileName);
$lex->setRules($example1DefRules);

$parser = new \Cheope_ppp_ns\src\Parser($lex);
$parser->setGrammarRulesContainer($example1DefGrRules);
$parser->setLogEnabled(true);
$parser->setEnableLogOnFile(true);
$parser->setLexRulesArray($example1RulesArray);

if (! $parser->exec())
 echo $parser->getCurrentError();
else
 echo "Ok.";

if (! isset ($_SERVER['SESSIONNAME'])) 
{
 echo "<br/>";
 echo "<br/>";
 echo "Results:<br/>";
 print_r($parser->getResults());
 echo "<br/>";
 echo "<br/>";
 $lex->dumpSymTable();
 echo "<br/>Items:<br/>";
}

?>