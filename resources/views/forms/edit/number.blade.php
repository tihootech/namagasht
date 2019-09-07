@extends('forms.layout')

@section('form-panel')
	<ul class="list-group p-0">

		<li class="list-group-item text-center">
			نوع سوال : {{__('words.NUMBER')}}
		</li>
		@include('forms.li.title', ['info'=>__('messages.NUMBER_QUESTION_GUIDE')])
		@include('forms.li.description')
		@include('forms.li.min_max')
		<li class="list-group-item">
			<div class="pos-relative">
				{{__('words.DECIMAL_ALLOWED')}}
				@include('forms.partials.toggle', ['name'=>'decimal', 'checked'=>$question->decimal])
			</div>
		</li>
		@include('forms.li.file')
		@include('forms.li.required')
	</ul>
@endsection

@section('form-body')
	<div id="preview" class="@unless($question->id) hidden @endunless">
		@include('forms.displays.title')
		@include('forms.displays.description')
		@include('forms.displays.file')
		@include('forms.displays.input', ['placeholder' => null, 'ltr'=>true])
		@include('forms.displays.button')
	</div>
@endsection
