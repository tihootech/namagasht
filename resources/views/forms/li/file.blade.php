<li class="list-group-item">
	<div class="pos-relative">
		{{__('words.IMAGE_OR_VIDEO')}}
		@include('forms.partials.toggle', ['target' => 'file-upload', 'name'=>'has_file', 'checked'=>$question->file_path])
	</div>
	<div class="form-group @unless($question->file_path) hidden @endunless mt-3" id="file-upload">
		<div class="custom-file mb-2">
			<input type="file" name="file" class="custom-file-input" id="file">
			<label class="custom-file-label" for="file" data-content="{{__('words.SELECT')}}"> {{__('words.CHOOSE_FILE')}} </label>
		</div>
		@if ($question->file_path)
			<small> <i class="fa fa-asterisk"></i> {{__('messages.REPLACE_FILE')}} </small>
		@endif
	</div>
</li>
