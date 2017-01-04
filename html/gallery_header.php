<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo ROOT_URL; ?>css/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo ROOT_URL; ?>css/style.css?ver=1" type="text/css" rel="stylesheet">
<script type="text/javascript" SRC="<?php echo ROOT_URL; ?>js/jquery.js"></script>
<script type="text/javascript" SRC="<?php echo ROOT_URL; ?>js/jquery-ui.min.js"></script>
<script type="text/javascript" SRC="<?php echo ROOT_URL; ?>js/main.js"></script>
<script type="text/javascript">
jQuery(document).ready(function()
{
	prepareUI();
});

function deleteImage(url, image)
{
	if (confirm('Наистина ли ще изтриете ' + image + '?'))
	{
		window.location.href = url;
	}
}
</script>
</head>
<body style="background: none;">