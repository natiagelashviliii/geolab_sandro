@extends ('index')

@section('content')

<!-- content start -->

<style type="text/css">
	iframe{
		border: none;
	}
	.spinner {
	  margin: 30px auto 0;
	  width: 70px;
	  text-align: center;
	}

	.spinner > div {
	  width: 8px;
	  height: 8px;
	  background-color: rgba(155,155,155,0.8);
	  margin: 0 4px;
	  border-radius: 100%;
	  display: inline-block;
	  -webkit-animation: sk-bouncedelay 1.4s infinite ease-in-out both;
	  animation: sk-bouncedelay 1.4s infinite ease-in-out both;
	}

	.spinner .bounce1 {
	  -webkit-animation-delay: -0.32s;
	  animation-delay: -0.32s;
	}

	.spinner .bounce2 {
	  -webkit-animation-delay: -0.16s;
	  animation-delay: -0.16s;
	}

	@-webkit-keyframes sk-bouncedelay {
	  0%, 80%, 100% { -webkit-transform: scale(0) }
	  40% { -webkit-transform: scale(1.0) }
	}

	@keyframes sk-bouncedelay {
	  0%, 80%, 100% { 
	    -webkit-transform: scale(0);
	    transform: scale(0);
	  } 40% { 
	    -webkit-transform: scale(1.0);
	    transform: scale(1.0);
	  }
	}
	.video-play-ico{
		position: absolute;
    	width: 17px;
    	right: 5px;
    	bottom: 5px;
	}
	.popup-inside.new.next{
		opacity: 1;
		transform: translateX(150%);
	}
	.popup-inside.new.previous{
		opacity: 1;
		transform: translateX(-150%);
	}
</style>

<section class="container wokrs-container">
	<div class="works-content">
		<div id="filter-menu" class="tabs-head hidden">
			@foreach ($Categories as $key => $value)
				<a href="{{ '/works/' . str_slug($value->title,'-') }}" class="{{ $slugID == $value->id ? 'active' : ''}}" data-slug="{{ str_slug($value->title,'-') }}">
					{{ $value->title }}
				</a>
			@endforeach
		</div>
		<div class="row">

			<div id="illustrations" class="col s12">
				<div id="illustrations-container" class="row">
					@include('works.works')
				</div>
			</div>
		</div>
	</div>
</section>

<!-- popup slider content start -->

<!-- popup slider content end -->

<!-- content end -->

@endsection