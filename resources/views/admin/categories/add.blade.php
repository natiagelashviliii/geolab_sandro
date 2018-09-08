@extends('admin/index')
       
@section('section')

<div class="row categories-add-content pd-all-40">
	<form action="{{ url('admin/categories/addCategory') }}" method="post" onsubmit="return admin.submitForm(this);">
		<div class="input-field col s12">
			<input id="Title" name="Title" type="text" data-error="*">
			<label class="active" for="Title">Title</label>
		</div>
	    <div class="input-field col s12 right-align">
	    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	    	<button class="waves-effect waves-light btn-small" type="submit">Add</button>
	    </div>
	</form>
</div>        

@endsection