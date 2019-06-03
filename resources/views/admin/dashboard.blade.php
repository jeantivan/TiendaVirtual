@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-3">
	<h1 class="title text-oscuro">Dashboard</h1>
	<hr>
	<div class="container mb-3">
		<h2 class="title text-mostaza">Ultimos Pagos.</h2>
		<ul class="list-unstyled p-3 border border-dark rounded-lg shadow-sm bg-light " >
		@foreach($payments as $payment)
			<li class="media mb-3">
			@switch($payment->banco)
				@case('banesco')
					<img src="{{Storage::url('public/images/logos/logo-banesco.jpg')}}" class="align-self-center mr-3 rounded-circle border border-dark" alt="logo-banesco.jpg" width="128">
					@break
				@case('mercantil')
					<img src="{{Storage::url('public/images/logos/logo-mercantil.jpg')}}" class="align-self-center mr-3 rounded-circle border border-dark" alt="logo-mercantil.jpg" width="128">
					@break
				@case('provincial')
					<img src="{{Storage::url('public/images/logos/logo-provincial.jpg')}}" class="align-self-center mr-3 rounded-circle border border-dark" alt="logo-provincial.jpg" width="128">
					@break
				@case('venezuela')
					<img src="{{Storage::url('public/images/logos/logo-venezuela.jpg')}}" class="align-self-center mr-3 rounded-circle border border-dark" alt="logo-provincial.jpg" width="128">
					@break
				@case('bancaribe')
					<img src="{{Storage::url('public/images/logos/logo-bancaribe.jpg')}}" class="align-self-center mr-3 rounded-circle border border-dark" alt="logo-bancaribe.jpg" width="128">
					@break
			@endswitch
				<div class="media-body row">
					<div class="col-md-9 col-sm-12">
						<p class="h4 mt-0">Orden: <a href="{{route('admin.orders.show', ['order' => $payment->order_id])}}" data-toggle="tooltip" title="Ver Orden" data-placement="right">#{{$payment->order_id}}</a></p>
						<p class="h5">
							Número de Referencia: <strong>{{$payment->nro_ref}}</strong>
						</p>
						<p class="h5">Monto: <span class="badge badge-success">{{$payment->order->total}} Bs</span></p>
						<p class="h5">Pagado en: <strong><i>{{$payment->created_at}}</i></strong></p>
					</div>
					<div class="col-md-3 col-sm-12 align-self-center">
						<a href="{{ route('admin.payments.show', ['payment' => $payment->id])}}" class="btn btn-primary btn-block my-auto">Ver Pago.</a>
					</div>
				</div>	
			</li>
		@endforeach
			<li>
				<h3 class="text-center title">
					<a href="{{route('admin.payments.index')}}">Ver todos...</a>
				</h3>
			</li>
		</ul>
	</div>

	<div class="container my-3">
		<h2 class="title text-mostaza">Productos.</h2>

		<div class="row">
			@foreach($products as $product)
			<div class="col-md-4 col-sm-12 mb-2">
				<div class="card shadow-sm scale" style="height:100%;">
					<img src="{{ Storage::url($product->images()->first()->path) }}" class="card-img-top d-block">
					<div class="card-body">
						<a href="{{route('admin.products.show', ['product' => $product->id])}}" class="card-link streched-link">
							<h3 class="card-title">{{ $product->name }}</h3>
						</a>
						<p class="card-text">{{ substr($product->description, 0, 50)}}...</p>
						<h5>Precio: <span class="badge badge-success p-2">{{ $product->price}} Bs</span></h5>
						@if($product->in_stock)
							<h5>
								Disponibles: <span class="badge badge-primary p-2">{{ $product->quantity_available }}</span>
							</h5>
						@else
							<h5>
								<span class="badge badge-dark p-2">Agotado</span>
							</h5>
						@endif
					</div>
				</div>
			</div>
			@endforeach
		</div>
		<h3 class="text-center title mt-2"><a href="{{route('admin.products.index')}}">Ver todos...</a></h3>
	</div>

	<div class="container">
		<h2 class="title text-mostaza">Ordenes.</h2>
		<div class="rounded-lg d-flex">
		  <button class="tablink title flex-fill created active" data-type="Created" data-color="#f6993f">Últimas Creadas.</button>
		  <button class="tablink title flex-fill paid" data-type="Paid" data-color="#4dc0b5">Útimas pagadas.</button>
		  <button class="tablink title flex-fill confirmed" data-type="Confirmed" data-color="#f6993f">Últimas Enviadas</button>
		</div>
		<div class="tabcontent w-100 p-4" id="Created" style="display: block;">
			<div class="row">
			@if(count($last_orders))
				@foreach($last_orders as $order)
					<div class="col-sm-12 col-md-3 col-xl-3">
						<div class="card shadow">
							<div class="card-body">
								<p class="h5">
									Orden: <span 
									class="text-info">#{{$order->id}}</span>
								</p>
								<p class="h5">
									Monto: <span class="badge badge-success shadow-sm">{{$order->total}} Bs</span>
								</p>
								<a class="btn btn-primary btn-block" href="{{route('admin.orders.show', ['order' => $order->id])}}">Ver Detalles</a>
							</div>
						</div>
					</div>
				@endforeach
			@else
				<div class="h3 col-12 p-4 text-center text-white">No hay Ordenes.</div>
			@endif	
			</div>
		</div>
		<div class="tabcontent w-100 p-4" id="Paid">
			<div class="row">
			@if(count($paid_orders))
				@foreach($paid_orders as $order)
					<div class="col-sm-12 col-md-3 col-xl-3">
						<div class="card shadow">
							<div class="card-body">
								<p class="h5">
									Orden: <span 
									class="text-info">#{{$order->id}}</span>
								</p>
								<p class="h5">
									Monto: <span class="badge badge-success shadow-sm">{{$order->total}} Bs</span>
								</p>
								<a class="btn btn-primary btn-block" href="{{route('admin.orders.show', ['order' => $order->id])}}">Ver Detalles</a>
							</div>
						</div>
					</div>
				@endforeach
			@else
				<div class="h3 p-4 col-12 text-center text-white">No hay Ordenes.</div>
			@endif
			</div>
		</div>
		<div class="tabcontent w-100 p-4" id="Confirmed">
			<div class="row">
			@if(count($confirmed_orders))
				@foreach($confirmed_orders as $order)
					<div class="col-sm-12 col-md-3 col-xl-3">
						<div class="card shadow">
							<div class="card-body">
								<p class="h5">
									Orden: <span 
									class="text-info">#{{$order->id}}</span>
								</p>
								<p class="h5">
									Monto: <span class="badge badge-success shadow-sm">{{$order->total}} Bs</span>
								</p>
								<a class="btn btn-primary btn-block" href="{{route('admin.orders.show', ['order' => $order->id])}}">Ver Detalles</a>
							</div>
						</div>
					</div>
				@endforeach
			@else

				<div class="h3 col-12 p-4 text-center text-white">No hay Ordenes.</div>
			@endif
			</div>
		</div>
		<div class="h3 title text-center mt-3"><a href="{{route('admin.orders.index')}}">Ver todas...</a></div>
	</div>

	


</div>
@endsection