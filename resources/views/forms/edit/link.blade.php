@extends('forms.layout')

@section('form-panel')
	<ul class="list-group p-0">

		<li class="list-group-item text-center">
			نوع سوال : {{__('words.LINK')}}
		</li>
		@include('forms.li.title')
		@include('forms.li.description')
		@include('forms.li.file')
		@include('forms.li.required')

	</ul>
@endsection

@section('form-body')
	<div id="preview" class="@unless($question->id) hidden @endunless">
		@include('forms.displays.title')
		@include('forms.displays.description')
		@include('forms.displays.file')
		@include('forms.displays.input', ['placeholder' => 'URL', 'ltr'=>true])
		@include('forms.displays.button')
	</div>
@endsection
