@extends ('index')

@section('content')

<p>About Data</p>
<img src="{{ asset('storage/about') . '/' . $About->image }}" alt="{{ $About->image }}" style="width: 400px">
<h5>{{ $About->title }}</h5>
<p>{{ $About->description }}</p>



@endsection