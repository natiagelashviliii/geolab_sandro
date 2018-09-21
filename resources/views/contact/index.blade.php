@extends ('index')

@section('content')


<p>contact info</p>
<a href="mailto:{{ $Contact->email }}">{{ $Contact->email }}</a>
<a href="tel:{{ $Contact->phone }}">{{ $Contact->phone }}</a>


@endsection