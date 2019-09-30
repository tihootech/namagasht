$(document).ready(function () {

	//initializers
	// $('[title]').tooltip();
	$('[data-toggle=popover]').popover();
	$('[data-popover=popover]').popover();
	$('.pdp').persianDatepicker();

	$( ".choices-sortable" ).sortable({
		out: function( event, ui ) {
			$('.choices-sortable > .clone-row').each(function (index) {
				$(this).find('.increment').html(index+1);
			});
		}
	});

	$( ".periority-display").sortable({
		out: function( event, ui ) {
			$('.periority-display > p').each(function (index) {
				$(this).find('span').html(index+1);
			});
		}
	});

	$( "#questions").sortable({
		out: function( event, ui ) {
			var base = $('base').attr('href');
			var formId = $('#questions').data('form-id');
			var data = [];
			$('#questions > .white-card').each(function (index) {
				$(this).find('.question-position').html(index+1);
				data.push($(this).data('question-id'));
			});

			data = Object.assign({}, data);
			$.get({
				url: base+'/form/question_positions/'+formId,
				data: data,
				success: function () {
					$('#q-orders-message').fadeIn(500).fadeOut(500).fadeIn(500).delay(3000).fadeOut(500);
				}
			});
		}
	});

	// flash message
	$('.flash-message').not('.hidden').fadeOut(500).fadeIn(500).fadeOut(500).fadeIn(500).delay(3000).fadeOut(500);
	$('.flash-message > i').click(function () {
		$(this).parents('.flash-message').hide();
	});

	// file display
	$("#file").change(function () {
		displayImage(this);
	});

});

$(document).on('click','.preview-theme',function () {
	var theme = $(this).data('theme');
	$('.preview-theme').removeClass('active');
	$(this).addClass('active');
	$('#form-theme').val(theme);
	var iframe = $('iframe.preview-iframe').contents();
	iframe.find('.theme-container').removeClass().addClass('theme-container theme-'+theme);
	iframe.find('#form-theme-hidden-input').val(theme);
});

$(document).on('click','.action-li',function () {
	$(this).children('i').toggleClass('fa-chevron-up fa-chevron-down');
});

$(document).on('focus','.porsline-select > input',function () {
	$('.porsline-select-dropdown').fadeIn('fast');
});

$(document).on('blur','.porsline-select > input',function () {
	$('.porsline-select-dropdown').fadeOut('fast');
});

$(document).on('input','.porsline-select > input',function () {
	$('#toggle-alphabet').is(':checked') ? displaySelectList('alphabetic') : displaySelectList('regular');
});

$(document).on('click','.porsline-select-dropdown > p',function () {
	$('.fa-check.selected').remove();
	var content = $(this).text();
	$(this).append('<i class="fa fa-check float-left m-1 selected"></i>');
	$('.porsline-select > input').val(content);
});

$(document).on('input','#preview-input',function () {
	if($(this).val()){
		$('#preview-confirm').show();
	}else {
		$('#preview-confirm').hide();
	}
});

$(document).on('input','.periorities',function () {
	$('.periority-display').html(null);
	$('.periorities').each(function (index) {
		index++;
		var value = $(this).val();
		if (value) {
			$('.periority-display').append('<p> <i class="fa fa-exchange"></i> <span>'+index+'</span> '+value+' </p>');
		}
	});
});

$(document).on('click','#display-choices > p',function () {
	var multiple = $('#display-choices').data('multiple');
	var target = $('#display-choices').siblings('input[name=answer]');
	var value = $(this).data('value');
	if (multiple) {
		$(this).children('i').toggle();
		var fval = [];
		$('.fa-check:visible').each(function () {
			fval.push($(this).parents('p').data('value'));
		});
		target.val(fval.join('&&&'));
	}else {
		$('#display-choices > p > i').hide();
		$(this).children('i').show();
		target.val(value);
	}
});

$(document).on('input','#enter-choices',function () {
	$(this).siblings('small').show();
	$('#toggle-alphabet').is(':checked') ? displaySelectList('alphabetic') : displaySelectList('regular');
	$('.porsline-select-dropdown').show();
});

$(document).on('click','.display-range > span',function () {
	$('.display-range > span').removeClass('selected');
	$('#range-answer').val($(this).data('value'));
	$(this).addClass('selected').fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);
});

$(document).on('mouseenter','.porsline-degree > p',function () {
	var icon = $('.porsline-degree').attr('data-icon');
	var index = $(this).attr('data-index');
	$('.porsline-degree > p').slice(0,index).children('i:not(.selected)').addClass('fa-'+icon).removeClass('fa-'+icon+'-o');
});

$(document).on('mouseleave','.porsline-degree > p',function () {
	var icon = $('.porsline-degree').attr('data-icon');
	var index = $(this).attr('data-index');
	$('.porsline-degree > p').slice(0,index).children('i:not(.selected)').addClass('fa-'+icon+'-o').removeClass('fa-'+icon);
});

$(document).on('click','.porsline-degree > p',function () {
	var icon = $('.porsline-degree').attr('data-icon');
	var index = $(this).attr('data-index');
	$('#levelize-answer').val(index);
	$('.porsline-degree i').removeClass('selected fa-'+icon).addClass('fa-'+icon+'-o');
	$('.porsline-degree > p').slice(0,index).children('i').addClass('selected fa-'+icon).removeClass('fa-'+icon+'-o');
});

$(document).on('input','#range,#toggle-zero_based',function () {
	var zeroBased = $('#toggle-zero_based').is(':checked');
	$('.display-range').html(null);
	var value = parseInt($('#range').val());
	value%2==0 ? $('.range-label-center').css('visibility', 'hidden') : $('.range-label-center').css('visibility', 'visible');
	for (var i = 0; i < value; i++) {
		number = zeroBased ? i : i+1;
		if (i==0 || i==value-1 || (value%2!=0 && i==(value-1)/2) ) {
			$('.display-range').append('<span class="label">'+number+'</span>')
		}else {
			$('.display-range').append('<span>'+number+'</span>')
		}
	}
});

$(document).on('input','#shape,#degree',function () {
	$('.porsline-degree').html(null);
	var count = parseInt($('#degree').val());
	var icon = $('#shape').val();
	for (var i = 1; i <= count; i++) {
		$('.porsline-degree').append('<p data-index="'+i+'"> <i class="fa fa-'+icon+'-o"></i> <span>'+i+'</span> </p>');
	}
});

$(document).on('input','#form-maker',function () {

	$('#preview').show();

	$('[data-yield=title]').html($('#title').val());
	$('[data-yield=description]').html($('#description').val());
	$('[data-yield=btn]').html($('#btn').val());
	$('[data-yield=question]').html($('#question').val());
	$('[data-yield=btn]').html($('#btn').val());

	$('#display-choices').attr('data-vertical', $('#toggle-vertical').is(':checked') );
	$('#display-choices').attr('data-multiple', $('#toggle-multiple').is(':checked') );
	$('.porsline-degree').attr('data-icon', $('#shape').val() );

	$('#toggle-has_button').is(':checked') ? $('#display-btn').show() : $('#display-btn').hide();
	$('#toggle-has_description').is(':checked') ? $('[data-yield=description]').show() : $('[data-yield=description]').hide();
	$('#toggle-has_file').is(':checked') ? $('[data-yield=image]').show() : $('[data-yield=image]').hide();
	$('#toggle-alphabet').is(':checked') ? displaySelectList('alphabetic') : displaySelectList('regular');
	$('#toggle-required').is(':checked') ? $('[data-yield=title]').append('<i class="fa fa-asterisk text-danger"></i>') : $('[data-yield=title] > i').remove();

	$('.range-label-left').html($('#left').val() ? $('#left').val() : $('.display-range > span').last().text());
	$('.range-label-center').html($('#center').val());
	$('.range-label-right').html($('#right').val() ? $('#right').val() : $('.display-range > span').first().text());

});

$(document).on('input','.custom-range',function () {
	var value = $(this).val();
	$('#range-value').html(value);
	if(value%2 == 0) {
		$('#center').attr('disabled','disabled');
	}else {
		$('#center').removeAttr('disabled');
	}
});

$(document).on('focus','.range-tag',function () {
	$('.range-tag-wrapper').removeClass('w-50').addClass('w-25');
	$(this).parents('.range-tag-wrapper').removeClass('w-25').addClass('w-50');
});

$(document).on('click', '[data-clone-action]', function () {
	var action = $(this).data('clone-action');
	var target = $(this).parents('#clone-container');
	var min = target.data('min') ? target.data('min') : 2;

	if (action == 'clone') {
		var content = $(this).parents('.clone-row').clone();
		content.attr('data-index', $('.clone-row').length + 1)
		content.find('input').val(null);
		$('#unclone-error').hide();
		target.append(content);
	}

	if (action == 'unclone') {
		var count = target.find('.clone-row').length;
		var index = $(this).parents('.clone-row').data('index');
		if (count > min) {
			$(this).parents('.clone-row').remove();
			$('[data-index='+index+']').remove();
		}else {
			$('#unclone-error').slideDown();
		}
	}

	// check increment numbers
	$('.clone-row').each(function (step) {
		$(this).find('.increment').html(step+1)
	});
});

$(document).on('click','[data-check]',function () {

	var content = $(this).data('check');
	var checked = $(this).attr('data-checked');

	if (content == 'all') {
		if (checked=='1') { // uncheck everything
			$('[data-check]').removeClass('fa-check-square-o').addClass('fa-square-o').attr('data-checked', '0');
		}else { // check everything
			$('[data-check]').removeClass('fa-square-o').addClass('fa-check-square-o').attr('data-checked', '1');
		}
	}else {
		$('[data-check=all]').removeClass('fa-check-square-o').addClass('fa-square-o').attr('data-checked', '0');
		if (checked=='1') { //unckeck this one
			$(this).removeClass('fa-check-square-o').addClass('fa-square-o').attr('data-checked', '0');
		}else { // check this one
			$(this).removeClass('fa-square-o').addClass('fa-check-square-o').attr('data-checked', '1');
		}
	}

	$('#checked-ids > .ids').remove();
	$('[data-checked=1]').each(function () {
		var id = $(this).data('check');
		if (id != 'all') {
			$('#checked-ids').append('<input type="hidden" class="ids" name="ids[]" value="'+id+'">');
		}
	});

});

function toggle(target) {
	$('#'+target).toggleClass('hidden');
}

function displayImage(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$('#preview [data-yield=image]').attr('src', e.target.result);
		}

		reader.readAsDataURL(input.files[0]);
	}
}

function equlizeWidthForChoices() {
	var vertical = $('#display-choices').attr('data-vertical');
	if (vertical=='true') {
		$('#display-choices > p').css('width', '100%');
	}else {
		var width = 0;
		$('#display-choices > p').each(function () {
			var thisWidth = $(this).width();
			width = thisWidth > width ? thisWidth : width;
		});
		// $('#display-choices > p').css('width', width+50);
	}
}

function displaySelectList(type) {

	$('.porsline-select-dropdown').html(null);
	var choices = $('#enter-choices').val() ? $('#enter-choices').val().split(/\n/) : [];
	var choices = choices.filter(function (el) {
		return el != '';
	});

	var phrase = $('.porsline-select > input').val();
	if (phrase != '') {
		var originalChoices = choices;
		choices = [];
		for (var i=0; i<originalChoices.length; i++) {
			if (originalChoices[i].match(phrase)) {
				choices.push(originalChoices[i]);
			}
		}
	}

	if (type=='alphabetic') {
		choices.sort();
	}

	if (choices.length > 0) {
		for (var i=0; i<choices.length; i++) {
			if (choices[i]) {
				$('.porsline-select-dropdown').append('<p>'+choices[i]+'</p>');
			}
		}
	}else {
		$('.porsline-select-dropdown').append('نتیجه‌ای یافت نشد');
	}
}

function redirect(url) {
	location.href = url;
}

function dragStart(event) {
  event.dataTransfer.setData("Text", event.target.id);
}

function allowDrop(event) {
  event.preventDefault();
}

function drop(event) {
  event.preventDefault();
  var data = event.dataTransfer.getData("Text");
  redirect(data)
}

$(document).on('click','.choice-file-upload',function () {
	$(this).siblings('input').trigger('click');
});

function copyToClipboard(text) {
	var $temp = $("<input>");
	$("body").append($temp);
	$temp.val(text).select();
	document.execCommand("copy");
	$temp.remove();
}

$(document).on('click','.copy-text',function () {
	$('.popover-body').html('<i class="fa fa-check text-success ml-1"></i>'+$(this).data('replacement-text'));
	copyToClipboard($(this).data('content-to-copy'));
});

$(document).on('mouseleave','.copy-text',function () {
	$(this).attr('data-content', $(this).data('initial-text'));
});

$(document).on('change','#user-file',function () {
	$(this).siblings('span').show();
	var target = $(this).siblings('label');
	target.css('border-color', '#77C475');
	target.find('#choose').hide();
	target.find('#change').show();
});

$(document).on('input','.display-choices-row .choices',function () {
	var index = $(this).parents('.display-choices-row').data('index');
	var target = $('#display-choices > p[data-index='+index+']');
	var value = $(this).val();
	if (target.length == 0) {
		$('#display-choices').append('<p data-index="'+index+'"> <span>'+index+'</span> <b>'+value+'</b> <i class="fa fa-check"></i> <img id="preview-'+index+'"> </p>');
	}else {
		target.find('b').html(value);
	}
	equlizeWidthForChoices();
});

function appendPreviewImg(input) {
	var index = $(input).parents('.display-choices-row').data('index');
	alert(index);
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			// $('#preview-'+index).attr('src', e.target.result);
		};

		reader.readAsDataURL(input.files[0]);
	}
}
