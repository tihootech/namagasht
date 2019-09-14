<li class="list-group-item">
	<div class="pos-relative">
		{{__('words.VERTIVAL_CHOICES')}}
		@include('forms.partials.toggle', ['name'=>'vertical', 'checked'=>$question->vertical])
	</div>
</li>
