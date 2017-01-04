<?php
class Product extends SEO
{
	public $properties = array(
			"id"=>null,
			"lang"=>'bg',
			"title"=>'',
			"published"=>0,
			"featured"=>0,
			"topoffer"=>0,
			"category"=>null,
			"submenu"=>null,
			"description"=>'',
			"dimensions"=>'',
			"price"=>'',
			"video"=>null
		);
		
	function __construct()
	{
		parent::__construct();
		$this->tableName = "products";
	}
	
	function onSave()
	{
		parent::onSave();
		$this->properties['lastmod'] = date('Y-m-d');
	}
	
	function addRecent()
	{
		if (isset($_COOKIE['recentProducts']))
		{
			$recentArray = $this->getRecent();
			if (!in_array($this->properties['id'], $recentArray))
			{
				$recent = $recentArray[count($recentArray) - 1].','.$this->properties['id'];
			}
			else
			{
				$recent = $_COOKIE['recentProducts'];
			}
		}
		else
		{
			$recent = $this->properties['id'];
		}
		
		setcookie ("recentProducts", $recent, time() + 30 * 24 * 60 * 60, '/');
		//$_COOKIE['recentProducts'] = $recent;
		//var_dump($_COOKIE['recentProducts']);
	}
	
	function getRecent()
	{
		$recentArray = array();
		if (isset($_COOKIE['recentProducts']))
		{
			$recentArray = explode(',', $_COOKIE['recentProducts']);
		}
		
		return $recentArray;
	}
}
?>