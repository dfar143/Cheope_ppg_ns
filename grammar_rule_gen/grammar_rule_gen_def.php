<?
namespace Cheope_ppg_ns\grammar_rule_gen;

require_once("../src/Lex_rules_container.php");
require_once("Grammar_rule_gen_parser_grammar_rules.php");
require_once("../src/Parser_grammar_rules_container.php");

define('TOKEN_VAL_NONTERMINALE',"NONTERMINALE");
define('TOKEN_VAL_TERMINALE',"TERMINALE");
define('TOKEN_VAL_WS',"WS");
define('TOKEN_VAL_OR',"OR");
define('TOKEN_VAL_EQUAL',"EQUAL");

define('TOKEN_VAL_EOS',"EOS");
define('TOKEN_VAL_ALFA',"ALFA");
define('TOKEN_VAL_AC',"AC");
define('TOKEN_VAL_AS',"AS");
define('TOKEN_VAL_BETA',"BETA");
define('TOKEN_VAL_CIAO',"CIAO");
define('TOKEN_VAL_BABAU',"BABAU");

define('RULE_NAME_SUFFIX',"rule");

define('NONTERMINALE_RULE',TOKEN_VAL_NONTERMINALE . STRING_UNDERSCORE . RULE_NAME_SUFFIX);
define('TERMINALE_RULE',TOKEN_VAL_TERMINALE . STRING_UNDERSCORE . RULE_NAME_SUFFIX);
define('WS_RULE',TOKEN_VAL_WS . STRING_UNDERSCORE . RULE_NAME_SUFFIX);
define('OR_RULE',TOKEN_VAL_OR . STRING_UNDERSCORE . RULE_NAME_SUFFIX);
define('EQUAL_RULE',TOKEN_VAL_EQUAL . STRING_UNDERSCORE . RULE_NAME_SUFFIX);
define('EOS_RULE',TOKEN_VAL_EOS . STRING_UNDERSCORE . RULE_NAME_SUFFIX );


$reservedWords = array();
$specialItems = array(TOKEN_VAL_OR,TOKEN_VAL_EQUAL);

define('LEX_RULE_1',"Regola1");
define('LEX_RULE_2',"Regola2");
define('LEX_RULE_3',"Regola3");
define('LEX_RULE_4',"Regola4");
define('LEX_RULE_5',"Regola5");

define('LEX_RULE_CONTAINER_1',"Contenitore_regole_1");

define('PARSER_RULE_1',"Regola_grammaticale_1");
define('PARSER_GRAMMAR_RULE_CONTAINER_1',"Contenitore_regole_grammaticali_1");

$rule1 = new \Cheope_ppg_ns\src\Lex_rule(LEX_RULE_1);
$rule2 = new \Cheope_ppg_ns\src\Lex_rule(LEX_RULE_2);
$rule3 = new \Cheope_ppg_ns\src\Lex_rule(LEX_RULE_3);
$rule4 = new \Cheope_ppg_ns\src\Lex_rule(LEX_RULE_4);
$rule5 = new \Cheope_ppg_ns\src\Lex_rule(LEX_RULE_5);
//$dfa6 = &new Lex_dfa(LEX_RULE_6);

$rule1->setRegexp("/^[A-Z][A-Z_a-z0-9]*/");
$rule1->setTokenType(\Cheope_ppg_ns\src\Token::TYPE_LEXICAL_ELEMENT);
$rule1->setTokenVal(TOKEN_VAL_NONTERMINALE);

$rule2->setRegexp("/^[a-z][A-Z_a-z0-9]*/");
$rule2->setTokenType(\Cheope_ppg_ns\src\Token::TYPE_LEXICAL_ELEMENT);
$rule2->setTokenVal(TOKEN_VAL_TERMINALE);

$rule3->setRegexp("/^[\s]+/");
$rule3->setTokenType(\Cheope_ppg_ns\src\Token::TYPE_DELIM);
$rule3->setTokenVal(TOKEN_VAL_WS);

$rule4->setRegexp("/^\|/");
$rule4->setTokenType(\Cheope_ppg_ns\src\Token::TYPE_SPECIAL_ITEM);
$rule4->setTokenVal(TOKEN_VAL_OR);

$rule5->setRegexp("/^=/");
$rule5->setTokenType(\Cheope_ppg_ns\src\Token::TYPE_SPECIAL_ITEM);
$rule5->setTokenVal(TOKEN_VAL_EQUAL);

$rules = new \Cheope_ppg_ns\src\Lex_rules_container(LEX_RULE_CONTAINER_1);
$rules->add($rule1);
$rules->add($rule2);
$rules->add($rule3);
$rules->add($rule4);
$rules->add($rule5);

$grRule1 = new Parser_grammar_rule_produz_1();

$grRules = new \Cheope_ppg_ns\src\Parser_grammar_rules_container(PARSER_GRAMMAR_RULE_CONTAINER_1);
$grRules->add($grRule1);
?>