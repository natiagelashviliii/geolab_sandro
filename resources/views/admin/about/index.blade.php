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
      		<!-- <div class="btn">
	        	<span>File</span>
	        	<input type="file" name="Image">
	        </div> -->
	      	<!-- <div class="file-path-wrapper">
	        	<input class="file-path validate" type="text" data-error="*" name="UplImage" value="{{ $Data->image }}">
	      	</div> -->
	    	<!-- <div class="about-img">
	    		@if ($Data->image)
	    			<img class="slider-form-img" src="{{ asset('storage/about/')  }}/{{ $Data->image }}">
	    		@endif
	    	</div> -->
	    	<div class="clearfix m-top-5">
	            <ul class="clearfix files-list files-list-news" data-types="[jpg, png, jpeg, gif]" data-max-files="1"
	            data-name="Photos" data-index="0">
	                @if($Data->image)
						<li data-file="{{ asset('storage/about') . '/' . $Data->image }}">
							<img src="{{ asset('storage/about') . '/' . $Data->image }}">
							<i class="fa fa-times" aria-hidden="true" onclick="_files.removeFile(this);" title="Delete"></i>
						</li>
					@endif
	                <li class="files-list-new-file shadow-inset" onclick="_files.selectFiles(this);" style="@if($Data->image) {{'display:none;'}} @endif">
	                    <span>
	                    	<i class="fa fa-camera-retro" aria-hidden="true"></i>
	                    </span>
	                    <p>Upload File</p>
	                </li>
	            </ul>
	        </div>
	    </div>
	    <div class="input-field col s12 right-align">
	    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	    	<button class="waves-effect waves-light btn-small" type="submit">Update</button>
	    </div>
	    @if($Data->image)
	    	<input type="hidden" class="file-names" data-index="0" name="Photos" value="{{ $Data->image }}">
	    @endif
	</form>
	<form class="j-form files-list-form" name="files-list-form" data-index="0" method="post" enctype="multipart/form-data"
		 action="{{ url('file/uploadphoto/') }}" data-name="Photos">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	    <input type="hidden" name="UploadedFiles" class="files-list-uploaded-files" value="0">
	    <input type="hidden" name="PostGroup" value="about">
	    <input type="file" name="Image" class="files-list-file" onchange="_files.uploadFiles(this);">
	</form>
</div>        

@endsection