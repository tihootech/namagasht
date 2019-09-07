<li class="list-group-item">
	@if ($toggle)
		<div class="pos-relative">
		{{__('words.BTN')}}
			@include('forms.partials.toggle', ['name'=>'has_button', 'target'=>'button', 'checked'=>$question->button])
		</div>
	@else
		<input type="hidden" name="has_button" value="1">
	@endif
	<div class="form-group mt-3 @if($toggle && !$question->button) hidden @endif" id="button">
		<label for="btn">{{__('words.BTN_BODY')}}</label>
		<input type="text" id="btn" name="button" class="form-control w-50" value="{{$question->button ?? __('words.CONTINUE')}}">
	</div>
</li>
