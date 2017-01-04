<?php
class Category extends SEO
{
	public $properties = array(
			"id"=>null,
			"title"=>'',
			"cat_type"=>null
		);
		
	function __construct()
	{
		parent::__construct();
		$this->tableName = "categories";
	}
}
?>