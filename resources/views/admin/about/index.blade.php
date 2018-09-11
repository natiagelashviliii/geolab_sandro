@extends('admin/index')
       
@section('section')

<div class="row about-content">
	<form action="{{ url('admin/about/edit') }}" class="file-form" method="post" onsubmit="return admin.submitForm(this);" enctype="multipart/form-data">
		<div class="input-field col s6">
			<input id="Title" name="Title" type="text" data-error="*" value="{{ $Data->title }}">
			<label class="active" for="Title">Title</label>
		</div>
		<div class="input-field col s12">
	    	<textarea id="Description" name="Description" class="materialize-textarea" rows="5" data-error="*">{{ $Data->description }}</textarea>
	    	<label for="Description">Description</label>
	    </div>
	    <div class="file-field input-field col s12 mg-tp-0">
        	<div class="file-loading">
                <input id="about-file" type="file" class="file" name="File">
            </div>
	    </div>
	    <div class="input-field col s12 right-align">
	    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	    	<button class="waves-effect waves-light btn-small" type="submit">Update</button>
	    </div>
	</form>
</div>        

@endsection

@section('sub_footer')
<script type="text/javascript">
	var url1 = "{{ asset('storage/about') . '/' . $Data->image }}";
	var $uploadFile = $("#about-file");
	$uploadFile.fileinput({
		@if($Data->image)
		 	initialPreview: [url1],
	        initialPreviewAsData: true,
	        initialPreviewFileType: "image",
	        initialPreviewConfig: [
	            {caption: "{{$Data->image}}", filename: "{{$Data->image}}", downloadUrl: url1, key:0},
	        ],
	        overwriteInitial: true,
	        deleteUrl: '{{ url("admin/works/deletephoto/")}}',
        @endif
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