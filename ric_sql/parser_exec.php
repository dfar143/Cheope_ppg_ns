<?
namespace Cheope_ppp_ns\ric_sql;

require_once("ric_sql_2_def.php");
require_once("../src/Parser.php");

if(isset($argv[1]))
 $inputFileName = $argv[1];
else
 $inputFileName = "example1.txt";

$lex = new \Cheope_ppp_ns\src\Lexer_3($inputFileName);
$lex->setRules($ricSql2DefRules);

$parser = new \Cheope_ppp_ns\src\Parser($lex);
$parser->setGrammarRulesContainer($ricSql2DefGrRules);
$parser->setLogEnabled(true);
//$parser->setEnableLogOnFile(true);

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