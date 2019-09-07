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
				<textarea name="title" id="question" rows="3" class="form-control" placeholder="{{__('words.QUESTION_BODY')}}...">{{null}}</textarea>
			</div>
		</li>
		<li class="list-group-item">
			<div class="pos-relative">
				{{__('words.DESCRIPTION')}}
				@include('forms.partials.toggle', ['target' => 'description-div', 'name'=>'description', 'checked'=>false])
			</div>
			<div class="form-group mt-3 hidden" id="description-div">
				<textarea name="description" id="description" rows="4" class="form-control" placeholder="{{__('words.DESCRIPTION')}}...">{{null}}</textarea>
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
								<input type="text" class="form-control choices" name="choices[]" value="{{null}}">
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
					<input type="file" class="custom-file-input" id="file">
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
		<li class="list-group-item">
			<div class="pos-relative">
				{{__('words.VERTIVAL_CHOICES')}}
				@include('forms.partials.toggle', ['name'=>'vertical', 'checked'=>false])
			</div>
		</li>
		<li class="list-group-item">
			<div class="pos-relative">
				{{__('words.MULTIPLE_CHOICE_QUESTION')}}
				@include('forms.partials.toggle', ['name'=>'multiple_choice', 'target'=>'multiple-chices', 'checked'=>false])
			</div>
			<div class="form-group hidden mt-3" id="multiple-chices">
				<label for="choices"> <small class="text-muted"> {{__('words.USER_MAX_CHOICES')}} </small> </label>
				<input type="number" id="choices" name="choices" class="form-control w-25" value="{{null}}">
			</div>
		</li>
	</ul>
@endsection

@section('form-body')
	<div id="preview" class="hidden">
		<h4> <i class="fa fa-arrow-left"></i> <span data-yield="question"></span> </h4>
		<p data-yield="description" class="m-0"></p>
		<img src="" alt="" data-yield="image" class="preview-img">
		<div id="display-choices" data-multiple="false" data-vertical="false">
			{{-- will be updated via jquery --}}
		</div>
	</div>
@endsection
