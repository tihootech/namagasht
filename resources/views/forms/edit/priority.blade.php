@extends('forms.layout')

@section('form-panel')
	<ul class="list-group p-0">

		<li class="list-group-item text-center">
			{{__('words.QUESTION_TYPE')}} : {{__('words.PRIORITY')}}
		</li>
		@include('forms.li.title')
		@include('forms.li.description')
		@include('forms.li.choices')
		@include('forms.li.file')
		@include('forms.li.required')
		@include('forms.li.random')

	</ul>
@endsection

@section('form-body')
	<div id="preview" class="@unless($question->id) hidden @endunless">
		@include('forms.displays.title')
		<p class="m-0">({{__('messages.PERIORITY_HELP')}})</p>
		@include('forms.displays.description')
		@include('forms.displays.file')
		<div class="periority-display mt-4">
			@foreach ($question->assets as $i => $asset)
				<p> <i class="fa fa-exchange"></i> <span>{{$i+1}}</span> {{$asset->content}} </p>
			@endforeach
		</div>
	</div>
@endsection
