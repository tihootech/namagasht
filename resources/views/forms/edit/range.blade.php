@extends('forms.layout')

@section('form-panel')
	<ul class="list-group p-0">

		<li class="list-group-item text-center">
			{{__('words.QUESTION_TYPE')}} : {{__('words.RANGE')}}
		</li>
		@include('forms.li.title')
		@include('forms.li.description')
		<li class="list-group-item">
			<div class="pos-relative">
				{{__('words.SET_RANGE')}}
				<span class="stick-left"><b class="ml-3" id="range-value">{{$question->range_end()}}</b></span>
			</div>
			<div class="form-group mt-3">
				<div class="mb-3">
					<input type="range" id="range" name="range" value="{{$question->range_end()}}" class="custom-range" min="3" max="11">
				</div>
				<div class="row justify-content-center">
					<div class="range-tag-wrapper w-50">
						<div class="mx-2">
							<input type="text" id="right" name="right_label" class="form-control range-tag" placeholder="{{__('words.RIGHT_TAG')}}" value="{{$question->right_label}}">
						</div>
					</div>
					<div class="range-tag-wrapper w-25">
						<div class="mx-2">
							<input type="text" id="center" name="center_label" class="form-control range-tag" placeholder="{{__('words.CENTER')}}" value="{{$question->center_label}}" @unless($question->range_middle()) disabled @endunless>
						</div>
					</div>
					<div class="range-tag-wrapper w-25">
						<div class="mx-2">
							<input type="text" id="left" name="left_label" class="form-control range-tag" placeholder="{{__('words.LEFT')}}" value="{{$question->left_label}}">
						</div>
					</div>
				</div>
			</div>
		</li>
		@include('forms.li.file')
		@include('forms.li.required')
		<li class="list-group-item">
			<div class="pos-relative">
				{{__('words.START_WITH_ZERO')}}
				@include('forms.partials.toggle', ['name'=>'zero_based', 'checked'=>$question->zero_based])
			</div>
		</li>
	</ul>
@endsection

@section('form-body')
	<div id="preview" class="@unless($question->id) hidden @endunless">
		@include('forms.displays.title')
		@include('forms.displays.description')
		@include('forms.displays.file')
		<div class="porsline-range">
			<div class="display-range">
				@for ($i = $question->range_start(); $i <= $question->range_end(); $i++)
					<span @if($i==$question->range_start() || $i==$question->range_end() || $i==$question->range_middle()) class="label" @endif>
						{{$i}}
					</span>
				@endfor
			</div>
			<div class="row display-range-footer mt-3">
				<span class="col-4 range-label-right">
					{{$question->right_label ?? $question->range_start()}}
				</span>
				<span class="col-4 text-center range-label-center">{{$question->range_middle() ? $question->center_label : null}}</span>
				<span class="col-4 text-left range-label-left">
					{{$question->left_label ?? $question->range_end()}}
				</span>
			</div>
		</div>
	</div>
@endsection
