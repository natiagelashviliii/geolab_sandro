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