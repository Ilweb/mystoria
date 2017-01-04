<?php
class Controller {
    protected $_action;
    protected $_model;
    protected $_template;
	protected $_controller;
	public $SQL;
	public $lang;

    function __construct($action = '', $locale = LOCALE) 
	{
		if(!method_exists($this, $action))
		{			
			//echo $action." does not ezist";
			$action = 'defaultAction';
		}
		$this->_controller = get_class($this);
        $this->_action = $action;
		$this->SQL = new MyMySQL;
		require(GLOBAL_PATH_LANG.$locale.'/lang.php');
		if (file_exists(GLOBAL_PATH_LANG.$locale.'/'.strtolower($this->_controller).'.php'))
		{
			require(GLOBAL_PATH_LANG.$locale.'/'.strtolower($this->_controller).'.php');
		}
		$this->lang = $lang;
		$this->_template = new View($this->lang);
		
		if ($this->_controller == DEFAULT_CONTROLLER)
		{
			define('SHOW_FOOTER', true);
		}
		else
		{
			define('SHOW_FOOTER', false);
		}
    }
	
	function setModel($model_name)
	{
		$this->_model = new $model_name;
	}
	
	function getModel()
	{
		return $this->_model;
	}
	
	function checkAccess()
	{
		$hasAccess = false;
		$result = $this->SQL->query("SELECT min_access, max_access, menu_id FROM controllers WHERE name = '".$this->_controller."'");
		if ($result->num_rows)
		{
			while ($row = $result->fetch_object())
			{
				if (($row->min_access <= $_SESSION["access"]) && ($row->max_access >= $_SESSION["access"]))
				{
					$hasAccess = true;
					$this->_template->menuItem = $row->menu_id;
				}
			}
		}
		else
		{
			$this->SQL->query("INSERT INTO controllers(name) VALUE('".$this->_controller."')");
			$hasAccess = true;
		}
		
		return $hasAccess;
	}
	
	function doAction()
	{
		if ($this->checkAccess())
		{
			$action = $this->_action;
			$this->$action();
			return 1;
		}
		else
		{
			$this->accessDenied();
			return 0;
		}
	}
	
	function defaultAction()
	{
		$this->notFound();
	}
	
	
	function notFound()
	{
		$this->_template->setView('message');
		$array = array(
			"title"=>$this->lang['Error 404'],
			"message"=>$this->lang['Page not found']
		);
	    $this->_template->render($array);
	}
	
	function accessDenied()
	{
		$this->_template->setView('message');
		$array = array(
			"title"=>$this->lang['Access denied'],
			"message"=>$this->lang['Access denied message']
		);
	    $this->_template->render($array);
	}
}
?>