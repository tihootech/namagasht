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
				<div class="col-md-3">
		            <div class="card mx-sm-1 p-3">
						<div class="row">
							<div class="col-6">
								<a class="btn shadow btn-outline-success btn-block p-2" href="{{url("forms/$form->id/edit")}}">
									<i class="fa fa-edit more-x"></i>
								</a>
							</div>
							<div class="col-6">
								<form action="{{url("forms/$form->id")}}" method="post">
									@csrf
									@method('DELETE')
					                <button class="btn shadow btn-outline-danger btn-block p-2" type="submit">
										<i class="fa fa-trash more-x"></i>
									</button>
								</form>
							</div>
						</div>
						<hr>
		                <div class="text-primary text-center mt-2">
							<h1> {{$form->name}} </h1>
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
