<?php
class Articles extends RichController
{
	function __construct($action)
	{
		parent::__construct($action);
		$this->setModel('article');
	}
	
	function defaultAction()
	{
		$this->listAll();
	}
	
	function listAll()
	{
		$where = "a.deleted = 0";
		if (isset($_REQUEST['category']))
		{
			$category = (int)$_REQUEST['category'];
		}
		else
		{
			$category = 0;
		}
		if ($category)
		{
			$where .= " AND a.category = $category";
		}
		if (isset($_REQUEST['page']))
		{
			$page = (int)$_REQUEST['page'];
			$simple = true;
		}
		else
		{
			$page = 1;
			$simple = false;
		}
		if ($page < 1)
		{
			$page = 1;
		}
		$count = $this->_model->count($where, "articles a");
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
			"a.id, publish_date, a.url, 
			a.title, a.lang,
			c.title AS category, c.url AS cat_url,
			s1.title AS parent, s.title AS submenu,
			IF(publish_date <= CURRENT_DATE(), 1, 0) AS published, 
			a.featured, important, feedback",
			"articles a 
			LEFT JOIN categories c ON c.id = a.category
			LEFT JOIN submenus s ON s.id = a.submenu
			LEFT JOIN submenus s1 ON s1.id = s.parent_id",
			$where,
			"a.publish_date IS NOT NULL, a.publish_date DESC, a.title",
			$start_from.", ".PAGE_ROWS
		);
		$this->_template->setView('articles');
		$array = array(
			"title"=>$this->lang['Articles'],
			"result"=>$result,
			"pages"=>$pages,
			"page"=>$page,
			"categories"=>$this->_model->select(
				"id, title AS category", 
				"categories",
				"cat_type = 1 AND deleted = 0"
			),
			"category"=>$category
		);
		if ($simple)
		{
			$this->_template->simpleRender($array);
		}
		else
		{
			$this->_template->render($array);
		}
	}
	
	function edit()
	{
		if (isset($_REQUEST['id']))
		{
			$this->_model->load((int)$_REQUEST['id']);
			$title = $this->lang['Edit article'];
		}
		else
		{
			$title = $this->lang['New article'];
		}
		$this->_template->setView('article_edit');
		$array = array(
			"title"=>$title,
			"article"=>$this->_model->getProperties(),
			"categories"=>$this->_model->select(
				"id, title AS category", 
				"categories",
				"cat_type = 1 AND deleted = 0"
			),
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
	
	function loadParents()
	{
		if (isset($_POST['category']) && isset($_POST['lang']))
		{
			$language = $_POST['lang'];
			$cat = (int)$_POST['category'];
			$result = $this->_model->select(
				"s.id, s1.title AS parent, s.title AS child",
				"submenus s LEFT JOIN submenus s1 ON s1.id = s.parent_id",
				"s.category = $cat AND s.lang = '$language' AND s.deleted = 0 AND IF(s.parent_id, s1.deleted = 0, 1)",
				"parent, s.order_no, child"
			);
			while ($row = $result->fetch_object())
			{
				if ($row->parent != "")
				{
					$menu = $row->parent.' -> '.$row->child;
				}
				else
				{
					$menu = $row->child;
				}
				echo '<option value="'.$row->id.'">'.$menu.'</option>';
			}
		}
	}
}
?>