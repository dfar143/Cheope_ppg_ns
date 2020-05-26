# Cheope_ppp_ns
Php generic parser generator with namespaces
===========================

BACKTRACKING PARSER GENERATOR FOR PHP.

The parser generator is in the 'grammar_rule_gen' directory.
The main module is 'parser_gen_exec.php'.

Usage:
php parser_gen_exec.php |prjName| -l |logFileName|

where |prjName| is the project name and must match the |prjName|.xml
grammars definition file.

Example:
php parser_gen_exec.php example_1 -l log.txt
or (the -l flag is optional)
php parser_gen_exec.php example_1

The module can be called from a browser too: the default log file name 
is 'log.txt'.
In this case, to specify the project name, you must edit the 
'grammar_rules_gen_def.php' file and set the PRJ_NAME constant to the right 
project name.

The grammar definition file allows to write any number of grammars in the 
'grammar_rules' section.
Each grammar must have a 'grammar_rule' main section with a 'name'
not null attribute. 
The main section contains 3 sub-sections:
'tokens_def' that contains tokens regular expressions definitions ('token' tags);
'tokens_attributes' that contains tokens attributes definitions ('Attr' tags);
'productions' that contains all the productions for the grammar ('production' tags).

A generic production has a very simple sintax; it is composed by
not terminals (in uppercase), terminals (in lowercase), the equal (=) symbol that
divides the left and the right side of the production 
and the logical OR symbol (|).
The terminal 'epsilon' is the always true terminal.
The terminal 'ws' is used to specify the white space and his exact definition 
must be included (with his regular expression) in the tokens definition section.
The code for not terminal SPACE is automatically generated and the associated production
(implicitly present) is SPACE = ws | epsilon. Not terminal SPACE can be freely
used in the others productions.
The right side is typically composed by successions of terminals and not terminals 
divided by logical ORs symbols; each succession is a logical AND succession.

Each token is defined by a 'token' xml tag that have two mandatory attributes:
'type' and 'val'.
The precedence of the tokens definitions is important.
See 'example_1.xml' for an example of a grammar definition file.

Attributes are optionally, but the section 'tokens_attributes' must be present.
See directory 'Ric_sql' and files 'ric_sql_def.php' and 
'Ric_sql_parser_grammar_rules.php' for an example of using them.
 
The php module generates two others modules that are : |prjName|_def.php and
|prjName|_parser_grammar_rules.php.
The first contains constants, lex rules objects instances definitions and grammar 
rules objects instances definitions. The second contains the parser recursive 
engine.
The results of the execution are added at each call, so to create a new 
parser you have to flush the old files.
These files must then be copied in the destination directory.
As an example of destination directory you can use the 'parser_example'
directory. This one contains the others parser files.
The parser generic engine is in the 'Parser.php' file and contains the main php
Parser class.
This class has ,as entry point, the public method 'exec' that tries all the grammars 
and returns true if the text to be parsed satisfied at least one.
It fills the '$results' array with the execution status for each grammar.
See 'Parser.php' file comments.
 
In the 'Parser_example' directory there is the 'parser_exec.php' module that
calls the parser engine.

Usage:
php parser_exec.php |textToBeParsedFileName|

where |textToBeParsedFileName| is the file that contains the text to be parsed.

Example:
php parser_exec.php example.txt

The 'parser_exec.php' module acts like a validator and returns 'Ok.' if succedes
or the current error if not.
Furthermore, if it is called by a browser, it displays the symbol table.

The applications 'php_arrays' and 'ric_sql' are under development.

This application has been developed with PHP version 5.5.7, but I suppose , it can run
with many others previous, since no particulary advanced techniques has been used,except class 
construct.
 


