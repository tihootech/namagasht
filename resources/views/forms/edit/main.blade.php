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

		<div id="welcome-page" class="mb-5">
			@if ($form->has_welcome_page())
				<div class="white-card white-card-header" onclick="redirect('{{url("forms/$form->id/edit?f=welcome_page&qid={$form->welcome_page->id}")}}')">
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

		<div id="questions" class="mb-5">
			@foreach ($form->questions as $question)
				<div class="white-card">
					<div class="container">
						<div class="row">
							<div class="col-md-8">
								<a href="{{url("forms/$form->id/edit?f=$question->type&qid={$question->id}")}}" class="redirect-to-edit py-3">
									{{$question->position}}. {{$question->title}}
								</a>
							</div>
							<div class="col-md-4 text-left py-3 pl-4">
								@if ($question->rules->count())
									<button class="btn btn-outline-success px-2 mx-2 add-points" type="button" data-toggle="collapse" data-target="#add-points-{{$question->id}}" aria-expanded="false" aria-controls="collapseExample">
										{{__('words.EDIT_POINTS')}}
									</button>
								@else
									<button class="btn btn-outline-primary px-2 mx-2 add-points" type="button" data-toggle="collapse" data-target="#add-points-{{$question->id}}" aria-expanded="false" aria-controls="collapseExample">
										{{__('words.ADD_POINTS')}}
									</button>
								@endif
								<a href="#" class="mx-2">
									<i title="{{__('words.DUPLICATE')}}" class="fa fa-clone text-primary"></i>
								</a>
								<a href="{{url("questions/{$question->id}/delete")}}" class="mx-2">
									<i title="{{__('words.DELETE')}}" class="fa fa-trash text-danger"></i>
								</a>
								<a href="#" class="mx-2">
									<i title="{{__('words.MOVE')}}" class="fa fa-exchange text-dark rotate"></i>
								</a>
							</div>
						</div>
					</div>
					<form class="collapse" action="{{url("form/point_rule/$question->id")}}" method="post" id="add-points-{{$question->id}}">
						@csrf
						<div class="card mt-3">
							<div class="card-body" id="clone-container" data-min="1">
								@foreach ($question->rules->count() ? $question->rules : [ new \App\QuestionPointRule ] as $rule)
									<div class="form-inline my-2 clone-row">
										<label for="type" class="mx-1"> <small> {{__('words.IF_USER_ANSWER')}} </small> </label>
										<select class="form-control mx-1" name="type[]" id="type" required>
											<option @if($rule->type == '==') selected @endif value="=="> {{__('words.EQUALS')}} </option>
											<option @if($rule->type == '!=') selected @endif value="!="> {{__('words.NOT_EQUALS')}} </option>
											<option @if($rule->type == '<') selected @endif value="<"> {{__('words.LESS_THAN')}} </option>
											<option @if($rule->type == '>') selected @endif value=">"> {{__('words.GREATER_THAN')}} </option>
											<option @if($rule->type == '>=') selected @endif value=">="> {{__('words.GREATER_THAN_OR_EQUAL')}} </option>
											<option @if($rule->type == '<=') selected @endif value="<="> {{__('words.LESS_THAN_OR_EQUAL')}} </option>
										</select>
										@if (count($question->assets))
											<select class="form-control mx-1" name="value[]" required>
												@foreach ($question->assets as $asset)
													<option @if($asset->content == $rule->value) selected @endif>{{$asset->content}}</option>
												@endforeach
											</select>
										@elseif($question->range)
											<select class="form-control mx-1" name="value[]" required>
												@for ($i = $question->range_start(); $i <= $question->range_end(); $i++)
													<option @if($i == $rule->value) selected @endif>{{$i}}</option>
												@endfor
											</select>
										@else
											<input type="text" class="form-control mx-1" name="value[]" value="{{$rule->value}}" required>
										@endif
										<label for="action" class="mx-1"> <small> {{__('words.THEN_USER_POINTS')}} </small> </label>
										<select class="form-control mx-1" name="action[]" id="action">
											<option @if($rule->action == '+') selected @endif value="+"> {{__('words.DO_ADDITION')}} </option>
											<option @if($rule->action == '-') selected @endif value="-"> {{__('words.DO_SUBTRACTION')}} </option>
											<option @if($rule->action == '*') selected @endif value="*"> {{__('words.DO_MULTIPLICATION')}} </option>
											<option @if($rule->action == '/') selected @endif value="/"> {{__('words.DO_DIVISION')}} </option>
										</select>
										<input type="number" class="form-control mx-1" name="target[]" value="{{$rule->target}}" required>
										<a href="#" class="mx-1" data-clone-action="clone">
											<i class="fa fa-plus text-success"></i>
										</a>
										<a href="#" class="mx-1" data-clone-action="unclone">
											<i class="fa fa-times text-danger"></i>
										</a>
									</div>
								@endforeach
							</div>
							<div class="card-footer">
								<button type="submit" class="btn btn-primary mx-2"> {{__('words.SAVE')}} </button>
								<button type="button" class="btn btn-outline-primary mx-2" data-toggle="collapse" data-target="#add-points-{{$question->id}}"> {{__('words.DISMISS')}} </button>
							</div>
						</div>
					</form>
				</div>
			@endforeach
			<div class="question-type mt-3">
				{{__('messages.DRAG_QUESTION_TYPE')}}
			</div>
		</div>

		<div id="thanks-page" class="mb-5">
			@if ($form->has_thanks_page())
				<div class="white-card white-card-footer" onclick="redirect('{{url("forms/$form->id/edit?f=thanks_page&qid={$form->thanks_page->id}")}}')">
					<i class="fa fa-sign-in text-primary mirror-rotate ml-2"></i>
					<span>{{$form->thanks_page->title}}</span>
					<a href="{{url("questions/{$form->thanks_page->id}/delete")}}"> <i class="fa fa-trash text-dark float-left"></i> </a>
				</div>
			@else
				<div class="header-footer">
					{{__('messages.DRAG_THANKS_PAGE')}}
				</div>
			@endif
		</div>

	</div>
@endsection
