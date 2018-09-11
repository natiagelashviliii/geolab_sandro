@extends('admin/index')
       
@section('section')

<div class="row works-content pd-all-40">
	<div class="col s12">
		<div class="manage-categories">
			<a href="{{ url('admin/categories') }}" class="btn"><i class="material-icons left">settings</i>Manage Categories</a>
		</div>
	</div>
	<div class="col s12 add-cat-btn">
		<ul class="left filter">
			@if(Request::get('cat'))
				<li class="filter-item clear"><a href="{{ url('admin/works') }}">all</a></li>
			@endif	
			@foreach($Cats as $key => $value)
				<li class="filter-item {{ Request::get('cat') && Request::get('cat') == $value->id ? 'active' : ''}}"><a href="{{ url('admin/works/?cat=') . $value->id }}">{{ $value->title }}</a></li>
			@endforeach
		</ul>
		<a href="{{ url('admin/works/add') }}" class="right btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a>
	</div>
	<div class="col s12 works">
		<div class="row">
		@foreach($Works as $key => $value) 
			<div class="col s12 m12 l6 xl4 each-work">
				<div class="file">
					<img src="{{ asset('storage/works') . '/' . $value->file }}">
				</div>
				<div class="file-descr">
					<div class="title">
						<p class="mg-all-0 center-align">{{ $value->title }}</p>
					</div>
					<div class="descr">
						<p class="mg-all-0">{{ str_limit($value->description, $limit = 100, $end = '...') }}</p>
					</div>
					<div class="tags">
						@foreach($value->tags as $tagKey => $tagVal)
							<span><a href="">#{{ $tagVal->name }}</a></span>
						@endforeach
					</div>
					<div class="category">
						<span>Category: <a href="">{{ $value->cat_title }}</a></span>
					</div>
					<div class="actions center-align">
						<a href="{{ url('admin/works/edit/'.$value->id) }}"><i class="large material-icons" title="Edit">edit</i></a>
						<a onclick="works.deleteWork({{ $value->id }}, this)"><i class="large material-icons" title="Delete">clear</i></a>
						<a onclick="works.changeWorkStatus({{ $value->id }}, this)"><i class="large material-icons" title="Delete">
							@if($value->status == 0) star_border @else star @endif
						</i></a>
					</div>
				</div>
			</div>
		@endforeach
		</div>
		<div class="row">
			<div class="col s12 right-align">
        		{{ $Works->links() }}
        	</div>
		</div>
	</div>
</div>        

@endsection