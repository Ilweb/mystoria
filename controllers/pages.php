<?php
class Pages extends RichController
{
	function __construct($action)
	{
		parent::__construct($action);
		$this->setModel('page');
	}
	
	function defaultAction()
	{
		$this->listAll();
	}
	
	function listAll()
	{
		$this->_template->setView('pages');
		$array = array(
			"title"=>$this->lang['Pages'],
			"pages"=>$this->_model->select(
				"id, title, url",
				"pages"
			)
		);
		$this->_template->render($array);
	}
	
	function edit()
	{
		if (isset($_REQUEST['id']))
		{
			$this->_model->load((int)$_REQUEST['id']);
			$title = $this->lang['Edit page'];
		}
		else
		{
			$title = $this->lang['New page'];
		}
		$this->_template->setView('page_edit');
		$array = array(
			"title"=>$title,
			"page"=>$this->_model->getProperties(),
			"tinyMice"=>true
		);
	    $this->_template->render($array);
	}
	
	protected function proceedSave()
	{
		$this->_model->save();
		if ($this->_model->properties["id"])
		{
			$this->saveImage();
		}
		
		if ($_POST['id'])
		{
			$this->listAll();
		}
		else
		{
			$this->edit();
		}
	}
	
	function uploadImage()
	{
		$this->saveImage();
		$this->editGallery();
	}
}
?>