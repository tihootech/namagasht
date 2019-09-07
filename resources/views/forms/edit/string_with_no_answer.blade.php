@extends('forms.layout')

@section('form-panel')
	<ul class="list-group p-0">
		<li class="list-group-item text-center">
			{{__('words.ADD_TEXT')}}
		</li>
		@include('forms.li.title', ['label'=>__('words.CONTINUE'), 'placeholder'=>__('words.STRING'), 'rows'=>6])
		@include('forms.li.description')
		@include('forms.li.file')
		@include('forms.li.button', ['toggle'=>false])
	</ul>
@endsection

@section('form-body')
	<div id="preview" class="@unless($question->id) hidden @endunless">
		@include('forms.displays.title')
		@include('forms.displays.description')
		@include('forms.displays.file')
		@include('forms.displays.custom_button')
	</div>
@endsection
