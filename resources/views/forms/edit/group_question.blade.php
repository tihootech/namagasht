@extends('forms.layout')

@section('form-panel')
	<ul class="list-group p-0">
		<li class="list-group-item text-center">
			نوع سوال : {{__('words.GROUP_QUESTION')}}
		</li>
		<li class="list-group-item">
			<div class="pos-relative">
				{{__('words.GROUP_QUESTION_TITLE')}}
			</div>
			<div class="form-group mt-3">
				<textarea name="question" id="question" rows="3" class="form-control" placeholder="{{__('words.GROUP_QUESTION_TITLE')}}...">{{null}}</textarea>
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
				{{__('words.BTN')}}
				@include('forms.partials.toggle', ['name'=>'btn', 'target'=>'button', 'checked'=>false])
			</div>
			<div class="form-group mt-3 hidden" id="button">
				<label for="btn">{{__('words.BTN_BODY')}}</label>
				<input type="text" id="btn" name="start_btn" class="form-control w-50" value="{{__('words.CONTINUE')}}">
			</div>
		</li>
	</ul>
@endsection

@section('form-body')
	<div id="preview" class="">
		<h4 data-yield="question"></h4>
		<p data-yield="description" class="m-0"></p>
		<img src="" alt="" data-yield="image" class="preview-img">
		<button type="button" class="btn btn-primary mt-4 hidden" id="display-btn" data-yield="btn"> {{__('words.CONTINUE')}} </button>
	</div>
@endsection
