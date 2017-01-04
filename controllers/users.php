<?php
class Users extends Controller
{
	function __construct($action)
	{
		parent::__construct($action);
		$this->setModel('user');
	}
	
	function checkUser()
	{
		if ($this->_model->checkUser(addslashes($_REQUEST["user_name"]), addslashes($_REQUEST["user_pass"])))
		{
			header("location: index.php?content=reservations");
		}
		else
		{
			$this->login($this->lang['Invalid user pass']);
		}
	}
	
	function login($error = '')
	{
		$this->_template->setView('login_form');
		$array = array(
			"title"=>$this->lang['Log in please'],
			"error"=>$error,
			"login"=>true
		);
	    $this->_template->render($array);
	}
	
	function logOut()
	{
		$this->_model->clearSession();
		header("location: ".ROOT_URL);
	}
	
	function changePassword()
	{
		if ((isset($_POST['password'])) && (isset($_POST['new_pass'])))
		{
			$query = "SELECT user_pass = SHA('".addslashes($_POST['password'])."') FROM users WHERE id = ".$_SESSION['user'];
			$result = $this->SQL->query($query);
			$row = $result->fetch_row();
			if ($row[0])
			{
				$this->SQL->query("UPDATE users SET user_pass = SHA('".addslashes($_POST['new_pass'])."') WHERE id = ".$_SESSION['user']);
				echo 'OK';
			}
			else
			{
				echo $this->lang['Old password is wrong'];
			}
		}
	}
	
	function changeValue()
	{
		if (isset($_GET['autosave']))
		{
			$_SESSION['autosave'] = (int)$_GET['autosave'];
			
			$this->SQL->query("UPDATE users SET autosave = ".$_SESSION['autosave']." WHERE id = ".$_SESSION['user']);
		}
	}
	
	function registration($error = '')
	{
		$this->_template->setView('registration_form');
		$array = array(
			"error"=>$error,
			"user"=>$this->_model->getProperties()
		);
	    $this->_template->simpleRender($array);
	}
	
	function registerUser()
	{
		$this->_model->loadFrom($_REQUEST);
		$email = new EmailValidator;
		$address = $this->_model->properties['e_mail'] = $this->_model->properties['user_name'];
		if (!$email->check($this->_model->properties['e_mail']))
		{
			$this->registration($this->lang['Invalid e-mail']);
		}
		else if ($this->_model->count("deleted = 0 AND user_name = '".addslashes($address)."'"))
		{
			$this->registration($this->lang['Duplicate user']);
		}
		else
		{
			$this->_model->properties['role_id'] = 4;
			$this->_model->properties['access_level'] = 50;
			$this->_model->properties['locale'] = LOCALE;
			$id = $this->_model->add();
			
			$code = $this->_model->randomCode();
			$this->SQL->query("UPDATE users SET user_pass = SHA1('$code') WHERE id = $id");
			$link = 'http://'.DOMAIN.ROOT_URL.'users/activation.php?code='.md5($this->_model->properties['id'].SITENAME.sha1($code));
			$message = $this->lang['Activation mail'].'<p><a href="'.$link.'">'.$link.'</a></p>';
			
			$this->mail($address, $this->lang['Profile activation'], $message, SITENAME.' <no-reply@krasiviidei.com>');
			echo $this->lang['Activation needed'];
		}
	}
	
	function forgottenPass($error = '')
	{
		$this->_template->setView('forgottenpass_form');
		$array = array(
			"error"=>$error
		);
	    $this->_template->simpleRender($array);
	}
	
	function getPass()
	{
		$this->_model->loadFrom($_REQUEST);
		$email = new EmailValidator;
		$address = $this->_model->properties['e_mail'];
		if (!$email->check($this->_model->properties['e_mail']))
		{
			$this->forgottenPass($this->lang['Invalid e-mail']);
		}
		else if ($this->_model->count("deleted = 0 AND e_mail = '".addslashes($address)."'"))
		{
			$result = $this->_model->select(
				"id, user_pass",
				"users",
				"e_mail = '".addslashes($address)."' AND deleted = 0"
			);
			$row = $result->fetch_object();
			$link = 'http://'.DOMAIN.ROOT_URL.'users/activation.php?code='.md5($row->id.SITENAME.$row->user_pass);
			$message = $this->lang['Forgotten pass mail'].'<p><a href="'.$link.'">'.$link.'</a></p>';
			
			$this->mail($address, $this->lang['Forgotten Pass'], $message, SITENAME.' <no-reply@krasiviidei.com>');
			echo $this->lang['Pass e-mail needed'];
		}
		else
		{
			$this->forgottenPass($this->lang['Invalid e-mail']);
		}
	}
	
	function activation()
	{
		if (isset($_GET['code']))
		{
			$code = addslashes($_GET['code']);
			$result = $this->_model->select(
				"id, first_name, last_name, access_level, locale",
				"users",
				"MD5(CONCAT(id, '".SITENAME."', user_pass)) = '$code'"
			);
			if ($result->num_rows)
			{
				$row = $result->fetch_object();
				$this->_model->setSession($row);
				$this->newPass();
			}
			else
			{
				$this->notFound();
			}
		}
		else
		{
			$this->notFound();
		}
	}
	
	function profile()
	{
		$this->_template->setView('profile');
	    $this->_template->render(array());
	}
	
	function newPass()
	{
		$this->_template->setView('newpass_form');
	    $this->_template->render(array());
	}
	
	function setPass()
	{
		if ((isset($_POST['pass2'])) && (isset($_POST['user_pass'])))
		{
			$this->SQL->query("UPDATE users SET activated = 1, user_pass = SHA('".addslashes($_POST['user_pass'])."') WHERE id = ".$_SESSION['user']);
			$_SESSION['activated'] = 1;
			if ($_SESSION['access'] < 100)
			{
				$this->SQL->query("UPDATE users SET role_id = 3, access_level = 100 WHERE id = ".$_SESSION['user']);
				$_SESSION['access'] = 100;
			}
			$main = new Main('home');
			$main->doAction();
		}
	}
	
	function mail($to, $subject, $message, $from, $additionalHeaders = "")
	{
		$header = 'From: '.$from."\r\n";
		$header .= 'MIME-Version: 1.0' . "\r\n" . 'Content-type: text/html; charset=UTF-8' . "\r\n";
		$header .= $additionalHeaders;
		mail($to, '=?UTF-8?B?'.base64_encode($subject).'?=', $message, $header); 
	}
}
?>