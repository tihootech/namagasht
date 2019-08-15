@extends('forms.layout')

@section('form-panel')
	<ul class="list-group p-0">
		<li class="list-group-item text-center">
			نوع سوال : {{__('words.QUIZ')}}
		</li>
		<li class="list-group-item">
			<div class="pos-relative">
				{{__('words.QUESTION')}}
			</div>
			<div class="form-group mt-3">
				<textarea name="question" rows="3" class="form-control" placeholder="{{__('words.QUESTION_BODY')}}...">{{null}}</textarea>
			</div>
		</li>
		<li class="list-group-item">
			<div class="pos-relative">
				{{__('words.DESCRIPTION')}}
				@include('forms.partials.toggle', ['target' => 'description', 'name'=>'description', 'checked'=>false])
			</div>
			<div class="form-group mt-3 hidden" id="description">
				<textarea name="description" rows="4" class="form-control" placeholder="{{__('words.DESCRIPTION')}}...">{{null}}</textarea>
			</div>
		</li>
		<li class="list-group-item">
			<div class="pos-relative">
				{{__('words.CHOICES')}}
			</div>
			<div class="form-group mt-3">
				<div class="container-fluid" id="clone-container">
					@for ($i=1; $i <= 2; $i++)
						<div class="row align-items-center clone-row my-2">
							<div class="col-1">
								<i class="fa fa-arrows-v fa-half-x"></i>
							</div>
							<div class="col-1">
								<strong class="increment">{{$i}}</strong>
							</div>
							<div class="col-7">
								<input type="text" class="form-control" name="choices[]" value="{{null}}">
							</div>
							<div class="col-1">
								<a data-clone-action="clone"> <i class="fa fa-half-x fa-plus-square text-success"></i> </a>
							</div>
							<div class="col-1">
								<a data-clone-action="unclone"> <i class="fa fa-half-x fa-trash text-danger"></i> </a>
							</div>
						</div>
					@endfor
				</div>
				<div class="alert alert-danger hidden" id="unclone-error">
					{{__('messages.AT_LEAST_TWO_CHOICES_ARE_REQUIRED')}}
				</div>
			</div>
		</li>
		<li class="list-group-item">
			<div class="pos-relative">
				{{__('words.IMAGE_OR_VIDEO')}}
				@include('forms.partials.toggle', ['target' => 'file-upload', 'name'=>'image', 'checked'=>false])
			</div>
			<div class="form-group hidden mt-3" id="file-upload">
				<div class="custom-file">
					<input type="file" class="custom-file-input" id="customFile">
					<label class="custom-file-label" for="customFile" data-content="{{__('words.SELECT')}}"> {{__('words.CHOOSE_FILE')}} </label>
				</div>
			</div>
		</li>
		<li class="list-group-item">
			<div class="pos-relative">
				{{__('words.ANSWER_REQUIRED')}}
				@include('forms.partials.toggle', ['name'=>'required', 'checked'=>false])
			</div>
		</li>
		<li class="list-group-item">
			<div class="pos-relative">
				{{__('words.RANDOM_CHOICES')}}
				@include('forms.partials.toggle', ['name'=>'random', 'checked'=>false])
			</div>
		</li>
	</ul>
@endsection

@section('form-body')
	<div id="preview">

	</div>
@endsection
