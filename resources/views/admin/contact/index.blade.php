@extends('admin/index')
       
@section('section')

<div class="row about-content">
	<form action="{{ url('admin/contact/edit') }}" method="post" onsubmit="return admin.submitForm(this);">
		<div class="input-field col s12">
			<input id="Email" name="Email" type="text" data-error="*" value="{{ $Data->email }}" onfocusout="return CheckEmail(this)">
			<label class="active" for="Email">Email</label>
		</div>
		<div class="input-field col s12">
			<input id="Phone" name="Phone" type="text" data-error="*" value="{{ $Data->phone }}" onkeydown="validate(event, 'int');">
			<label class="active" for="Phone">Phone</label>
		</div>

		@foreach (config('constants.socials') as $SocKey => $Soc)
			<div class="input-field col s12 contact-socials">
				{!! config('constants.socialIcons')[$SocKey] !!}
		        <input id="Social-{{ $SocKey }}" type="text" name="Socials[]" data-error="*" value="{{ $Socials[$SocKey] }}">
		        <label for="Social-{{ $SocKey }}">{{ $Soc }}</label>
			</div>
		@endforeach

	    <div class="input-field col s12 right-align">
	    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	    	<button class="waves-effect waves-light btn-small" type="submit">Update</button>
	    </div>
	</form>
</div>        

@endsection