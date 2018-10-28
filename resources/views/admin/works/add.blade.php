@extends('admin/index')

@section('sub_header')

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
        <div class="input-field col s12 image-field">
        	<div class="file-loading">
                <input id="work-file" type="file" class="file" name="File">
            </div>
        </div>
	    <div class="input-field col s12 video-field">
			<input id="Video" name="Video" type="text">
			<label class="active" for="Video">Insert video url here</label>
		</div>
		<div class="input-field col s12">
			<button class="waves-effect waves-light btn upload-file-btn"><i class="material-icons left">image</i>Upload File</button>
			<button class="waves-effect waves-light btn upload-video-btn"><i class="material-icons left">video_library</i>Insert Video URL</button>
		</div>
        <div class="input-field col s12 right-align">
	    	<input type="hidden" name="Tags" id="Tags" value="">
	    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	    	<button class="waves-effect waves-light btn-small btn" type="submit">Save</button>
	    </div>
	</form>
</div>        

@endsection

@section('sub_footer')
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
	var $uploadFile = $("#work-file");
	$uploadFile.fileinput({
		theme: 'fa',
	    uploadUrl: "{!! url('admin/works/uploadImage') !!}",
	    allowedFileExtensions: ['jpg', 'png', 'gif', 'mp4'],
	    showUpload: false,
	    showRemove: false,
	    showClose: false,
	    maxFileSize: 10000,
		maxFileCount: 1,
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
	});
</script>
@endsection