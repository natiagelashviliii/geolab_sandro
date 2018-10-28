@foreach($Works as $key => $value)
	<a class="each-work  col l4 m4 s12" onclick="projects.show({{ $value->id }})">
		@if($value->file)
		<div class="image" style="background-image: url({{ asset('storage/works') . '/' . $value->file }})"></div>
		@elseif($value->video)
		<div class="image" style="background-image: url({{ $value->video_thumb }})">
			<img class="video-play-ico" src="{{ asset('img/video-play.svg') }}">
		</div>
		@endif
	</a>
	<div class="hidden-responsive-text col s12">
		<div class="text">
			<div class="title hidden">
				{{ $value->title }}
			</div>
			<p class="tags hidden">
				@foreach($value->tags as $tagKey => $tagVal)
					<a href="#">#{{ $tagVal->name }}</a>
				@endforeach
			</p>
			<p class="text-body hidden">
				{{ $value->description }}
			</p>
		</div>
		<div class="text-footer">
			<a href="" class="share hidden">
				<img src="{{ asset('img/share.svg') }}" alt="" class="left">
				Share This
			</a>
			<time class="right hidden">july 4, 2018</time>
		</div>
	</div>
@endforeach