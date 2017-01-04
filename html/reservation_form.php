<div id="wall_4" class="calendar">
	<div id="content_4" class="content">
		<div class="text_calendar"><h2><?php echo $lang['Reservation calendar']; ?></h2></div>
		<div class="prev_next">
			<div class="prev noselect" style="visibility: hidden;"><i class="fa fa-arrow-left" aria-hidden="true"></i> <?php echo $lang['Previous week']; ?></div>
			<div class="next noselect"><?php echo $lang['Next week']; ?> <i class="fa fa-arrow-right" aria-hidden="true"></i></div>
		</div>
		<div class="dates"><?php $this->showView('calendar'); ?></div>
	
		<div class="choose_people">
			<ul>
				<li class="dates1">2 <?php echo $lang['Players']; ?></li>
				<li><input type="radio" name="players" value="2" id="price"><label for="price" class="noselect"><span>30 BGN</span></label></input></li>
			</ul>
			
			<ul>
				<li class="dates1">3 <?php echo $lang['Players']; ?></li>
				<li><input type="radio" name="players" value="3" id="price2"><label for="price2" class="noselect"><span>45 BGN</span></label></input></li>
			</ul>
			
			<ul>
				<li class="dates1">4 <?php echo $lang['Players']; ?></li>
				<li><input type="radio" name="players" value="4" id="price3"><label for="price3" class="noselect"><span>55 BGN</span></label></input></li>
			</ul>
			
			<ul>
				<li class="dates1">5 <?php echo $lang['Players']; ?></li>
				<li><input type="radio" name="players" value="5" id="price4"><label for="price4" class="noselect"><span>65 BGN</span></label></input></li>
			</ul>
			
			<ul>
				<li class="dates1">6 <?php echo $lang['Players']; ?></li>
				<li><input type="radio" name="players" value="6" id="price5"><label for="price5" class="noselect"><span>70 BGN</span></label></input></li>
			</ul>
			
		</div>
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

$(".prev_next .prev").click(function()
{
	if (week)
	{
		week--;
		if (!week)
		{
			$(this).css("visibility", "hidden");
		}
		loadWeek();
		$(".prev_next .next").css("visibility", "visible");
	}
});

$(".prev_next .next").click(function()
{
	if (week < 8)
	{
		week++;
		if (week >= 8)
		{
			$(this).css("visibility", "hidden");
		}
		loadWeek();
		$(".prev_next .prev").css("visibility", "visible");
	}
});
</script>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo $lang['Complete your order']; ?></h4>
		<p><?php echo $lang['Enter your details and complete your order']; ?></p>
      </div>
      <div class="modal-body">
	    <form method="post" role="form" id="resForm">
			<input type="hidden" name="start_time" id="fstart" />
			<div class="row">
				<div class="col-sm-4 required">
					 <input type="text" class="form-control" id="fname" name="name" placeholder="<?php echo $lang['Your name']; ?>" />
				</div>
				<div class="col-sm-4 required">
					 <input type="text" class="form-control" id="femail" name="email" placeholder="<?php echo $lang['Your email address']; ?>" />
				</div>
				<div class="col-sm-4">
					 <input type="text" class="form-control" id="fteam" name="team" placeholder="<?php echo $lang['Name of your team']; ?>" />
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4 required">
					 <input type="text" class="form-control" id="fphone" name="phone" placeholder="<?php echo $lang['Phone number']; ?>" />
				</div>
				<div class="col-sm-4">
					 <input type="text" class="form-control" id="fcode" name="code" placeholder="<?php echo $lang['Discount code']; ?>" />
				</div>
				<div class="col-sm-4 required">
					<select name="difficulty" id="fdifficulty" class="form-control">
						<option value=""><?php echo $lang['Difficulty level']; ?></option>
						<option value="Medium"><?php echo $lang['Medium']; ?></option>
						<option value="Hard"><?php echo $lang['Hard']; ?></option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4 required">
					<select name="language" id="flang" class="form-control">
						<option value=""><?php echo $lang['Language']; ?></option>
						<option value="bg"><?php echo $lang['Bulgarian']; ?></option>
						<option value="en"><?php echo $lang['English']; ?></option>
					</select>
				</div>
				<div class="col-sm-4 required">
					<select name="payment" id="fpayment" class="form-control">
						<option value=""><?php echo $lang['Payment method']; ?></option>
						<option value="ePay"><?php echo $lang['ePay']; ?></option>
						<option value="Cash"><?php echo $lang['Cash']; ?></option>
					</select>
				</div>
				<div class="col-sm-4 required">
					<select name="players" id="fplayers" class="form-control">
						<option value=""><?php echo $lang['Number of players']; ?></option>
						<option value="2">2 <?php echo $lang['Players']; ?></option>
						<option value="3">3 <?php echo $lang['Players']; ?></option>
						<option value="4">4 <?php echo $lang['Players']; ?></option>
						<option value="5">5 <?php echo $lang['Players']; ?></option>
						<option value="6">6 <?php echo $lang['Players']; ?></option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4"></div>
				<div class="col-sm-4">
					<div class="checkbox">
						<label><input id="agree" type="checkbox" value="1"><?php echo $lang['I agree with']; ?> <a><?php echo $lang['T&C']; ?></a></label>
					</div>
				</div>
				<div class="col-sm-4"></div>
			</div>
		</form>
      </div>
      <div class="modal-footer">
		<h4><?php echo $lang['Total of your order']; ?>: <span id="total">45</span> BGN</h4>
		<p>You will have to deposit 30% before your reservation.</p>
        <button id="confirmRes" type="button" class="myst-btn"><?php echo $lang['Reserve now']; ?></button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">

$(".dates").on("change", 'input[name="start"]', function()
{
	$("#fstart").val($('input[name="start"]:checked').val());
	$("#myModal").modal("show");
});

$("#confirmRes").click(function()
{
	if(validate1("#resForm"))
	{
		var email_reg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		var emailinput = $('#femail').val();

		if (email_reg.test(emailinput) == false) {
			jQuery('#femail').parents(".required").addClass("has-error");
		}
		else if ($("#agree").prop("checked"))
		{
			$("#confirmRes").hide();
			$("#myModal").modal("hide");
			
			$.post(
				"<?php echo LOCALE_URL.'reservation.php'; ?>",
				$("#resForm").serialize(),
				function(data)
				{
					if (data)
					{
						alert(data);
						$("#confirmRes").show();
						loadWeek();
						$("#confirmRes").show();
					}
					else
					{
						window.location.href = '<?php echo LOCALE_URL.'thankyou.php'; ?>';
					}
				}
			);
		}
		else
		{
			alert("Please confirm you agree with T&C!");
		}
	}
});
</script>