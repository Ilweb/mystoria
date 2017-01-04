<div class="container">
	<h1>Reservations</h1>
	<div class="row buttonrow">
		<div class="col-sm-6">
			<a class="btn btn-primary btn-block">Show Calendar</a>
		</div>
		<div class="col-sm-6">
			<select name="status" id="fstatus" class="form-control">
				<option value="">All not cancelled</option>
				<?php
				foreach ($statuses as $status)
				{
					echo '<option>'.$status.'</option>';
				}
				?>
			</select>
		</div>
	</div>
	<div class="row dates" style="background:#131843;"></div>
	<div class="row buttonrow1" style="display: none;">
		<div class="col-sm-4">
			<a class="btn btn-info btn-block prev" style="visibility: hidden;">Previous week</a>
		</div>
		<div class="col-sm-4">
			<a class="btn btn-primary btn-block create" style="visibility: hidden;">Create reservation</a>
		</div>
		<div class="col-sm-4">
			<a class="btn btn-info btn-block next">Next week</a>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12" id="reservvationList"></div>
	</div>
</div>
<script type="text/javascript">
var week = 0;
function loadWeek()
{
	$(".dates").load("<?php echo ROOT_URL ?>",
	{
		content: "main",
		action: "getCalendar",
		"week": week
	});
}

$(".prev").click(function()
{
	if (week)
	{
		week--;
		if (!week)
		{
			$(this).css("visibility", "hidden");
		}
		loadWeek();
		$(".next").css("visibility", "visible");
		
		$(".create").css("visibility", "hidden");
	}
});

$(".next").click(function()
{
	if (week < 8)
	{
		week++;
		if (week >= 8)
		{
			$(this).css("visibility", "hidden");
		}
		loadWeek();
		$(".prev").css("visibility", "visible");
		
		$(".create").css("visibility", "hidden");
	}
});

$(".buttonrow a").first().click(function()
{
	loadWeek(); 
	$('.dates').show(); 
	$('.buttonrow').hide();
	$('.buttonrow1').show();
});

$(".dates").on("change", 'input[name="start"]', function()
{
	$(".create").css("visibility", "visible");
	$(".create").attr("href", "<?php echo LOCALE_URL.'index.php?content=reservations&action=edit&start_time=' ?>" + $('input[name="start"]:checked').val());
});

function loadReservations(page)
{
	$("#reservvationList").load("<?php echo ROOT_URL ?>",
	{
		content: "reservations",
		action: "filter",
		"state": $("#fstatus").val(),
		"page": page
	});
}

loadReservations(1);

$("#fstatus").change(function()
{
	loadReservations(1);
});

jQuery("#reservvationList").on("click", ".pagination a", function()
{
	loadReservations(jQuery(this).data("page"));
});
</script>