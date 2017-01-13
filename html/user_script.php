<script type="text/javascript">
jQuery(document).ready(function()
{
jQuery(".changePass").dialog({
		modal: true,
		autoOpen: false,
		resizable: false,
		width: 400,
		buttons: 
		{
			"<?php echo $lang['Save']; ?>": function() 
			{ 
				if (jQuery(".password1").val() != jQuery(".password2").val())
				{
					alert('<?php echo $lang['Choose another title']; ?>');
				}
				else if (jQuery(".changePass .password1").val() == '')
				{
					jQuery(".changePass .alert").html("<?php echo $lang['Fill new pass']; ?>");
				}
				else 
				{
					jQuery.post("index.php",
					{
						content: "users",
						action: "changePassword",
						password: jQuery(".changePass .password").val(),
						new_pass: jQuery(".changePass .password1").val()
					},
					function(data)
					{
						if (jQuery.trim(data) == 'OK')
						{
							jQuery('.changePass input[type="password"]').val('');
							jQuery('.changePass .alert').html('');
						}
						else
						{
							jQuery(".changePass").dialog("open");
							jQuery(".changePass .alert").html(data);
						}
					});
					jQuery(this).dialog("close"); 
				}
			},
			"<?php echo $lang['Cancel']; ?>": function() 
			{ 
				jQuery(this).dialog("close"); 
				jQuery('.changePass input[type="password"]').val('');
				jQuery('.changePass .alert').html('');
			}
		}
	});
	jQuery(".changePassLink").click(function()
	{
		//jQuery(".changePass").dialog("open");
	});
});
</script>