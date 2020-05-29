<?
namespace Cheope_ppg_ns\grammar_rule_gen;

require_once("Grammar_defs_xml_reader.php");

define('PRJ_NAME',"php_arrays");

if(isset($argv[1]))
 $prjName = $argv[1];
else
 $prjName = PRJ_NAME;

$grDefsXmlReader = new Grammar_defs_xml_reader(0);
$defFileName = $prjName . STRING_POINT . "xml";

if(file_exists($defFileName))
 $grDefsXmlReader->setFileName($defFileName);
else
 die($defFileName . " not exists.");

$grDefsXmlReader->exec();
$grDefs = $grDefsXmlReader->getGrammarDefs();

?>