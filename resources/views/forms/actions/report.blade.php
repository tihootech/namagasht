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

				<table class="table table-sm table-hover table-bordered table-striped">

					<div class="row">
						<div class="col-md-3">
							<label for="from"> {{__('words.FROM')}} : </label>
							<input type="text" id="from" class="form-control pdp" name="from" value="{{request('from')}}">
						</div>
						<div class="col-md-3">
							<label for="untill"> {{__('words.UNTILL')}} : </label>
							<input type="text" id="untill" class="form-control pdp" name="untill" value="{{request('untill')}}">
						</div>
						<div class="col-md-2 mr-auto align-self-center">
							<button type="button" class="btn btn-success px-3" title="{{__('words.EXCEL_OUTPUT')}}">
								<i class="fa fa-file-excel-o"></i>
							</button>
							<button type="submit" form="checked-ids" class="btn btn-danger px-3" title="{{__('words.DELETE_ITEMS')}}">
								<i class="fa fa-trash"></i>
							</button>
						</div>
					</div>

					<hr>

					<thead>
						<tr>
							<th> <i class="fa fa-square-o" data-check="all" data-checked="0"></i> </th>
							<th> {{__('words.FILLER_UID')}} </th>
							@foreach ($form->questions as $question)
								<th> {{$question->title}} </th>
							@endforeach
							<th> {{__('words.START_DATE')}} </th>
							<th> {{__('words.FINISH_DATE')}} </th>
							<th> {{__('words.POINT')}} </th>
						</tr>
					</thead>
					<tbody>
						@foreach ($form->fillers as $filler)
							<tr>
								<td> <i class="fa fa-square-o" data-check="{{$filler->id}}" data-checked="0"></i> </td>
								<td> {{$filler->uid}} </td>
								@foreach ($form->questions as $question)
									<td> {{$question->raw_answer($filler->uid)}} </td>
								@endforeach
								<td> {{pdate($filler->created_at)}} </td>
								<td> {{$filler->finished_at ? pdate($filler->finished_at) : __('words.NOT_FINISHED')}} </td>
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
