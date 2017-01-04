<?php
class Menu
{
	public $SQL;
	private $lang;
	
	function __construct($lang)
	{
		$this->SQL = new MyMySQL;
		$this->lang = $lang;
	}
	
	function menu()
	{
		return array(
			$this->lang['About us']=>LOCALE_URL.'semeen-hotel-akladi.html',
			$this->lang['Rooms']=>LOCALE_URL.'rooms/',
			$this->lang['Prices']=>LOCALE_URL.'tseni.html',
			$this->lang['Restaurants']=>LOCALE_URL.'restaurants/',
			$this->lang['Location']=>LOCALE_URL.'location/',
			$this->lang['Contacts']=>LOCALE_URL.'contacts.html'
		);
	}
	
	function getUserMenu()
	{
		$access = $_SESSION['access'];
		$result = $this->SQL->query("SELECT id, name, link AS url, min_access FROM menu WHERE min_access <= $access AND min_access AND max_access >= $access ORDER BY `order`");
		$links = array();
		while ($row = $result->fetch_object())
		{
			$links[] = $row;
		}
		
		return $links;
	}
	
	function getCategories($cat_type)
	{
		$query = "SELECT id, title, url 
					FROM categories 
					WHERE cat_type = $cat_type AND deleted = 0";
		$result = $this->SQL->query($query);
		$categories = array();
		while ($row = $result->fetch_object())
		{
			$categories[] = $row;
		}
		
		return $categories;
	}
	
	function getSubmenus($cat, $parent)
	{
		$query = "SELECT id, title, url 
					FROM submenus 
					WHERE category = $cat 
						AND parent_id = $parent 
						AND deleted = 0 
						AND lang = '".LOCALE."'
					ORDER BY order_no";
		$result = $this->SQL->query($query);
		$submenus = array();
		while ($row = $result->fetch_object())
		{
			$submenus[] = $row;
		}
		
		return $submenus;
	}
	
	function getArticles($cat, $parent)
	{
		$query = "SELECT id, title, url 
					FROM articles 
					WHERE category = $cat
						AND submenu = $parent 
						AND deleted = 0 
						AND lang = '".LOCALE."'
						AND publish_date <= CURDATE()
					ORDER BY publish_date DESC";
		$result = $this->SQL->query($query);
		$articles = array();
		while ($row = $result->fetch_object())
		{
			$articles[] = $row;
		}
		
		return $articles;
	}
	
	function getRecentProducts()
	{
		$p = new Products('nothing');
		$model = $p->getModel();
		
		$result = $model->select(
			"p.id, p.url, p.title, c.url AS cat_url",
			"products p
				LEFT JOIN categories c ON c.id = p.category",
			"p.deleted = 0 AND p.published 
				AND p.id IN (".$_COOKIE['recentProducts'].")"
		);
		$products = array();
		while ($row = $result->fetch_object())
		{
			$dir = "products/".$row->id;
			$row->dir = $dir;
			$row->images = $p->getSortedImages($row->id);
			$products[] = $row;
		}
		
		return $products;
	}
	
	function getBanners()
	{
		$query = "SELECT banner_type, title, filename, code, target 
					FROM banners
					WHERE from_date <= CURDATE() AND to_date >= CURDATE() AND deleted = 0";
		$result = $this->SQL->query($query);
		$banners = array();
		while ($row = $result->fetch_object())
		{
			$banners[] = $row;
		}
		
		$query = "UPDATE banners
					SET impressions = impressions + 1
					WHERE from_date <= CURDATE() AND to_date >= CURDATE()";
		$this->SQL->query($query);
		
		return $banners;
	}
}
?>