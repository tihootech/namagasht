@isset($form)
	@foreach ($form->questions as $question)
		@if ($question->range || $question->assets->count())
			@include('forms.partials.chart', ['chart_type' => 'line'])
			@include('forms.partials.chart', ['chart_type' => 'bar'])
			@include('forms.partials.chart', ['chart_type' => 'pie'])
		@endif
	@endforeach
@endisset
