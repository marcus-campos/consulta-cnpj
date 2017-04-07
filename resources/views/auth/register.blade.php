@extends('template-login')
@extends('vendor.auth.header.meta')
@extends('vendor.auth.header.title-fav')
@extends('vendor.auth.css-js.css')
@extends('vendor.auth.css-js.js')

@section('content')
	<div class=" card-box">
		<div class="panel-heading">
			<h3 class="text-center"> Registrar em <strong class="text-custom">Consulta CNPJ</strong> </h3>
		</div>

		<div class="panel-body">
			@if (isset($errors) && count($errors) > 0)
				<div class="alert alert-danger">
					<strong>Opa!</strong> Encontramos alguns erros.<br><br>
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
				{!! csrf_field() !!}

				<div class="form-group ">
					<div class="col-xs-12">
						<input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Nome">
					</div>
				</div>

				<div class="form-group ">
					<div class="col-xs-12">
						<input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12">
						<input type="password" class="form-control" name="password" placeholder="Senha">
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12">
						<input type="password" class="form-control" name="password_confirmation" placeholder="Confirmar senha">
					</div>
				</div>

				<div class="form-group text-center m-t-40">
					<div class="col-xs-12">
						<button class="btn btn-default btn-block text-uppercase waves-effect waves-light" type="submit">
							Registrar
						</button>
					</div>
				</div>

			</form>

		</div>
	</div>

	<div class="row">
		<div class="col-sm-12 text-center">
			<p>
				Já possui uma conta?<a href="{{ url('/auth/login')}}" class="text-primary m-l-5"><b>Entrar</b></a>
			</p>
		</div>
	</div>
@endsection
