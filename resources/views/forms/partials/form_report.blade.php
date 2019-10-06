<table class="table table-sm table-hover table-bordered table-striped">

	<thead>
		<tr>
			<th> <i class="fa fa-square-o" data-check="all" data-checked="0"></i> </th>
			<th> {{__('words.FILLER_UID')}} </th>
			<th> {{__('words.FILLER_IP')}} </th>
			@foreach ($form->questions as $question)
				<th> {{$question->title}} </th>
			@endforeach
			<th> {{__('words.START_DATE')}} </th>
			<th> {{__('words.TIME')}} </th>
			<th> {{__('words.POINT')}} </th>
		</tr>
	</thead>
	<tbody>
		@foreach ($fillers ?? $form->fillers as $filler)
			<tr>
				<td> <i class="fa fa-square-o" data-check="{{$filler->id}}" data-checked="0"></i> </td>
				<td> {{$filler->uid}} </td>
				<td> {{$filler->client_ip}} </td>
				@foreach ($form->questions as $question)
					<td>
						@if (strpos($question->raw_answer($filler->uid), '&&&') !== false)
							<ul class="pr-4">
								@foreach (explode('&&&', $question->raw_answer($filler->uid)) as $item)
									<li>{{$item}}</li>
								@endforeach
							</ul>
						@elseif($question->type == 'upload_file')
							@if ($question->raw_answer($filler->uid))
								<a href="{{asset($question->raw_answer($filler->uid))}}" download>
									{{__('words.DOWNLOAD_FILE')}}
								</a>
							@else
								<em> - </em>
							@endif
						@else
							 {{$question->raw_answer($filler->uid)}}
						@endif
					</td>
				@endforeach
				<td> {{pdate($filler->created_at)}} </td>
				<td @if($filler->time) data-toggle="popover" data-content="{{$filler->time.' '.__('words.SECOND')}}" data-placement="top" data-trigger="hover" @endif>
					{{$filler->time ? gmdate("i:s", $filler->time) : __('words.NOT_FINISHED')}}
				</td>
				<td> {{is_null($filler->points) ? __('words.NOT_FINISHED') : $filler->points}} </td>
			</tr>
		@endforeach
	</tbody>

</table>
