<?php
class Submenus extends RichController
{
	function __construct($action)
	{
		parent::__construct($action);
		$this->setModel('submenu');
	}
	
	function defaultAction()
	{
		$this->listAll();
	}
	
	function listAll()
	{
		$result = $this->_model->select(
			"s.id, s.title, s.lang, c.title AS category, s.order_no, c.id AS cat_id",
			"submenus s 
				LEFT JOIN categories c ON c.id = s.category",
			"s.deleted = 0 AND parent_id = 0",
			"lang, category, s.order_no, s.title"
		);
		$submenus = array();
		while ($row = $result->fetch_object())
		{
			$submenus[] = $row;
			$result1 = $this->_model->select(
				"id, title, lang, order_no",
				"submenus",
				"deleted = 0 AND category = ".$row->cat_id." AND parent_id = ".$row->id,
				"order_no, title"
			);
			while ($row1 = $result1->fetch_object())
			{
				$row1->parent = $row->title;
				$row1->category = $row->category;
				$submenus[] = $row1;
			}
		}
		$this->_template->setView('submenus');
		$array = array(
			"title"=>$this->lang['Menus'],
			"submenus"=>$submenus
		);
		$this->_template->render($array);
	}
	
	function edit()
	{
		if (isset($_REQUEST['id']))
		{
			$this->_model->load((int)$_REQUEST['id']);
			$title = $this->lang['Edit record'];
		}
		else
		{
			$title = $this->lang['New record'];
		}
		$categories = $this->_model->select("id, title AS category", "categories");
		$this->_template->setView('submenu_edit');
		$array = array(
			"title"=>$title,
			"submenu"=>$this->_model->getProperties(),
			"categories"=>$categories
		);
	    $this->_template->simpleRender($array);
	}
	
	protected function proceedSave()
	{
		if ((!$_FILES['upload_file']['error']))
		{
			move_uploaded_file($_FILES['upload_file']['tmp_name'], IMAGE_DIR.'submenus/'.$_FILES['upload_file']['name']);
			$this->_model->properties['image'] = $_FILES['upload_file']['name'];
		}
		
		if (!strlen($this->_model->properties['order_no']))
		{
			$result = $this->_model->select(
				"MAX(order_no) AS max_order",
				"submenus",
				"category = ".$this->_model->properties['category']."
					AND parent_id = ".$this->_model->properties['parent_id']."
					AND lang = '".$this->_model->properties['lang']."'",
				"max_order"
			);
			if ($result->num_rows)
			{
				$row = $result->fetch_object();
				$this->_model->properties['order_no'] = $row->max_order + 1;
			}
			else
			{
				$this->_model->properties['order_no'] = 1;
			}
		}
		$this->_model->save();
		$this->listAll();
	}
	
	function loadParents()
	{
		if (isset($_POST['category']) && isset($_POST['lang']) && isset($_POST['id']))
		{
			$language = $_POST['lang'];
			$cat = (int)$_POST['category'];
			$id = (int)$_POST['id'];
			$result = $this->_model->select(
				"id, title",
				"submenus",
				"category = $cat AND lang = '$language' AND id != $id AND parent_id = 0 AND deleted = 0"
			);
			while ($row = $result->fetch_object())
			{
				echo '<option value="'.$row->id.'">'.$row->title.'</option>';
			}
		}
	}
}
?>