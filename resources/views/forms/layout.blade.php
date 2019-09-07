@extends('layouts.namagasht')
@section('main')

	<header class="form-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-3">
					<a class="btn btn-link" href="{{$fragment=='main' ? url("forms") : url("forms/$form->id/edit")}}">
						<i class="fa fa-arrow-right text-light fa-2x"></i>
					</a>
					<input type="text" name="name" value="{{$form->name}}" class="edit-form-header-input">
				</div>
				<div class="col-md-6 align-self-end">
					<ol class="header-panel">
						<li class="active"><a href="#"> {{__('words.CREATE')}} </a></li>
						<li><a href="#"> {{__('words.DESIGN')}} </a></li>
						<li><a href="#"> {{__('words.SETTINGS')}} </a></li>
						<li><a href="#"> {{__('words.SEND')}} </a></li>
						<li><a href="#"> {{__('words.REPORT')}} </a></li>
					</ol>
				</div>
				<div class="col-md-3">
					<a class="btn btn-outline-primary" href="{{url("forms/$form->id")}}"> {{__('words.PREVIEW')}} </a>
				</div>
			</div>
		</div>
	</header>

	<section>
		<div class="form-panel">
			<form id="form-maker" action="{{url("questions")}}" enctype="multipart/form-data" method="post">

				@csrf
				<input type="hidden" id="fragment-type" name="type" value="{{$fragment}}">
				<input type="hidden" name="form_id" value="{{$form->id}}">
				<input type="hidden" name="question_id" value="{{$question->id}}">

				@yield('form-panel')

			</form>
		</div>
		@if ($fragment == 'main')
			<div class="form-panel-footer">
				<span> {{__('messages.REGISTER_HIDDEN_INFO')}} </span>
				<i class="fa fa-question-circle mirror-rotate mr-1" data-toggle="popover" data-content="{{__('messages.REGISTER_HIDDEN_INFO_POPOVER')}}" data-placement="top" data-trigger="hover" data-original-title="" title=""></i>
				<span class="float-left">
					<label class="switch">
						<input type="checkbox" name="hidden_info" value="1"
							@if(false) checked @endif
						>
						<span class="slider round"></span>
					</label>
				</span>
			</div>
		@else
			<div class="form-panel-actions">
				<a class="btn btn-link text-light" href="{{url("forms/$form->id/edit")}}"> {{__('words.CANCEL')}} </a>
				<button form="form-maker" class="btn btn-primary" href="{{url("forms/$form->id/edit")}}"> {{__('words.SAVE')}} </button>
			</div>
		@endif
		<div class="form-body @if($fragment == 'main') form-main @else form-preview @endif">
			@yield('form-body')
		</div>
	</section>

@endsection
