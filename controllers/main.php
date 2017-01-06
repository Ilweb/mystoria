<?php
class Main extends Controller
{
	function __construct($action)
	{
		parent::__construct($action);
		$this->setModel('article');
	}
	
	function defaultAction()
	{
		$p = new Page;
		$p->properties['url'] = null;
		$p->load(1);
		
		$this->_template->setView('home');
		$array = array(
			"canonical"=>'',
			"hours"=>$this->getHours()
		);
	    $this->_template->render($array);
	}
	
	function getCalendar()
	{
		$this->_template->setView('calendar');
		$array = array(
			"hours"=>$this->getHours(),
			"week"=>isset($_POST['week']) ? (int)$_POST['week'] : 0
		);
	    $this->_template->simpleRender($array);
	}
	
	private function getHours()
	{
		$result = $this->_model->select(
			"start",
			"available_hours",
			"1",
			"start"
		);
		$hours = array();
		while ($row = $result->fetch_object())
		{
			$hours[] = $row->start;
		}
		
		$result = $this->_model->select(
			"start_time",
			"reservations",
			"status NOT IN ('cancelled') 
				AND start_time >= NOW() 
				AND start_time < ADDDATE(CURDATE(), INTERVAL 1 WEEK)"
		);
		$reservations = array();
		while ($row = $result->fetch_object())
		{
			$reservations[] = $row->start_time;
		}
		
		return array(
			'hours'=>$hours,
			'reservations'=>$reservations
		);
	}
	
	function folder()
	{
		if (isset($_REQUEST['url']))
		{
			$cat = new Category;
			$cat->properties['url'] = "";
			$cat->loadItem($_REQUEST['url']);
			
			if ($cat->properties['cat_type'] == 1)
			{
				$this->articles($cat);
			}	
			/*else
			{
				$this->products($cat);
			}*/
		}
		else
		{
			$this->notFound();
		}
	}
	
	function item()
	{
		if (isset($_REQUEST['cat']))
		{
			$cat = new Category;
			$cat->loadItem($_REQUEST['cat']);
			
			if ($cat->properties['cat_type'] == 1)
			{
				$this->article();
			}	
			/*else
			{
				$this->product();
			}*/
		}
		else
		{
			$this->notFound();
		}
	}
	
	private function articles($cat)
	{
		$canonical = LOCALE_URL;
		if ($cat->properties['id'] && ($cat->properties['cat_type'] == 1))
		{
			$title = $this->lang[$cat->properties['title']];
			$where = "a.category = ".$cat->properties['id'];
			$canonical .= $cat->properties['url'].'/';
			
			$submenus = array();
			if (isset($_REQUEST['sub1']))
			{
				$sub1 = new Submenu;
				$sub1->properties['url'] = "";
				$sub1->loadItem($_REQUEST['sub1'], $cat->properties['id']);
				if ($sub1->properties['id'])
				{
					$canonical .= $sub1->properties['url'].'/';
					$submenus[] = $sub1->getProperties();
					if (!isset($_REQUEST['sub2']))
					{
						$title = $sub1->properties['title'];
						$where .= " AND a.submenu = ".$sub1->properties['id'];
					}
					else
					{
						$sub2 = new Submenu;
						$sub2->properties['url'] = "";
						$sub2->loadItem($_REQUEST['sub2'], $cat->properties['id']);
						if ($sub1->properties['id'])
						{
							$canonical .= $sub2->properties['url'].'/';
							$submenus[] = $sub2->getProperties();
							$title = $sub2->properties['title'];
							$where .= " AND a.submenu = ".$sub2->properties['id'];
						}
						else
						{
							$this->notFound();
							return;
						}
					}
				}
				else
				{
					$this->notFound();
					return;
				}
			}
			else
			{
				$where .= " AND a.submenu = 0";
			}
		}
		else
		{
			$this->notFound();
			return;
		}
		
		// Subcategories
		/*$smWhere = str_replace("a.", "sm.", $where);
		$smWhere = str_replace("submenu", "parent_id", $smWhere);
		$result = $this->_model->select(
			"sm.id, sm.url, sm.title, c.url AS cat_url, image",
			"submenus sm 
				LEFT JOIN categories c ON c.id = sm.category",
			"sm.deleted = 0 AND $smWhere AND sm.lang = '".LOCALE."'",
			"order_no, sm.title"
		);
		$subcats = array();
		while ($row = $result->fetch_object())
		{
			$subcats[] = $row;
		}*/
		
		// Articles
		$result = $this->_model->select(
			"a.id, a.url, a.title, publish_date, c.url AS cat_url, a.featured, body",
			"articles a 
				LEFT JOIN categories c ON c.id = a.category
				LEFT JOIN submenus sm ON sm.id = a.submenu",
			"a.deleted = 0 AND a.publish_date <= CURDATE() 
				AND $where AND a.lang = '".LOCALE."'",
			"a.featured DESC, a.publish_date DESC"
		);
		$articles = array();
		while ($row = $result->fetch_object())
		{
			$dir = "articles/".$row->id;
			$row->dir = $dir;
			$row->images = RichController::getSortedImages($row->id);
			$articles[] = $row;
		}
		
		if (count($articles) == 1)
		{
			header("location: ".LOCALE_URL.$articles[0]->cat_url."/".$articles[0]->url.".html");
		}
		
		$this->_template->setView('category_articles_preview');
		$array = array(
			"title"=>$title,
			"submenus"=>$submenus,
			//"subcats"=>$subcats,
			"articles"=>$articles,
			"iArticles"=>$iArticles,
			"catObj"=>$cat->getProperties(),
			"canonical"=>$canonical,
			"topImages"=>RichController::getSortedImages($cat->properties['id'] == 3 ? 6 : 5, 'page'),
			"topDir"=>'pages/'.($cat->properties['id'] == 3 ? '6' : '5').'/'
		);
	    $this->_template->render($array);
	}
	
	private function article()
	{
		if (isset($_REQUEST['url']))
		{
			$article = new Article;
			$article->loadItem($_REQUEST['url']);
			if (!$article->properties['id'])
			{
				$this->notFound();
				return;
			}
			$cat = new Category;
			$cat->properties['url'] = "";
			$cat->load($article->properties['category']);
			if (!isset($_REQUEST['cat']) || ($_REQUEST['cat'] != $cat->properties['url']))
			{
				$location = LOCALE_URL.$cat->properties['url'].'/'.$_REQUEST['url'].'.html';
				header("location: $location");
			}
		}
		else
		{
			$this->notFound();
			return;
		}
		$submenus = array();
		if ($article->properties['submenu'])
		{
			$submenu1 = new Submenu;
			$submenu1->properties['url'] = "";
			$submenu1->load($article->properties['submenu'], $cat->properties['id']);
			$submenus[] = $submenu1->getProperties();
			if ($submenu1->properties['parent_id'])
			{
				$submenu2 = new Submenu;
				$submenu2->properties['url'] = "";
				$submenu2->load($submenu1->properties['parent_id']);
				array_unshift($submenus, $submenu2->getProperties());
			}
		}
		
		$this->SQL->query("UPDATE articles SET impressions = impressions + 1 WHERE id = ".$article->properties['id']);
		
		$dir = 'articles/'.$article->properties['id'];
		$this->_template->setView('article_preview');
		$array = array(
			"title"=>$article->properties['title'],
			"description"=>$article->shortBody(),
			"article"=>$article->getProperties(),
			"dir"=>$dir,
			"images"=>RichController::getSortedImages($article->properties['id']),
			"catObj"=>$cat->getProperties(),
			"submenus"=>$submenus,
			"cat_type"=>1,
			"canonical"=>LOCALE_URL.$cat->properties['url'].'/'.$_REQUEST['url'].'.html',
			"topImages"=>RichController::getSortedImages($cat->properties['id'] == 3 ? 6 : 5, 'page'),
			"topDir"=>'pages/'.($cat->properties['id'] == 3 ? '6' : '5').'/'
		);
	    $this->_template->render($array);
	}
	
	function page()
	{
		$this->setModel('page');
		if (isset($_REQUEST['url']))
		{
			if ($_REQUEST['url'] == 'contacts')
			{
				$this->contacts();
				return;
			}
			
			$this->_model->loadItem($_REQUEST['url']);
			if (!$this->_model->properties['id'])
			{
				$this->notFound();
				return;
			}
		}
		else
		{
			$this->notFound();
			return;
		}
		
		$dir = 'pages/'.$this->_model->properties['id'];
		$this->_template->setView('article_preview');
		$array = array(
			"title"=>$this->_model->properties['title'],
			"description"=>$this->_model->shortBody(),
			"article"=>$this->_model->getProperties(),
			"dir"=>$dir,
			"images"=>RichController::getSortedImages($this->_model->properties['id']),
			"topImages"=>RichController::getSortedImages(5),
			"topDir"=>'pages/5/',
			"canonical"=>LOCALE_URL.strtolower($_REQUEST['url']).'.html'
		);
	    $this->_template->render($array);
	}
	
	
	function contactForm()
	{
		$this->_template->setView('contact_form');
	    $this->_template->simpleRender(array());
	}
	
	function checkEmail()
	{
		if (isset($_GET['email']))
		{
			$checker = new EmailAddressValidator;
			if ($checker->check_email_address($_GET['email']))
			{
				echo 'OK';
			}
		}
	}
	
	function sendFeedback()
	{
		$feedback = new Feedback;
		$feedback->loadFrom($_POST);
		$feedback->properties['ip'] = $_SERVER['REMOTE_ADDR'];
		$feedback->add();
	}
	
	function reservation()
	{
		$r = new Reservation;
		$r->loadFrom($_POST);
		if ($r->isAvailable())
		{
			$_SESSION['reservation_id'] = $r->add();
		}
		else
		{
			// Send Error
			echo 'Sorry, we already have a reservation for this date and time!';
		}
	}
	
	function thankyou()
	{
		$this->_template->setView('thankyou');
		$array = array(
			"title"=>'Thank you',
			"styles"=>array('reg')
		);
	    $this->_template->render($array);
	}
	function faq()
	{
		$this->_template->setView('faq');
		$array = array(
			"title"=>$this->lang['FAQ'],
			"styles"=>array('contacts','FAQ')
		);
	    $this->_template->render($array);
	}
	function rankings()
	{
		$result = $this->_model->select(
			"id, team, time, image",
			"reservations",
			"status = 'completed' AND time IS NOT NULL AND image IS NOT NULL",
			"time, id",
			"0, 9"
		);
		$teams = array();
		while ($row = $result->fetch_object())
		{
			$teams[] = $row;
		}
		
		$this->_template->setView('rankings');
		$array = array(
			"title"=>$this->lang['Rankings'],
			"styles"=>array('rankings','contacts'),
			"teams"=>$teams
		);
	    $this->_template->render($array);
	}
	function vp()
	{
		$this->_template->setView('vp');
		$array = array(
			"title"=>$this->lang['vp'],
			"styles"=>array('vp')
		);
	    $this->_template->render($array);
	}
	function contacts()
	{
		$this->_template->setView('contacts');
		$array = array(
			"title"=>$this->lang['Contacts'],
			"styles"=>array('contacts')
		);
	    $this->_template->render($array);
	}
	function teambuilding()
	{
		$this->_template->setView('teambuilding');
		$array = array(
			"title"=>$this->lang['Team building'],
			"styles"=>array('teambuilding')
		);
	    $this->_template->render($array);
	}
	function terms()
	{
		$this->_template->setView('terms');
		$array = array(
			"title"=>$this->lang['terms'],
			"styles"=>array('terms')
		);
	    $this->_template->render($array);
	}
}
?>