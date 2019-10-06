@extends('layouts.namagasht')
@section('main')

	<div class="text-center p-5">
		<!-- Button to Open the Modal -->
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#new-form">
			ایجاد پرسشنامه جدید
		</button>
	</div>

	<div class="container text-center">
		<div class="row justify-content-center">
			@foreach ($forms as $form)
				<div class="col-md-4">
		            <div class="card mx-sm-1 p-3">
						<div class="row">
							<div class="col-3" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="{{__('words.PREVIEW')}}" >
								<a class="btn shadow btn-outline-primary btn-block p-2" href="{{url("form/$form->uid?p=1")}}">
									<i class="fa fa-eye more-x"></i>
								</a>
							</div>
							<div class="col-3" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="{{__('words.SEE_RESULTS')}}" >
								<a class="btn shadow btn-outline-secondary btn-block p-2" href="{{url("form/$form->id/action/report")}}">
									<i class="fa fa-line-chart more-x"></i>
								</a>
							</div>
							<div class="col-3" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="{{__('words.EDIT_AND_MANAGE')}}" >
								<a class="btn shadow btn-outline-success btn-block p-2" href="{{url("forms/$form->id/edit")}}">
									<i class="fa fa-edit more-x"></i>
								</a>
							</div>
							<div class="col-3" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="{{__('words.DELETE')}}" >
								<form action="{{url("forms/$form->id")}}" method="post">
									@csrf
									@method('DELETE')
					                <button class="btn shadow btn-outline-danger btn-block p-2" type="submit"
										onclick="return confirm('{{__('words.ARE_YOU_SURE')}}');">
										<i class="fa fa-trash more-x"></i>
									</button>
								</form>
							</div>
						</div>
						<hr>
		                <div class="text-center mt-2">
							<ul class="list-group list-group-flush p-0">
								<li class="list-group-item">
									<h2 class="text-primary"> {{$form->name}} </h2>
								</li>
								<li class="list-group-item">
									{{__('words.FORM_VISITS')}} : {{$form->visits()}}
								</li>
								<li class="list-group-item">
									{{__('words.ANSWERS')}} : {{$form->answers()}}
								</li>
								<li class="list-group-item">
									{{__('words.STATUS')}} :
									@if ($form->active)
										<span class="text-success"> {{__('words.ACTIVE')}} </span>
									@else
										<span class="text-danger"> {{__('words.INACTIVE')}} </span>
									@endif
								</li>
								<li class="list-group-item">
									{{__('words.SHARE_LINK')}} :
									<br>
									<a href="{{$form->link()}}" target="_blank"> {{$form->link()}} </a>
									<br>
									<button type="button" class="btn btn-outline-primary mt-3 copy-text" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="{{__('words.DO_COPY')}}" data-initial-text="{{__('words.DO_COPY')}}" data-replacement-text="{{__('words.COPIED')}}" data-content-to-copy="{{$form->link()}}" data-html="true">
										<i class="fa fa-link ml-1"></i>
										{{__('words.COPY_LINK')}}
									</button>
								</li>
							</ul>
						</div>
		            </div>
		        </div>
			@endforeach
	     </div>
	</div>

	<!-- The Modal -->
	<div class="modal fade" id="new-form">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">

				<div class="modal-body">
					<form class="px-2" action="{{url('/forms')}}" method="post">
						@csrf
						<label form="new"> لطفا نام پرسشنامه را را وارد کنید. </label>
						<input type="text" name="name" class="form-control mb-2" required>
						<button id="new" type="submit" class="btn btn-primary">ایجاد</button>
						<button type="button" class="btn btn-link" data-dismiss="modal">بازگشت</button>
					</form>
				</div>

			</div>
		</div>
	</div>

@endsection
