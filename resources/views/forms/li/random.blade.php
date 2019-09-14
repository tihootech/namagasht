<li class="list-group-item">
	<div class="pos-relative">
		{{__('words.RANDOM_CHOICES')}}
		@include('forms.partials.toggle', ['name'=>'randomize', 'checked'=>$question->randomize])
	</div>
</li>
