<?
namespace Cheope_ppp_ns\grammar_rule_gen;

require_once(__DIR__ . "/../src/Generic_interface.php");

define('PARENT_CLASS',"parser_grammar_rule");

class Php_class_gen extends \Cheope_ppp_ns\src\Generic_interface
{
 private $fileName;
 private $fileHandle;
 private $requireOnces = array();
 private $defines = array();
 private $className;
 private $parentClass;
 private $publicProps = array();
 private $constructorArgs = array();
 private $constructorBody;
 private $methodsNames = array();
 // Array of array.
 private $methodsArgs = array();
 private $methodsBodies = array();

 function __construct($actClass,$actNum)
 {
 	parent::__construct(STRING_NULL,INT_PHP_CLASS_GEN,$actNum);
 	$this->setClassName($actClass);
 }
 
 function getFileName()
 {
 	return $this->fileName;
 }
 
 function setFileName($actFileName)
 {
 	$this->fileName = $actFileName;
 }
 
 function getFileHandle()
 {
 	return $this->fileHandle;
 }
 
 function setFileHandle($actFileHandle)
 {
 	$this->fileHandle = $actFileHandle;
 }
 
 function &getRequireOnces()
 {
 	return $this->requireOnces;
 }
 
 function setRequireOnces($actRequireOnces)
 {
 	$this->requireOnces = $actRequireOnces;
 }
 
 function &getDefines()
 {
 	return $this->defines;
 }
 
 function setDefines($actDefines)
 {
 	$this->defines = $actDefines;
 }
 
 function EOL()
 {
 	$fileName = $this->getFileName();
 	if($fileName != STRING_NULL)
 	{
 	 return STRING_RETURN . STRING_LINE_FEED;
  }
  else
   return SEP_COMPLETE_TAG;
 }
 
 function puts($actStr)
 {
 	$fileName = $this->getFileName();
 	if($fileName != STRING_NULL)
 	{
 	 $fileHandle = $this->getFileHandle();
 	 fwrite($fileHandle,$actStr);
  }
  else
   echo $actStr;
 }
 
 function setClassName($actClassName)
 {
 	$this->className = $actClassName;
 }
 
 function getClassName()
 {
 	return $this->className;
 }
 
 function setParentClass($actParentClass)
 {
 	$this->parentClass = $actParentClass;
 }
 
 function getParentClass()
 {
 	if (isset($this->parentClass))
 	 return $this->parentClass;
 	else
 	 return PARENT_CLASS;
 }
 
 function putMethodCall($actObj,$actMethodName,$actMethodArgs=array())
 {
 	if(isset($actMethodArgs[0]))
 	{
 	 $methodArgs=$actMethodArgs[0]; 
 	 $num = count($actMethodArgs);	 
 	 for($i=1;$i<=$num-1;$i++)
 	 {
 		$methodArgs = $methodArgs . STRING_COMMA . $actMethodArgs[$i];
 	 }
  }
 	$this->puts($actObj . "->" . $actMethodName . STRING_OPEN_PAR . $methodArgs .
 	STRING_CLOSE_PAR . STRING_SEMICOLON .  	$this->EOL());
 }
 
 function methodCall($actObj,$actMethodName,$actMethodArgs=array())
 {
 	if(isset($actMethodArgs[0]))
 	{
 	 $methodArgs=$actMethodArgs[0]; 
 	 $num = count($actMethodArgs);	 
 	 for($i=1;$i<=$num-1;$i++)
 	 {
 		$methodArgs = $methodArgs . STRING_COMMA . $actMethodArgs[$i];
 	 }
  }
 	return $actObj . "->" . $actMethodName . STRING_OPEN_PAR . $methodArgs .
 	STRING_CLOSE_PAR;
 }
 
 function constructorCall($actClass,$actConstructorArgs=array())
 {
 	$constructorArgs = STRING_NULL;
 	if(isset($actConstructorArgs[0]))
 	{
 	 $constructorArgs=$actConstructorArgs[0]; 
 	 $num = count($actConstructorArgs);	 
 	 for($i=1;$i<=$num-1;$i++)
 	 {
 		$constructorArgs = $constructorArgs . STRING_COMMA . $actConstructorArgs[$i];
 	 }
  }
 	return "new" . STRING_SPACE . $actClass . STRING_OPEN_PAR . $constructorArgs .
 	STRING_CLOSE_PAR;
 }
 
 function putFunctionCall($actFunction,$actFunctionArgs)
 {
 	$functionArgs = STRING_NULL;
 	if(isset($actFunctionArgs[0]))
 	{
 	 $functionArgs=$actFunctionArgs[0]; 
 	 $num = count($actFunctionArgs);	 
 	 for($i=1;$i<=$num-1;$i++)
 	 {
 		$functionArgs = $functionArgs . STRING_COMMA . $actFunctionArgs[$i];
 	 }
  }
 	$this->puts($actFunction . STRING_OPEN_PAR . $functionArgs .
 	STRING_CLOSE_PAR . STRING_SEMICOLON . 	$this->EOL()); 	
 }
 
 function functionCall($actFunction,$actFunctionArgs)
 {
 	$functionArgs = STRING_NULL;
 	if(isset($actFunctionArgs[0]))
 	{
 	 $functionArgs=$actFunctionArgs[0]; 
 	 $num = count($actFunctionArgs);	 
 	 for($i=1;$i<=$num-1;$i++)
 	 {
 		$functionArgs = $functionArgs . STRING_COMMA . $actFunctionArgs[$i];
 	 }
  }
 	return $actFunction . STRING_OPEN_PAR . $functionArgs .
 	STRING_CLOSE_PAR; 	
 }
 
 function putAssignment($actVar,$actItem)
 {
 	$this->puts($actVar . STRING_EQUAL . $actItem . STRING_SEMICOLON .
 	 	$this->EOL());
 }
 
 function &getPublicProps()
 {
 	return $this->publicProps;
 }
 
 function setPublicProps($actPublicProps)
 {
 	$this->publicProps = $actPublicProps;
 }
 
 function &getConstructorArgs()
 {
 	return $this->getConstructorArgs;
 }
 
 function setConstructorArgs($actConstructorArgs)
 {
 	$this->constructorArgs = $actConstructorArgs;
 }
 
 function getConstructorBody()
 {
 	return $this->constructorBody;
 }
 
 function setConstructorBody($actConstructorBody)
 {
 	$this->constructorBody = $actConstructorBody;
 }
 
 function &getMethodsNames()
 {
 	return $this->methodsNames;
 }
 
 function setMethodsNames($actMethodsNames)
 {
 	$this->methodsNames = $actMethodsNames;
 }
 
 function &getMethodsArgs()
 {
 	return $this->methodsArgs;
 }
 
 function setMethodsArgs($actMethodsArgs)
 {
 	$this->methodsArgs = $actMethodsArgs;
 }
 
 function &getMethodsBodies()
 {
 	return $this->methodsBodies;
 }
 
 function setMethodsBodies($actMethodsBodies)
 {
 	$this->methodsBodies = $actMethodsBodies; 
 }
 
 function putRequireOnces()
 {
 	$requireOnces = &$this->getRequireOnces();
 	foreach($requireOnces as $requireOnce)
 	{
 	 $this->putFunctionCall("require_once",array("\"" . $requireOnce . "\""));
 	}
 }
 
 function putDefines()
 {
 	$defines = &$this->getDefines();
 	foreach($defines as $ind =>$define)
 	{
 	 $this->putFunctionCall("define",array("'" . $ind . "'","\"" . $define . "\""));
 	}
 }
 
 function putClassHeader()
 {
 	$className = $this->getClassName();
 	$parentClass = $this->getParentClass();
 	
 	if($parentClass != STRING_NULL)
 	 $this->puts("class" . STRING_SPACE . STRING_SPACE . $className . 
 	 STRING_SPACE . "extends" . STRING_SPACE . $parentClass);
 	else
 	 $this->puts("class" . STRING_SPACE . STRING_SPACE . $className);
 	  	 
 }
 
 function putProps()
 {
 	$publicProps = &$this->getPublicProps();
 	foreach($publicProps as $publicPropInd=>$publicPropVal)
 	{
 	 if($publicPropVal == STRING_NULL)
 	  $this->puts("var" . STRING_SPACE . $publicPropInd . 
 	  STRING_SEMICOLON);
 	 else
 	  $this->puts("var" . STRING_SPACE . $publicPropInd . 
 	   STRING_EQUAL . $publicPropVal . STRING_SEMICOLON); 	  
 	 $this->puts($this->EOL());
 	} 	
 }
 
 function putConstructor()
 {
 	$constructorArgs = &$this->getConstructorArgs();
 	$constructorHeader = "function" . STRING_SPACE . "__construct" .
 	STRING_OPEN_PAR ;
 	$constructorBody = $this->getConstructorBody();
 	if(isset($constructorArgs[0]))
   $constructorHeader = $constructorHeader . $constructorArgs[0];
  $num = strlen($constructorArgs); 
  for($i=1;$i<=$num-1;$i++)
   $constructorHeader = $constructorHeader . STRING_COMMA . $constructorArgs[$i];
  $constructorHeader = $constructorHeader . STRING_CLOSE_PAR;
  $constructor = $this->EOL() . $constructorHeader . $this->EOL() . 
  STRING_OPEN_GRAFF_BRACKET . $this->EOL() . $constructorBody . 
  $this->EOL() . STRING_CLOSE_GRAFF_BRACKET;
  $this->puts($constructor);
 }
 
 function putMethod($actMethodName)
 {
 	$methodsArgs = &$this->getMethodsArgs();
 	$methodsBodies = &$this->getMethodsBodies();
 
	$methodBody = $methodsBodies[$actMethodName];
	$methodArgs = $methodsArgs[$actMethodName];
  $methodHeader = "function" . STRING_SPACE . $actMethodName . STRING_OPEN_PAR ;
  if(isset($methodArgs[0]))
   $methodHeader = $methodHeader . $methodArgs[0];
  $num = count($methodArgs); 
  for($i=1;$i<=$num-1;$i++)
   $methodHeader = $methodHeader . STRING_COMMA . $methodArgs[$i];
  $methodHeader = $methodHeader . STRING_CLOSE_PAR;
    
  $method = $this->EOL() . $methodHeader . $this->EOL() . 
  STRING_OPEN_GRAFF_BRACKET . $this->EOL() . $methodBody . 
  $this->EOL() . STRING_CLOSE_GRAFF_BRACKET;
  $this->puts($method);  
 }
 
 function putBody()
 {
 	$this->putProps();
 	$this->puts($this->EOL());
 	$this->putConstructor();
 	$this->puts($this->EOL());
 	$methodsNames = $this->getMethodsNames();
 	foreach($methodsNames as $methodName)
 	{
 	 $this->putMethod($methodName);
 	 $this->puts($this->EOL());
 	}		
 }
 
 function putData()
 {
 	$fileName = $this->getFileName();
 	if($fileName != STRING_NULL)
  {
   $fileHandle = fopen($fileName,"a");
   $this->setFileHandle($fileHandle);
 	}
 	$this->puts($this->EOL());
 	$this->putRequireOnces();
 	$this->puts($this->EOL());
 	$this->putDefines();
 	$this->puts($this->EOL());
 	$this->putClassHeader();
 	$this->puts($this->EOL());
 	$this->puts(STRING_OPEN_GRAFF_BRACKET);
 	$this->puts($this->EOL());
 	$this->putBody();
 	$this->puts($this->EOL());
 	$this->puts(STRING_CLOSE_GRAFF_BRACKET);
 	$this->puts($this->EOL());
 	if($fileName != STRING_NULL)
 	 fclose($fileHandle);
 }

}



?>