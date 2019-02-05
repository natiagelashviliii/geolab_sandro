@extends('admin/index')
       
@section('section')

<div class="row categories-content pd-all-40">
	<div class="col s12">
		<ul class="cat-list">
			@foreach($Cats as $key => $value)
			<li>
				<span class="title">{{ $value->title }}</span>
				<!-- <span class="cat-cnt">(works - 15)</span> -->
				<span class="actions right">
					<a href="{{ url('admin/categories/edit/'.$value->id) }}"><i class="large material-icons" title="Edit">edit</i></a>
					<a onclick="admin.deleteCategory({{ $value->id }}, this)"><i class="large material-icons" title="Delete">clear</i></a>
				</span>
			</li>
			@endforeach
		</ul>
	</div>
	<div class="col s12 right-align add-cat-btn">
		<a href="{{ url('admin/categories/add') }}" class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a>
	</div>
</div>        

@endsection