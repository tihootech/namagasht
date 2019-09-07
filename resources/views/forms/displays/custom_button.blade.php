<button type="button" class="btn btn-primary mt-4" @isset($toggle) id="display-btn" @endisset data-yield="btn"> {{$question->button ?? __('words.CONFIRM')}} </button>
