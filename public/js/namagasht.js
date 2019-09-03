$(document).ready(function () {
	$('[title]').tooltip();
	$('[data-toggle=popover]').popover();

	$("#file").change(function () {
		displayImage(this);
	});
});

$(document).on('input','#form-maker',function () {
	$('#preview').show();
	var type = $('#fragment-type').val();
	if (type == 'welcome_page') {
		$('#preview [data-yield=title]').html($('#title').val());
		$('#preview [data-yield=description]').html($('#description').val());
		$('#preview [data-yield=btn]').html($('#btn').val());
	}
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
	action = $(this).data('clone-action');

	if (action == 'clone') {
		var target = $(this).parents('#clone-container');
		var content = $(this).parents('.clone-row').clone();
		content.find('input').val(null);
		$('#unclone-error').hide();
		target.append(content);
	}

	if (action == 'unclone') {
		var count = $('.clone-row').length;
		if (count > 2) {
			$(this).parents('.clone-row').remove();
		}else {
			$('#unclone-error').slideDown();
		}
	}

	// check increment numbers
	$('.clone-row').each(function (step) {
		$(this).find('.increment').html(step+1)
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
