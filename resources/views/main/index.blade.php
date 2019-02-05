@extends ('index')

@section('content')

<!-- content start -->

<section class="">
	<div class="row">
		<div class="animation hidden col l6 m12 s12">
			<?php 
				$randNum = rand(0,2);
				if($randNum == 0){
					include '../public/animations/life-in-the-bottle/demo.php';
				} elseif($randNum == 1) {
					include '../public/animations/software-souls/demo.php';
				} else {
					include '../public/animations/life-in-the-hand/demo.php';
				}
			 ?>
		</div>
		<div class="col l6 m12 s12">
			<div class="main-text">
				<div>
					<p class="hidden">panroboticum</p>
					<p class="hidden">soul of the computer inside the bottle</p>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- content end -->

@endsection