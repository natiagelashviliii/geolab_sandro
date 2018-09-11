@extends ('index')

@section('content')

<p>navigation</p>
<a href="{{ url('works') }}">works</a>
<a href="{{ url('about') }}">about</a>
<a href="{{ url('contact') }}">contact</a>

<br>
<br>
<br>

<p>About Data</p>
<img src="{{ asset('storage/about') . '/' . $About->image }}" alt="{{ $About->image }}" style="width: 400px">
<h5>{{ $About->title }}</h5>
<p>{{ $About->description }}</p>


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