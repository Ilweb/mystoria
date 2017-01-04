function checkButton(element)
{
	if (element.checked)
	{
		if (jQuery(element).attr("type") == "radio")
		{
			jQuery('input[name="'+jQuery(element).attr("name")+'"]').button("option", "icons", {primary: "ui-icon-close"});
		}
		jQuery(element).button("option", "icons", {primary: "ui-icon-check"});
	}
	else
	{
		jQuery(element).button("option", "icons", {primary: "ui-icon-close"});
	}
}

function prepareUI()
{
	jQuery(".button").button();
	jQuery(".checkButton").each(function()
	{
		jQuery(".checkButton").button();
		checkButton(this);
		jQuery(this).change(function()
		{
			checkButton(this);
		});
	});
	
	jQuery(".add").button({icons: {primary: "ui-icon-circle-plus"}});
	jQuery(".submit").button({icons: {primary: "ui-icon-check"}});
	jQuery(".cancel").button({icons: {primary: "ui-icon-cancel"}});
	jQuery(".fore").button({icons: {primary: "ui-icon-arrowthick-1-e"}});
	jQuery(".reload").button({icons: {primary: "ui-icon-refresh"}});
	jQuery(".reset").button({icons: {primary: "ui-icon-closethick"}});
	jQuery(".delete").button({icons: {primary: "ui-icon-trash"}, text: false});
	jQuery(".edit").button({icons: {primary: "ui-icon-pencil"}, text: false});
	jQuery(".preview").button({icons: {primary: "ui-icon-search"}, text: false});
	jQuery(".minus").button({icons: {primary: "ui-icon-minusthick"}, text: false});
	jQuery(".plus").button({icons: {primary: "ui-icon-plusthick"}, text: false});
	jQuery(".commentTooltip").button({icons: {primary: "ui-icon-comment"}, text: false});
	jQuery(".restore").button({icons: {primary: "ui-icon-script"}});
	jQuery(".download").button({icons: {primary: "ui-icon-disk"}, text: false});
	setCalendars(".date", null);
	setRequired();
	
	jQuery('input[type="text"], select').change(function()
	{
		validate(jQuery(this).parent());
	});
	
	jQuery("#mainmenu").tooltip({});
	
	// Set titles on hint boxes
	jQuery(".hintbox").each(function()
	{
		if (jQuery(this).val() == '')
		{
			jQuery(this).val(jQuery(this).attr("title"));
			jQuery(this).css("color", "#8a8989");
		}
	});
	// Remove titles on focus
	jQuery(".hintbox").focus(function()
	{
		if (jQuery(this).val() == jQuery(this).attr("title"))
		{
			jQuery(this).val('');
			jQuery(this).css("color", "#000000");
		}
	});
	// Set titles again on blur
	jQuery(".hintbox").blur(function()
	{
		if (jQuery(this).val() == '')
		{
			jQuery(this).val(jQuery(this).attr("title"));
			jQuery(this).css("color", "#8a8989");
		}
	});
}

// Calendar for fields which need it
function setCalendars(selector)
{
	jQuery(selector).datepicker({ 
			dateFormat: "dd.mm.yy",
			firstDay: 1,
			showMonthAfterYear: false,
			yearSuffix: 'г.',
			nextText: 'Следващ месец',
			prevText: 'Предишен месец',
			dayNamesMin: [
				'Нд', 
				'Пн', 
				'Вт', 
				'Ср', 
				'Чт', 
				'Пт', 
				'Сб'
			],
			monthNames: [
				'Януари',
				'Февруари',
				'Март',
				'Април',
				'Май',
				'Юни',
				'Юли',
				'Август',
				'Септември',
				'Октомври',
				'Ноември',
				'Декември'
			]
		});
	jQuery(selector).attr("maxlength", 10);
}

function setRequired()
{
	jQuery("input.required, select.required").each(function()
	{
		if (!jQuery(this).hasClass("requiredFlag"))
		{
			jQuery(this).addClass("requiredFlag");
			jQuery(this).after('<span class="requiredMark" title="Задължително поле">*</span>');
		}
	});
}


function goToByScroll( id )
{
    $('html,body').animate( { scrollTop: $(id).offset().top - 20 }, 'fast' );
}

function goTop()
{
    $('html,body').stop().animate( { scrollTop: 0 }, 1000, 'swing' );
}

function addAlert(selector, warning, alertType)
{
	var str = '<div class="alert alert-' + alertType + ' alert-dismissable">';
	str += '<button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button>';
	str += warning;
	str += '</div>';
	jQuery(selector).prepend(str);
}

function AddAllertAndGo(selector, warning, alertType)
{
	addAlert(selector, warning, alertType);
	goToByScroll( selector );
}

function clearAlerts(selector)
{
	jQuery(selector).find(".alert").remove();
}

function validate1(selector)
{
	clearAlerts(selector);
	jQuery(selector).find(".has-error").removeClass("has-error");
	
	// Check required inputboxes
	var inputs = jQuery(selector).find('.required:visible input[type="text"], .required:visible input[type="number"], .required:visible textarea');
	for (var i = inputs.length - 1; i >= 0; i--)
	{
		value = jQuery.trim(jQuery(inputs[i]).val());
		
		if (value == '')
		{
			if (!jQuery(inputs[i]).parents(".required").hasClass("has-error"))
			{
				jQuery(inputs[i]).parents(".required").addClass("has-error");
				//addAlert(jQuery(inputs[i]).parents(".required"), '<strong>' + jQuery(inputs[i]).parents(".required").find("label:first").html() + '</strong> е задължително поле.', 'danger');
			}
		}
	}
	
	// Check required selectboxes
	var inputs = jQuery(selector).find(".required:visible select");
	for (var i = inputs.length - 1; i >= 0; i--)
	{
		value = jQuery.trim(jQuery(inputs[i]).val());
		if ((value == '') || (value == 0))
		{
			if (!jQuery(inputs[i]).parents(".required").hasClass("has-error"))
			{
				jQuery(inputs[i]).parents(".required").addClass("has-error");
				//addAlert(jQuery(inputs[i]).parents(".required"), '<strong>' + jQuery(inputs[i]).parents(".required").find("label:first").html() + '</strong> е задължително поле.', 'danger');
			}
		}
	}
	
	// Check integers
	var inputs = jQuery(selector).find("input.int");
	var patt1 = new RegExp(/\d*/);
	for (var i = 0; i < inputs.length; i++)
	{
		value = jQuery(inputs[i]).val();
		if ((value != '') && (patt1.exec(value) != value))
		{
			if (!jQuery(inputs[i]).parent().hasClass("has-error"))
			{
				jQuery(inputs[i]).parent().addClass("has-error");
				addAlert(jQuery(inputs[i]).parent(), 'Въведете <strong>цяло число</string>!', 'danger');
			}
		}
	}
	
	return !jQuery(selector).find(".has-error:visible").length;
}

function validate(selector)
{
	var value = "";
	// Check dates
	var inputs = jQuery(selector).find("input.date");
	var patt1 = new RegExp(/[0123]\d\.[01]\d\.\d{4}/);
	for (var i = 0; i < inputs.length; i++)
	{
		value = jQuery(inputs[i]).val();
		if ((value != '') && (patt1.exec(value) != value))
		{
			jQuery(inputs[i]).addClass("invalid");
		}
		else
		{
			jQuery(inputs[i]).removeClass("invalid");
		}
	}
	// Check datetimes
	var inputs = jQuery(selector).find("input.datetime");
	var patt1 = new RegExp(/[0123]\d\.[01]\d\.\d{4} [012]\d\:[012345]\d\:[012345]\d/);
	for (var i = 0; i < inputs.length; i++)
	{
		value = jQuery(inputs[i]).val();
		if ((value != '') && (patt1.exec(value) != value))
		{
			jQuery(inputs[i]).addClass("invalid");
		}
		else
		{
			jQuery(inputs[i]).removeClass("invalid");
		}
	}
	// Check times
	var inputs = jQuery(selector).find("input.time");
	var patt1 = new RegExp(/[012]\d\:[012345]\d/);
	for (var i = 0; i < inputs.length; i++)
	{
		value = jQuery(inputs[i]).val();
		if ((value != '') && (patt1.exec(value) != value))
		{
			jQuery(inputs[i]).addClass("invalid");
		}
		else
		{
			jQuery(inputs[i]).removeClass("invalid");
		}
	}
	
	var inputs = jQuery(selector).find("input.time1");
	var patt1 = new RegExp(/00\:[012345]\d/);
	for (var i = 0; i < inputs.length; i++)
	{
		value = jQuery(inputs[i]).val();
		if ((value != '') && (patt1.exec(value) != value))
		{
			jQuery(inputs[i]).addClass("invalid");
		}
		else
		{
			jQuery(inputs[i]).removeClass("invalid");
		}
	}
	// Check integers
	var inputs = jQuery(selector).find("input.int");
	var patt1 = new RegExp(/\d*/);
	for (var i = 0; i < inputs.length; i++)
	{
		value = jQuery(inputs[i]).val();
		if ((value != '') && (patt1.exec(value) != value))
		{
			jQuery(inputs[i]).addClass("invalid");
		}
		else
		{
			jQuery(inputs[i]).removeClass("invalid");
		}
	}
	// Check real
	var inputs = jQuery(selector).find("input.real");
	var patt1 = new RegExp(/\-?\d*\.?\d*/);
	for (var i = 0; i < inputs.length; i++)
	{
		value = jQuery(inputs[i]).val();
		if ((value != '') && (patt1.exec(value) != value))
		{
			jQuery(inputs[i]).addClass("invalid");
		}
		else
		{
			jQuery(inputs[i]).removeClass("invalid");
		}
	}
	// Check device address
	var inputs = jQuery(selector).find("input.address");
	var patt1 = new RegExp(/0[0-9a-fA-F][0-9a-fA-F][0-9a-fA-F]/);
	for (var i = 0; i < inputs.length; i++)
	{
		value = jQuery(inputs[i]).val();
		if ((value != '') && (patt1.exec(value) != value))
		{
			jQuery(inputs[i]).addClass("invalid");
		}
		else
		{
			jQuery(inputs[i]).removeClass("invalid");
		}
	}
	// Check required inputboxes
	var inputs = jQuery(selector).find("input.required:visible");
	for (var i = 0; i < inputs.length; i++)
	{
		value = jQuery.trim(jQuery(inputs[i]).val());
		if (value == '')
		{
			jQuery(inputs[i]).addClass("invalid1");
		}
		else
		{
			jQuery(inputs[i]).removeClass("invalid1");
		}
	}
	// Check required selectboxes
	var inputs = jQuery(selector).find("select.required");
	for (var i = 0; i < inputs.length; i++)
	{
		value = jQuery.trim(jQuery(inputs[i]).val());
		if (value == '')
		{
			jQuery(inputs[i]).addClass("invalid1");
			jQuery(inputs[i]).children(":selected").addClass("invalid");
		}
		else
		{
			jQuery(inputs[i]).removeClass("invalid1");
			jQuery(inputs[i]).children().removeClass("invalid");
		}
	}
	
	return !(jQuery(selector).find(".invalid:visible").length + jQuery(selector).find(".invalid1:visible").length);
}

function initializeGoogleMapsAPI() 
{
	if (typeof initializeGoogleMapsAPI.map == "undefined")
	{
		var centerLocation = new google.maps.LatLng(42.720299, 23.274128);
		var myOptions = {
			zoom: 14,
			minZoom: 12,
			maxZoom: 17,
			panControl: true,
			zoomControl: true,
			mapTypeControl: false,
			scaleControl: true,
			streetViewControl: false,
			overviewMapControl: false,
			center: centerLocation,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			styles: [{
				featureType: "poi",
				elementType: "labels",
				stylers: [{
					visibility: "off"
				}]
			}]
		}
		initializeGoogleMapsAPI.map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
		
		var home = new google.maps.Marker({
			position: centerLocation,
			draggable: false,
			"map": initializeGoogleMapsAPI.map
		});
	}
	return initializeGoogleMapsAPI.map;
}