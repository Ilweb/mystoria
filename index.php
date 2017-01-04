<?php
session_start();
require_once 'config.php';

$controller_name = '';
$method = '';

if(!isset($_REQUEST['content']))
{
    $controller_name = ucfirst(DEFAULT_CONTROLLER);
    $method = DEFAULT_ACTION;
}
else
{
    $controller_name = ucfirst($_REQUEST['content']);

    if(!class_exists($controller_name))
    {
        $controller_name = 'Error';
    }
	
    if(isset($_REQUEST['action']))
	{
		$method = $_REQUEST['action'];
		if (count($actionWords = explode('-', $method, 2)) == 2)
		{
			$method = $actionWords[0].ucfirst($actionWords[1]);
		}
	}
}

User::init();
$controller = new $controller_name($method);
$controller->doAction();
//echo $_SERVER['QUERY_STRING'];
?>