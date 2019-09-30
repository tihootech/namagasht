@extends('forms.layout')

@section('form-panel')

	<div class="nav flex-column nav-pills porsline-pills">
		<a class="nav-link @if($page=='elements') active @elseif(!$page) active @endif" data-toggle="pill" href="#elements">
			{{__('words.ANSWERING_ELEMENTS')}}
		</a>
		<a class="nav-link @if($page=='table') active @endif" data-toggle="pill" href="#table"> {{__('words.RESULT_TABLE')}}  </a>
		<a class="nav-link @if($page=='charts') active @endif" data-toggle="pill" href="#charts"> {{__('words.ANALAYSE_AND_CHARTS')}} </a>
	</div>


@endsection

@section('form-body')

	<div class="tab-content">
		<div class="tab-pane fade @if($page=='elements') show active @elseif(!$page) show active @endif" id="elements">

			<div class="p-2 p-md-5">

				<div class="row form-visits-statics">
					<div class="col-md-3">
						<h4> {{$form->visits()}} </h4>
						<p class="text-muted"> {{__('words.FORM_VISITS')}} </p>
					</div>
					<div class="col-md-3">
						<h4> {{$form->answers()}} </h4>
						<p class="text-muted"> {{__('words.ANSWERS')}} </p>
					</div>
					<div class="col-md-3">
						<h4> {{round($form->ratio())}}% </h4>
						<p class="text-muted">
							{{__('words.ANSWER_RATIO')}}
							<i class="fa fa-question-circle mirror-rotate mr-1" data-toggle="popover" data-content="{{__('messages.ANSWER_RATIO_INFO')}}" data-placement="top" data-trigger="hover"></i>
						</p>
					</div>
					<div class="col-md-3">
						<h4> {{$form->answer_average_time()}} </h4>
						<p class="text-muted"> {{__('words.ANSWER_AVERAGE_TIME')}} </p>
					</div>
				</div>

				<hr>
				<h5 class="mb-3"> {{__('words.DEVICES')}} </h5>
				<div class="row justify-content-center form-visits-statics">
					<div class="col-md-4">
						<h5> {{__('words.MOBILE')}} </h5>
						<p class="text-muted my-1"> {{$form->mobile_visits('count')}} </p>
						<p class="text-muted my-1"> {{round($form->mobile_visits('percent'))}}% </p>
					</div>
					<div class="col-md-4">
						<h5> {{__('words.LAPTOP')}} </h5>
						<p class="text-muted my-1"> {{$form->laptop_visits('count')}} </p>
						<p class="text-muted my-1"> {{round($form->laptop_visits('percent'))}}% </p>
					</div>
				</div>

			</div>

		</div>
		<div class="tab-pane fade @if($page=='table') active show @endif" id="table">

			<div class="table-responsive p-2 p-md-5">

				<div class="text-left">
					<button type="button" class="btn btn-primary mx-1 px-3" data-popover="popover" data-content="{{__('words.ADVANCED_SEARCH')}}" data-placement="top" data-trigger="hover" data-toggle="collapse" data-target="#search-in-table">
						<i class="fa fa-search"></i>
					</button>
					<button type="button" class="btn btn-success mx-1 px-3" data-toggle="popover" data-content="{{__('words.EXCEL_OUTPUT')}}" data-placement="top" data-trigger="hover">
						<i class="fa fa-file-excel-o"></i>
					</button>
					<button type="submit" form="checked-ids" class="btn btn-danger mx-1 px-3" data-toggle="popover" data-content="{{__('words.DELETE_ITEMS')}}" data-placement="top" data-trigger="hover">
						<i class="fa fa-trash"></i>
					</button>
				</div>

				<form class="collapse @if(request('search')) show @endif" action="{{url("form/$form->id/action/report/table")}}" id="search-in-table">
					<hr>
					<div class="row justify-content-center">
						<div class="col-md-5">
							<div class="card">
								<div class="card-header">
									{{__('words.SEARCH_ON_DATE')}}
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-6">
											<label for="from"> {{__('words.FROM')}} : </label>
											<input type="text" id="from" class="form-control pdp" name="from" autocomplete="off" value="{{request('from')}}">
										</div>
										<div class="col-6">
											<label for="untill"> {{__('words.UNTILL')}} : </label>
											<input type="text" id="untill" class="form-control pdp" name="untill" autocomplete="off" value="{{request('untill')}}">
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-5">
							<div class="card">
								<div class="card-header">
									{{__('words.SEARCH_ON_POINT')}}
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-8">
											<label for="op"> {{__('words.OPERATOR')}} </label>
											<select class="form-control mx-1" name="op" id="op" required>
												<option @if(request('op') == '=') selected @endif value="="> {{__('words.EQUALS')}} </option>
												<option @if(request('op') == '!=') selected @endif value="!="> {{__('words.NOT_EQUALS')}} </option>
												<option @if(request('op') == '<') selected @endif value="<"> {{__('words.LESS_THAN')}} </option>
												<option @if(request('op') == '>') selected @endif value=">"> {{__('words.GREATER_THAN')}} </option>
												<option @if(request('op') == '>=') selected @endif value=">="> {{__('words.GREATER_THAN_OR_EQUAL')}} </option>
												<option @if(request('op') == '<=') selected @endif value="<="> {{__('words.LESS_THAN_OR_EQUAL')}} </option>
											</select>
										</div>
										<div class="col-4">
											<label for="points"> {{__('words.POINT')}} : </label>
											<input type="number" id="points" class="form-control" name="points" value="{{request('points')}}">
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="w-100 my-2"></div>
						<div class="col-md-2">
							<button type="submit" class="btn btn-primary btn-block mx-1 px-3" name="search" value="1">
								{{__('words.SEARCH')}} <i class="fa fa-search mr-1"></i>
							</button>
							<a href="{{url("form/$form->id/action/report/table")}}" class="btn btn-outline-primary btn-block mx-1 px-3">
								{{__('words.DISMISS')}} <i class="fa fa-times mr-1"></i>
							</a>
						</div>
					</div>
				</form>

				<hr>

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

				<form class="hidden" method="post" action="{{url("form/delete_filler")}}" id="checked-ids">
					@csrf
				</form>

			</div>

		</div>

		<div class="tab-pane fade @if($page=='charts') active show @endif" id="charts">

			<div class="container py-4">
				@foreach ($form->questions as $question)

					<div class="px-1 px-md-3">
						<h4 class="mb-4"> {{$question->position}}. {{$question->title}} </h4>
						@if ($question->range || $question->assets->count())
							<ul class="nav nav-tabs">
								<li class="nav-item">
									<a class="nav-link active" data-toggle="tab" href="#linear-{{$question->id}}" role="tab"> <i class="more-x fa fa-line-chart"></i> </a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#datatable-{{$question->id}}"><i class="more-x fa fa-table"></i></a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#pie-{{$question->id}}"><i class="more-x fa fa-pie-chart"></i></a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#bar-{{$question->id}}"><i class="more-x fa fa-bar-chart"></i></a>
								</li>
							</ul>
							<div class="tab-content p-4">
								<div class="tab-pane fade show active" id="linear-{{$question->id}}">
									<canvas id="question-chart-line-{{$question->id}}" height="125"></canvas>
								</div>
								<div class="tab-pane fade" id="datatable-{{$question->id}}">
									<table class="table table-striped table-bordered">
										<thead>
											<tr>
												<th> {{__('words.CHOICE')}} </th>
												<th> {{__('words.ANSWER_COUNT')}} </th>
												<th> {{__('words.AMOUNT_PERCENT')}} </th>
											</tr>
										</thead>
										<tbody>
											@if($question->assets->count())
												@foreach ($question->assets as $asset)
													<tr>
														<td> {{$asset->content}} </td>
														<td> {{$question->count_answers($asset->content)}} </td>
														<td> {{$question->answer_percent($asset->content)}}% </td>
													</tr>
												@endforeach
											@elseif($question->range)
												@for($i=$question->range_start(); $i<=$question->range_end(); $i++)
													<tr>
														<td> {{$i}} </td>
														<td> {{$question->count_answers($i)}} </td>
														<td> {{$question->answer_percent($i)}}% </td>
													</tr>
												@endfor
											@endif
										</tbody>
									</table>
								</div>
								<div class="tab-pane fade" id="pie-{{$question->id}}">
									<canvas id="question-chart-pie-{{$question->id}}" height="125"></canvas>
								</div>
								<div class="tab-pane fade" id="bar-{{$question->id}}">
									<canvas id="question-chart-bar-{{$question->id}}" height="125"></canvas>
								</div>
							</div>
						@else
							<p class="text-center py-3"> <i class="fa fa-warning ml-1"></i> {{__('messages.NO_CHART')}} </p>
						@endif
					</div>
					<hr>

				@endforeach
			</div>

		</div>

	</div>

@endsection
