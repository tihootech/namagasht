<input
	type="text" autocomplete="off" name="answer" id="preview-input" class="porsline porsline-input" autocomplete="off"
	@if($ltr) dir="ltr" @endif
	@if($placeholder) placeholder="{{$placeholder}}..." @endif
	@isset($value) value="{{$value}}" @endisset
	data-validate-type="{{$question->type}}"
	@if($question->max) data-max="{{$question->max}}" @endif
	@if($question->min) data-min="{{$question->min}}" @endif
	@if($question->required) data-required="1" @endif
	@if($question->decimal) data-decimal-allowed="1" @endif
>
