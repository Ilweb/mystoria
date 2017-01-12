<?php
class Settings extends RichController
{
	function __construct($action)
	{
		parent::__construct($action);
		$this->setModel('reservation');
	}
	
	function defaultAction()
	{
		$this->_template->setView('settings');
		$array = array(
			"title"=>'Settings',
			"settings"=>$this->_model->select(
				"id, set_key, set_value",
				"settings",
				1,
				"id"
			),
			"hours"=>$this->_model->select(
				"id, start",
				"available_hours",
				1, 
				"start"
			)
		);
		$this->_template->render($array);
	}
	
	protected function proceedSave()
	{
		foreach ($_POST['set'] as $id => $value)
		{
			$value = addslashes($value);
			$this->SQL->query("
				UPDATE settings
					SET set_value = '$value'
					WHERE id = $id
			");
		}
		
		$this->SQL->query("TRUNCATE TABLE available_hours");
		foreach ($_POST['hours'] as $key => $value)
		{
			if (!empty($value))
			{
				$value = addslashes($value);
				$this->SQL->query("
					INSERT INTO available_hours
						SET `start` = '$value'
				");
			}
		}
		
		$this->defaultAction();
	}
}
?>