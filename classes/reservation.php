<?php
class Reservation extends model
{
	public $properties = array(
			"id"=>null,
			"start_time"=>'',
			"name"=>'',
			"email"=>'',
			"team"=>'',
			"phone"=>'',
			"code"=>'',
			"difficulty"=>null,
			"ip"=>null,
			"language"=>'bg',
			"payment"=>null,
			"players"=>null,
			"status"=>'pending',
			"time"=>null
		);
		
	function __construct()
	{
		parent::__construct();
		$this->tableName = "reservations";
	}
	
	function statuses()
	{
		return array(
			'pending',
			'confirmed',
			'cancelled',
			'completed'
		);
	}
	
	function isAvailable()
	{
		$result = $this->SQL->query("
			SELECT id FROM reservations
				WHERE status NOT IN ('cancelled') 
					AND 
					((start_time <= '".$this->properties['start_time']."'
					AND start_time >= '".date('Y-m-d H:i:s', strtotime($this->properties['start_time']) - 3600)."')
					OR (start_time >= '".$this->properties['start_time']."'
					AND start_time <= '".date('Y-m-d H:i:s', strtotime($this->properties['start_time']) + 3600)."'))
		");
	
		return !$result->num_rows;
	}
	
	function add()
	{
		$this->properties['ip'] = $_SERVER['REMOTE_ADDR'];
	
		$id = parent::add();
		
		$validator = new EmailAddressValidator;
			
		$feedback = $this->getProperties();
		
		if ($validator->check_email_address($feedback->email))
		{
			$msg .= "<p>Tkank you for your reservation!</p>";
			$msg .= "<p>Date & Time: <b>".$feedback->start_time."</b><br/>";
			$msg .= "E-mail: <b>".$feedback->email."</b><br/>";
			$msg .= "Name: <b>".$feedback->name."</b><br/>";
			$msg .= "Phone: <b>".$feedback->phone."</b><br/>";
			$msg .= "Language: <b>".strtoupper($feedback->language)."</b><br/>";
			$msg .= "Difficulty: <b>".$feedback->difficulty."</b></p>";
			$msg .= "<p>Mystoria Team</p>";
			
			$this->mail($feedback->email, "Reservation is received", $msg, DEFAULT_EMAIL);
		}
		
		$users = $this->SQL->query("SELECT e_mail, first_name, last_name FROM users WHERE deleted = 0");
		while ($user = $users->fetch_object())
		{
			if ($validator->check_email_address($user->e_mail))
			{
				$msg = "<p>New reservation from the web form:</p>";
				$msg .= "<p>ID: <b>".$feedback->id."</b><br/>";
				$msg .= "Date & Time: <b>".$feedback->start_time."</b><br/>";
				$msg .= "E-mail: <b>".$feedback->email."</b><br/>";
				$msg .= "Name: <b>".$feedback->name."</b><br/>";
				$msg .= "Phone: <b>".$feedback->phone."</b><br/>";
				$msg .= "Team: <b>".$feedback->team."</b><br/>";
				$msg .= "Language: <b>".strtoupper($feedback->language)."</b><br/>";
				$msg .= "Difficulty: <b>".$feedback->difficulty."</b><br/>";
				$msg .= "IP address: <b>".$feedback->ip."</b></p>";
				
				$this->mail($user->e_mail, "Reservation on ".date('d.m.Y H:i', strtotime($feedback->start_time)), $msg, $feedback->name.' <'.$feedback->email.'>');
			}
		}
		
		return $id;
	}
}
?>