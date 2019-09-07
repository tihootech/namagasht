<li class="list-group-item">
	<div class="pos-relative">
		{{$label ?? __('words.QUESTION')}}
	</div>
	<div class="form-group mt-3">
		<textarea name="title" id="title" rows="{{$rows??3}}" class="form-control" placeholder="{{$placeholder ?? __('words.QUESTION_BODY')}}...">{{$question->title}}</textarea>
	</div>
	@isset($info)
		<small class="text-muted"> <i class="fa fa-asterisk ml-1"></i> {{$info}} </small>
	@endisset
</li>
