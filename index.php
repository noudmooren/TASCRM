<?
#	LR DESIGN
#	Built: 30 januari 2012

#	Index file
	session_start();
	define('LR_ACCESS', true);

	require_once("language/language.php");

	require_once("system/func.autoload.php");

#	Built
	$Start = new Get();
	$Start->Cms();
	
	
?>