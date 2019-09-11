@extends('layouts.namagasht')
@section('main')

	@if (session('finished'))

		<div class="alert alert-success m-2 m-md-5">
			{{__('messages.FORM_FILLING_PROCESS_FINISHED')}}
		</div>

	@elseif ($question)
		<form action="{{url("form/fill/$form->id/$question->id")}}" method="post">
			@csrf

			<div class="p-relative">

				<div class="fill-form-body">

					@if ($question->type == 'welcome_page')

						<div class="text-center">
							@include('forms.displays.file')
							<h2 data-yield="title" class="mt-2">{{$question->title}}</h2>
							@include('forms.displays.description')
						</div>

					@elseif ($question->type == 'thanks_page')

					@else

						@if ($question->type == 'text')
							@include('forms.displays.title')
							@include('forms.displays.description')
							@include('forms.displays.file')
							@include('forms.displays.input', ['placeholder' => __('words.ANSWER_LOCATION'), 'ltr'=>false, 'value'=>$question->raw_answer(session('filler_uid'))])
							<button type="submit" class="btn btn-primary mt-4" name="dir" value="next">{{__('words.CONFIRM')}} </button>
						@endif

						@if ($question->type == 'textarea')
							@include('forms.displays.title')
							@include('forms.displays.description')
							@include('forms.displays.file')
							@include('forms.displays.textarea', ['placeholder' => __('words.ANSWER_LOCATION'), 'value'=>$question->raw_answer(session('filler_uid'))])
							<button type="submit" class="btn btn-primary mt-4" name="dir" value="next">{{__('words.CONFIRM')}} </button>
						@endif

						@if ($question->type == 'number')
							@include('forms.displays.title')
							@include('forms.displays.description')
							@include('forms.displays.file')
							@include('forms.displays.input', ['placeholder' => null, 'ltr'=>true, 'value'=>$question->raw_answer(session('filler_uid'))])
							<button type="submit" class="btn btn-primary mt-4" name="dir" value="next">{{__('words.CONFIRM')}} </button>
						@endif

						@if ($question->type == 'email')
							@include('forms.displays.title')
							@include('forms.displays.description')
							@include('forms.displays.file')
							@include('forms.displays.input', ['placeholder' => 'Email Address', 'ltr'=>true, 'value'=>$question->raw_answer(session('filler_uid'))])
							<button type="submit" class="btn btn-primary mt-4" name="dir" value="next">{{__('words.CONFIRM')}} </button>
						@endif

						@if ($question->type == 'group_question')
							@include('forms.displays.title', ['no_icon'=>true])
							@include('forms.displays.description')
							@include('forms.displays.file')
							<div class="my-2"></div>
							<button type="submit" class="btn btn-primary mt-4" name="dir" value="next"> {{$question->button ?? __('words.CONFIRM')}} </button>
						@endif

						@if ($question->type == 'string_with_no_answer')
							@include('forms.displays.title')
							@include('forms.displays.description')
							@include('forms.displays.file')
							<button type="submit" class="btn btn-primary mt-4" name="dir" value="next"> {{$question->button ?? __('words.CONFIRM')}} </button>
						@endif

						@if ($question->type == 'link')
							@include('forms.displays.title')
							@include('forms.displays.description')
							@include('forms.displays.file')
							@include('forms.displays.input', ['placeholder' => 'URL', 'ltr'=>true, 'value'=>$question->raw_answer(session('filler_uid'))])
							<button type="submit" class="btn btn-primary mt-4" name="dir" value="next"> {{$question->button ?? __('words.CONFIRM')}} </button>
						@endif

					@endif

				</div>

				<div class="fill-form-footer">
					@if ($question->type == 'welcome_page')
						<button type="submit" name="dir" value="next" class="btn btn-primary">{{$question->button ?? __('words.CONFIRM')}}</button>
					@else
						<div class="container">
							<div class="row">
								<div class="col-md-6 text-right">
									@if ($question->prev())
										<button type="submit" name="dir" value="prev" class="btn btn-primary py-2"> {{__('words.PREV')}} </button>
									@endif
									@if ($question->next())
										<button type="submit" name="dir" value="next" class="btn btn-primary py-2"> {{__('words.NEXT')}} </button>
									@endif
								</div>
								<div class="col-md-3 mr-auto">
									<p class="text-right mb-1"> {{__('words.ANSWERED')}} : {{$question->step()}} {{__('words.FROM')}} {{$form->questions_count()}} </p>
									<div class="progress">
										<div class="progress-bar" style="width: {{$percent = $question->step()/$form->questions_count() * 100}}%">
											{{round($percent)}}%
										</div>
									</div>
								</div>
							</div>
						</div>
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
