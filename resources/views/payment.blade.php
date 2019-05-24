@extends('layouts.app')

@section('content')
<div class="container-fluid my-3">
	<div class="row">
		<div class="col-10 mx-auto">
			<div class="card">
				<div class="card-header bg-dark">
					<div class="clearfix">
						<h3 class="text-white title float-left">Verificar Pago.</h3>
						<a href="{{route('users.orders.index')}} " class="btn btn-danger float-right">Volver</a>
					</div>
				</div>
				<div class="card-body">
					<h5 class="text-center">Para pagar debe realizar una transferencia bancaria a una de nuestras cuentas bancarias.</h5>
					<nav class="navbar navbar-expand-md justify-content-center mb-2">
						<ul class="navbar-nav">
							<li class="nav-item">
								<a href="#banesco" class="btn btn-outline-secondary mx-1 nav-link">Banesco</a>
							</li>
							<li class="nav-item">
								<a href="#provincial" class="btn btn-outline-secondary mx-1 nav-link">Provincial</a>
							</li>
							<li class="nav-item">
								<a href="#mercantil" class="btn btn-outline-secondary mx-1 nav-link">Mercantil</a>
							</li>
							<li class="nav-item" >
								<a href="#venezuela" class="btn btn-outline-secondary mx-1 nav-link">Venezuela</a>
							</li>
							<li class="nav-item">
								<a href="#bancaribe" class="btn btn-outline-secondary mx-1 nav-link">Bancaribe</a>
							</li>
						</ul>
					</nav>
					<form action="{{route('users.payments.store')}}" method="POST">
						@csrf
						<div class="form-row">
							<div class="form-group col-md-3">
								<label for="ref">
									Total a pagar:
								</label>
								<input type="text" class="form-control" value="{{$order->total}} Bs" disabled>
							</div>
							<div class="form-group col-md-3">
								<label for="ref">
									Número de Referencía:
								</label>
								<input type="text" name="ref" id="ref" class="form-control" placeholder="Nro de Ref de la Transacción..." required>
							</div>
							<div class="form-group col-md-4">
								<label class="d-block">Banco:</label>
								<div class="custom-control custom-radio custom-control-inline">
									<input type="radio" class="custom-control-input" id="banescoCheck" name="banco" value="banesco" required>
									<label class="custom-control-label" for="banescoCheck">Banesco</label>
								</div>
								<div class="custom-control custom-radio custom-control-inline">
									<input type="radio" class="custom-control-input" id="provinCheck" name="banco" value="provincial">
									<label class="custom-control-label" for="provinCheck">Provincial</label>
								</div>
								<div class="custom-control custom-radio custom-control-inline">
									<input type="radio" class="custom-control-input" id="mercanCheck" name="banco" value="mercantil">
									<label class="custom-control-label" for="mercanCheck">Mercantil</label>
								</div>
								<div class="custom-control custom-radio custom-control-inline">
									<input type="radio" class="custom-control-input" id="vzlaCheck" name="banco" value="venezuela">
									<label class="custom-control-label" for="vzlaCheck">Venezuela</label>
								</div>
								<div class="custom-control custom-radio custom-control-inline">
									<input type="radio" class="custom-control-input" id="bancaCheck" name="banco" value="bancaribe">
									<label class="custom-control-label" for="bancaCheck">Bancaribe</label>
								</div>
							</div>
							<div class="form-group col-md-2 my-auto">
								<input type="hidden" name="order_id" value="{{$order->id}}">
								<button type="submit" class="btn btn-block btn-success">Enviar</button>
							</div>
						</div>
						
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container my-4">
	<div class="media p-3 my-2 border border-secondary shadow-sm rounded-lg" id="banesco">
  		<img src="{{Storage::url('public/images/logos/logo-banesco.jpg')}}" class="align-self-center mr-3 rounded-circle border border-dark" alt="logo-banesco.jpg" width="128">
		<div class="media-body">
	    	<h5 class="mt-0 title"><strong>Cuenta Banco Banesco.</strong></h5>
	    	<h5 class="my-2">Número de Cuenta: <strong>0000-0000-0000-0000-0000</strong></h5>
	    	<h5 class="my-2">Rif: <strong>J - 0000000-0</strong></h5>
	    	<h5 class="my-2">Beneficiario: <strong>TiendaVirtualJP</strong></h5>
	    	<h5 class="my-2">Cuenta: <strong>Corriente</strong></h5>
		</div>
	</div>
	<div class="media p-3 my-2 border border-secondary shadow-sm rounded-lg" id="provincial">
  		<img src="{{Storage::url('public/images/logos/logo-provincial.jpg')}}" class="align-self-center mr-3 rounded-circle border border-dark" alt="logo-provincial.jpg" width="128">
		<div class="media-body">
	    	<h5 class="mt-0 title"><strong>Cuenta Banco Provincial.</strong></h5>
	    	<h5 class="my-2">Número de Cuenta:<strong>0000-0000-0000-0000-0000</strong></h5>
	    	<h5 class="my-2">Rif: <strong>J - 0000000-0</strong></h5>
	    	<h5 class="my-2">Beneficiario: <strong>TiendaVirtualJP</strong></h5>
	    	<h5 class="my-2">Cuenta: <strong>Corriente</strong></h5>
		</div>
	</div>
	<div class="media p-3 my-2 border border-secondary shadow-sm rounded-lg" id="mercantil">
  		<img src="{{Storage::url('public/images/logos/logo-mercantil.jpg')}}" class="align-self-center mr-3 rounded-circle border border-dark" alt="logo-mercantil.jpg" width="128">
		<div class="media-body">
	    	<h5 class="mt-0 title"><strong>Cuenta Banco Mercantil.</strong></h5>
	    	<h5 class="my-2">Número de Cuenta: <strong>0000-0000-0000-0000-0000</strong></h5>
	    	<h5 class="my-2">Rif: <strong>J - 0000000-0</strong></h5>
	    	<h5 class="my-2">Beneficiario: <strong>TiendaVirtualJP</strong></h5>
	    	<h5 class="my-2">Cuenta: <strong>Corriente</strong></h5>
		</div>
	</div>
	<div class="media p-3 my-2 border border-secondary shadow-sm rounded-lg" id="venezuela">
  		<img src="{{Storage::url('public/images/logos/logo-venezuela.jpg')}}" class="align-self-center mr-3 rounded-circle border border-dark" alt="logo-provincial.jpg" width="128">
		<div class="media-body">
	    	<h5 class="mt-0 title"><strong>Cuenta Banco Venezuela.</strong></h5>
	    	<h5 class="my-2">Número de Cuenta: <strong>0000-0000-0000-0000-0000</strong></h5>
	    	<h5 class="my-2">Rif: <strong>J - 0000000-0</strong></h5>
	    	<h5 class="my-2">Beneficiario: <strong>TiendaVirtualJP</strong></h5>
	    	<h5 class="my-2">Cuenta: <strong>Corriente</strong></h5>
		</div>
	</div>
	<div class="media p-3 my-2 border border-secondary shadow-sm rounded-lg" id="bancaribe">
  		<img src="{{Storage::url('public/images/logos/logo-bancaribe.jpg')}}" class="align-self-center mr-3 rounded-circle border border-dark" alt="logo-bancaribe.jpg" width="128">
		<div class="media-body">
	    	<h5 class="mt-0 title"><strong>Cuenta Banco Bancaribe.</strong></h5>
	    	<h5 class="my-2">Número de Cuenta: <strong>0000-0000-0000-0000-0000</strong></h5>
	    	<h5 class="my-2">Rif: <strong>J - 0000000-0</strong></h5>
	    	<h5 class="my-2">Beneficiario: <strong>TiendaVirtualJP</strong></h5>
	    	<h5 class="my-2">Cuenta: <strong>Corriente</strong></h5>
		</div>
	</div>
	
</div>
@endsection