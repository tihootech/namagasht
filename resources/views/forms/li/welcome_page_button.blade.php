<input type="hidden" name="has_button" id="toggle-has_button" value="1">
<li class="list-group-item">
	<div class="pos-relative">
		{{__('words.ENTER_BTN')}}
	</div>
	<div class="form-group mt-3">
		<input type="text" name="button" id="btn" class="form-control w-50" value="{{$question->button ?? __('words.START')}}">
	</div>
</li>
