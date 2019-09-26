@extends('forms.layout')

@section('form-panel')
	<ul class="list-group p-0">

		<li class="list-group-item p-0">
			<div class="action-li" data-toggle="collapse" data-target="#collapse-theme">
				<h5> {{__('words.CHOOSE_FORM_THEME')}} </h5>
				<p class="text-muted m-0"> {{__('words.CLICK_TO_SEE_THEMES')}} </p>
				<i class="fa fa-chevron-down"></i>
			</div>
			<div class="collapse" id="collapse-theme">
				<form class="p-4 text-center" action="{{url("forms/$form->id")}}" method="post" id="change-theme">

					@csrf
					@method('PUT')
					<div class="row justify-content-center">
						@for ($i = 1; $i <= 14; $i++)
							<div class="col-4 my-1">
								<div class="preview-theme preview-theme-{{$i}} @if($i == $form->theme) active @endif" data-theme="{{$i}}">
									{{__('words.QUESTION_BODY')}}
									<br>
									{{__('words.ANSWER')}}
									<br>
									<span></span>
								</div>
							</div>
						@endfor
					</div>

					<input type="hidden" name="update[theme]" value="{{$form->theme}}" id="form-theme">

				</form>
			</div>
		</li>

		<li class="list-group-item p-0">
			<div class="action-li" data-toggle="collapse" data-target="#collapse-bg">
				<h5> {{__('words.CHOOSE_BG_IMG')}} </h5>
				<p class="text-muted m-0"> {{__('words.CHOOSE_BG_IMG_INFO')}} </p>
				<i class="fa fa-chevron-down"></i>
			</div>
			<div class="collapse" id="collapse-bg">
				<form class="p-4 text-center" action="{{url("forms/$form->id")}}" method="post" enctype="multipart/form-data">

					@csrf
					@method('PUT')
					<div class="custom-file mb-3">
						<input type="file" name="bg_image" class="custom-file-input" id="change-form-bg">
						<label class="custom-file-label" for="change-form-bg" data-content="{{__('words.SELECT')}}"> {{__('words.CHOOSE_FILE')}} </label>
					</div>

					<button type="submit" class="btn btn-primary m-1"> {{__('words.SAVE_CHANGES')}} </button>
					@if ($form->bg_image)
						<button type="submit" class="btn btn-danger m-1" name="delete_bg" value="1"> {{__('words.DELETE_BG_IMG')}} </button>
					@endif

				</form>
			</div>
		</li>

	</ul>
@endsection

@section('form-body')
	<iframe src="{{url("form/$form->uid?p=1&t=1")}}" class="preview-iframe"></iframe>
	<div class="p-3">

		<button type="button" class="btn btn-primary mx-1 px-3 py-2 float-right" data-toggle="popover" data-content="{{__('words.RELOAD')}}" data-placement="top" data-trigger="hover" onclick="location.reload()">
			<i class="fa fa-refresh"></i>
		</button>

		<button type="submit" class="btn btn-primary mx-1 px-3 py-2 float-left" form="change-theme">
			{{__('words.SAVE_CHANGES')}}
		</button>
		<button type="button" class="btn btn-primary mx-1 px-3 py-2 float-left" onclick="location.reload()">
			{{__('words.BACK_TO_PREV')}}
		</button>

	</div>
@endsection
