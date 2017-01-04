<form id="contactForm">
	<input type="hidden" id="subject" name="subject" value="<?php echo $lang[SITENAME]; ?>" />
	<label class="contacts" for="name"><?php echo $lang['Your name']; ?> *</label>
	<div class="input">
		<input type="text" id="name" name="name" class="contacts" maxlength="64" />
	</div>
	<label class="contacts" for="email">E-mail *</label>
	<div class="input">
		<input type="text" id="email" name="email" class="contacts" maxlength="128" />
	</div>
	<label class="contacts" for="phone"><?php echo $lang['Phone number']; ?></label>
	<div class="input">
		<input type="text" id="phone" name="phone" class="contacts" maxlength="45" />
	</div>
	<label class="contacts" for="from_date"><?php echo $lang['From date']; ?></label>
	<div class="input">
		<input type="text" id="from_date" name="from_date" class="contacts date" maxlength="10" />
	</div>
	<label class="contacts" for="to_date"><?php echo $lang['To date']; ?></label>
	<div class="input">
		<input type="text" id="to_date" name="to_date" class="contacts date" maxlength="10" />
	</div>
	<label class="contacts" for="message"><?php echo $lang['Message']; ?></label>
	<div class="input">
		<textarea class="contacts" id="message" name="message" style="height: 150px;"></textarea>
	</div>
	<div>
		<a id="sendMail" class="button"><?php echo $lang['Send']; ?></a>
	</div>
	<div style="clear: both; height: 20px;"></div>
</form>
<script type="text/javascript">
prepareUI();

jQuery("#sendMail").click(function()
{
	if (jQuery.trim(jQuery("#name").val()) != "")
	{
		jQuery("#name").parent().removeClass("error");
		
		if (jQuery.trim(jQuery("#email").val()) != "")
		{
			jQuery.get("index.php",
			{
				content: "main",
				action: "checkEmail",
				email: jQuery.trim(jQuery("#email").val())
			}, function(data)
			{
				if (data == 'OK')
				{
					jQuery("#email").parent().removeClass("error");
					jQuery("#sendMail").hide();
					jQuery.post("index.php",
					{
						content: "main",
						action: "sendFeedback",
						name: jQuery("#name").val(),
						email: jQuery("#email").val(),
						phone: jQuery("#phone").val(),
						from_date: jQuery("#from_date").val(),
						to_date: jQuery("#to_date").val(),
						message: jQuery("#message").val()
					}, function()
					{
						jQuery("#contactForm").hide();
						jQuery("#contactForm").after('<p class="red"><?php echo $lang['Thank you']; ?></p>');
					});
				}
				else
				{
					jQuery("#email").parent().addClass("error");
					jQuery(".alertDlg").html('<?php echo $lang['Invalid email']; ?>');
					jQuery(".alertDlg").dialog("open");
				}
			});
		}
		else
		{
			jQuery("#email").parent().addClass("error");
			jQuery(".alertDlg").html('<?php echo $lang['Fill in email']; ?>');
			jQuery(".alertDlg").dialog("open");
		}
	}
	else
	{
		jQuery("#name").parent().addClass("error");
		jQuery(".alertDlg").html('<?php echo $lang['Fill in name']; ?>');
		jQuery(".alertDlg").dialog("open");
	}
});
</script>