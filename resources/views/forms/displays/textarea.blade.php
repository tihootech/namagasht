<textarea class="porsline porsline-textarea" name="answer" id="preview-input" placeholder="{{$placeholder}}..." data-validate-type="{{$question->type}}" @if($question->max) data-max="{{$question->max}}" @endif @if($question->min) data-min="{{$question->min}}" @endif @if($question->required) data-required="1" @endif >@isset($value){{$value}}@endisset</textarea>
