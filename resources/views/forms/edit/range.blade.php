@extends('forms.layout')

@section('form-panel')
	<ul class="list-group p-0">
		<li class="list-group-item text-center">
			نوع سوال : {{__('words.RANGE')}}
		</li>
		<li class="list-group-item">
			<div class="pos-relative">
				{{__('words.QUESTION')}}
			</div>
			<div class="form-group mt-3">
				<textarea name="question" rows="3" class="form-control" placeholder="{{__('words.QUESTION_BODY')}}...">{{null}}</textarea>
			</div>
		</li>
		<li class="list-group-item">
			<div class="pos-relative">
				{{__('words.DESCRIPTION')}}
				@include('forms.partials.toggle', ['target' => 'description', 'name'=>'description', 'checked'=>false])
			</div>
			<div class="form-group mt-3 hidden" id="description">
				<textarea name="description" rows="4" class="form-control" placeholder="{{__('words.DESCRIPTION')}}...">{{null}}</textarea>
			</div>
		</li>
		<li class="list-group-item">
			<div class="pos-relative">
				{{__('words.SET_RANGE')}}
				<span class="stick-left"><b class="ml-3" id="range-value">5</b></span>
			</div>
			<div class="form-group mt-3">
				<div class="mb-3">
					<input type="range" name="range" class="custom-range" min="3" max="11">
				</div>
				<div class="row justify-content-center">
					<div class="range-tag-wrapper w-50">
						<div class="mx-2">
							<input type="text" id="left" name="right" class="form-control range-tag" placeholder="{{__('words.RIGHT_TAG')}}" value="{{null}}">
						</div>
					</div>
					<div class="range-tag-wrapper w-25">
						<div class="mx-2">
							<input type="text" id="center" name="center" class="form-control range-tag" placeholder="{{__('words.CENTER')}}" value="{{null}}">
						</div>
					</div>
					<div class="range-tag-wrapper w-25">
						<div class="mx-2">
							<input type="text" id="right" name="left" class="form-control range-tag" placeholder="{{__('words.LEFT')}}" value="{{null}}">
						</div>
					</div>
				</div>
			</div>
		</li>
		<li class="list-group-item">
			<div class="pos-relative">
				{{__('words.IMAGE_OR_VIDEO')}}
				@include('forms.partials.toggle', ['target' => 'file-upload', 'name'=>'image', 'checked'=>false])
			</div>
			<div class="form-group hidden mt-3" id="file-upload">
				<div class="custom-file">
					<input type="file" class="custom-file-input" id="customFile">
					<label class="custom-file-label" for="customFile" data-content="{{__('words.SELECT')}}"> {{__('words.CHOOSE_FILE')}} </label>
				</div>
			</div>
		</li>
		<li class="list-group-item">
			<div class="pos-relative">
				{{__('words.ANSWER_REQUIRED')}}
				@include('forms.partials.toggle', ['name'=>'required', 'checked'=>false])
			</div>
		</li>
		<li class="list-group-item">
			<div class="pos-relative">
				{{__('words.START_WITH_ZERO')}}
				@include('forms.partials.toggle', ['name'=>'zero', 'checked'=>false])
			</div>
		</li>
	</ul>
@endsection

@section('form-body')
	<div id="preview">

	</div>
@endsection
