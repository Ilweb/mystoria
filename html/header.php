<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />

 <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<link href="<?php echo ROOT_URL; ?>css/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo ROOT_URL; ?>css/general.css?ver=1" type="text/css" rel="stylesheet"/>
<link href="<?php echo ROOT_URL; ?>css/font-awesome.min.css" type="text/css" rel="stylesheet"/>
<link href="<?php echo ROOT_URL; ?>css/lightbox.min.css" type="text/css" rel="stylesheet"/>

<?php
if (isset($styles))
{
	foreach ($styles as $style)
	{
		?>
		<link href="<?php echo ROOT_URL; ?>css/<?php echo $style; ?>.css?ver=1" type="text/css" rel="stylesheet"/>
		<?php
	}
}
?>

<script type="text/javascript" SRC="<?php echo ROOT_URL; ?>js/jquery-ui.min.js"></script>
<script type="text/javascript" SRC="<?php echo ROOT_URL; ?>js/main.js?v=1"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgRfpfzYdPBGQDWPAU7DPlLxVCuJfkKQY&callback=initMap"></script>

<script src="<?php echo ROOT_URL; ?>js/mystoria.js"></script>
<link href='https://fonts.googleapis.com/css?family=Roboto:300&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
<link rel="shortcut icon" href="<?php echo IMAGE_URL; ?>akladi.ico" />  
<meta property="og:site_name" content="<?php echo $lang[SITENAME]; ?>"/>
<?php
$this->showView('title');
if (isset($description) && ($description != "")) 
{ 
	$meta_descr = str_replace('"', '\'', $description);
	$meta_descr = str_replace("\r\n", ' ', $meta_descr);
	$meta_descr = str_replace("\n", ' ', $meta_descr);
	$meta_descr = str_replace('&nbsp;', ' ', $meta_descr);
	$meta_descr = str_replace('&ndash;', '-', $meta_descr);
	$meta_descr = str_replace('&bdquo;', '\'', $meta_descr);
	$meta_descr = str_replace('&ldquo;', '\'', $meta_descr);
	$meta_descr = str_replace("  ", ' ', $meta_descr);
	$meta_descr = trim($meta_descr);
	?>
	<meta name="description" content="<?php echo $meta_descr; ?>">
	<?php 
} 
$prps = array(
	"crop"=>1.6,
	"keepHigh"=>true,
	"watermark"=>!true
);
if (isset($images) && is_array($images) && count($images) && isset($dir))
{
	foreach ($images as $key => $image)
	{
		?>
		<meta property="og:image" content="<?php echo "http://".$_SERVER['SERVER_NAME'].$this->thumbnail($dir.'/'.$images[$key], 600, $prps); ?>"/>
		<?php
	}
}
if (isset($canonical))
{
	?>
	<link rel="canonical" href="http://<?php echo DOMAIN.$canonical; ?>" />
	<?php
}
$this->showView('header_script');
if ($_SESSION['user'])
{
	$this->showView('user_script');
}
if (isset($tinyMice))
{
	$this->showView('tinymice_init');
}
?>
</head>
<script type="text/javascript" SRC="<?php echo ROOT_URL; ?>js/lightbox.min,js"></script>
<body>
