<div class="container">
	<h1>Edit reservation</h1>
	<form method="post" role="form" id="resForm" action="<?php echo LOCALE_URL.'index.php'; ?>"  enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo $reservation->id; ?>"/>
		<input type="hidden" name="content" value="reservations" />
		<input type="hidden" name="action" value="save" />
		<div class="row">
			<div class="col-sm-4">
				<div class="form-group required">
					<label for="fdate">Date & Time</label>
					<input type="text" class="form-control" id="fdate" name="start_time" value="<?php echo $reservation->start_time; ?>" />
				</div>
				<div class="form-group required">
					<label for="fname">Name</label>
					<input type="text" class="form-control" id="fname" name="name" value="<?php echo $reservation->name; ?>" />
				</div>
				<div class="form-group">
					<label for="femail">Email address</label>
					<input type="text" class="form-control" id="femail" name="email" value="<?php echo $reservation->email; ?>" />
				</div>
				<div class="form-group required">
					<label for="fphone">Phone number</label>
					<input type="text" class="form-control" id="fphone" name="phone" value="<?php echo $reservation->phone; ?>" />
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group required">
					<label for="fplayers">Number of players</label>
					<input type="number" class="form-control" id="fplayers" name="players" value="<?php echo $reservation->players; ?>" />
				</div>
				<div class="form-group required">
					<label for="fpayment">Game language</label>
					<select name="language" id="flang" class="form-control">
						<option <?php if ($reservation->language == 'en') echo 'selected="selected"' ?>>English</option>
						<option <?php if ($reservation->language == 'bg') echo 'selected="selected"' ?>>Bulgarian</option>
					</select>
				</div>
				<div class="form-group required">
					<label for="fdifficulty">Difficulty level</label>
					<select name="difficulty" id="fdifficulty" class="form-control">
						<option <?php if ($reservation->difficulty == 'medium') echo 'selected="selected"' ?>>Medium</option>
						<option <?php if ($reservation->difficulty == 'hard') echo 'selected="selected"' ?>>Hard</option>
					</select>
				</div>
				<div class="form-group">
					<label for="fteam">Team name</label>
					<input type="text" class="form-control" id="fteam" name="team" value="<?php echo $reservation->team; ?>" />
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label for="fcode">Discount code</label>
					<input type="text" class="form-control" id="fcode" name="code" value="<?php echo $reservation->code; ?>" />
				</div>
				<div class="form-group required">
					<label for="fpayment">Payment method</label>
					<select name="payment" id="fpayment" class="form-control">
						<option <?php if ($reservation->payment == 'ePay') echo 'selected="selected"' ?>>ePay</option>
						<option <?php if ($reservation->payment == 'Cash') echo 'selected="selected"' ?>>Cash</option>
					</select>
				</div>
				<div class="form-group required">
					<label for="fstatus">Reservation status</label>
					<select name="status" id="fstatus" class="form-control">
					<?php
					foreach ($statuses as $status)
					{
						echo '<option'.($reservation->status == $status ? ' selected="selected"' : '').'>';
						echo $status;
						echo '</option>';
					}
					?>
					</select>
				</div>
			</div>
		</div>
		<div id="results" <?php if ($reservation->status != "completed") echo 'style="display: none;"' ?>>
			<h3>Results</h3>
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group required">
						<label for="ftime">Time</label>
						<input type="text" class="form-control" id="ftime" name="time" value="<?php echo $reservation->time; ?>" />
					</div>
				</div>
				<div class="col-sm-4">
					<label>Team photo</label>
					<label class="btn btn-info btn-block btn-file">
						Upload file <input type="file" name="image_file" style="display: none;" onchange="$('#upload-file-info').html($(this).val());">
					</label>
					<span class="label label-info" id="upload-file-info"></span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<a id="submitButton" class="btn btn-block btn-primary"><i class="fa fa-check"></i> Save</a>
			</div>
			<div class="col-sm-6">
				<a class="btn btn-block btn-warning" href="<?php echo LOCALE_URL.'index.php?content=reservations'; ?>">Don't save</a>
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
$("#submitButton").click(function()
{
	if (validate1("#resForm"))
	{
		$("#resForm").submit();
	}
});

$("#fstatus").change(function()
{
	if ($(this).val() == "completed")
	{
		$("#results").show();
	}	
	else
	{
		$("#results").hide();
	}
});
</script>