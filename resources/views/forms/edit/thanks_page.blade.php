@extends('forms.layout')

@section('form-panel')
	<ul class="list-group p-0">

		<li class="list-group-item text-center">
			{{__('words.THANKS_PAGE')}}
		</li>
		@include('forms.li.file')
		@include('forms.li.title', ['label'=>__('words.TITLE'), 'placeholder'=>__('words.THANKS_TEXT')])
		@include('forms.li.description')
		{{-- <li class="list-group-item">
			<div class="pos-relative">
				{{__('words.SHARE_FORM_LINK')}}
				@include('forms.partials.toggle', ['name'=>'share', 'checked'=>$question->share])
			</div>
		</li> --}}
		{{-- <li class="list-group-item">
			<div class="pos-relative">
				{{__('words.DEFAULT_THANKS_PAGE')}}
				@include('forms.partials.toggle', ['name'=>'required', 'checked'=>false])
			</div>
		</li> --}}
		{{-- <li class="list-group-item">
			<div class="pos-relative">
				{{__('words.REDIRECT/RELOAD_BTN')}}
				@include('forms.partials.toggle', ['name'=>'required', 'checked'=>false])
			</div>
		</li> --}}
		{{-- <li class="list-group-item">
			<div class="pos-relative">
				{{__('words.AUTO_RELOAD')}}
				@include('forms.partials.toggle', ['name'=>'auto_reload', 'checked'=>$question->auto_reload])
			</div>
		</li> --}}
	</ul>
@endsection

@section('form-body')
	<div id="preview" class="@unless($question->id) hidden @endunless text-center">
		@include('forms.displays.file')
		<h2 data-yield="title" class="mt-2">{{$question->title}}</h2>
		@include('forms.displays.description')
	</div>
@endsection
