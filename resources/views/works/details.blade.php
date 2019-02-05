@extends ('index')

@section('content')

<!-- content start -->

<section class="container">
	<div class="works-content">
		<div class="popup-content illustrations-inner">
			<div class="popup-inside">
				<div class="row">
					<div class="col m7 s12 image-block">
						@if($Work->file)
						<div class="image" style="background-image: url({{ asset('storage/works') . '/' . $Work->file }})"></div>
						@elseif($Work->video)
						<iframe src="{{ $Work->video_embed }}" width="500" height="500" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
						@endif
					</div>
					<div class="col m5 s12">
						<div class="text">
							<div class="title">
								{{ $Work->title }}
							</div>
							<p class="tags">
								@if($Tags)
									@foreach($Tags as $key => $value)
									<a href="#">#{{ $value}}</a>
									@endforeach
								@endif
							</p>
							<p class="text-body">
								{{ $Work->description }}
							</p>
						</div>
						<div class="text-footer">
							<a href="" class="share">
								<img src="{{ asset('img/share.svg') }}" alt="" class="left">
								Share This
							</a>
							<time class="right">july 4, 2018</time>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- popup slider content start -->

<!-- popup slider content end -->

<!-- content end -->

@endsection