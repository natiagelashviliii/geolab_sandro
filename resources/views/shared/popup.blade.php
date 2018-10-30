<div class="popup-content">
	<div>
		<div class="container project-popup-container">
			@include('works.inc.popup-content')
		</div>
		<div class="arrows">
			<button class="arrow left" onclick="projects.previous(this)" data-id="{{ $previous }}">
				<img src="{{ asset('img/left.svg') }}">
			</button>
			<button class="arrow right" onclick="projects.next(this)" data-id="{{ $next }}">
				<img src="{{ asset('img/left.svg') }}" style="transform: rotate(180deg);">
			</button>
		</div>
	</div>
	<div class="close"></div>
</div>