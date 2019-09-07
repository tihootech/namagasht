<li class="list-group-item">
	<div class="pos-relative">
		{{__('words.DESCRIPTION')}}
		@include('forms.partials.toggle', ['target' => 'header-description', 'name'=>'has_description', 'checked'=>$question->description])
	</div>
	<div class="form-group mt-3 @unless($question->description) hidden @endunless" id="header-description">
		<textarea name="description" id="description" rows="4" class="form-control" placeholder="{{__('words.DESCRIPTION')}}...">{{$question->description}}</textarea>
	</div>
</li>
