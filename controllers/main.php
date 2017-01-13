<?php
class Main extends Controller
{
	function __construct($action)
	{
		parent::__construct($action);
		$this->setModel('article');
	}
	
	private function getSettings()
	{
		$result = $this->_model->select(
			"id, set_key, set_value",
			"settings",
			1,
			"id"
		);
		
		$settings = array();
		while ($row = $result->fetch_object())
		{
			$settings[$row->set_key] = $row->set_value;
		}
		
		return $settings;
	}
	
	function defaultAction()
	{
		
		$rooms = $this->_model->select(
			"id, url, title, body",
			"articles",
			"!deleted AND publish_date <= CURDATE() AND category = 1 AND lang = '".LOCALE."'",
			"publish_date DESC",
			1
		);
		while ($row = $rooms->fetch_object())
		{
			$room = $row;
		}
		
		$result = $this->_model->select(
			"COUNT(id) AS teams, MINUTE(MIN(time)) AS record, ROUND(AVG(TIME_TO_SEC(time) / 60)) AS average",
			"reservations",
			"status = 'completed' AND time IS NOT NULL AND image IS NOT NULL"
		);
		$records = $result->fetch_object();
		
		$result = $this->_model->select(
			"COUNT(id) AS teams, ROUND(AVG(TIME_TO_SEC(time) / 60)) AS average",
			"reservations",
			"status = 'completed' AND time < '01:00:00' AND image IS NOT NULL"
		);
		$row = $result->fetch_object();
		$records->rate = round(($row->teams / $records->teams) * 100);
		//$records->average = $row->average;
		
		$this->_template->setView('home');
		$array = array(
			"canonical"=>'',
			"hours"=>$this->getHours(),
			"room"=>$room,
			"images"=>RichController::getSortedImages($room->id),
			"records"=>$records,
			"settings"=>$this->getSettings()
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
			"title"=>$this->lang['Thank you'],
			"styles"=>array('reg'),
			"settings"=>$this->getSettings()
		);
	    $this->_template->render($array);
	}
	
	function faq()
	{
		$rooms = $this->_model->select(
			"id, url, title, body",
			"articles",
			"!deleted AND publish_date <= CURDATE() AND category = 2 AND lang = '".LOCALE."'",
			"publish_date DESC"
		);
		$questions = array();
		while ($row = $rooms->fetch_object())
		{
			$questions[] = $row;
		}
	
		$this->_template->setView('faq');
		$array = array(
			"title"=>$this->lang['FAQ'],
			"styles"=>array('contacts','FAQ'),
			"questions"=>$questions,
			"settings"=>$this->getSettings()
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
			"0, 3"
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
			"teams"=>$teams,
			"settings"=>$this->getSettings()
		);
	    $this->_template->render($array);
	}
	
	function restRankings()
	{
		$where = "status = 'completed' AND time IS NOT NULL AND image IS NOT NULL";
		if (isset($_REQUEST['page']))
		{
			$page = (int)$_REQUEST['page'];
		}
		else
		{
			$page = 1;
		}
		if ($page < 1)
		{
			$page = 1;
		}
		$count = $this->_model->count($where, "reservations r");
		$pages = ceil(($count - 3) / 6);
		if ($pages == 0)
		{
			$pages = 1;
		}
		if ($page > $pages)
		{
			$page = $pages;
		}
		$start_from = ($page - 1) * 6 + 3;
	
		$result = $this->_model->select(
			"id, team, time, image",
			"reservations",
			$where,
			"time, id",
			$start_from.", 6"
		);
		$teams = array();
		while ($row = $result->fetch_object())
		{
			$teams[] = $row;
		}
		
		$this->_template->setView('rankings_rest');
		$array = array(
			"teams"=>$teams,
			"pages"=>$pages,
			"page"=>$page,
			"count"=>$count
		);
	    $this->_template->simpleRender($array);
	}
	
	function vp()
	{
		$this->_template->setView('vp');
		$array = array(
			"title"=>$this->lang['Vouchers'],
			"styles"=>array('vp'),
			"settings"=>$this->getSettings()
		);
	    $this->_template->render($array);
	}
	
	function contacts()
	{
		$this->_template->setView('contacts');
		$array = array(
			"title"=>$this->lang['Contacts'],
			"styles"=>array('contacts'),
			"settings"=>$this->getSettings()
		);
	    $this->_template->render($array);
	}
	
	function teambuilding()
	{
		$rooms = $this->_model->select(
			"id, url, title, body",
			"articles",
			"!deleted AND publish_date <= CURDATE() AND category = 3 AND lang = '".LOCALE."'",
			"publish_date DESC"
		);
		$team = array();
		while ($row = $rooms->fetch_object())
		{
			$images = RichController::getSortedImages($row->id);
			if (isset($images[0]))
			{
				$row->image = $images[0];
			}
			$team[] = $row;
		}
	
		$this->_template->setView('teambuilding');
		$array = array(
			"title"=>$this->lang['Team building'],
			"styles"=>array('teambuilding'),
			"team"=>$team,
			"settings"=>$this->getSettings()
		);
	    $this->_template->render($array);
	}

	function terms()
	{
		$this->_template->setView('terms');
		$array = array(
			"title"=>$this->lang['terms'],
			"styles"=>array('terms'),
			"settings"=>$this->getSettings()
		);
	    $this->_template->render($array);
	}
}
?>