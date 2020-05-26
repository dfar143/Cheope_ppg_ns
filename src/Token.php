<?
namespace Cheope_ppp_ns\src;

require_once("generic_const.php");

class Token
{
 const TYPE_RESERVED_WORD="Reserved_word";
 const TYPE_LEXICAL_ELEMENT="Lexical_element";
 const TYPE_SPECIAL_ITEM="Special_item";
 const TYPE_DELIM="Delim";
 const VAL_SUFFIX="VAL";
 const TYPE_SUFFIX="TYPE";	

 var $type;
 var $val;
 var $attribute;
 var $lexema;
 
 function __construct($actType=STRING_NULL,$actVal=STRING_NULL)
 {
 	$this->type = $actType;
 	$this->val = $actVal;
 }
 
 function setLexema($actLexema)
 {
 	$this->lexema = $actLexema;
 }
 
 function getLexema()
 {
 	return $this->lexema;
 }
 
 function setType($actType)
 {
 	$this->type = $actType;
 }
 
 function getType()
 {
 	return $this->type;
 }
 
 function setVal($actVal)
 {
 	$this->val = $actVal;
 }
 
 function getVal()
 {
 	return $this->val;
 }
 
 function setAttribute($actAttr)
 {
 	$this->attribute = $actAttr;
 }
 
 function getAttribute()
 {
 	return $this->attribute;
 }
 
}

?>