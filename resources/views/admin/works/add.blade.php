@extends('admin/index')

@section('sub_header')
<link rel="stylesheet" href="{{ asset('css/plugins/fileinput.css') }}">
<link rel="stylesheet" href="{{ asset('css/plugins/file-theme.css') }}">
@endsection
       
@section('section')

<div class="row works-add-content pd-all-40">
	<form action="{{ url('admin/works/addwork') }}" class="file-form" method="post" onsubmit="return admin.submitForm(this);" enctype="multipart/form-data">
		<div class="input-field col s5">
			<select name="CatID">
			  @foreach($data['cats'] as $key => $value)
			  <option value="{{ $value->id }}">{{ $value->title }}</option>
			  @endforeach
			</select>
		</div>
		<div class="input-field col s12">
			<input id="Title" name="Title" type="text" data-error="*">
			<label class="active" for="Title">Title</label>
		</div>
		<div class="input-field col s12">
	    	<textarea id="Description" name="Description" class="materialize-textarea height-110" rows="5" data-error="*"></textarea>
	    	<label for="Description">Description</label>
	    </div>
		<div class="input-field col s12">
        	<i class="material-icons prefix">textsms</i>
        	<div id="chip-data-cont" class="chips chips-autocomplete"></div>
        </div>
        <div class="input-field col s12">
        	<div class="file-loading">
                <input id="file-1" type="file" class="file" name="File">
            </div>
        </div>
        <div class="input-field col s12 right-align">
        	<!-- <input type="hidden" name="Files" value="" id="Files"> -->
	    	<input type="hidden" name="Tags" id="Tags" value="">
	    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	    	<button class="waves-effect waves-light btn-small" type="submit">Save</button>
	    </div>

	</form>
</div>        

@endsection

@section('sub_footer')
<script src="{{ asset('js/plugins/fileinput.js') }}"></script>
<script src="{{ asset('js/plugins/files-sortable.js') }}"></script>
<script src="{{ asset('js/plugins/file-theme.js') }}"></script>
<script src="{{ asset('js/plugins/files-fa-theme.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.chips-autocomplete').chips({
			autocompleteOptions: {
			  data: {!! $data['tags'] !!},
			  limit: 7,
			  minLength: 1
			},
			onChipAdd: function() {
				let chipsDataObj = M.Chips.getInstance($('.chips')).chipsData;
				let chipsArray = chipsDataObj.map(function(v, i){
					return v.tag;
				});
				$('#Tags').val(chipsArray);
			}
		});

	});
	var $el1 = $("#file-1");
		$el1.fileinput({
        	theme: 'fa',
	        uploadUrl: "{!! url('admin/works/uploadImage') !!}",
	        allowedFileExtensions: ['jpg', 'png', 'gif', 'mp4'],
	        overwriteInitial: false,
	        showUpload: false,
	        showRemove: false,
	        showClose: false,
	        maxFileSize: 10000,
	        minFileCount: 1,
    		maxFileCount: 5,
    		showUploadedThumbs: true,
	        fileActionSettings : {
	        	showZoom: false,
	        	showUpload: false,
				showRemove: true,
				showDrag: true,
				indicatorNew: "",
				indicatorSuccess: "",
				indicatorError: ""
			},
	    })
	 //    .on("filebatchselected", function(event, files) {
  //   		var files = $('#file-1').fileinput('getFileStack');
  //   		let fileNames = [];
  //   		fileNames = files.map(function(v, i) {
  //   			return v.name;
  //   		});
  //   		console.log($('#file-1').val());

  //   		$('#Files').val($('#file-1').val());
		// });
		// $('#file-1').on('fileremoved', function(event, id, index) {
		//     var files = $('#file-1').fileinput('getFileStack');
  //   		let fileNames = [];
  //   		fileNames = files.map(function(v, i) {
  //   			return v.name;
  //   		});

  //   		$('#Files').val(fileNames.join(','));
		// });
</script>
@endsection