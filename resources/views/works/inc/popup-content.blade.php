<div class="popup-inside">
	<div class="row">
		<div class="col m7 image-block hide-on-small-only">
			@if($work->file)
			<div class="image" style="background-image: url({{ asset('storage/works') . '/' . $work->file }})"></div>
			@elseif($work->video)
			<iframe src="{{ $work->video_embed }}" width="500" height="500" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
			@endif
		</div>
		<div class="col m5">
			<div class="text">
				<div class="title">
					{{ $work->title }}
				</div>
				<p class="tags">
					@if($tags)
						@foreach($tags as $key => $value)
						<a href="#">#{{ $value}}</a>
						@endforeach
					@endif
				</p>
				<p class="text-body">
					{{ $work->description }}
				</p>
			</div>
			<div class="text-footer">
				<a href="" class="share">
					<img src="{{ asset('img/share.svg') }}" alt="" class="left">
					Share This
				</a>
				<time class="right date-time">july 4, 2018</time>
			</div>
		</div>
	</div>
</div>