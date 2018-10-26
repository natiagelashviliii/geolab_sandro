@extends ('index')

@section('content')

<!-- content start -->

<section class="container">
	<div class="about-content row">
		<div class="col l8 m8 s10 offset-l2 offset-m2 offset-s1">
			<div class="animation about hidden">
				<?php include '../public/animations/software-souls/demo.php' ?>
			</div>
			<div class="title hidden">
				{{ $About->title }}
			</div>
			<div class="text hidden">
				{{ $About->description }}
			</div>
		</div>
	</div>
</section>

<!-- content end -->


@endsection