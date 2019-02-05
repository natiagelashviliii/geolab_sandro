@extends ('index')

@section('content')

<!-- content start -->

<section class="">
	<div class="row">
		<div class="animation hidden col l6 m12 s12">
			<?php 
				$randNum = rand(0,1);
				if($randNum == 0){
					include '../public/animations/life-in-the-bottle/demo.php';
				} else {
					include '../public/animations/life-in-the-hand/demo.php';
				}
			 ?>
		</div>
		<div class="col l6 m12 s12 hodden">
			<div class="main-text">
				<div class="contact-text hidden">
					<span>Contact</span>
					<a href="mailto:{{ $Contact->email }}">{{ $Contact->email }}</a>
					<a href="tel:{{ $Contact->phone }}">{{ $Contact->phone }}</a>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- content end -->

@endsection