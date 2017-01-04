<title>
<?php 
if (isset($title) && ($title != $lang[SITENAME]))
{
	echo $lang[SITENAME].' - '.$title;
}
else
{
	echo $lang[SITENAME];
}
?>
</title>