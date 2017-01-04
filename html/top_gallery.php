<div id="topGallery">
<?php
$prps = array(
	"crop"=>1.6,
	"watermark"=>!true
);
foreach ($topImages as $key=>$image)
{
	echo '<canvas id="canvas'.$key.'" width="600" height="420"></canvas>';
	echo '<img id="top'.$key.'" alt="" src="'.$this->thumbnail($topDir.'/'.$image, 470, $prps).'" />';
}
?>
</div>
<script type="text/javascript">
var t2;

jQuery(window).load(function()
{
	jQuery("canvas").each(function(key)
	{
		var nextKey = key + 1;
		if (nextKey >= jQuery("canvas").length)
		{
			nextKey = 0;
		}

		var ctx = this.getContext("2d");

		ctx.shadowBlur=5;
		ctx.shadowColor="#414141";
		ctx.fillStyle = "#FFFFFF";

		ctx.translate(490, 0);
		ctx.rotate(-Math.PI/20);
		ctx.translate(-490, 0);


		ctx.shadowOffsetX=2;
		ctx.shadowOffsetY=2;
		ctx.fillRect(0,0,490,313);

		ctx.shadowOffsetX=0;
		ctx.shadowOffsetY=0;
		var img = document.getElementById("top"+nextKey);
		ctx.drawImage(img,10,10);

		ctx.translate(490, 0);
		ctx.rotate(Math.PI/20);
		ctx.translate(-490, 0);

		ctx.shadowOffsetX=2;
		ctx.shadowOffsetY=2;
		ctx.fillRect(100,0,490,313);

		ctx.shadowOffsetX=0;
		ctx.shadowOffsetY=0;
		var img = document.getElementById("top"+key);
		ctx.drawImage(img,110,10);
	});
	
	jQuery("#topGallery canvas").hide();
	jQuery("#topGallery canvas").first().show();

	t2 = setTimeout("changeTopImage()", 5000);
});

function changeTopImage()
{
	jQuery("#topGallery canvas").first().appendTo("#topGallery");
	jQuery("#topGallery canvas").last().fadeOut(500)
	jQuery("#topGallery canvas").first().fadeIn(500);
	t2 = setTimeout("changeTopImage()", 10000);
}
</script>