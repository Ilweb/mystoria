<?php
require_once("config_private.php");

$GLOBAL_PATH = (getcwd().'/');

define('GLOBAL_PATH', $GLOBAL_PATH);
define('ROOT_URL', PROJECT_DIRECTORY);

define('GLOBAL_PATH_CONTROLLERS',GLOBAL_PATH.'controllers/');
define('GLOBAL_PATH_VIEWS',GLOBAL_PATH.'html/');
define('GLOBAL_PATH_CLASSES',GLOBAL_PATH.'classes/');
define('GLOBAL_PATH_LANG',GLOBAL_PATH.'lang/');
define('IMAGE_URL', ROOT_URL.'images/');
define('IMAGE_DIR', GLOBAL_PATH.'images/');
define('DOC_URL',ROOT_URL.'download/');
define('DOC_DIR',GLOBAL_PATH.'download/');
define('BANNER_URL',ROOT_URL.'banners/');
define('BANNER_DIR',GLOBAL_PATH.'banners/');
define('DUMP_URL',ROOT_URL.'dump/');
define('DUMP_DIR',GLOBAL_PATH.'dump/');

define('DEFAULT_CONTROLLER','Main');
define('DEFAULT_ACTION','defaultAction');

define('PAGE_ROWS', 15);

define('SITENAME', 'Mystoria Rooms');
define('DOMAIN', $_SERVER["SERVER_NAME"]);
define('DEFAULT_EMAIL', "mystoriarooms@gmail.com");

define('DEFAULT_LOCALE', "bg");

define("ENCODING", "utf8"); 

function __autoload($class_name)
{
	if(file_exists(GLOBAL_PATH_CONTROLLERS.strtolower($class_name).'.php'))
	{
		require_once GLOBAL_PATH_CONTROLLERS.strtolower($class_name).'.php';
	}
	else if(file_exists(GLOBAL_PATH_CLASSES.strtolower($class_name).'.php'))
	{
		require_once GLOBAL_PATH_CLASSES.strtolower($class_name).'.php';
	}
	else 
	{
		//echo 'CLASS "'.$class_name.'" does not exist! <br />';
	}
}

define('CURRENT_TIME_ZONE','Europe/Sofia');
date_default_timezone_set(CURRENT_TIME_ZONE);	

define('CURRENT_DATE', date('d.m.Y', time()));
?>