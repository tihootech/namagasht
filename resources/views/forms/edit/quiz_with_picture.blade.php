@extends('forms.layout')

@section('form-panel')
	<ul class="list-group p-0">
		<li class="list-group-item text-center">
			نوع سوال : {{__('words.QUIZ_WITH_PICTURE')}}
		</li>
	</ul>
	<div class="text-center p-5">
		انجام نشده...
	</div>
@endsection

@section('form-body')
	<div id="preview">

	</div>
@endsection
