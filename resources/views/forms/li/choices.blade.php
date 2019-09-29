<li class="list-group-item">
	<div class="pos-relative">
		{{__('words.CHOICES')}}
	</div>
	<div class="form-group mt-3">
		<div class="container-fluid choices-sortable" id="clone-container">
			@for ($i=1; $i <= $question->assets_count_or_two(); $i++)
				<div class="row align-items-center clone-row my-2 display-choices-row" data-index="{{$i}}">
					<input type="hidden" name="choices_id[]" value="{{$question->get_asset_id($i)}}">
					<div class="col-1 draggable">
						<i class="fa fa-arrows-v fa-half-x"></i>
					</div>
					<div class="col-1">
						<strong class="increment">{{$i}}</strong>
					</div>
					<div class="col-{{$fragment=='quiz_with_picture'?'6':'7'}}">
						<input type="text" class="form-control {{$fragment == 'priority' ? 'periorities' : 'choices'}}" name="choices[]" value="{{$question->get_asset_content($i)}}">
					</div>
					@if ($fragment=='quiz_with_picture')
						<div class="col-1">
							<label class="fa fa-half-x fa-upload text-primary pointer mt-1 choice-file-upload"></label>
							<input type="file" name="choices_file[]" class="hidden" onchange="appendPreviewImg(this)">
						</div>
					@endif
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
