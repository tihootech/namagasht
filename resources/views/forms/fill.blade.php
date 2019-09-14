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

						@if ($question->type == 'quiz' || $question->type == 'quiz_with_picture')
							@include('forms.displays.title')
							@include('forms.displays.description')
							@include('forms.displays.file')
							<div id="display-choices" data-multiple="{{$question->multiple ? 'true' : 'false'}}" data-vertical="{{$question->vertical ? 'true' : 'false'}}">
								@foreach ($question->assets as $i => $asset)
									<p @if($question->vertical) style="width:100%" @endif> <span>{{$i+1}}</span> {{$asset->content}} <i class="fa fa-check"></i> </p>
								@endforeach
							</div>
						@endif

						@if ($question->type == 'list')
							<textarea class="hidden" id="enter-choices">{{$question->list_text()}}</textarea>
							@include('forms.displays.title')
							@include('forms.displays.description')
							@include('forms.displays.file')
							<div class="porsline-select">
								<label class="fa fa-angle-down fa-2x" for="search"></label>
								<input type="text" id="search" class="porsline porsline-input" placeholder="{{__('words.CHOOSE_OR_TYPE_ANSWER')}}...">
								<div class="porsline-select-dropdown">
									@foreach ($question->assets as $asset)
										<p>{{$asset->content}}</p>
									@endforeach
								</div>
							</div>
						@endif

						@if ($question->type == 'range')
							@include('forms.displays.title')
							@include('forms.displays.description')
							@include('forms.displays.file')
							<div class="porsline-range">
								<div class="display-range">
									@for ($i = $question->range_start(); $i <= $question->range_end(); $i++)
										<span @if($i==$question->range_start() || $i==$question->range_end() || $i==$question->range_middle()) class="label" @endif>
											{{$i}}
										</span>
									@endfor
								</div>
								<div class="row display-range-footer mt-3">
									<span class="col-4 range-label-right">
										{{$question->right_label ?? $question->range_start()}}
									</span>
									<span class="col-4 text-center range-label-center">{{$question->range_middle() ? $question->center_label : null}}</span>
									<span class="col-4 text-left range-label-left">
										{{$question->left_label ?? $question->range_end()}}
									</span>
								</div>
							</div>
						@endif

						@if ($question->type == 'levelize')
							@include('forms.displays.title')
							@include('forms.displays.description')
							@include('forms.displays.file')
							<div class="porsline-degree mt-4" data-icon="{{$question->shape ?? 'star'}}">
								@for ($i = $question->range_start(); $i <= $question->range_end(); $i++)
									<p data-index="{{$i}}"> <i class="fa fa-{{$question->shape ?? 'star'}}-o"></i> <span>{{$i}}</span> </p>
								@endfor
							</div>
						@endif

						@if ($question->type == 'priority')
							@include('forms.displays.title')
							<p class="m-0">({{__('messages.PERIORITY_HELP')}})</p>
							@include('forms.displays.description')
							@include('forms.displays.file')
							<div class="periority-display mt-4">
								@foreach ($question->assets as $i => $asset)
									<p> <i class="fa fa-exchange"></i> <span>{{$i+1}}</span> {{$asset->content}} </p>
								@endforeach
							</div>
						@endif

						@if ($question->type == 'upload_file')
							@include('forms.displays.title')
							@include('forms.displays.description')
							@include('forms.displays.file')
							<br>
							<div class="custom-file mt-3 w-25">
								<input type="file" name="user_file" class="custom-file-input" id="user-file">
								<label class="custom-file-label" for="user-file" data-content="{{__('words.SELECT')}}"> {{__('words.CHOOSE_FILE')}} </label>
							</div>
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
									@if ($question->last())
										<button type="submit" name="dir" value="next" class="btn btn-primary py-2"> {{__('words.FINAL_REGISTER')}} </button>
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
