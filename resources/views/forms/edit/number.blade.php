@extends('forms.layout')

@section('form-panel')
	<ul class="list-group p-0">
		<li class="list-group-item text-center">
			نوع سوال : {{__('words.NUMBER')}}
		</li>
		<li class="list-group-item">
			<div class="pos-relative">
				{{__('words.QUESTION')}}
			</div>
			<div class="form-group mt-3">
				<textarea name="title" id="question" rows="3" class="form-control" placeholder="{{__('words.QUESTION_BODY')}}...">{{null}}</textarea>
			</div>
			<small class="text-muted"> * {{__('messages.NUMBER_QUESTION_GUIDE')}} </small>
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
				{{__('words.ANSWER_MIN&MAX_NUMBER')}}
			</div>
			<div class="form-group mt-3">
				<div class="row">
					<div class="col-6">
						<label for="min">{{__('words.MIN')}}</label>
						<input type="number" id="min" name="min" class="form-control w-75" value="{{null}}">
					</div>
					<div class="col-6">
						<label for="max">{{__('words.MAX')}}</label>
						<input type="number" id="max" name="max" class="form-control w-75" value="{{null}}">
					</div>
				</div>
			</div>
		</li>
		<li class="list-group-item">
			<div class="pos-relative">
				{{__('words.DECIMAL_ALLOWED')}}
				@include('forms.partials.toggle', ['name'=>'decimal', 'checked'=>false])
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
	<div id="preview" class="hidden">
		<h4> <i class="fa fa-arrow-left"></i> <span data-yield="question"></span> </h4>
		<p data-yield="description" class="m-0"></p>
		<img src="" alt="" data-yield="image" class="preview-img">
		<input dir="ltr" type="text" class="porsline porsline-input" id="preview-input">
		<button type="button" class="btn btn-primary mt-4 hidden" id="preview-confirm"> {{__('words.CONFIRM')}} </button>
	</div>
@endsection
