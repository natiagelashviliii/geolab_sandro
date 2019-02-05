$(document).ready(function() {
	$('.resp-menu-btn').on('click', function(e) {
		e.preventDefault();
		if ($('.admin-header').hasClass('active')) {
			$('.admin-header').css({
			    "-webkit-transform":"translate(calc(-100% + 25px))",
			    "-ms-transform":"translate(calc(-100% + 25px))",
			    "transform":"translate(calc(-100% + 25px))"
	  		});
	  		$('.admin-header').removeClass('active');
		} else {
			$('.admin-header').css({
			    "-webkit-transform":"translate(0)",
			    "-ms-transform":"translate(0)",
			    "transform":"translate(0)"
	  		});
	  		$('.admin-header').addClass('active');
		}
	});

	$('.upload-file-btn').on('click', function(e) {
		$('.image-field').css('display', 'block');
		$('.video-field').css('display', 'none');
		checkFileUplBlock();
		e.preventDefault();
	});

	$('.upload-video-btn').on('click', function(e) {
		$('.image-field').css('display', 'none');
		$('.video-field').css('display', 'block');
		checkFileUplBlock();
		e.preventDefault();
	});

	function checkFileUplBlock() {
		if($('.image-field:visible').length > 0) {
			$('#Video').val('');
			$('.upload-video-btn').css('display', 'block');
			$('.upload-file-btn').css('display', 'none');
		}
		if($('.video-field:visible').length > 0) {
			$('#work-file').val('');
			$('.upload-video-btn').css('display', 'none');
			$('.upload-file-btn').css('display', 'block');
		}
	}
});


function CheckEmail(obj) {
	$('.input-error-text').remove();
	var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
	console.log($(obj).val().search(emailRegEx));
    if ($(obj).val().search(emailRegEx) == -1) {
        $(obj).closest('.input-field').append('<p class="input-error-text">Invaild Email Address</p>');
    } else {
    	$('.input-error-text').remove();
    	return (true);
    }
}

var admin = {
	submitForm: function(obj) {
		var error = false;
		var name = '';
		var parent;

		$('.input-error').remove();

		$.each($(obj).find(':text:visible, :file:visible, textarea:visible'), function() {
			parent = $(this).closest('.input-field');
			if ($(this).data('error') && $.trim($(this).val()) == '') {
				name = $(this).attr('id');
				parent.append('<p class="input-error" id="input-error-'+ name +'">' + $(this).data('error') + '</p>');
				error = true;
			} else {
				name = $(this).attr('id');
				parent.find('#input-error-'+ name).remove();
			}
		});
		
		return error ? false : true;
	},

	deleteCategory: function(CatID = null, obj) {
		if (!CatID) {
			return false;
		}
		
		jConfirm('Do you want to delete this category?', 'Message', function(e){
			if (e) {
				$.post('categories/delete', {'CatID': CatID, '_token': $('meta[name="csrf-token"]').attr('content')}, function(resp) {
					if (resp.success) {
						jAlert('Category was successfully deleted', 'Message', function() {
							$(obj).closest('li').remove();
						});
					}
				});
			} else{
				console.log('false');
			}
		});

		return false;
	}
}

works = {
	addLoader: function(obj) {
		$(obj).closest('.each-work').prepend('<div class="loading"></div>');
	},	
	removeLoader: function() {
		$('.loading').remove();
	},
	changeWorkStatus: function(WorkID = null, obj) {
		if (!WorkID) {
			return
		}

		let starStatus = ($(obj).find('i').text().trim() == 'star') ? 'star_border' : 'star' ;
		works.addLoader(obj);
		$.post('works/changeStatus', {'WorkID': WorkID, '_token': $('meta[name="csrf-token"]').attr('content')}, function(resp) {
			if (resp.success) {
				$(obj).find('i').text(starStatus);
				works.removeLoader();
			} else {
				jAlert('Problem while updating status!', 'Message', function() {
					
				});
			}
		});
	},

	deleteWork: function(WorkID, obj) {
		if (!WorkID) {
			return false;
		}
		
		works.addLoader(obj);
		jConfirm('Do you want to delete this work project?', 'Message', function(e){
			if (e) {
				$.post('works/delete', {'WorkID': WorkID, '_token': $('meta[name="csrf-token"]').attr('content')}, function(resp) {
					if (resp.success) {
						$(obj).closest('.each-work').remove();
						jAlert('Work project was successfully deleted', 'Message', function() {

						});
					}
				});
			} else{
				works.removeLoader();
				console.log('false');
			}
		});

		return false;
	}

}

