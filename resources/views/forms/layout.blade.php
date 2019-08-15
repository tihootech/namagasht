@extends('layouts.namagasht')
@section('main')

	<header class="bg-dark text-light text-center p-2">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-3">
					<a class="btn btn-link" href="{{$fragment=='main' ? url("forms") : url("forms/$form->id/edit")}}">
						<i class="fa fa-arrow-right text-light fa-2x"></i>
					</a>
					<input type="text" name="name" value="{{$form->name}}" class="edit-form-header-input">
				</div>
				<div class="col-md-6">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active"> {{__('words.CREATE')}} </li>
						<li class="breadcrumb-item"><a href="#"> {{__('words.DESIGN')}} </a></li>
						<li class="breadcrumb-item"><a href="#"> {{__('words.DESIGN')}} </a></li>
						<li class="breadcrumb-item"><a href="#"> {{__('words.SETTINGS')}} </a></li>
						<li class="breadcrumb-item"><a href="#"> {{__('words.SEND')}} </a></li>
						<li class="breadcrumb-item"><a href="#"> {{__('words.REPORT')}} </a></li>
					</ol>
				</div>
				<div class="col-md-3">
					<a class="btn btn-outline-light" href="{{url("forms/$form->id")}}"> {{__('words.PREVIEW')}} </a>
				</div>
			</div>
		</div>
	</header>

	<section class="container-fluid p-0">
		<div class="row no-gutters">
			<div class="w-30">
				<form class="d-inline" action="{{url("forms/$form->id")}}" enctype="multipart/form-data" method="post">

					@csrf
					@method('PUT')
					<input type="hidden" name="type" value="{{$fragment}}">

					<div class="form-panel">
						@yield('form-panel')
					</div>
					@unless ($fragment == 'main')
						<div class="bg-dark text-left px-3 py-2">
							<a class="btn btn-link text-light" href="{{url("forms/$form->id/edit")}}"> {{__('words.CANCEL')}} </a>
							<button class="btn btn-primary" href="{{url("forms/$form->id/edit")}}"> {{__('words.SAVE')}} </button>
						</div>
					@endunless

				</form>
			</div>
			<div class="w-70">
				<div class="form-body">
					@yield('form-body')
				</div>
			</div>
		</div>
	</secttion>

@endsection
