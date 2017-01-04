<?php
class Page extends SEO
{
	public $properties = array(
			"id"=>null,
			"title"=>'',
			"body"=>'',
			"video"=>null
		);
		
	function __construct()
	{
		parent::__construct();
		$this->tableName = "pages";
	}
	
	function onSave()
	{
		parent::onSave();
		$this->properties['lastmod'] = date('Y-m-d');
	}
}
?>