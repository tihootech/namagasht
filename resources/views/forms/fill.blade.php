@extends('layouts.namagasht')
@section('main')

	@if ($question)
		<form action="{{url("form/fill/$form->id/$question->id")}}" method="post">
			@csrf

			<div id="preview">

				@if ($question->type == 'welcome_page')

					<input type="hidden" name="position" value="welcome_page">
					<div class="text-center">
						@include('forms.displays.file')
						<h2 data-yield="title" class="mt-2">{{$question->title}}</h2>
						@include('forms.displays.description')
					</div>

				@elseif ($question->type == 'thanks_page')
					<input type="hidden" name="position" value="thanks_page">
				@else
					<div class="alert alert-success">
						نمایش سوالات در دست ساخت
					</div>
					<input type="hidden" name="position" value="{{$question->position}}">
				@endif

				<div class="fill-form-footer">
					@if ($question->type == 'welcome_page')
						<button type="submit" class="btn btn-primary">{{$question->button ?? __('words.CONFIRM')}}</button>
					@endif
				</div>

			</div>

		</form>
	@else
		<div class="alert alert-danger m-5">
			{{__('messages.NO_WELCOME_PAGE_ERROR')}}
		</div>
	@endif

@endsection
