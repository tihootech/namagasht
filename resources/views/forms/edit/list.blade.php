@extends('forms.layout')

@section('form-panel')
	<ul class="list-group p-0">

		<li class="list-group-item text-center">
			{{__('words.QUESTION_TYPE')}} : {{__("words.LIST")}}
		</li>
		@include('forms.li.title')
		@include('forms.li.description')
		<li class="list-group-item">
			<div class="pos-relative">
				{{__('words.CHOICES')}}
				<i class="fa fa-question-circle mirror-rotate mr-1" aria-hidden="true" href="#" data-toggle="popover" data-content="{{__('messages.SEPERATE_CHOICES_BY_ENTER')}}" data-placement="left" data-trigger="hover"></i>
			</div>
			<div class="form-group mt-3">
				<textarea name="choices" id="enter-choices" rows="4" class="form-control" placeholder="{{__('words.ENTER_CHOICES')}}...">{{$question->list_text()}}</textarea>
				<small class="hidden"> <i class="fa fa-asterisk ml-1"></i> {{__('messages.LIST_HELP')}}</small>
			</div>
		</li>
		@include('forms.li.file')
		@include('forms.li.required')
		@include('forms.li.random')
		<li class="list-group-item">
			<div class="pos-relative">
				{{__('words.ALPHABET_ORDER')}}
				@include('forms.partials.toggle', ['name'=>'alphabet', 'checked'=>$question->alphabet])
			</div>
		</li>
	</ul>
@endsection

@section('form-body')
	<div id="preview" class="@unless($question->id) hidden @endunless">
		@include('forms.displays.title')
		@include('forms.displays.description')
		@include('forms.displays.file')
		<div class="porsline-select">
			<label class="fa fa-angle-down fa-2x" for="search"></label>
			<input type="text" id="search" class="porsline porsline-input" autocomplete="off" placeholder="{{__('words.CHOOSE_OR_TYPE_ANSWER')}}...">
			<div class="porsline-select-dropdown">
				@foreach ($question->assets as $asset)
					<p>{{$asset->content}}</p>
				@endforeach
			</div>
		</div>
	</div>
@endsection
