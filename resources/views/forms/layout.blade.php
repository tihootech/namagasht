@extends('layouts.namagasht')
@section('main')

	<header class="form-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-3">
					<a class="btn btn-link" href="{{$fragment=='main' ? url("forms") : url("forms/$form->id/edit")}}">
						<i class="fa fa-arrow-right text-light fa-2x"></i>
					</a>
					<form class="d-inline" action="{{url("forms/$form->id")}}" method="post">
						@csrf
						@method('PUT')
						<input type="text" name="update[name]" value="{{$form->name}}" class="edit-form-header-input">
					</form>
				</div>
				<div class="col-md-6 align-self-end">
					<ol class="header-panel">
						<li @if($action == 'edit') class="active" @endif>
							<a href="{{url("forms/$form->id/edit")}}"> {{__('words.CREATE')}} </a>
						</li>
						<li @if($action == 'design') class="active" @endif>
							<a href="{{url("form/$form->id/action/design")}}"> {{__('words.DESIGN')}} </a>
						</li>
						<li @if($action == 'settings') class="active" @endif>
							<a href="{{url("form/$form->id/action/settings")}}"> {{__('words.SETTINGS')}} </a>
						</li>
						<li @if($action == 'report') class="active" @endif>
							<a href="{{url("form/$form->id/action/report")}}"> {{__('words.REPORT')}} </a>
						</li>
					</ol>
				</div>
				<div class="col-md-3">
					<a class="btn btn-outline-primary" href="{{url("form/$form->uid?p=1")}}" target="_blank"> {{__('words.PREVIEW')}} </a>
				</div>
			</div>
		</div>
	</header>

	<section>
		@if ($action == 'edit')

			{{-- EDIT --}}
			<div class="form-panel">
				<form id="form-maker" action="{{url("questions")}}" enctype="multipart/form-data" method="post">

					@csrf
					<input type="hidden" id="fragment-type" name="type" value="{{$fragment}}">
					<input type="hidden" name="form_id" value="{{$form->id}}">
					@unless ($duplicate)
						<input type="hidden" name="question_id" value="{{$question->id}}">
					@endunless

					@yield('form-panel')

				</form>
			</div>
			@if ($fragment == 'main')
				<div class="form-panel-footer">
					<span> {{__('messages.REGISTER_HIDDEN_INFO')}} </span>
					<i class="fa fa-question-circle mirror-rotate mr-1" data-toggle="popover" data-content="{{__('messages.REGISTER_HIDDEN_INFO_POPOVER')}}" data-placement="top" data-trigger="hover"></i>
					<form class="d-inline" action="{{url("forms/$form->id")}}" method="post">
						@csrf
						@method('PUT')
						<span class="float-left">
							<label class="switch">
								<input type="hidden" name="update[hidden_inputs]" value="0">
								<input type="checkbox" name="update[hidden_inputs]" value="1" onchange="$(this).parents('form').submit()"
									@if($form->hidden_inputs) checked @endif >
								<span class="slider round"></span>
							</label>
						</span>
					</form>
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

		@else

			{{-- ACTIONS --}}
			<div class="form-panel bottom-0">
				@yield('form-panel')
			</div>

			<div class="form-body">
				@yield('form-body')
			</div>

		@endif
	</section>

@endsection
