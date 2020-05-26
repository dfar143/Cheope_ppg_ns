<?
namespace Cheope_ppp_ns\src;
require_once("generic_const.php");

if (substr(PHP_OS, 0, 3) == 'WIN') {
    define('OS_WINDOWS', true);
    define('OS_UNIX',    false);
    define('OS',    'Windows');
} else {
    define('OS_WINDOWS', false);
    define('OS_UNIX',    true);
    define('OS',    'Unix'); 
}

if(OS=="Windows")
{
 //define('DIR_SEP',STRING_BACKSLASH);
 // *****************
 // per evitare casini.
 // *****************
 define('DIR_SEP',STRING_SLASH);
}
elseif(OS=="Unix")
{
 define('DIR_SEP',STRING_SLASH);
} 

if(OS=="Windows")
{
 define('DEFAULT_LOGICAL_UNIT',"C"); 
 define('DEFAULT_FILESYSTEM_ROOT',DEFAULT_LOGICAL_UNIT . STRING_COLON . DIR_SEP);
}
elseif(OS=="Unix")
{
 define('DEFAULT_FILESYSTEM_ROOT',DIR_SEP);
}

define('THIS_DIR',STRING_POINT);
define('FILE_NAME_ELEMENTS_SEP',STRING_POINT);

if(OS=="Windows")
{
define('TTF_DIR',DEFAULT_FILESYSTEM_ROOT . "windows" . DIR_SEP . "fonts");
}

define('XML_SUFFIX',"xml");

?>