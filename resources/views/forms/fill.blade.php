@extends('layouts.namagasht')

@section('main')

	@if (session('finished'))

		<div class="alert alert-success m-2 m-md-5">
			{{__('messages.FORM_FILLING_PROCESS_FINISHED')}}
			<hr>
			<a href="javascript:location.reload(true)" class="btn btn-success">{{__('words.RELOAD_FORM')}}</a>
		</div>

	@elseif ($question)

		<form action="{{url("form/fill/$form->id/$question->id")}}" method="post" enctype="multipart/form-data">
			@csrf
			<input type="hidden" name="theme" value="{{session('theme')}}" id="form-theme-hidden-input">
			@if ($preview)
				<input type="hidden" name="preview" value="1">
			@endif

			<div class="theme-container theme-{{session('theme') ?? $form->theme}}" @if($form->bg_image) style="background:url('{{asset($form->bg_image)}}')" @endif>

				@if ($preview && !request('t'))
					<div class="alert alert-warning alert-dismissible fade show">
						{{__('messages.FORM_PREVIEW')}} <a href="{{url("form/$form->uid")}}">{{__('words.DO_CLICK')}}</a>
						<button type="button" class="close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				@endif

				<div class="fill-form-body">

					@if ($question->type == 'welcome_page')

						<div class="text-center">
							@include('forms.displays.file')
							<h2 data-yield="title" class="mt-2">{{$question->title}}</h2>
							@include('forms.displays.description')
						</div>

					@elseif ($question->type == 'thanks_page')

						<div class="text-center">
							@include('forms.displays.file')
							<h2 data-yield="title" class="mt-2">{{$question->title}}</h2>
							@include('forms.displays.description')
						</div>

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
									<p @if($question->vertical) style="width:100%" @endif data-value="{{$asset->content}}">
										<span>{{$i+1}}</span> {{$asset->content}}
										<i class="fa fa-check @unless($asset->is_checked(session('filler_uid'))) hidden @endunless"></i>
									</p>
								@endforeach
							</div>
							<input type="hidden" name="answer" value="{{$question->raw_answer(session('filler_uid'))}}">
							<button type="submit" class="btn btn-primary mt-4" name="dir" value="next"> {{__('words.CONFIRM')}} </button>
						@endif

						@if ($question->type == 'list')
							<textarea class="hidden" id="enter-choices">{{$question->list_text()}}</textarea>
							@include('forms.displays.title')
							@include('forms.displays.description')
							@include('forms.displays.file')
							<div class="porsline-select">
								<label class="fa fa-angle-down fa-2x" for="search"></label>
								<input type="text" id="search" class="porsline porsline-input" autocomplete="off" name="answer" placeholder="{{__('words.CHOOSE_OR_TYPE_ANSWER')}}..." value="{{$question->raw_answer(session('filler_uid'))}}">
								<div class="porsline-select-dropdown">
									@foreach ($question->assets as $asset)
										<p>{{$asset->content}}</p>
									@endforeach
								</div>
							</div>
							<button type="submit" class="btn btn-primary mt-4" name="dir" value="next"> {{__('words.CONFIRM')}} </button>
						@endif

						@if ($question->type == 'range')
							@include('forms.displays.title')
							@include('forms.displays.description')
							@include('forms.displays.file')
							<div class="porsline-range">
								<div class="display-range">
									@for ($i = $question->range_start(); $i <= $question->range_end(); $i++)
										<span class="@if($i==$question->range_start() || $i==$question->range_end() || $i==$question->range_middle()) label @endif @if($i==$question->raw_answer(session('filler_uid'))) selected @endif" data-value="{{$i}}">
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
							<input type="hidden" name="answer" id="range-answer" value="{{$question->raw_answer(session('filler_uid'))}}">
							<button type="submit" class="btn btn-primary mt-4" name="dir" value="next"> {{__('words.CONFIRM')}} </button>
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
							<input type="hidden" name="answer" id="levelize-answer" value="{{$question->raw_answer(session('filler_uid'))}}">
							<button type="submit" class="btn btn-primary mt-4" name="dir" value="next"> {{__('words.CONFIRM')}} </button>
						@endif

						@if ($question->type == 'priority')
							@include('forms.displays.title')
							<p class="m-0">({{__('messages.PERIORITY_HELP')}})</p>
							@include('forms.displays.description')
							@include('forms.displays.file')
							<div class="periority-display mt-4">
								@foreach ($question->assets as $i => $asset)
									<p>
										<input type="hidden" name="answer[]" value="{{$asset->content}}">
										<i class="fa fa-exchange"></i> <span>{{$i+1}}</span> {{$asset->content}}
									</p>
								@endforeach
							</div>
						@endif

						@if ($question->type == 'upload_file')
							@include('forms.displays.title')
							@include('forms.displays.description')
							@include('forms.displays.file')
							<br>
							<div class="custom-file mt-3 w-25">
								<input type="file" name="answer" class="custom-file-input" id="user-file">
								<label class="custom-file-label" for="user-file" data-content="{{__('words.SELECT')}}">
									<span id="choose"> {{__('words.CHOOSE_FILE')}} </span>
									<span id="change" class="hidden"> {{__('words.CHANGE_FILE')}} </span>
								</label>
								<span class="text-success hidden"> {{__('words.FILE_SELECTED')}} </span>
							</div>
						@endif

					@endif

				</div>

				<div class="fill-form-footer">
					@if ($question->type == 'welcome_page')
						<button type="submit" name="dir" value="next" class="btn btn-primary">{{$question->button ?? __('words.CONFIRM')}}</button>
					@elseif ($question->type == 'thanks_page')
						<a href="{{url("form/$form->uid")}}" class="btn btn-primary py-2">{{__('words.REVIEW')}}</a>
						<button type="submit" name="dir" value="next" class="btn btn-primary py-2"> {{__('words.FINAL_REGISTER')}} </button>
					@else
						<div class="container">
							<div class="row">
								<div class="col-md-6 text-right">
									@if (!$form->no_back && $question->prev())
										<button type="submit" name="dir" value="prev" class="btn btn-primary py-2"> {{__('words.PREV')}} </button>
									@endif
									@if (!$form->no_next && $question->next())
										<button type="submit" name="dir" value="next" class="btn btn-primary py-2"> {{__('words.NEXT')}} </button>
									@endif
									@if (!$form->has_thanks_page() && $question->last())
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
