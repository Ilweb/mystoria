<?php
class Reservations extends RichController
{
	function __construct($action)
	{
		parent::__construct($action);
		$this->setModel('reservation');
	}
	
	function defaultAction()
	{
		$this->_template->setView('reservations');
		$array = array(
			"title"=>'Reservations',
			"reservations"=>$reservations,
			"pages"=>$pages,
			"page"=>$page,
			"statuses"=>$this->_model->statuses()
		);
		$this->_template->render($array);
	}
	
	function filter()
	{
		$where = "";
		if (isset($_REQUEST['state']) && !empty($_REQUEST['state']))
		{
			$where = "status = '".$_REQUEST['state']."'";
		}
		else
		{
			$where = "status != 'cancelled'";
		}	
		if (isset($_REQUEST['page']))
		{
			$page = (int)$_REQUEST['page'];
		}
		else
		{
			$page = 1;
		}
		if ($page < 1)
		{
			$page = 1;
		}
		$count = $this->_model->count($where, "reservations r");
		$pages = ceil($count / PAGE_ROWS);
		if ($pages == 0)
		{
			$pages = 1;
		}
		if ($page > $pages)
		{
			$page = $pages;
		}
		$start_from = ($page - 1) * PAGE_ROWS;
		$result = $this->_model->select(
			"*",
			"reservations",
			$where,
			"status, start_time",
			$start_from.", ".PAGE_ROWS
		);
		$reservations = array();
		while ($row = $result->fetch_object())
		{
			$reservations[] = $row;
		}
		
		$this->_template->setView('reservation_table');
		$array = array(
			"reservations"=>$reservations,
			"pages"=>$pages,
			"page"=>$page,
			"count"=>$count
		);
		$this->_template->simpleRender($array);
	}
	
	function edit()
	{
		if (isset($_REQUEST['start_time']))
		{
			$this->_model->properties['start_time'] = $_REQUEST['start_time'];
			$this->_model->properties['status'] = "confirmed";
		}
		if (isset($_REQUEST['id']))
		{
			$this->_model->properties['image'] = null;
			$this->_model->load((int)$_REQUEST['id']);
			if (isset($_REQUEST['state']))
			{
				$this->_model->properties['status'] = $_REQUEST['state'];
			}
		}
		$this->_template->setView('reservation_edit');
		$array = array(
			"title"=>'Reservations',
			"reservation"=>$this->_model->getProperties(),
			"statuses"=>$this->_model->statuses()
		);
	    $this->_template->render($array);
	}
	
	function confirm()
	{
		if (isset($_REQUEST['id']))
		{
			$this->_model->load((int)$_REQUEST['id']);
			$this->_model->properties['status'] = "confirmed";
			$this->_model->update();
		}
	}
	
	protected function proceedSave()
	{
		$this->_model->save();
		if ($this->_model->properties["id"])
		{
			$image = $this->saveImage();
			if ($image)
			{
				$this->_model->properties['image'] = $image;
				$this->_model->update();
			}
		}
		
		if ($_POST['id'])
		{
			$this->defaultAction();
		}
		else
		{
			$this->edit();
		}
	}
}
?>