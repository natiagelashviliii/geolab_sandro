@extends('admin/index')
       
@section('section')

<div class="row works-add-content pd-all-40">
	<form action="{{ url('admin/works/editwork') }}" class="file-form" method="post" onsubmit="return admin.submitForm(this);" enctype="multipart/form-data">
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
        <div class="input-field col s12">
        	<div class="file-loading">
                <input id="work-file" type="file" class="file" name="File">
            </div>
        </div>
        <div class="input-field col s12 right-align">
	    	<input type="hidden" name="Tags" id="Tags" value="">
	    	<input type="hidden" name="WorkID" value="{{ $data['work']->id }}">
	    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	    	<button class="waves-effect waves-light btn-small" type="submit">Save</button>
	    </div>
	</form>
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
        initialPreviewFileType: "image",
        initialPreviewConfig: [
            {caption: "{{$data['work']->file}}", filename: "{{$data['work']->file}}", downloadUrl: url1, key:0},
        ],
        overwriteInitial: true,
        deleteUrl: '{{ url("admin/works/deletephoto/") }}',
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
			showDrag: false,
			indicatorNew: "",
			indicatorSuccess: "",
			indicatorError: ""
		},
    });
</script>
@endsection