@extends ('index')

@section('content')

<!-- <img src="{{ asset('storage/about') . '/' . $About->image }}" alt="{{ $About->image }}" style="width: 400px"> -->
<section class="container">
	<div class="about-content row">
		<div class="col l8 m8 s10 offset-l2 offset-m2 offset-s1">
			<div class="title hidden">
				{{ $About->title }}
			</div>
			<div class="text hidden">
				{{ $About->description }}
			</div>
		</div>
	</div>
</section>



@endsection