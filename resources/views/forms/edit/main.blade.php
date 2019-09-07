@extends('forms.layout')

@section('form-panel')
	<div class="form-options">
		<a @if($form->has_welcome_page()) class="disabled" @else href="{{url("forms/$form->id/edit?f=welcome_page")}}" @endif> {{__('words.WELCOME_PAGE')}} </a>
		<a href="{{url("forms/$form->id/edit?f=text")}}"> {{__('words.TEXT')}} </a>
		<a href="{{url("forms/$form->id/edit?f=quiz")}}"> {{__('words.QUIZ')}} </a>
		<a href="{{url("forms/$form->id/edit?f=textarea")}}"> {{__('words.TEXTAREA')}} </a>
		<a href="{{url("forms/$form->id/edit?f=quiz_with_picture")}}"> {{__('words.QUIZ_WITH_PICTURE')}} </a>
		<a href="{{url("forms/$form->id/edit?f=group_question")}}"> {{__('words.GROUP_QUESTION')}} </a>
		<a href="{{url("forms/$form->id/edit?f=list")}}"> {{__('words.LIST')}} </a>
		<a href="{{url("forms/$form->id/edit?f=number")}}"> {{__('words.NUMBER')}} </a>
		<a href="{{url("forms/$form->id/edit?f=range")}}"> {{__('words.RANGE')}} </a>
		<a href="{{url("forms/$form->id/edit?f=email")}}"> {{__('words.EMAIL')}} </a>
		<a href="{{url("forms/$form->id/edit?f=levelize")}}"> {{__('words.LEVELIZE')}} </a>
		<a href="{{url("forms/$form->id/edit?f=link")}}"> {{__('words.LINK')}} </a>
		<a href="{{url("forms/$form->id/edit?f=priority")}}"> {{__('words.PRIORITY')}} </a>
		<a href="{{url("forms/$form->id/edit?f=string_with_no_answer")}}"> {{__('words.STRING_WITH_NO_ANSWER')}} </a>
		<a href="{{url("forms/$form->id/edit?f=upload_file")}}"> {{__('words.UPLOAD_FILE')}} </a>
		<a href="{{url("forms/$form->id/edit?f=thanks_page")}}">
			{{__('words.THANKS_PAGE')}}
			<i class="fa fa-question-circle mirror-rotate mr-1" data-toggle="popover" data-content="{{__('messages.TNX_PAGE_POPOVER')}}" data-placement="top" data-trigger="hover" data-original-title="" title=""></i>
		</a>
	</div>
@endsection

@section('form-body')
	<div class="form-map">

		<div class="mb-5">
			@if ($form->has_welcome_page())
				<div class="white-card">
					<i class="fa fa-sign-in text-primary mirror-rotate ml-2"></i>
					<span>{{$form->welcome_page->title}}</span>
					<a href="{{url("questions/{$form->welcome_page->id}/delete")}}"> <i class="fa fa-trash text-dark float-left"></i> </a>
				</div>
			@else
				<div class="header-footer">
					{{__('messages.DRAG_WELCOME_PAGE')}}
				</div>
			@endif
		</div>

		<div class="mb-5">
			@foreach ($form->questions as $n => $question)
				<div class="white-card">
					<span>{{$n+1}}. {{$question->title}}</span>
					<a href="#"> <i title="{{__('words.MOVE')}}" class="fa fa-exchange text-dark float-left mx-2 rotate"></i> </a>
					<a href="{{url("questions/{$question->id}/delete")}}"> <i title="{{__('words.DELETE')}}" class="fa fa-trash text-dark float-left mx-2"></i> </a>
					<a href="#"> <i title="{{__('words.DUPLICATE')}}" class="fa fa-clone text-dark float-left mx-2"></i> </a>
				</div>
			@endforeach
			<div class="question-type mt-3">
				{{__('messages.DRAG_QUESTION_TYPE')}}
			</div>
		</div>

		<div class="mb-5">
			@if ($form->has_thanks_page())
				<div class="white-card">
					<i class="fa fa-sign-in text-primary mirror-rotate ml-2"></i>
					<span>{{$form->thanks_page->title}}</span>
					<a href="{{url("questions/{$form->welcome_page->id}/delete")}}"> <i class="fa fa-trash text-dark float-left"></i> </a>
				</div>
			@else
				<div class="header-footer">
					{{__('messages.DRAG_THANKS_PAGE')}}
				</div>
			@endif
		</div>

	</div>
@endsection
