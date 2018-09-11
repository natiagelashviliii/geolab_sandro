@extends ('index')

@section('content')

<p>navigation</p>
<a href="{{ url('works') }}">works</a>
<a href="{{ url('about') }}">about</a>
<a href="{{ url('contact') }}">contact</a>

<br>
<br>
<br>

<p>contact info</p>
<a href="mailto:{{ $Contact->email }}">{{ $Contact->email }}</a>
<a href="tel:{{ $Contact->phone }}">{{ $Contact->phone }}</a>

<br>
<br>
<br>

<p>socials</p>

@foreach (config('constants.socials') as $SocKey => $Soc)
	@if($Socials[$SocKey])
		<a href="{{ $Socials[$SocKey] }}" target="_blank">{{ $Soc }}</a>
	@endif
@endforeach

@endsection