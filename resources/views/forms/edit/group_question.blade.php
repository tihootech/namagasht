@extends('forms.layout')

@section('form-panel')
	<ul class="list-group p-0">

		<li class="list-group-item text-center">
			نوع سوال : {{__('words.GROUP_QUESTION')}}
		</li>
		@include('forms.li.title', ['label'=>__('words.GROUP_QUESTION_TITLE'), 'placeholder'=>__('words.GROUP_QUESTION_TITLE')])
		@include('forms.li.description')
		@include('forms.li.file')
		@include('forms.li.button', ['toggle'=>true])

	</ul>
@endsection

@section('form-body')
	<div id="preview" class="@unless($question->id) hidden @endunless">
		@include('forms.displays.title', ['no_icon'=>true])
		@include('forms.displays.description')
		@include('forms.displays.file')
		<div class="my-2"></div>
		@include('forms.displays.custom_button', ['toggle' => true])
	</div>
@endsection
