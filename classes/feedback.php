<?php
class Feedback extends model
{
	public $properties = array(
			"id"=>null,
			"from_date"=>'',
			"to_date"=>'',
			"name"=>'',
			"email"=>'',
			"phone"=>'',
			"message"=>'',
			"ip"=>null,
			"lang"=>LOCALE
		);
		
	function __construct()
	{
		parent::__construct();
		$this->tableName = "feedback";
	}
	
	function add()
	{
		$validator = new EmailAddressValidator;
			
		$feedback = $this->getProperties();
		$users = $this->SQL->query("SELECT e_mail, first_name, last_name FROM users WHERE deleted = 0");
		while ($user = $users->fetch_object())
		{
			if ($validator->check_email_address($user->e_mail))
			{
				$msg .= "<p>Имате ново съобщение от формата за контакти.</p>";
				$msg .= "<p>Име: <b>".$feedback->name."</b><br/>";
				$msg .= "E-mail: <b>".$feedback->email."</b><br/>";
				$msg .= "Телефон: <b>".$feedback->phone."</b><br/>";
				$msg .= "Дати от: <b>".$feedback->from_date."</b> до: <b>".$feedback->to_date."</b></p>";
				$msg .= "<p>Текст на съобщението: <b>".$feedback->message."</b><br/><br/></p>";
				
				$this->mail($user->e_mail, "Запитване от ".$feedback->name, $msg, $feedback->name.' <'.$feedback->email.'>');
			}
		}
		
		$this->properties['ip'] = $_SERVER['REMOTE_ADDR'];
	
		return parent::add();
	}
}
?>