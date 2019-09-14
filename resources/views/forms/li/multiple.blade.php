<li class="list-group-item">
	<div class="pos-relative">
		{{__('words.MULTIPLE_CHOICE_QUESTION')}}
		@include('forms.partials.toggle', ['name'=>'multiple', 'target'=>'multiple-choices-div', 'checked'=>$question->multiple])
	</div>
	<div class="form-group mt-3 @unless($question->multiple) hidden @endunless" id="multiple-choices-div">
		<label for="max"> <small class="text-muted"> {{__('words.USER_MAX_CHOICES')}} </small> </label>
		<input type="number" id="max" name="max" class="form-control w-25" value="{{$question->max ?? 2}}">
	</div>
</li>
