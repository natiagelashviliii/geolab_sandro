@extends('admin/index')
       
@section('section')

<div class="row works-add-content pd-all-40">
	<form action="{{ url('admin/works/addwork') }}" class="file-form" method="post" onsubmit="return admin.submitForm(this);" enctype="multipart/form-data">
		<div class="input-field col s5">
			<select name="CatID">
			  @foreach($data['cats'] as $key => $value)
			  <option value="{{ $value->id }}" @if($data['work']->cat_id == $value->id) selected @endif>{{ $value->title }}</option>
			  @endforeach
			</select>
		</div>
		<div class="input-field col s12">
			<input id="Title" name="Title" type="text" data-error="*" value="{{ $data['work']->title }}">
			<label class="active" for="Title">TItle</label>
		</div>
		<div class="input-field col s12">
	    	<textarea id="Description" name="Description" class="materialize-textarea height-110" rows="5" data-error="*">{{ $data['work']->description }}</textarea>
	    	<label for="Description">Description</label>
	    </div>

		<div class="input-field col s12">
        	<i class="material-icons prefix">textsms</i>
        	<div id="chip-data-cont" class="chips chips-autocomplete"></div>
        </div>
	    <!-- <div class="clearfix m-top-5">
            <ul class="clearfix files-list files-list-news" data-types="[jpg, png, jpeg, gif, svg]" data-max-files="1"
            data-name="Photos" data-index="0">
       			@if($data['work']->file)
					<li data-file="{{ asset('storage/works') . '/' . $data['work']->file }}">
						<img src="{{ asset('storage/works') . '/' . $data['work']->file }}">
						<i class="fa fa-times" aria-hidden="true" onclick="_files.removeFile(this);" title="Delete"></i>
					</li>
				@endif
                <li class="files-list-new-file shadow-inset" onclick="_files.selectFiles(this);" style="@if($data['work']->file) {{'display:none;'}} @endif">
                    <span>
                    	<i class="fa fa-camera-retro" aria-hidden="true"></i>
                    </span>
                    <p>Upload File</p>
                </li>
            </ul>
        </div> -->
        <div class="input-field col s12">
        	<div class="file-loading">
                <input id="work-file" type="file" class="file" name="File">
            </div>
        </div>
        <div class="input-field col s12 right-align">
        	<!-- @if($data['work']->file)
		    	<input type="hidden" class="file-names" data-index="0" name="Photos" value="{{ $data['work']->file }}">
		    @endif -->
	    	<input type="hidden" name="Tags" id="Tags" value="">
	    	<input type="hidden" name="WorkID" value="{{ $data['work']->id }}">
	    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	    	<button class="waves-effect waves-light btn-small" type="submit">Save</button>
	    </div>
	</form>
	<!-- <form class="j-form files-list-form" name="files-list-form" data-index="0" method="post" enctype="multipart/form-data"
		 action="{{ url('file/uploadphoto/') }}" data-name="Photos">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	    <input type="hidden" name="UploadedFiles" class="files-list-uploaded-files" value="0">
	    <input type="hidden" name="PostGroup" value="works">
	    <input type="file" name="File" class="files-list-file" onchange="_files.uploadFiles(this);">
	</form> -->
</div>        

@endsection

@section('sub_footer')
<script type="text/javascript">
	$(document).ready(function(){
		$('.chips-autocomplete').chips({
			data: {!! $data['usedTags'] !!},
			autocompleteOptions: {
			  data: {!! $data['tags'] !!},
			  limit: 7,
			  minLength: 1
			},
			onChipAdd: function() {
				generateChips();
			}
		});
		function generateChips() {
			let chipsDataObj = M.Chips.getInstance($('.chips')).chipsData;
			let chipsArray = chipsDataObj.map(function(v, i){
				return v.tag;
			});
			$('#Tags').val(chipsArray);
		}
		generateChips();
	});
	var url1 = "{{ asset('storage/works') . '/' . $data['work']->file }}";
	var $uploadFile = $("#work-file");
	$uploadFile.fileinput({
		initialPreview: [url1],
        initialPreviewAsData: true,
        initialPreviewConfig: [
            {caption: "{{$data['work']->file}}", filename: "{{$data['work']->file}}", downloadUrl: url1, size: 930321, width: "120px", key: 1},
        ],
        overwriteInitial: true,

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