<li class="list-group-item">
	<div class="pos-relative">
		@if ($fragment == 'number')
			{{__('words.ANSWER_MIN&MAX_NUMBER')}}
		@else
			{{__('words.ANSWER_MIN&MAX_CHARS')}}
		@endif
	</div>
	<div class="form-group mt-3">
		<div class="row">
			<div class="col-6">
				<label for="min">{{__('words.MIN')}}</label>
				<input type="number" id="min" name="min" class="form-control w-75" value="{{$question->min}}">
			</div>
			<div class="col-6">
				<label for="max">{{__('words.MAX')}}</label>
				<input type="number" id="max" name="max" class="form-control w-75" value="{{$question->max}}">
			</div>
		</div>
	</div>
</li>
