<li class="list-group-item">
	<div class="pos-relative">
		{{__('words.ANSWER_REQUIRED')}}
		@include('forms.partials.toggle', ['name'=>'required', 'checked'=>$question->required])
	</div>
</li>
