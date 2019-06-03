<!DOCTYPE html>
<html>
<head>
	<title>Factura de Compra #{{$order->id}}</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="widtd=device-widtd, initial-scale=1">

	<link rel="stylesheet" href="https://stackpatd.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet" type="text/css">
    <style type="text/css">
    	*,
    	*::before,
    	*::after {
    	  box-sizing: border-box;
    	}
    	body{
    		margin: 0;
    		font-family: Helvetica, serif;
    	}
    	table{
    		width: 100%;
  			margin-bottom: 1rem;
  			color: #212529;
  			border: 1px solid black;
  			border-collapse: collapse;
    	}
    	table .thead-dark td {
    	  color: white;
    	  background-color: #343a40;
    	  border-right: 0;
    	  border-left: 0;
    	}

    	table td, table tr td {
    	  padding: 0.75rem;
    	  vertical-align: top;
    	  border: 1px solid black;
    	}
    	.bg-light {
    	  background-color: #f8f9fa !important;
    	}
    	.mono{
    		font-family: monospace !important;
    	}
    	.text-center {
    	  text-align: center !important;
    	}
    	.text-right{
    		text-align: right !important;
    	}
    	.upper{
    		text-transform: uppercase;
    	}
    	.h5,.h6 {
    	  margin-bottom: 0.25rem;
    	  font-weight: 500;
    	  line-height: 1.2;
    	}
    	h5, .h5 {
    	  font-size: 1.25rem;
    	}
    	h6, .h6 {
    	  font-size: 1rem;
    	}
		.border-tb{
			border-top: 2px solid black;
			border-bottom: 2px solid black;
		}
		div{
			margin: 0.5rem 1.25rem;
			padding: 0;
			border: 1px solid #ccc;
		}

    </style>

</head>
<body class="bg-light">
	<h1 class="upper text-center mono">TiendaVirtual</h1>
	<h3 class="text-center mono"><i>Consigue lo que buscas al mejor precio.</i></h3>
	<h2 class="text-center" style="margin-bottom: 0;">Factura de compra</h2>
	<div>
		<p class="h5 upper border-tb">
			<strong>Datos del cliente.</strong>
		</p>
		<p class="h6">
			Cliente: {{$order->user->name . " " . $order->user->last_name}}
		</p>
		<p class="h6">
			Correo: {{$order->user->email}}
		</p>
		<p class="h6">
			Telefono: {{$order->user->phone_number}}
		</p>
	</div>
	<div>
		<p class="h5 upper border-tb">
			<strong>Datos de la compra.</strong>
		</p>
		<p class="h6">
			Número de compra: {{$order->id}}
		</p>
		<p class="h6">
			Estado de la compra: {{$order->status}}
		</p>
		<p class="h6">
			Cantidad de productos: {{$order->total_products->total_products}}
		</p>
		<p class="h6">
			Dirección de envio: <i>{{$order->shipping_address}}</i>
		</p>
		<p class="h6">
			Fecha y hora emisión: <i>{{$order->created_at}}</i>
		</p>
		<p class="h5 text-center">Productos</p>
		<table>
			<tr class="thead-dark text-center">
				<td>ID Producto</td>
				<td>Nombre</td>
				<td>Precio</td>
				<td>Cantidad</td>
				<td>Subtotal</td>
			</tr>
		@foreach($order->orderDetails as $detail)
			<tr class="text-center">
				<td>{{$detail->product_id}}</td>
				<td>{{$detail->product->name}}</td>
				<td>{{$detail->product->price}}</td>
				<td>{{$detail->quantity}}</td>
				<td>{{ $detail->product->price * $detail->quantity}}</td>
			</tr>
		@endforeach	
			<tr>
				<td colspan="4"  class="text-right">Total + IVA (12%)</td>
				<td class="text-center">{{$order->total}}</td>
			</tr>
		</table>
	</div>
</body>
</html>