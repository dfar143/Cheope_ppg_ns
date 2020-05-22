<?
namespace Cheope_ppp_ns\php_arrays;

require_once("php_arrays_def.php");
require_once("../src/Parser.php");

if(isset($argv[1]))
 $inputFileName = $argv[1];
else
 $inputFileName = "example.txt";

$lex = new \Cheope_ppp_ns\src\Lexer_3($inputFileName);
$lex->setRules($phpArraysDefRules);
$parser = new \Cheope_ppp_ns\src\Parser($lex);
$parser->setGrammarRulesContainer($phpArraysDefGrRules);
$parser->setLogEnabled(true);
$parser->setEnableLogOnFile(true);

if (! $parser->exec())
 echo $parser->getCurrentError();
else
 echo "Ok.";

if (! isset ($_SERVER['SESSIONNAME'])) 
{
 echo "<br/>";
 $lex->dumpSymTable();
 echo "<br/>Items:<br/>";
}

?>