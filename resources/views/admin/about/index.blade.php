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
	    <div class="input-field col s12 right-align">
	    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	    	<button class="waves-effect waves-light btn-small btn" type="submit">Update</button>
	    </div>
	</form>
</div>        

@endsection

@section('sub_footer')

@endsection