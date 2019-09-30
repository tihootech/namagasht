<script>
	var ctx = document.getElementById('question-chart-{{$chart_type}}-{{$question->id}}').getContext('2d');
	var myChart = new Chart(ctx, {
		type: '{{$chart_type}}',
		data: {
			labels: [
				@if($question->assets->count())
					@foreach ($question->assets as $asset)
						'{{$asset->content}}',
					@endforeach
				@elseif($question->range)
					@for($i=$question->range_start(); $i<=$question->range_end(); $i++)
						'{{$i}}',
					@endfor
				@endif
			],
			datasets: [{
				label: '{{__('words.ABUNDANCE')}}',
				data: [
					@if($question->assets->count())
						@foreach ($question->assets as $asset)
							'{{ $question->count_answers($asset->content) }}',
						@endforeach
					@elseif($question->range)
						@for($i=$question->range_start(); $i<=$question->range_end(); $i++)
							'{{ $question->count_answers($i) }}',
						@endfor
					@endif
				],
				backgroundColor: [
					@if($question->assets->count())
						@foreach ($question->assets as $asset)
							'{{random_rgba('0.4')}}',
						@endforeach
					@elseif($question->range)
						@for($i=$question->range_start(); $i<=$question->range_end(); $i++)
							'{{random_rgba('0.4')}}',
						@endfor
					@endif
				],
				borderColor: [
					@if($question->assets->count())
						@foreach ($question->assets as $asset)
							'#35404B',
						@endforeach
					@elseif($question->range)
						@for($i=$question->range_start(); $i<=$question->range_end(); $i++)
							'#35404B',
						@endfor
					@endif
				],
				borderWidth: 2
			}]
		},
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true
					}
				}]
			}
		}
	});
</script>
