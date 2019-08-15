@extends('forms.layout')

@section('form-panel')
	<ul class="list-group p-0">
		<li class="list-group-item text-center">
			{{__('words.WELCOME_PAGE')}}
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
				{{__('words.TITLE')}}
				@include('forms.partials.toggle', ['target' => 'header-title', 'name'=>'header_title', 'checked' => true])
			</div>
			<div class="form-group mt-3" id="header-title">
				<input type="text" name="header_title" class="form-control" value="{{null}}" placeholder="{{__('words.TITLE')}}">
			</div>
		</li>
		<li class="list-group-item">
			<div class="pos-relative">
				{{__('words.DESCRIPTION')}}
				@include('forms.partials.toggle', ['target' => 'header-description', 'name'=>'header_description', 'checked'=>false])
			</div>
			<div class="form-group mt-3 hidden" id="header-description">
				<textarea name="header_description" rows="4" class="form-control" placeholder="{{__('words.DESCRIPTION')}}...">{{null}}</textarea>
			</div>
		</li>
		<li class="list-group-item">
			<div class="pos-relative">
				{{__('words.ENTER_BTN')}}
			</div>
			<div class="form-group mt-3">
				<input type="text" name="start_btn" class="form-control w-50" value="{{__('words.START')}}">
			</div>
		</li>
	</ul>
@endsection

@section('form-body')
	<div id="preview">

	</div>
@endsection
