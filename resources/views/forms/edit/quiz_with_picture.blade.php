@extends('forms.layout')

@section('form-panel')
	<ul class="list-group p-0">

		<li class="list-group-item text-center">
			{{__('words.QUESTION_TYPE')}} : {{__('words.QUIZ_WITH_PICTURE')}}
		</li>
		@include('forms.li.title')
		@include('forms.li.description')
		@include('forms.li.choices')
		@include('forms.li.file')
		@include('forms.li.required')
		@include('forms.li.random')
		@include('forms.li.vertical')
		@include('forms.li.multiple')

	</ul>
@endsection

@section('form-body')
	<div id="preview" class="@unless($question->id) hidden @endunless">
		@include('forms.displays.title')
		@include('forms.displays.description')
		@include('forms.displays.file')
		<div id="display-choices" data-multiple="{{$question->multiple ? 'true' : 'false'}}" data-vertical="{{$question->vertical ? 'true' : 'false'}}">
			@foreach ($question->assets as $asset)
				<p @if($question->vertical) style="width:100%" @endif> <span>{{$asset->position}}</span> {{$asset->content}} <i class="fa fa-check"></i> </p>
			@endforeach
		</div>
	</div>
@endsection
