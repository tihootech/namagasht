<h4>
	@unless(isset($no_icon))
		<i class="fa fa-arrow-left"></i>
	@endunless
	<span data-yield="title">
		{{$question->title}}
		@if ($question->required)
			<i class="fa fa-asterisk text-danger"></i>
		@endif
	</span>
</h4>
