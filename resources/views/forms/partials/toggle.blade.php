<span class="stick-left">
	<label class="switch">
		@isset($name) <input type="hidden" name="{{$name}}" value="0"> @endisset
		<input type="checkbox" @isset($name) name="{{$name}}" id="toggle-{{$name}}" value="1" @endisset
			@isset($target) onclick="toggle('{{$target}}')" @endisset
			@if($checked) checked @endif
		>
		<span class="slider round"></span>
	</label>
</span>
