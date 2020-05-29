<?
namespace Cheope_ppg_ns\php_arrays;

require_once("../src/Lex_rules_container.php");
require_once("../src/Parser_grammar_rules_container.php");
require_once("Php_arrays_parser_grammar_rules.php");

define('PHP_ARRAYS_TOKEN_VAL_ARRAY',"array");
define('PHP_ARRAYS_TOKEN_VAL_ARROW',"arrow");
define('PHP_ARRAYS_TOKEN_VAL_OPEN_PAR',"open_par");
define('PHP_ARRAYS_TOKEN_VAL_CLOSE_PAR',"close_par");
define('PHP_ARRAYS_TOKEN_VAL_VIRGOLA',"virgola");
define('PHP_ARRAYS_TOKEN_VAL_WS',"ws");
define('PHP_ARRAYS_TOKEN_VAL_ITEM1',"item1");
define('PHP_ARRAYS_TOKEN_VAL_ITEM2',"item2");
define('PHP_ARRAYS_TOKEN_VAL_NUM',"num");
define('PHP_ARRAYS_TOKEN_VAL_CONST',"const");


define('PHP_ARRAYS_RULE_NAME_SUFFIX',"rule");

define('PHP_ARRAYS_ARRAY_RULE',PHP_ARRAYS_TOKEN_VAL_ARRAY . PHP_ARRAYS_RULE_NAME_SUFFIX);
define('PHP_ARRAYS_ARROW_RULE',PHP_ARRAYS_TOKEN_VAL_ARROW . PHP_ARRAYS_RULE_NAME_SUFFIX);
define('PHP_ARRAYS_OPEN_PAR_RULE',PHP_ARRAYS_TOKEN_VAL_OPEN_PAR . PHP_ARRAYS_RULE_NAME_SUFFIX);
define('PHP_ARRAYS_CLOSE_PAR_RULE',PHP_ARRAYS_TOKEN_VAL_CLOSE_PAR . PHP_ARRAYS_RULE_NAME_SUFFIX);
define('PHP_ARRAYS_VIRGOLA_RULE',PHP_ARRAYS_TOKEN_VAL_VIRGOLA . PHP_ARRAYS_RULE_NAME_SUFFIX);
define('PHP_ARRAYS_WS_RULE',PHP_ARRAYS_TOKEN_VAL_WS . PHP_ARRAYS_RULE_NAME_SUFFIX);
define('PHP_ARRAYS_ITEM1_RULE',PHP_ARRAYS_TOKEN_VAL_ITEM1 . PHP_ARRAYS_RULE_NAME_SUFFIX);
define('PHP_ARRAYS_ITEM2_RULE',PHP_ARRAYS_TOKEN_VAL_ITEM2 . PHP_ARRAYS_RULE_NAME_SUFFIX);
define('PHP_ARRAYS_NUM_RULE',PHP_ARRAYS_TOKEN_VAL_NUM . PHP_ARRAYS_RULE_NAME_SUFFIX);
define('PHP_ARRAYS_CONST_RULE',PHP_ARRAYS_TOKEN_VAL_CONST . PHP_ARRAYS_RULE_NAME_SUFFIX);

$phpArraysRule0=new \Cheope_ppg_ns\src\Lex_rule("regola0");
$phpArraysRule1=new \Cheope_ppg_ns\src\Lex_rule("regola1");
$phpArraysRule2=new \Cheope_ppg_ns\src\Lex_rule("regola2");
$phpArraysRule3=new \Cheope_ppg_ns\src\Lex_rule("regola3");
$phpArraysRule4=new \Cheope_ppg_ns\src\Lex_rule("regola4");
$phpArraysRule5=new \Cheope_ppg_ns\src\Lex_rule("regola5");
$phpArraysRule6=new \Cheope_ppg_ns\src\Lex_rule("regola6");
$phpArraysRule7=new \Cheope_ppg_ns\src\Lex_rule("regola7");
$phpArraysRule8=new \Cheope_ppg_ns\src\Lex_rule("regola8");
$phpArraysRule9=new \Cheope_ppg_ns\src\Lex_rule("regola9");

$phpArraysRule0->setRegexp("/^[Aa]rray/i");
$phpArraysRule0->setTokenType(\Cheope_ppg_ns\src\Token::TYPE_RESERVED_WORD);
$phpArraysRule0->setTokenVal(PHP_ARRAYS_TOKEN_VAL_ARRAY);

$phpArraysRule1->setRegexp("/^=>/i");
$phpArraysRule1->setTokenType(\Cheope_ppg_ns\src\Token::TYPE_SPECIAL_ITEM);
$phpArraysRule1->setTokenVal(PHP_ARRAYS_TOKEN_VAL_ARROW);

$phpArraysRule2->setRegexp("/^\(/i");
$phpArraysRule2->setTokenType(\Cheope_ppg_ns\src\Token::TYPE_SPECIAL_ITEM);
$phpArraysRule2->setTokenVal(PHP_ARRAYS_TOKEN_VAL_OPEN_PAR);

$phpArraysRule3->setRegexp("/^\)/i");
$phpArraysRule3->setTokenType(\Cheope_ppg_ns\src\Token::TYPE_SPECIAL_ITEM);
$phpArraysRule3->setTokenVal(PHP_ARRAYS_TOKEN_VAL_CLOSE_PAR);

$phpArraysRule4->setRegexp("/^,/i");
$phpArraysRule4->setTokenType(\Cheope_ppg_ns\src\Token::TYPE_SPECIAL_ITEM);
$phpArraysRule4->setTokenVal(PHP_ARRAYS_TOKEN_VAL_VIRGOLA);

$phpArraysRule5->setRegexp("/^[\s]+/i");
$phpArraysRule5->setTokenType(\Cheope_ppg_ns\src\Token::TYPE_DELIM);
$phpArraysRule5->setTokenVal(PHP_ARRAYS_TOKEN_VAL_WS);

$phpArraysRule6->setRegexp("/^'(?:[^'\\\\]|(?:\\\\\\\\)|(?:\\\\\\\\)*\\\\.{1})*'/i");
$phpArraysRule6->setTokenType(\Cheope_ppg_ns\src\Token::TYPE_LEXICAL_ELEMENT);
$phpArraysRule6->setTokenVal(PHP_ARRAYS_TOKEN_VAL_ITEM1);

$phpArraysRule7->setRegexp("/^\"(?:[^\"\\\\]|(?:\\\\\\\\)|(?:\\\\\\\\)*\\\\.{1})*\"/i");
$phpArraysRule7->setTokenType(\Cheope_ppg_ns\src\Token::TYPE_LEXICAL_ELEMENT);
$phpArraysRule7->setTokenVal(PHP_ARRAYS_TOKEN_VAL_ITEM2);

$phpArraysRule8->setRegexp("/^[0-9][0-9]*/i");
$phpArraysRule8->setTokenType(\Cheope_ppg_ns\src\Token::TYPE_LEXICAL_ELEMENT);
$phpArraysRule8->setTokenVal(PHP_ARRAYS_TOKEN_VAL_NUM);

$phpArraysRule9->setRegexp("/^[A-Z@_]+/");
$phpArraysRule9->setTokenType(\Cheope_ppg_ns\src\Token::TYPE_LEXICAL_ELEMENT);
$phpArraysRule9->setTokenVal(PHP_ARRAYS_TOKEN_VAL_CONST);

define('PHP_ARRAYS_LEX_RULE_CONTAINER_0',"Contenitore_regole_0");

$phpArraysDefRules=new \Cheope_ppg_ns\src\Lex_rules_container(PHP_ARRAYS_LEX_RULE_CONTAINER_0);
$phpArraysDefRules->add($phpArraysRule0);
$phpArraysDefRules->add($phpArraysRule1);
$phpArraysDefRules->add($phpArraysRule2);
$phpArraysDefRules->add($phpArraysRule3);
$phpArraysDefRules->add($phpArraysRule4);
$phpArraysDefRules->add($phpArraysRule5);
$phpArraysDefRules->add($phpArraysRule6);
$phpArraysDefRules->add($phpArraysRule7);
$phpArraysDefRules->add($phpArraysRule8);
$phpArraysDefRules->add($phpArraysRule9);

$phpArraysRulesArray=array($phpArraysDefRules);

define('PHP_ARRAYS_PARSER_GRAMMAR_RULE_CONTAINER_1',"Contenitore_regole_grammaticali_1");

$phpArraysDefGrRule0=new Parser_grammar_rule_a();

$phpArraysDefGrRules=new \Cheope_ppg_ns\src\Parser_grammar_rules_container(PHP_ARRAYS_PARSER_GRAMMAR_RULE_CONTAINER_1);
$phpArraysDefGrRules->add($phpArraysDefGrRule0);

?>