<?
namespace Cheope_ppp_ns\parser_example;

require_once("../src/Parser_grammar_rule.php");

define('A_GRAMMAR_RULE',"a");

class  Parser_grammar_rule_a extends \Cheope_ppp_ns\src\parser_grammar_rule
{


function __construct()
{
parent::__construct(A_GRAMMAR_RULE);
}

function init()
{

}

function getTokensBufferPointer()
{
$parser = &$this->getParser();
$tokensBufferIter = &$parser->getTokensBufferIterator();
return ($tokensBufferIter->pos());

}

function backtrack($actTokensBufferPointer)
{
$parser = &$this->getParser();
$tokensBufferIter = &$parser->getTokensBufferIterator();
$tokensBufferIter->reset();
$i=0;
while($i <= $actTokensBufferPointer-1)
{
$tokensBufferIter->next();
$i++;
}

}

function space()
{
$parser = &$this->getParser();
$localTokensBufferPointer = $this->getTokensBufferPointer();
$res1 = $parser->match(\Cheope_ppp_ns\src\Token::TYPE_DELIM,EXAMPLE_1_TOKEN_VAL_WS);
if(! $res1)
$this->backtrack($localTokensBufferPointer);
$res2 = true;
$res = $res1 || $res2;
if(! $res)
return false;
return true;

}

function exec()
{
$parser = &$this->getParser();
$lex = &$parser->getLex();
$localTokensBufferPointer = $this->getTokensBufferPointer();

$res1=true;
$res2=true;
$res11=false;
$res12=false;
$res13=false;

$res11=$this->A();

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res12=$parser->match(\Cheope_ppp_ns\src\Token::TYPE_LEXICAL_ELEMENT,EXAMPLE_1_TOKEN_VAL_B);

if(!$res12)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res13=$this->A();

if(!$res13)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
}

}

}

$res1=$res11 && $res12 && $res13;

if(!$res1)
{
$res21=false;
$res22=false;

$res21=$this->A();

if(!$res21)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res22=$parser->match(\Cheope_ppp_ns\src\Token::TYPE_LEXICAL_ELEMENT,EXAMPLE_1_TOKEN_VAL_B);

if(!$res22)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
}

}

$res2=$res21 && $res22;
}

$res=$res1 | $res2;

if (! $res)
return false;
return true;
}

function A()
{
$parser = &$this->getParser();
$lex = &$parser->getLex();
$localTokensBufferPointer = $this->getTokensBufferPointer();

$res1=true;
$res11=false;

$res11=$parser->match(\Cheope_ppp_ns\src\Token::TYPE_LEXICAL_ELEMENT,EXAMPLE_1_TOKEN_VAL_A);

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
}

$res1=$res11;
$res=$res1;

if (! $res)
return false;
return true;
}

function B()
{
$parser = &$this->getParser();
$lex = &$parser->getLex();
$localTokensBufferPointer = $this->getTokensBufferPointer();

$res1=true;
$res11=false;

$res11=$parser->match(\Cheope_ppp_ns\src\Token::TYPE_LEXICAL_ELEMENT,EXAMPLE_1_TOKEN_VAL_B);

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
}

$res1=$res11;
$res=$res1;

if (! $res)
return false;
return true;
}

}


define('B_GRAMMAR_RULE',"b");

class  Parser_grammar_rule_b extends \Cheope_ppp_ns\src\parser_grammar_rule
{


function Parser_grammar_rule_b()
{
parent::parser_grammar_rule(B_GRAMMAR_RULE);
}

function init()
{

}

function getTokensBufferPointer()
{
$parser = &$this->getParser();
$tokensBufferIter = &$parser->getTokensBufferIterator();
return ($tokensBufferIter->pos());

}

function backtrack($actTokensBufferPointer)
{
$parser = &$this->getParser();
$tokensBufferIter = &$parser->getTokensBufferIterator();
$tokensBufferIter->reset();
$i=0;
while($i <= $actTokensBufferPointer-1)
{
$tokensBufferIter->next();
$i++;
}

}

function space()
{
$parser = &$this->getParser();
$localTokensBufferPointer = $this->getTokensBufferPointer();
$res1 = $parser->match(Token::TYPE_DELIM,EXAMPLE_1_TOKEN_VAL_WS);
if(! $res1)
$this->backtrack($localTokensBufferPointer);
$res2 = true;
$res = $res1 || $res2;
if(! $res)
return false;
return true;

}

function exec()
{
$parser = &$this->getParser();
$lex = &$parser->getLex();
$localTokensBufferPointer = $this->getTokensBufferPointer();

$res1=true;
$res2=true;
$res11=false;

$res11=$this->B();

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
}

$res1=$res11;

if(!$res1)
{
$res21=false;

$res21=$parser->match(\Cheope_ppp_ns\src\Token::TYPE_LEXICAL_ELEMENT,EXAMPLE_1_TOKEN_VAL_C);

if(!$res21)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
}

$res2=$res21;
}

$res=$res1 | $res2;

if (! $res)
return false;
return true;
}

function B()
{
$parser = &$this->getParser();
$lex = &$parser->getLex();
$localTokensBufferPointer = $this->getTokensBufferPointer();

$res1=true;
$res11=false;

$res11=$parser->match(\Cheope_ppp_ns\src\Token::TYPE_LEXICAL_ELEMENT,EXAMPLE_1_TOKEN_VAL_B);

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
}

$res1=$res11;
$res=$res1;

if (! $res)
return false;
return true;
}

}
?>