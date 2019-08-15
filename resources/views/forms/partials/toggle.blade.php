<span class="stick-left">
	<label class="switch">
		<input type="hidden" name="availables[{{$name}}]" value="0">
		<input type="checkbox" name="availables[{{$name}}]" value="1"
			@isset($target) onclick="toggle('{{$target}}')" @endisset
			@if($checked) checked @endif
		>
		<span class="slider round"></span>
	</label>
</span>
