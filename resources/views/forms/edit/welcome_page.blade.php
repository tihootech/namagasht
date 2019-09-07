@extends('forms.layout')

@section('form-panel')
	<ul class="list-group p-0">

		<li class="list-group-item text-center">
			{{__('words.WELCOME_PAGE')}}
		</li>
		@include('forms.li.file')
		@include('forms.li.title', ['label'=>__('words.TITLE'), 'placeholder'=>__('words.TITLE')])
		@include('forms.li.description')
		@include('forms.li.welcome_page_button')

	</ul>
@endsection

@section('form-body')
	<div id="preview" class="@unless($question->id) hidden @endunless text-center">
		@include('forms.displays.file')
		<h2 data-yield="title" class="mt-2">{{$question->title}}</h2>
		@include('forms.displays.description')
		<button type="button" class="btn btn-primary mt-4" data-yield="btn"> {{$question->button ?? __('words.CONFIRM')}} </button>
	</div>
@endsection
