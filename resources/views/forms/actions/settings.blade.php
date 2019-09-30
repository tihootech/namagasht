@extends('forms.layout')

@section('form-panel')

	<div class="nav flex-column nav-pills porsline-pills">
		<a class="nav-link active" data-toggle="pill" href="#base">
			{{__('words.BASE_SETTINGS')}}
		</a>
	</div>


@endsection

@section('form-body')

	<div class="tab-content">

		<div class="tab-pane fade show active" id="base">

			<div class="container py-4">
				<form class="row justify-content-center" action="{{url("forms/$form->id")}}" method="post">
					@csrf
					@method('PUT')

					<div class="w-50">
						<div class="form-group">
							<label for="name"> {{__('words.FORM_NAME')}} </label>
							<input type="text" name="update[name]" id="name" value="{{$form->name}}" class="form-control">
						</div>
						<hr>
						<div class="form-group">
							<span class="ml-2">
								<label class="switch">
									<input type="hidden" name="update[email_informing_form_creator]" value="0">
									<input type="checkbox" name="update[email_informing_form_creator]" value="1" @if($form->email_informing_form_creator) checked @endif>
									<span class="slider round"></span>
								</label>
							</span>
							<label> {{__('words.EMAIL_INFORMING_FORM_CREATOR')}} </label>
						</div>
						<hr>
						<div class="form-group">
							<span class="ml-2">
								<label class="switch">
									<input type="hidden" name="update[email_informing_answerer]" value="0">
									<input type="checkbox" name="update[email_informing_answerer]" value="1" @if($form->email_informing_answerer) checked @endif>
									<span class="slider round"></span>
								</label>
							</span>
							<label> {{__('words.EMAIL_INFORMING_ANSWERER')}} </label>
						</div>
						<hr>
						<div class="form-group">
							<span class="ml-2">
								<label class="switch">
									<input type="hidden" name="update[no_back]" value="0">
									<input type="checkbox" name="update[no_back]" value="1" @if($form->no_back) checked @endif>
									<span class="slider round"></span>
								</label>
							</span>
							<label> {{__('words.NO_BACK_BTN')}} </label>
						</div>
						<hr>
						<div class="form-group">
							<span class="ml-2">
								<label class="switch">
									<input type="hidden" name="update[no_next]" value="0">
									<input type="checkbox" name="update[no_next]" value="1" @if($form->no_next) checked @endif>
									<span class="slider round"></span>
								</label>
							</span>
							<label> {{__('words.NO_NEXT_BTN')}} </label>
						</div>
						<hr>
						<div class="form-group">
							<span class="ml-2">
								<label class="switch">
									<input type="hidden" name="update[no_progress_bar]" value="0">
									<input type="checkbox" name="update[no_progress_bar]" value="1" @if($form->no_progress_bar) checked @endif>
									<span class="slider round"></span>
								</label>
							</span>
							<label> {{__('words.NO_PROGRESS_BAR')}} </label>
						</div>
						<hr>

						<div class="text-center">
							<button type="submit" class="btn btn-primary"> {{__('words.CONFIRM')}} </button>
						</div>
					</div>



				</form>
			</div>

		</div>

	</div>

@endsection
