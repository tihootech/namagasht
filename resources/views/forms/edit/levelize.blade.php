@extends('forms.layout')

@section('form-panel')
	<ul class="list-group p-0">

		<li class="list-group-item text-center">
			{{__('words.QUESTION_TYPE')}} : {{__('words.LEVELIZE')}}
		</li>
		@include('forms.li.title')
		@include('forms.li.description')
		<li class="list-group-item">
			<div class="pos-relative">
				{{__('words.SET_DEGREE')}}
				<span class="stick-left"><b class="ml-3" id="range-value">{{$question->range_end()}}</b></span>
			</div>
			<div class="form-group mt-3">
				<input type="range" name="range" id="degree" class="custom-range" value="{{$question->range_end()}}" min="1" max="10">
				<label for="shape">{{__('words.SHAPE')}}</label>
				<select class="form-control w-50" id="shape" name="shape">
					<option @if($question->shape == 'star') selected @endif value="star"> &#xf005; {{__('words.STAR')}} </option>
					<option @if($question->shape == 'heart') selected @endif value="heart"> &#xf004; {{__('words.HEART')}} </option>
					<option @if($question->shape == 'thumbs-up') selected @endif value="thumbs-up"> &#xf164; {{__('words.THUMB')}} </option>
				</select>
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
		<div class="porsline-degree mt-4" data-icon="{{$question->shape ?? 'star'}}">
			@for ($i = $question->range_start(); $i <= $question->range_end(); $i++)
				<p data-index="{{$i}}"> <i class="fa fa-{{$question->shape ?? 'star'}}-o"></i> <span>{{$i}}</span> </p>
			@endfor
		</div>
	</div>
@endsection
