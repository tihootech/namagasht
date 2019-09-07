@extends('forms.layout')

@section('form-panel')
	<ul class="list-group p-0">
		<li class="list-group-item text-center">
			{{__('words.WELCOME_PAGE')}}
		</li>
		<li class="list-group-item">
			<div class="pos-relative">
				{{__('words.IMAGE_OR_VIDEO')}}
				@include('forms.partials.toggle', ['target' => 'file-upload', 'name'=>'has_file', 'checked'=>$form->welcome_page->file_path ?? false])
			</div>
			<div class="form-group hidden mt-3" id="file-upload">
				<div class="custom-file">
					<input type="file" class="custom-file-input" id="file">
					<label class="custom-file-label" for="file" data-content="{{__('words.SELECT')}}"> {{__('words.CHOOSE_FILE')}} </label>
				</div>
			</div>
		</li>
		<li class="list-group-item">
			<div class="pos-relative">
				{{__('words.TITLE')}}
			</div>
			<div class="form-group mt-3">
				<textarea name="title" id="title" rows="2" class="form-control" placeholder="{{__('words.TITLE')}}...">{{$form->welcome_page->title ?? null}}</textarea>
			</div>
		</li>
		<li class="list-group-item">
			<div class="pos-relative">
				{{__('words.DESCRIPTION')}}
				@include('forms.partials.toggle', ['target' => 'header-description', 'name'=>'has_description', 'checked'=>$form->welcome_page->description ?? false])
			</div>
			<div class="form-group mt-3 hidden" id="header-description">
				<textarea name="description" id="description" rows="4" class="form-control" placeholder="{{__('words.DESCRIPTION')}}...">{{$form->welcome_page->description ?? null}}</textarea>
			</div>
		</li>
		<li class="list-group-item">
			<div class="pos-relative">
				{{__('words.ENTER_BTN')}}
			</div>
			<div class="form-group mt-3">
				<input type="text" name="button" id="btn" class="form-control w-50" value="{{__('words.START')}}">
			</div>
		</li>
	</ul>
@endsection

@section('form-body')
	<div id="preview" class="hidden text-center">
		<img src="" alt="" data-yield="image" class="preview-img">
		<h2 data-yield="title" class="mt-2"></h2>
		<p data-yield="description" class="text-muted font-weight-bold"></p>
		<button type="button" class="btn btn-primary mt-3" data-yield="btn"></button>
	</div>
@endsection
