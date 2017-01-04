<?php
abstract class RichController extends Controller
{
	public $page = 1;
	public $pages = 1;
	public $resultsCount = 0;

	function __construct($action)
	{
		parent::__construct($action);
	}
	
	function checkUrl()
	{
		if (isset($_POST['title']))
		{
			$id = (int)$_POST['id'];
			$url = addslashes($this->_model->urlFromTitle($_POST['title']));
			echo $this->_model->checkUrl($url, $id);
		}
	}
	
	abstract protected function proceedSave();
	
	protected function checkUserDenied($id)
	{
		// If Editor or above
		if ($_SESSION['access'] >= 100)
		{
			return 0;
		}
		// If Unregistered user
		else
		{
			return 1;
		}
	}
	
	function save()
	{
		if ($_SESSION['access'] >= 100)
		{
			$this->_model->loadFrom($_POST);
			if ($this->_model->properties['id'])
			{
				if (!$this->checkUserDenied($this->_model->properties['id']))
				{
					$this->proceedSave();
				}
				else
				{
					$this->accessDenied();
				}
			}
			else
			{
				$this->proceedSave();
			}
		}
		else
		{
			$this->accessDenied();
		}
	}
	
	function delete()
	{
		if (isset($_REQUEST[strtolower(get_class($this->_model))]))
		{
			$id = (int)$_REQUEST[strtolower(get_class($this->_model))];
			if (!$this->checkUserDenied($id))
			{
				$this->_model->delete($id);
				echo "OK";
			}
		}
	}
	
	function editGallery()
	{
		if (isset($_REQUEST['id']) && (!$this->checkUserDenied($_REQUEST['id'])))
		{
			$id = (int)$_REQUEST['id'];
			$dir = strtolower(get_class($this)).'/'.$id.'/';
			if (!is_dir(IMAGE_DIR.$dir))
			{
				mkdir(IMAGE_DIR.$dir, 777, true);
			}
			
			$result = $this->_model->select(
				"order_no, image",
				strtolower(get_class($this->_model))."_images",
				strtolower(get_class($this->_model))."_id = '".$_REQUEST['id']."'",
				"order_no"
			);
			$images = array();
			$key = 1;
			while ($row = $result->fetch_object())
			{
				if (file_exists(IMAGE_DIR.$dir.$row->image) && (!in_array($row->image, $images)))
				{
					$images[$key] = $row->image;
					if ($row->order_no > $key)
					{
						$this->SQL->query("UPDATE
							".strtolower(get_class($this->_model))."_images
								SET order_no = $key
							WHERE ".strtolower(get_class($this->_model))."_id = '".$_REQUEST['id']."'
								AND order_no = ".$row->order_no);
					}
					$key++;
				}
				else
				{
					$this->SQL->query("DELETE FROM
							".strtolower(get_class($this->_model))."_images
							WHERE ".strtolower(get_class($this->_model))."_id = '".$_REQUEST['id']."'
								AND order_no = ".$row->order_no);
				}
			}
			
			foreach (scandir(IMAGE_DIR.$dir) as $k=>$image)
			{
				if (!is_dir(IMAGE_DIR.$dir.$image))
				{
					if (!in_array($image, $images))
					{
						$images[$key] = $image;
						$this->SQL->query("INSERT INTO
							".strtolower(get_class($this->_model))."_images(".strtolower(get_class($this->_model))."_id, order_no, image)
							VALUE('".$_REQUEST['id']."', $key, \"$image\")");
						$key++;
					}
				}
			}
			
			$this->_template->setView('gallery_edit');
			$array = array(
				"dir"=>$dir,
				"id"=>$id,
				"class"=>get_class($this),
				"images"=>$images
			);
			$this->_template->simpleRender($array);
		}
		else
		{
			//echo 'error';
		}
	}
	
	function reorderImages()
	{
		if (isset($_REQUEST['id']) && (!$this->checkUserDenied($_REQUEST['id'])))
		{
			$this->SQL->query("DELETE FROM
					".strtolower(get_class($this->_model))."_images
					WHERE ".strtolower(get_class($this->_model))."_id = '".$_REQUEST['id']."'");
					
			if (isset($_POST['images']) && is_array($_POST['images']))
			{
				foreach ($_POST['images'] as $key => $image)
				{
					$this->SQL->query("INSERT INTO
							".strtolower(get_class($this->_model))."_images(".strtolower(get_class($this->_model))."_id, order_no, image)
							VALUE('".$_REQUEST['id']."', $key, \"$image\")");
				}
			}
		}
	}
	
	protected function saveImage($subfolder = '', $input_image = 'image_file')
	{
		$id = $this->_model->properties['id'];
		if (!$id && isset($_POST['id']))
		{
			$id = (int)$_POST['id'];
		}
		if ($id)
		{
			if (!$this->checkUserDenied($id))
			{
				$dir = IMAGE_DIR.strtolower(get_class($this)) . '/' . $id . '/';
				$dir .= ($subfolder != '') ? $subfolder . '/' : '';
				if (!is_dir($dir)) 
				{
					// recursive True (if somehow we've missed to create directories)
					mkdir($dir, 0777, true);
				}
				if (isset($_FILES[$input_image]))
				{
					if (
						(!$_FILES[$input_image]['error']) 
						&& (
							str_replace('image', '', $_FILES[$input_image]['type']) != $_FILES[$input_image]['type'] 
						)
					   ) 
					{
						$newName = str_replace('.jpg', '', $_FILES[$input_image]['name']);
						$newName = str_replace('.JPG', '', $newName);
						$newName = SEO::urlFromTitle($newName).'.jpg';
						move_uploaded_file($_FILES[$input_image]['tmp_name'], $dir.$newName);
						
						$this->clarThumb($dir, $newName);
					}
					else
					{
						echo $_FILES[$input_image]['type'];
					}
				}
			}
		}
		else
		{
			echo 'error';
		}
	}
	
	protected function clarThumb($dir, $image)
	{
		$info = pathinfo($dir.$image);
		if (is_dir($dir.'thmb') && (strtolower($info['extension']) == 'jpg' ))
		{	
			$suffix = array(
				"???",
				"????",
				"?????",
				"??????"
			);
			foreach ($suffix as $k => $suff)
			{
				$files = glob($info['dirname']."/thmb/".$info['filename']."-$suff.".$info['extension']);
				foreach ($files as $key => $file)
				{
					unlink($file);
				}
			}
		}
	}
	
	function clearThumbs()
	{
		$result = $this->_model->select("id", "#table", 1);
		while ($row = $result->fetch_object())
		{
			$dir = IMAGE_DIR.strtolower(get_class($this)) . '/' . $row->id . '/thmb/';
			if (is_dir($dir))
			{
				foreach (scandir($dir) as $k=>$image)
				{
					if (!is_dir($dir.$image))
					{
						unlink($dir.$image);
					}
				}
			}
		}
	}
	
	function deleteImage($subfolder = '', $render_after_delete = true)
	{
		if (isset($_GET['id']) && (!$this->checkUserDenied($_GET['id'])))
		{
			$id = (int)$_GET['id'];
			$dir = IMAGE_DIR.strtolower(get_class($this)).'/'.$id.'/';
			$dir .= ($subfolder != '') ? $subfolder . '/' : '';
			if (is_file($dir.$_GET['image']))
			{
				unlink($dir.$_GET['image']);
				$this->clarThumb($dir, $_GET['image']);
			}
		}
		// if we delete from the logos directory for example
		// than don't show the Image Gallery afterwards
		if($render_after_delete) {
			$this->editGallery();
		}
	}
	
	function getImages($dir)
	{
		$images = array();
		if (is_dir(IMAGE_DIR.$dir))
		{
			foreach (scandir(IMAGE_DIR.$dir) as $key=>$image)
			{
				if (!is_dir(IMAGE_DIR.$dir.'/'.$image))
				{
					$images[] = $image;
				}
			}
		}
		return $images;
	}
	
	function getSortedImages($id, $model = null)
	{
		if (!$model)
		{
			$model = strtolower(get_class($this->_model));
		}
		$result = $this->_model->select(
			"order_no, image",
			$model."_images",
			$model."_id = $id",
			"order_no"
		);
		$images = array();
		while ($row = $result->fetch_object())
		{
			$images[] = $row->image;
		}
		
		return $images;
	}
	
	protected function limitStartFrom($tables, $where,  $cntField)
	{
		if (isset($_REQUEST['page']))
		{
			$page = (int)$_REQUEST['page'];
		}
		else if (isset($_SESSION[get_class($this)]['page']))
		{
			$page = $_SESSION[get_class($this)]['page'];
		}
		else
		{
			$page = 1;
		}
		if ($page < 1)
		{
			$page = 1;
		}
		$count = $this->_model->count($where, $tables, $cntField);
		$pages = ceil($count / PAGE_ROWS);
		if ($pages == 0)
		{
			$pages = 1;
		}
		if ($page > $pages)
		{
			$page = $pages;
		}
		$_SESSION[get_class($this)]['page'] = $page;
		$this->page = $page;
		$this->pages = $pages;
		$this->resultsCount = $count;
		
		return ($page - 1) * PAGE_ROWS;
	}
	
	function youtubeLink()
	{
		if (isset($_POST['url']))
		{
			echo $this->linkifyYouTubeURLs($_POST['url']);
		}
	}
	
	// Linkify youtube URLs which are not already links.
	private function linkifyYouTubeURLs($text) 
	{
		$text = preg_replace('~
			# Match non-linked youtube URL in the wild. (Rev:20111012)
			https?://         # Required scheme. Either http or https.
			(?:[0-9A-Z-]+\.)? # Optional subdomain.
			(?:               # Group host alternatives.
			  youtu\.be/      # Either youtu.be,
			| youtube\.com    # or youtube.com followed by
			  \S*             # Allow anything up to VIDEO_ID,
			  [^\w\-\s]       # but char before ID is non-ID char.
			)                 # End host alternatives.
			([\w\-]{11})      # $1: VIDEO_ID is exactly 11 chars.
			(?=[^\w\-]|$)     # Assert next char is non-ID or EOS.
			(?!               # Assert URL is not pre-linked.
			  [?=&+%\w]*      # Allow URL (query) remainder.
			  (?:             # Group pre-linked alternatives.
				[\'"][^<>]*>  # Either inside a start tag,
			  | </a>          # or inside <a> element text contents.
			  )               # End recognized pre-linked alts.
			)                 # End negative lookahead assertion.
			[?=&+%\w-]*        # Consume any URL (query) remainder.
			~ix', 
			'$1',
			$text);
		
		if (strlen($text) != 11)
		{
			$text = "";
		}
			
		return $text;
	}
}
?>