@extends('forms.layout')

@section('form-panel')
	<ul class="list-group p-0">
		<li class="list-group-item text-center">
			نوع سوال : {{__("words.LIST")}}
		</li>
		<li class="list-group-item">
			<div class="pos-relative">
				{{__('words.QUESTION')}}
			</div>
			<div class="form-group mt-3">
				<textarea name="question" id="question" rows="3" class="form-control" placeholder="{{__('words.QUESTION_BODY')}}...">{{null}}</textarea>
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
				{{__('words.CHOICES')}}
				<i class="fa fa-question-circle mirror-rotate mr-1" aria-hidden="true" href="#" data-toggle="popover" data-content="{{__('messages.SEPERATE_CHOICES_BY_ENTER')}}" data-placement="left" data-trigger="hover" data-original-title="" title=""></i>
			</div>
			<div class="form-group mt-3">
				<textarea name="choices" id="enter-choices" rows="4" class="form-control" placeholder="{{__('words.ENTER_CHOICES')}}...">{{null}}</textarea>
				<small class="hidden"> <i class="fa fa-asterisk ml-1"></i> {{__('messages.LIST_HELP')}}</small>
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
		<li class="list-group-item">
			<div class="pos-relative">
				{{__('words.RANDOM_CHOICES')}}
				@include('forms.partials.toggle', ['name'=>'random', 'checked'=>false])
			</div>
		</li>
		<li class="list-group-item">
			<div class="pos-relative">
				{{__('words.ALPHABET_ORDER')}}
				@include('forms.partials.toggle', ['name'=>'alphabet', 'checked'=>false])
			</div>
		</li>
	</ul>
@endsection

@section('form-body')
	<div id="preview" class="hidden">
		<h4> <i class="fa fa-arrow-left"></i> <span data-yield="question"></span> </h4>
		<p data-yield="description" class="m-0"></p>
		<img src="" alt="" data-yield="image" class="preview-img">
		<div class="porsline-select">
			<label class="fa fa-angle-down fa-2x" for="search"></label>
			<input type="text" id="search" class="porsline porsline-input" placeholder="{{__('words.CHOOSE_OR_TYPE_ANSWER')}}...">
			<div class="porsline-select-dropdown">
				{{-- will be updated via jquery --}}
			</div>
		</div>
	</div>
@endsection
