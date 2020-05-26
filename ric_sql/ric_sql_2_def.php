<?
namespace Cheope_ppp_ns\ric_sql;
require_once(__DIR__ . "/../src/Lex_rules_container.php");
require_once(__DIR__ . "/../src/Parser_grammar_rules_container.php");
require_once("Ric_sql_2_parser_grammar_rules.php");

define('RIC_SQL_2_TOKEN_VAL_SELECT',"select");
define('RIC_SQL_2_TOKEN_VAL_FROM',"from");
define('RIC_SQL_2_TOKEN_VAL_INNER',"inner");
define('RIC_SQL_2_TOKEN_VAL_JOIN',"join");
define('RIC_SQL_2_TOKEN_VAL_LEFT',"left");
define('RIC_SQL_2_TOKEN_VAL_ON',"on");
define('RIC_SQL_2_TOKEN_VAL_WHERE',"where");
define('RIC_SQL_2_TOKEN_VAL_ORDER',"order");
define('RIC_SQL_2_TOKEN_VAL_BY',"by");
define('RIC_SQL_2_TOKEN_VAL_GROUP',"group");
define('RIC_SQL_2_TOKEN_VAL_AS',"as");
define('RIC_SQL_2_TOKEN_VAL_LIKE',"like");
define('RIC_SQL_2_TOKEN_VAL_STAR',"star");
define('RIC_SQL_2_TOKEN_VAL_FUN_HEAD',"fun_head");
define('RIC_SQL_2_TOKEN_VAL_NUM',"num");
define('RIC_SQL_2_TOKEN_VAL_LOGICALOP',"logicalop");
define('RIC_SQL_2_TOKEN_VAL_OP',"op");
define('RIC_SQL_2_TOKEN_VAL_RELOP',"relop");
define('RIC_SQL_2_TOKEN_VAL_ITEM',"item");
define('RIC_SQL_2_TOKEN_VAL_WS',"ws");
define('RIC_SQL_2_TOKEN_VAL_COMMA',"comma");
define('RIC_SQL_2_TOKEN_VAL_POINT',"point");
define('RIC_SQL_2_TOKEN_VAL_OPEN_PAR',"open_par");
define('RIC_SQL_2_TOKEN_VAL_CLOSE_PAR',"close_par");
define('RIC_SQL_2_TOKEN_VAL_SSTRING',"sstring");

define('RIC_SQL_2_TOKEN_ATTR_FIELD',"field");
define('RIC_SQL_2_TOKEN_ATTR_TABLE',"table");

define('RIC_SQL_2_RULE_NAME_SUFFIX',"rule");

define('RIC_SQL_2_SELECT_RULE',RIC_SQL_2_TOKEN_VAL_SELECT . RIC_SQL_2_RULE_NAME_SUFFIX);
define('RIC_SQL_2_FROM_RULE',RIC_SQL_2_TOKEN_VAL_FROM . RIC_SQL_2_RULE_NAME_SUFFIX);
define('RIC_SQL_2_INNER_RULE',RIC_SQL_2_TOKEN_VAL_INNER . RIC_SQL_2_RULE_NAME_SUFFIX);
define('RIC_SQL_2_JOIN_RULE',RIC_SQL_2_TOKEN_VAL_JOIN . RIC_SQL_2_RULE_NAME_SUFFIX);
define('RIC_SQL_2_LEFT_RULE',RIC_SQL_2_TOKEN_VAL_LEFT . RIC_SQL_2_RULE_NAME_SUFFIX);
define('RIC_SQL_2_ON_RULE',RIC_SQL_2_TOKEN_VAL_ON . RIC_SQL_2_RULE_NAME_SUFFIX);
define('RIC_SQL_2_WHERE_RULE',RIC_SQL_2_TOKEN_VAL_WHERE . RIC_SQL_2_RULE_NAME_SUFFIX);
define('RIC_SQL_2_ORDER_RULE',RIC_SQL_2_TOKEN_VAL_ORDER . RIC_SQL_2_RULE_NAME_SUFFIX);
define('RIC_SQL_2_BY_RULE',RIC_SQL_2_TOKEN_VAL_BY . RIC_SQL_2_RULE_NAME_SUFFIX);
define('RIC_SQL_2_GROUP_RULE',RIC_SQL_2_TOKEN_VAL_GROUP . RIC_SQL_2_RULE_NAME_SUFFIX);
define('RIC_SQL_2_AS_RULE',RIC_SQL_2_TOKEN_VAL_AS . RIC_SQL_2_RULE_NAME_SUFFIX);
define('RIC_SQL_2_LIKE_RULE',RIC_SQL_2_TOKEN_VAL_LIKE . RIC_SQL_2_RULE_NAME_SUFFIX);
define('RIC_SQL_2_STAR_RULE',RIC_SQL_2_TOKEN_VAL_STAR . RIC_SQL_2_RULE_NAME_SUFFIX);
define('RIC_SQL_2_FUN_HEAD_RULE',RIC_SQL_2_TOKEN_VAL_FUN_HEAD . RIC_SQL_2_RULE_NAME_SUFFIX);
define('RIC_SQL_2_NUM_RULE',RIC_SQL_2_TOKEN_VAL_NUM . RIC_SQL_2_RULE_NAME_SUFFIX);
define('RIC_SQL_2_LOGICALOP_RULE',RIC_SQL_2_TOKEN_VAL_LOGICALOP . RIC_SQL_2_RULE_NAME_SUFFIX);
define('RIC_SQL_2_OP_RULE',RIC_SQL_2_TOKEN_VAL_OP . RIC_SQL_2_RULE_NAME_SUFFIX);
define('RIC_SQL_2_RELOP_RULE',RIC_SQL_2_TOKEN_VAL_RELOP . RIC_SQL_2_RULE_NAME_SUFFIX);
define('RIC_SQL_2_ITEM_RULE',RIC_SQL_2_TOKEN_VAL_ITEM . RIC_SQL_2_RULE_NAME_SUFFIX);
define('RIC_SQL_2_WS_RULE',RIC_SQL_2_TOKEN_VAL_WS . RIC_SQL_2_RULE_NAME_SUFFIX);
define('RIC_SQL_2_COMMA_RULE',RIC_SQL_2_TOKEN_VAL_COMMA . RIC_SQL_2_RULE_NAME_SUFFIX);
define('RIC_SQL_2_POINT_RULE',RIC_SQL_2_TOKEN_VAL_POINT . RIC_SQL_2_RULE_NAME_SUFFIX);
define('RIC_SQL_2_OPEN_PAR_RULE',RIC_SQL_2_TOKEN_VAL_OPEN_PAR . RIC_SQL_2_RULE_NAME_SUFFIX);
define('RIC_SQL_2_CLOSE_PAR_RULE',RIC_SQL_2_TOKEN_VAL_CLOSE_PAR . RIC_SQL_2_RULE_NAME_SUFFIX);
define('RIC_SQL_2_SSTRING_RULE',RIC_SQL_2_TOKEN_VAL_SSTRING . RIC_SQL_2_RULE_NAME_SUFFIX);

$ricSql2Rule0=new \Cheope_ppp_ns\src\Lex_rule("regola0");
$ricSql2Rule1=new \Cheope_ppp_ns\src\Lex_rule("regola1");
$ricSql2Rule2=new \Cheope_ppp_ns\src\Lex_rule("regola2");
$ricSql2Rule3=new \Cheope_ppp_ns\src\Lex_rule("regola3");
$ricSql2Rule4=new \Cheope_ppp_ns\src\Lex_rule("regola4");
$ricSql2Rule5=new \Cheope_ppp_ns\src\Lex_rule("regola5");
$ricSql2Rule6=new \Cheope_ppp_ns\src\Lex_rule("regola6");
$ricSql2Rule7=new \Cheope_ppp_ns\src\Lex_rule("regola7");
$ricSql2Rule8=new \Cheope_ppp_ns\src\Lex_rule("regola8");
$ricSql2Rule9=new \Cheope_ppp_ns\src\Lex_rule("regola9");
$ricSql2Rule10=new \Cheope_ppp_ns\src\Lex_rule("regola10");
$ricSql2Rule11=new \Cheope_ppp_ns\src\Lex_rule("regola11");
$ricSql2Rule12=new \Cheope_ppp_ns\src\Lex_rule("regola12");
$ricSql2Rule13=new \Cheope_ppp_ns\src\Lex_rule("regola13");
$ricSql2Rule14=new \Cheope_ppp_ns\src\Lex_rule("regola14");
$ricSql2Rule15=new \Cheope_ppp_ns\src\Lex_rule("regola15");
$ricSql2Rule16=new \Cheope_ppp_ns\src\Lex_rule("regola16");
$ricSql2Rule17=new \Cheope_ppp_ns\src\Lex_rule("regola17");
$ricSql2Rule18=new \Cheope_ppp_ns\src\Lex_rule("regola18");
$ricSql2Rule19=new \Cheope_ppp_ns\src\Lex_rule("regola19");
$ricSql2Rule20=new \Cheope_ppp_ns\src\Lex_rule("regola20");
$ricSql2Rule21=new \Cheope_ppp_ns\src\Lex_rule("regola21");
$ricSql2Rule22=new \Cheope_ppp_ns\src\Lex_rule("regola22");
$ricSql2Rule23=new \Cheope_ppp_ns\src\Lex_rule("regola23");
$ricSql2Rule24=new \Cheope_ppp_ns\src\Lex_rule("regola24");

$ricSql2Rule0->setRegexp("/^SELECT\b/i");
$ricSql2Rule0->setTokenType(\Cheope_ppp_ns\src\Token::TYPE_RESERVED_WORD);
$ricSql2Rule0->setTokenVal(RIC_SQL_2_TOKEN_VAL_SELECT);

$ricSql2Rule1->setRegexp("/^FROM\b/i");
$ricSql2Rule1->setTokenType(\Cheope_ppp_ns\src\Token::TYPE_RESERVED_WORD);
$ricSql2Rule1->setTokenVal(RIC_SQL_2_TOKEN_VAL_FROM);

$ricSql2Rule2->setRegexp("/^INNER\b/i");
$ricSql2Rule2->setTokenType(\Cheope_ppp_ns\src\Token::TYPE_RESERVED_WORD);
$ricSql2Rule2->setTokenVal(RIC_SQL_2_TOKEN_VAL_INNER);

$ricSql2Rule3->setRegexp("/^JOIN\b/i");
$ricSql2Rule3->setTokenType(\Cheope_ppp_ns\src\Token::TYPE_RESERVED_WORD);
$ricSql2Rule3->setTokenVal(RIC_SQL_2_TOKEN_VAL_JOIN);

$ricSql2Rule4->setRegexp("/^LEFT\b/i");
$ricSql2Rule4->setTokenType(\Cheope_ppp_ns\src\Token::TYPE_RESERVED_WORD);
$ricSql2Rule4->setTokenVal(RIC_SQL_2_TOKEN_VAL_LEFT);

$ricSql2Rule5->setRegexp("/^ON\b/i");
$ricSql2Rule5->setTokenType(\Cheope_ppp_ns\src\Token::TYPE_RESERVED_WORD);
$ricSql2Rule5->setTokenVal(RIC_SQL_2_TOKEN_VAL_ON);

$ricSql2Rule6->setRegexp("/^WHERE\b/i");
$ricSql2Rule6->setTokenType(\Cheope_ppp_ns\src\Token::TYPE_RESERVED_WORD);
$ricSql2Rule6->setTokenVal(RIC_SQL_2_TOKEN_VAL_WHERE);

$ricSql2Rule7->setRegexp("/^ORDER\b/i");
$ricSql2Rule7->setTokenType(\Cheope_ppp_ns\src\Token::TYPE_RESERVED_WORD);
$ricSql2Rule7->setTokenVal(RIC_SQL_2_TOKEN_VAL_ORDER);

$ricSql2Rule8->setRegexp("/^BY\b/i");
$ricSql2Rule8->setTokenType(\Cheope_ppp_ns\src\Token::TYPE_RESERVED_WORD);
$ricSql2Rule8->setTokenVal(RIC_SQL_2_TOKEN_VAL_BY);

$ricSql2Rule9->setRegexp("/^GROUP\b/i");
$ricSql2Rule9->setTokenType(\Cheope_ppp_ns\src\Token::TYPE_RESERVED_WORD);
$ricSql2Rule9->setTokenVal(RIC_SQL_2_TOKEN_VAL_GROUP);

$ricSql2Rule10->setRegexp("/^AS\b/i");
$ricSql2Rule10->setTokenType(\Cheope_ppp_ns\src\Token::TYPE_RESERVED_WORD);
$ricSql2Rule10->setTokenVal(RIC_SQL_2_TOKEN_VAL_AS);

$ricSql2Rule11->setRegexp("/^LIKE(?=(\b)|(\())/i");
$ricSql2Rule11->setTokenType(\Cheope_ppp_ns\src\Token::TYPE_RESERVED_WORD);
$ricSql2Rule11->setTokenVal(RIC_SQL_2_TOKEN_VAL_LIKE);

$ricSql2Rule12->setRegexp("/^[\*]/");
$ricSql2Rule12->setTokenType(\Cheope_ppp_ns\src\Token::TYPE_SPECIAL_ITEM);
$ricSql2Rule12->setTokenVal(RIC_SQL_2_TOKEN_VAL_STAR);

$ricSql2Rule13->setRegexp("/^(count|avg|sum)(?=\()/i");
$ricSql2Rule13->setTokenType(\Cheope_ppp_ns\src\Token::TYPE_SPECIAL_ITEM);
$ricSql2Rule13->setTokenVal(RIC_SQL_2_TOKEN_VAL_FUN_HEAD);

$ricSql2Rule14->setRegexp("/^([+-]?[1-9][0-9]*)|[+-]?[0-9]*[\.][0-9]/");
$ricSql2Rule14->setTokenType(\Cheope_ppp_ns\src\Token::TYPE_SPECIAL_ITEM);
$ricSql2Rule14->setTokenVal(RIC_SQL_2_TOKEN_VAL_NUM);

$ricSql2Rule15->setRegexp("/^AND(?=(\b)|(\())|OR(?=(\b)|(\())/i");
$ricSql2Rule15->setTokenType(\Cheope_ppp_ns\src\Token::TYPE_SPECIAL_ITEM);
$ricSql2Rule15->setTokenVal(RIC_SQL_2_TOKEN_VAL_LOGICALOP);

$ricSql2Rule16->setRegexp("/^[\+\-\/]/i");
$ricSql2Rule16->setTokenType(\Cheope_ppp_ns\src\Token::TYPE_SPECIAL_ITEM);
$ricSql2Rule16->setTokenVal(RIC_SQL_2_TOKEN_VAL_OP);

$ricSql2Rule17->setRegexp("/^(<>|<=|>=|>|<|=)/i");
$ricSql2Rule17->setTokenType(\Cheope_ppp_ns\src\Token::TYPE_SPECIAL_ITEM);
$ricSql2Rule17->setTokenVal(RIC_SQL_2_TOKEN_VAL_RELOP);

$ricSql2Rule18->setRegexp("/^[A-Za-z][A-Za-z0-9_]*/");
$ricSql2Rule18->setTokenType(\Cheope_ppp_ns\src\Token::TYPE_LEXICAL_ELEMENT);
$ricSql2Rule18->setTokenVal(RIC_SQL_2_TOKEN_VAL_ITEM);

$ricSql2Rule19->setRegexp("/^[\s]+/");
$ricSql2Rule19->setTokenType(\Cheope_ppp_ns\src\Token::TYPE_DELIM);
$ricSql2Rule19->setTokenVal(RIC_SQL_2_TOKEN_VAL_WS);

$ricSql2Rule20->setRegexp("/^,/");
$ricSql2Rule20->setTokenType(\Cheope_ppp_ns\src\Token::TYPE_SPECIAL_ITEM);
$ricSql2Rule20->setTokenVal(RIC_SQL_2_TOKEN_VAL_COMMA);

$ricSql2Rule21->setRegexp("/^\./");
$ricSql2Rule21->setTokenType(\Cheope_ppp_ns\src\Token::TYPE_SPECIAL_ITEM);
$ricSql2Rule21->setTokenVal(RIC_SQL_2_TOKEN_VAL_POINT);

$ricSql2Rule22->setRegexp("/^\(/");
$ricSql2Rule22->setTokenType(\Cheope_ppp_ns\src\Token::TYPE_SPECIAL_ITEM);
$ricSql2Rule22->setTokenVal(RIC_SQL_2_TOKEN_VAL_OPEN_PAR);

$ricSql2Rule23->setRegexp("/^\)/");
$ricSql2Rule23->setTokenType(\Cheope_ppp_ns\src\Token::TYPE_SPECIAL_ITEM);
$ricSql2Rule23->setTokenVal(RIC_SQL_2_TOKEN_VAL_CLOSE_PAR);

$ricSql2Rule24->setRegexp("/^(\"[a-zA-Z0-9_,:\.;\\\|!\$\/\(\)=\?\^\[\]@#]*\")|('[a-zA-Z0-9_,:\.;\\\|!\$\/\(\)=\?\^\[\]@#\s]*')/");
$ricSql2Rule24->setTokenType(\Cheope_ppp_ns\src\Token::TYPE_SPECIAL_ITEM);
$ricSql2Rule24->setTokenVal(RIC_SQL_2_TOKEN_VAL_SSTRING);

define('RIC_SQL_2_LEX_RULE_CONTAINER_0',"Contenitore_regole_0");

$ricSql2DefRules=new \Cheope_ppp_ns\src\Lex_rules_container(RIC_SQL_2_LEX_RULE_CONTAINER_0);
$ricSql2DefRules->add($ricSql2Rule0);
$ricSql2DefRules->add($ricSql2Rule1);
$ricSql2DefRules->add($ricSql2Rule2);
$ricSql2DefRules->add($ricSql2Rule3);
$ricSql2DefRules->add($ricSql2Rule4);
$ricSql2DefRules->add($ricSql2Rule5);
$ricSql2DefRules->add($ricSql2Rule6);
$ricSql2DefRules->add($ricSql2Rule7);
$ricSql2DefRules->add($ricSql2Rule8);
$ricSql2DefRules->add($ricSql2Rule9);
$ricSql2DefRules->add($ricSql2Rule10);
$ricSql2DefRules->add($ricSql2Rule11);
$ricSql2DefRules->add($ricSql2Rule12);
$ricSql2DefRules->add($ricSql2Rule13);
$ricSql2DefRules->add($ricSql2Rule14);
$ricSql2DefRules->add($ricSql2Rule15);
$ricSql2DefRules->add($ricSql2Rule16);
$ricSql2DefRules->add($ricSql2Rule17);
$ricSql2DefRules->add($ricSql2Rule18);
$ricSql2DefRules->add($ricSql2Rule19);
$ricSql2DefRules->add($ricSql2Rule20);
$ricSql2DefRules->add($ricSql2Rule21);
$ricSql2DefRules->add($ricSql2Rule22);
$ricSql2DefRules->add($ricSql2Rule23);
$ricSql2DefRules->add($ricSql2Rule24);

$ricSql2RulesArray=array($ricSql2DefRules);

define('RIC_SQL_2_PARSER_GRAMMAR_RULE_CONTAINER_1',"Contenitore_regole_grammaticali_1");

$ricSql2DefGrRule0=new Parser_grammar_rule_a("");

$ricSql2DefGrRules=new \Cheope_ppp_ns\src\Parser_grammar_rules_container(RIC_SQL_2_PARSER_GRAMMAR_RULE_CONTAINER_1);
$ricSql2DefGrRules->add($ricSql2DefGrRule0);

?>