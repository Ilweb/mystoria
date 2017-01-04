<div class="pathway">
	<?php
	echo '<a href="'.LOCALE_URL.'">'.$lang[SITENAME].'</a>';
	echo ' > ';
	if (isset($catObj))
	{
		echo '<a href="'.LOCALE_URL.$catObj->url.'/">'.$lang[$catObj->title].'</a>';
		if (isset($submenus) && count($submenus))
		{
			$lnk = LOCALE_URL.$catObj->url;
			foreach ($submenus as $key => $submenu)
			{
				$lnk .= '/'.$submenu->url;
				if (!isset($canonical) || ($canonical != $lnk.'/'))
				{
					echo ' > ';
					echo '<a href="'.$lnk.'/">'.$submenu->title.'</a>';
				}
			}
		}
	}
	else
	{
		//echo $title;
	}
	?>
</div>