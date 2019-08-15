@extends('forms.layout')

@section('form-panel')
	<div class="form-options">
		<a href="{{url("forms/$form->id/edit?f=welcome_page")}}"> {{__('words.WELCOME_PAGE')}} </a>
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
		<a href="{{url("forms/$form->id/edit?f=thanks_page")}}"> {{__('words.THANKS_PAGE')}} </a>
	</div>
@endsection

@section('form-body')
	<div class="form-map">
		<div class="">
			{{__('messages.DRAG_WELCOME_PAGE')}}
		</div>

		<div class="">
			{{__('messages.DRAG_QUESTION_TYPE')}}
		</div>

		<div class="">
			{{__('messages.DRAG_THANKS_PAGE')}}
		</div>
	</div>
@endsection
