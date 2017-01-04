<?php
class Article extends SEO
{
	public $properties = array(
			"id"=>null,
			"lang"=>'bg',
			"title"=>'',
			"featured"=>0,
			"important"=>0,
			"feedback"=>0,
			"category"=>null,
			"submenu"=>0,
			"publish_date"=>'',
			"image"=>null,
			"body"=>'',
			"video"=>null
		);
		
	function __construct()
	{
		parent::__construct();
		$this->tableName = "articles";
	}
	
	function onSave()
	{
		parent::onSave();
		$this->properties['lastmod'] = date('Y-m-d');
	}
}
?>