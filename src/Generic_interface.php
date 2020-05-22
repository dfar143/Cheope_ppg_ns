<?
namespace Cheope_ppp_ns\src;

require_once("generic_const.php");

define("INT_PHP_CLASS_GEN","class_gen");
define("INT_GRAMMAR_RULE_GEN","grammar_rule_gen");
define("INT_GRAMMAR_RULES_GEN","grammar_rules_gen");
define("INT_GRAMMAR_DEFS_XML_READER","grammar_defs_xml_reader");
define("INT_PARSER_DEF_GEN","parser_def_gen");

abstract class Generic_interface
{

 // Every instance of the class is identified by 
 // an operation, a progressive number and
 // an interface type.
 //
 
 private $op;
 
 private $num;
 
 private $type;
 
 function __construct($actOp,$actType,$actNum)
 {
	$this->op = $actOp;
	$this->num = $actNum;
	$this->type = $actType;
 }
 
 function getNum()
 {
  return $this->num;
 }
 
 function setNum($actNum)
 {
  $this->num = $actNum; 
 }
 
 function getType()
 {
  return $this->type;
 }
 
 function setType($actType)
 {
  $this->type = $actType;
 }
 
 function getOp()
 {
  return $this->op;
 }
 
 function setOp($actOp)
 {
  $this->op = $actOp;
 }
 
 function getInterfaceId()
 {
 	$num = $this->getNum();
 	$op = $this->getOp();
 	$type = $this->getType();
 	return $type . VAR_SEP . $op . VAR_SEP . $num;
 }
 
 // Implements the emission
 // of data.
 //
 abstract function putData();
   
}



?>