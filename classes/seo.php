<?php
class SEO extends Model
{
	public $properties = array(
			"id"=>null,
			"title"=>'',
			"body"=>''
		);

	function onSave()
	{
		$this->properties['url'] = $this->urlFromTitle($this->properties['title']);
	}
	
	static function urlFromTitle($title)
	{
		$title = mb_strtolower(trim(strip_tags($title)), 'UTF-8');
		$title = str_replace('@', ' at ', $title);
		$title = str_replace('%', ' percent ', $title);
		$title = str_replace('&', ' and ', $title);
		
		$CyrToLat = array(
			"а"=>'a',
			"б"=>'b',
			"в"=>'v',
			"г"=>'g',
			"д"=>'d',
			"е"=>'e',
			"ж"=>'j',
			"з"=>'z',
			"и"=>'i',
			"й"=>'y',
			"к"=>'k',
			"л"=>'l',
			"м"=>'m',
			"н"=>'n',
			"о"=>'o',
			"п"=>'p',
			"р"=>'r',
			"с"=>'s',
			"т"=>'t',
			"у"=>'u',
			"ф"=>'f',
			"х"=>'h',
			"ц"=>'ts',
			"ч"=>'ch',
			"ш"=>'sh',
			"щ"=>'sht',
			"ъ"=>'u',
			"ьо"=>'yo',
			"ю"=>'yu',
			"я"=>'ya'
		);
		foreach ($CyrToLat as $cyr=>$lat)
		{
			$title = str_replace($cyr, $lat, $title);
		}
		
		$title = preg_replace('/[\s\W_]+/', '-', $title);
		$title = preg_replace('/^[\-]+/','',$title); // Strip off the starting hyphens
		$title = preg_replace('/[\-]+$/','',$title); // // Strip off the ending hyphens 
		
		return $title;
	}
	
	function checkUrl($url, $id)
	{
		$result = $this->select("id, url", "#table", "deleted = 0 AND url = '$url' AND id != '$id'");
		if ($result->num_rows)
		{
			return 'URL is in use';
		}
		else
		{
			return 'OK';
		}
	}
	
	function loadItem($url)
	{
		$url = addslashes($url);
		$result = $this->select("id", "#table", "deleted = 0 AND url = '$url'");
		while ($row = $result->fetch_object())
		{
			$this->load($row->id);
		}
	}
	
	function shortBody($body = null)
	{
		if (!$body)
		{
			$body = $this->properties['body'];
		}
		$body = trim(strip_tags($body));
		//$body = str_replace("\n", ' ', $body);
		$p = explode(".", $body);
		if (count($p))
		{
			$body = '';
			for ($i = 0; $i < count($p) && strlen($body) < 600; $i++)
			{
				$body .= $p[$i].'.';
			}
		}
		
		return $body;
	}
}
?>