@extends('forms.layout')

@section('form-panel')
	<ul class="list-group p-0">

		<li class="list-group-item text-center">
			{{__('words.QUESTION_TYPE')}} : {{__('words.UPLOAD_FILE')}}
		</li>
		@include('forms.li.title')
		@include('forms.li.description')
		<li class="list-group-item">
			{{__('messages.SET_MAX_IN_KB')}}
			<input type="number" name="max" value="{{$question->max ?? 5000}}" class="form-control mt-2 w-25">
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
		<br>
		<div class="custom-file mt-3 w-25">
			<input type="file" name="user_file" class="custom-file-input" id="user-file">
			<label class="custom-file-label" for="user-file" data-content="{{__('words.SELECT')}}"> {{__('words.CHOOSE_FILE')}} </label>
		</div>
	</div>
@endsection
