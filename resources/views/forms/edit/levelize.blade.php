@extends('forms.layout')

@section('form-panel')
	<ul class="list-group p-0">
		<li class="list-group-item text-center">
			نوع سوال : {{__('words.LEVELIZE')}}
		</li>
		<li class="list-group-item">
			<div class="pos-relative">
				{{__('words.QUESTION')}}
			</div>
			<div class="form-group mt-3">
				<textarea name="title" id="question" rows="3" class="form-control" placeholder="{{__('words.QUESTION_BODY')}}...">{{null}}</textarea>
			</div>
		</li>
		<li class="list-group-item">
			<div class="pos-relative">
				{{__('words.DESCRIPTION')}}
				@include('forms.partials.toggle', ['target' => 'description-div', 'name'=>'description', 'checked'=>false])
			</div>
			<div class="form-group mt-3 hidden" id="description-div">
				<textarea name="description" id="description" rows="4" class="form-control" placeholder="{{__('words.DESCRIPTION')}}...">{{null}}</textarea>
			</div>
		</li>
		<li class="list-group-item">
			<div class="pos-relative">
				{{__('words.SET_DEGREE')}}
				<span class="stick-left"><b class="ml-3" id="range-value">5</b></span>
			</div>
			<div class="form-group mt-3">
				<input type="range" name="degree" id="degree" class="custom-range" value="5" min="1" max="10">
				<label for="shape">{{__('words.SHAPE')}}</label>
				<select class="form-control w-50" id="shape" name="shape">
					<option @if(null) selected @endif value="star"> &#xf005; {{__('words.STAR')}} </option>
					<option @if(null) selected @endif value="heart"> &#xf004; {{__('words.HEART')}} </option>
					<option @if(null) selected @endif value="thumbs-up"> &#xf164; {{__('words.THUMB')}} </option>
				</select>
			</div>
		</li>
		<li class="list-group-item">
			<div class="pos-relative">
				{{__('words.IMAGE_OR_VIDEO')}}
				@include('forms.partials.toggle', ['target' => 'file-upload', 'name'=>'image', 'checked'=>false])
			</div>
			<div class="form-group hidden mt-3" id="file-upload">
				<div class="custom-file">
					<input type="file" class="custom-file-input" id="file">
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
	</ul>
@endsection

@section('form-body')
	<div id="preview" class="">
		<h4> <i class="fa fa-arrow-left"></i> <span data-yield="question"></span> </h4>
		<p data-yield="description" class="m-0"></p>
		<img src="" alt="" data-yield="image" class="preview-img">
		<div class="porsline-degree mt-4" data-icon="star">
			<p data-index="1"> <i class="fa fa-star-o"></i> <span>1</span> </p>
			<p data-index="2"> <i class="fa fa-star-o"></i> <span>2</span> </p>
			<p data-index="3"> <i class="fa fa-star-o"></i> <span>3</span> </p>
			<p data-index="4"> <i class="fa fa-star-o"></i> <span>4</span> </p>
			<p data-index="5"> <i class="fa fa-star-o"></i> <span>5</span> </p>
		</div>
	</div>
@endsection
