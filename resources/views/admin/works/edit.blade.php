@extends('admin/index')
       
@section('section')

<div class="row works-add-content pd-all-40">
	<form action="{{ url('admin/works/addwork') }}" class="file-form" method="post" onsubmit="return admin.submitForm(this);" enctype="multipart/form-data">
		<div class="input-field col s5">
			<select name="CatID">
			  @foreach($data['cats'] as $key => $value)
			  <option value="{{ $value->id }}" @if($data['work']->cat_id == $value->id) selected @endif>{{ $value->title }}</option>
			  @endforeach
			</select>
		</div>
		<div class="input-field col s12">
			<input id="Title" name="Title" type="text" data-error="*" value="{{ $data['work']->title }}">
			<label class="active" for="Title">TItle</label>
		</div>
		<div class="input-field col s12">
	    	<textarea id="Description" name="Description" class="materialize-textarea height-110" rows="5" data-error="*">{{ $data['work']->description }}</textarea>
	    	<label for="Description">Description</label>
	    </div>

		<div class="input-field col s12">
        	<i class="material-icons prefix">textsms</i>
        	<div id="chip-data-cont" class="chips chips-autocomplete"></div>
        </div>
	    <div class="clearfix m-top-5">
            <ul class="clearfix files-list files-list-news" data-types="[jpg, png, jpeg, gif, svg]" data-max-files="1"
            data-name="Photos" data-index="0">
                <li class="files-list-new-file shadow-inset" onclick="_files.selectFiles(this);">
                    <span>
                    	<i class="fa fa-camera-retro" aria-hidden="true"></i>
                    </span>
                    <p>Upload File</p>
                </li>
            </ul>
        </div>
        <div class="input-field col s12 right-align">
	    	<input type="hidden" name="Tags" id="Tags" value="">
	    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	    	<button class="waves-effect waves-light btn-small" type="submit">Save</button>
	    </div>
	</form>
	<form class="j-form files-list-form" name="files-list-form" data-index="0" method="post" enctype="multipart/form-data"
		 action="{{ url('file/uploadphoto/') }}" data-name="Photos">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	    <input type="hidden" name="UploadedFiles" class="files-list-uploaded-files" value="0">
	    <input type="hidden" name="PostGroup" value="works">
	    <input type="file" name="File" class="files-list-file" onchange="_files.uploadFiles(this);">
	</form>
</div>        

@endsection

@section('sub_footer')
<script type="text/javascript">
	$(document).ready(function(){
		console.log({!! $data['usedTags'] !!});
		$('.chips-autocomplete').chips({
			data: {!! $data['usedTags'] !!},
			autocompleteOptions: {
			  data: {!! $data['tags'] !!},
			  limit: 7,
			  minLength: 1
			},
			onChipAdd: function() {
				let chipsDataObj = M.Chips.getInstance($('.chips')).chipsData;
				let chipsArray = chipsDataObj.map(function(v, i){
					return v.tag;
				});
				$('#Tags').val(chipsArray);
			}
		});
	});
</script>
@endsection