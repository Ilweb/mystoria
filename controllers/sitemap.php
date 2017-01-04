<?php
class Sitemap extends Controller
{
	function __construct($action = '')
	{
		parent::__construct($action);
	}

	function defaultAction()
	{
		$locale = $_GET['locale'];
		$this->setModel('article');
		
		if (in_array($locale, array('bg')))
		{
			$this->_template->setView('sitemap_xml');
			$array = array(
				"categories"=>$this->_model->select(
					"url",
					"categories",
					"deleted = 0 AND cat_type = 1"
				),
				"articles"=>$this->_model->select(
					"a.id, c.url AS cat_url, a.url, lastmod", 
					"articles a LEFT JOIN categories c ON a.category = c.id", 
					"a.deleted = 0 AND a.publish_date <= CURDATE() AND lang = '$locale'
						AND category != 2 AND featured = 0",
					"a.id"
				),
				"locale"=>$locale.'/'
			);
			$this->_template->simpleRender($array);
		}
	}
}
?>
