@extends('admin/index')
       
@section('section')

<div class="row about-content">
	<form action="{{ url('admin/user/edit') }}" method="post" onsubmit="return admin.submitForm(this);">
		<div class="input-field col s12">
			<input id="Name" name="Name" type="text" data-error="*" value="{{ $Data->name }}">
			<label class="active" for="Name">Name</label>
		</div>
		<div class="input-field col s12">
			<input id="Email" name="Email" type="text" data-error="*" value="{{ $Data->email }}" onfocusout="return CheckEmail(this)">
			<label class="active" for="Email">Email</label>
		</div>

	    <div class="input-field col s12 right-align">
	    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	    	<button class="waves-effect waves-light btn-small btn" type="submit">Update</button>
	    </div>
	</form>
	
	<form action="{{ url('admin/user/changePassword') }}" method="post" onsubmit="return admin.submitForm(this);">
		@if(isset($messages) && $messages )
		<div class="password-error-messages @if($status) success @endif">
			<i class="material-icons">@if(!$status) error_outline @else check @endif</i>
			{{ $messages }}
		</div>
		@endif
		<div class="input-field col s12">
			<input id="Old_Password" name="OldPassword" type="text" data-error="*">
			<label class="active" for="Old_Password">Old Password</label>
		</div>
		<div class="input-field col s12">
			<input id="New_Password" name="NewPassword" type="text" data-error="*">
			<label class="active" for="New_Password">New Password</label>
		</div>
		<div class="input-field col s12">
			<input id="Repeat_Password" name="RepeatPassword" type="text" data-error="*">
			<label class="active" for="Repeat_Password">Repeat Password</label>
		</div>
	    <div class="input-field col s12 right-align">
	    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	    	<button class="waves-effect waves-light btn-small btn" type="submit">Update Password</button>
	    </div>
	</form>
</div>        

@endsection