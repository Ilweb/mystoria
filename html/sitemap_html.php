<?php $this->showView('pathway'); ?>
<h1><?php echo $title; ?></h1>
<div class="articlePreview">
<?php
echo '<a href="'.ROOT_URL.'"><h2>'.$lang['Welcome'].' '.$lang[SITENAME].'</h2></a>';
echo '<ul>';

echo '<li><a href="'.ROOT_URL.'contacts.html">'.$lang['Contacts'].'</a>';

if ($_SESSION['access'])
{
	foreach ($menu->getUserMenu() as $key => $item)
	{
		if ($item->min_access < 1000)
		{
			echo '<li><a href="'.ROOT_URL.$item->url.'">'.$lang[$item->name].'</a></li>';
		}
	}
	?>
	<li><a class="changePassLink"><?php echo $lang['Change Password'] ?></a></li>
	<li><a href="<?php echo ROOT_URL; ?>index.php?content=users&action=logOut"><?php echo $lang['Log Out']; ?></a></li>
	<?php
}
else
{
	?>
	<li><a href="<?php echo ROOT_URL.'users/login.php'; ?>"><?php echo $lang['Log in']; ?></a></li>
	<li><a class="register"><?php echo $lang['Sign Up']; ?></a></li>
	<li><a class="forgotten"><?php echo $lang['Forgotten Pass']; ?></a></li>
	<?php
}

while ($page = $pages->fetch_object())
{
	echo '<li><a href="'.ROOT_URL.$page->url.'.html">'.$page->title.'</a></li>';
}

foreach ($categories as $cat => $category)
{
	echo '<li><h3><a href="'.ROOT_URL.$category->url.'/">'.$category->title.'</a></h3></li>';
	echo '<ul>';
	foreach ($category->submenus as $sub => $submenu)
	{
		echo '<li>';
		echo '<a href="'.ROOT_URL.$category->url.'/'.$submenu->url.'/">'.$submenu->title.'</a>';
		if (count($submenu->children))
		{
			echo '<ul>';
			foreach ($submenu->children as $ch => $child)
			{
				echo '<li>';
				echo '<a href="'.ROOT_URL.$category->url.'/'.$child->url.'/">'.$child->title.'</a>';
				if (count($child->articles) > 1)
				{
					echo '<ul>';
					foreach ($child->articles as $a => $article)
					{
						echo '<li>';
						echo '<a href="'.ROOT_URL.$category->url.'/'.$article->url.'.html">'.$article->title.'</a>';
						echo '</li>';
					}
					echo '</ul>';
				}
				if (count($child->products) > 1)
				{
					echo '<ul>';
					foreach ($child->products as $p => $product)
					{
						echo '<li>';
						echo '<a href="'.ROOT_URL.$category->url.'/'.$product->url.'.html">'.$product->title.'</a>';
						echo '</li>';
					}
					echo '</ul>';
				}
				echo '</li>';
			}
			echo '</ul>';
		}
		if (count($submenu->articles) > 1)
		{
			echo '<ul>';
			foreach ($submenu->articles as $a => $article)
			{
				echo '<li>';
				echo '<a href="'.ROOT_URL.$category->url.'/'.$article->url.'.html">'.$article->title.'</a>';
				echo '</li>';
			}
			echo '</ul>';
		}
		if (count($submenu->products) > 1)
		{
			echo '<ul>';
			foreach ($submenu->products as $p => $product)
			{
				echo '<li>';
				echo '<a href="'.ROOT_URL.$category->url.'/'.$product->url.'.html">'.$product->title.'</a>';
				echo '</li>';
			}
			echo '</ul>';
		}
		echo '</li>';
	}
	if (count($category->articles) > 1)
	{
		foreach ($category->articles as $a => $article)
		{
			echo '<li>';
			echo '<a href="'.ROOT_URL.$category->url.'/'.$article->url.'.html">'.$article->title.'</a>';
			echo '</li>';
		}
	}
	if (count($category->products) > 1)
	{
		foreach ($category->products as $p => $product)
		{
			echo '<li>';
			echo '<a href="'.ROOT_URL.$category->url.'/'.$product->url.'.html">'.$product->title.'</a>';
			echo '</li>';
		}
	}
	echo '</ul>';
}
echo '</ul>';
?>
</div>