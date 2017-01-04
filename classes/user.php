<?php
class User extends Model
{
	public $properties = array(
			"id"=>null,
			"first_name"=>"",
			"last_name"=>"",
			"user_name"=>"",
			"e_mail"=>"",
			"role_id"=>null,
			"locale"=>DEFAULT_LOCALE
		);
		
	function __construct()
	{
		parent::__construct();
		$this->tableName = "users";
	}
	
	function checkUser($user, $pass)
	{
		$result = $this->SQL->query("SELECT id, first_name, last_name, access_level, locale FROM users 
										WHERE user_name = '$user' AND user_pass = SHA('$pass') AND deleted = 0");
		if ($result->num_rows)
		{
			$row = $result->fetch_object();
			$this->setSession($row);
		}
		else
		{
			$this->clearSession();
		}
		
		return $result->num_rows;
	}
	
	function setSession($row)
	{
		$_SESSION['access'] = $row->access_level;
		$_SESSION['user'] = $row->id;
		$_SESSION['name'] = $row->first_name.' '.$row->last_name;
		$_SESSION['locale'] = $row->locale;
	}
	
	static function clearSession()
	{
		$_SESSION['access'] = 0;
		$_SESSION['user'] = 0;
		$_SESSION['name'] = "";
	}
	
	static function init()
	{
		if (!isset($_SESSION['user']))
		{
			self::clearSession();
		}
		
		$_SESSION['locale'] = DEFAULT_LOCALE;
		
		if (isset($_GET['locale']))
		{
			if (is_dir(GLOBAL_PATH_LANG.$_GET['locale']))
			{
				if ($_SESSION['user'] && ($_SESSION['locale'] != $_GET['locale']))
				{
					self::updateLocale($_SESSION['user'], $_GET['locale']);
				}
				$_SESSION['locale'] = $_GET['locale'];
			}
		}
		
		define('LOCALE', $_SESSION['locale']);
		define('LOCALE_URL', ROOT_URL.LOCALE.'/');
		
		return $_SESSION['user'];
	}
	
	static function updateLocale($user_id, $locale)
	{
		$user = new User;
		$user->load($user_id);
		$user->properties['locale'] = $locale;
		$user->update();
	}
	
	function randomCode()
	{
		$code = "";
		for ($i = 0; $i < 8; $i++)
		{
			$code .= chr(mt_rand(ord('a'), ord('z')));
		}
		
		return $code;
	}
	
	function getAccessByRole($role_id = 0)
	{
		if (!$role_id)
		{
			$role_id = $this->properties['role_id'];
		}
		$role_id = (int)$role_id;
		
		$result = $this->SQL->query("SELECT access_level FROM roles WHERE id = $role_id");
		if ($result->num_rows)
		{
			$row = $result->fetch_row();
			if ($_SESSION['access'] > $row[0])
			{
				$this->properties['access_level'] = $row[0];
			}
		}
		return 0;
	}
	
	function add()
	{
		if (isset($_POST['time_control']))
		{
			if (isset($_SESSION['time_control']) && ($_SESSION['time_control'] == $_POST['time_control']))
			{
				return null;
			}
			$_SESSION['time_control'] = $_POST['time_control'];
		}
		
		return parent::add();
	}
}
?>