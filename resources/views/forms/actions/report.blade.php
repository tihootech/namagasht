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
						<h4> {{$form->ratio()}}% </h4>
						<p class="text-muted">
							{{__('words.ANSWER_RATIO')}}
							<i class="fa fa-question-circle mirror-rotate mr-1" title="{{__('messages.ANSWER_RATIO_INFO')}}"></i>
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
						<p class="text-muted my-1"> {{$form->mobile_visits('percent')}}% </p>
					</div>
					<div class="col-md-4">
						<h5> {{__('words.LAPTOP')}} </h5>
						<p class="text-muted my-1"> {{$form->laptop_visits('count')}} </p>
						<p class="text-muted my-1"> {{$form->laptop_visits('percent')}}% </p>
					</div>
				</div>

			</div>

		</div>
		<div class="tab-pane fade @if($page=='table') active show @endif" id="table">

			<div class="table-responsive p-2 p-md-5">

				<div class="text-left">
					<button type="button" class="btn btn-primary mx-1 px-3" title="{{__('words.ADVANCED_SEARCH')}}" data-toggle="collapse" data-target="#search-in-table">
						<i class="fa fa-search"></i>
					</button>
					<button type="button" class="btn btn-success mx-1 px-3" title="{{__('words.EXCEL_OUTPUT')}}">
						<i class="fa fa-file-excel-o"></i>
					</button>
					<button type="submit" form="checked-ids" class="btn btn-danger mx-1 px-3" title="{{__('words.DELETE_ITEMS')}}">
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
									<td> {{$question->raw_answer($filler->uid)}} </td>
								@endforeach
								<td> {{pdate($filler->created_at)}} </td>
								<td> {{$filler->time ?? __('words.NOT_FINISHED')}} </td>
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
			33333
		</div>
	</div>

@endsection
