<!DOCTYPE html>
<html>
<head>
	<title>Factura de Compra #{{$order->id}}</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="widtd=device-widtd, initial-scale=1">
    <style type="text/css">
		*,
		*::before,
		*::after {
			box-sizing: border-box;
		}
		body {
			margin: 0;
			font-family:monospace, sans-serif;
			font-size: 16px;
			font-weight: 400;
			line-height: 1.5;
			color: #212529;
			text-align: left;
			background-color: #fff;
		}
		hr {
			box-sizing: content-box;
			height: 0;
			overflow: visible;
		}

		h1, h2, h3, h4, h5, h6,
		.h1, .h2, .h3, .h4, .h5, .h6 {
			margin-top: 0;
			margin-bottom: 8px;
			font-weight: 500;
			line-height: 1.2;
		}

		h1, .h1 {
			font-size: 36px;
		}

		h2, .h2 {
			font-size: 32px;
		}

		h3, .h3 {
			font-size: 28px;
		}

		h4, .h4 {
			font-size: 24px;
		}

		h5, .h5 {
			font-size: 20px;
		}

		h6, .h6 {
			font-size: 16px;
		}

		hr {
			margin-top: 16px;
			margin-bottom: 16px;
			border: 0;
			border-top: 1px solid rgba(0, 0, 0, 0.1);
		}

		p {
			margin-top: 0;
			margin-bottom: 16px;
			position: relative;
		}
		table{
			width: 100%;
			margin: 16px 0;
			color: #212529;
			border: 1px solid black;
			border-collapse: collapse;
		}

		table .thead-dark td {
			color: white;
			background-color: #343a40;
			border-right: 0;
			border-left: 0;
			font-weight: bold;
		}

		table tr, table td {
			padding: 6px;
			vertical-align: top;
			border: 1px solid black;
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
		div{
			margin-top: 0;
			margin-bottom: 20px;
			padding: 16px;
			position: relative;
		}

		div p, div table{
			padding-left: 16px;
			padding-right: 16px;
		}
		
		.bg-claro{
			background-color: #EBF2F5;
		}
    </style>

</head>
<body class="bg-claro">
	<h1 class="text-center">
		<strong>TiendaVirtual</strong>
	</h1>
	<h2 class="text-center h6">
		<i>Donde encuentras tus productos al mejor precio.</i>
	</h2>
	<h2 class="h6 text-center">
		Rif: J - 0000000
	</h2>
	<h2 class="h6 text-center">
		<i>Chacao, diagonal a la estación del metro, Edif. Negro 222, PB, Miranda, Caracas.</i>
	</h2>
	<h2 class="h6 text-center">
		(0212)123.4567
	</h2>

	<h2 class="text-center" style="margin: 24px 0;">
		<strong>Factura de compra.</strong>
	</h2>
	<div>
		<h5 class="upper" style="border-bottom: 1px solid black;">
			<strong>Datos del cliente.</strong>
		</h5>
		<p class="h6">
			Cliente: {{ $order->user->name . " " . $order->user->last_name }}
		</p>
		<p class="h6">
			Correo: {{ $order->user->email }}
		</p>
		<p class="h6">
			Telefono: {{ $order->user->phone_number }}
		</p>
	</div>
	<div>
		<h5 class="upper" style="border-bottom: 1px solid black;">
			<strong>Datos de la compra.</strong>
		</h5>
		<p class="h6">
			Número de compra: #{{ $order->id }}
		</p>
		<p class="h6">
			Estado de la compra: {{ $order->status }}
		</p>
		<p class="h6">
			Cantidad de productos: {{ $order->total_products->total_products }}
		</p>
		<p class="h6">
			Dirección de envio: <i>{{ $order->shipping_address }}</i>
		</p>
		<p class="h6">
			Fecha y hora emisión: <i>{{ $order->created_at }}</i>
		</p>
		<h5 class="text-center" style="margin-top: 26px;">
			<strong>Productos.</strong>
		</h5>
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
				<td>{{ $detail->product_id }}</td>
				<td>{{ $detail->product->name }}</td>
				<td>{{ $detail->product->price }}</td>
				<td>{{ $detail->quantity }}</td>
				<td>{{ $detail->product->price * $detail->quantity }}</td>
			</tr>
		@endforeach	
			<tr>
				<td colspan="4"  class="text-right">Total + IVA (12%)</td>
				<td class="text-center">{{ $order->total }}</td>
			</tr>
		</table>
	@if($order->payment != null)

		<h5 class="upper" style="border-bottom: 1px solid black;">
			<strong>Datos del pago</strong>
		</h5>
		<p class="h6">
			Número de pago: #{{ $order->payment->id }}
		</p>
		<p class="h6">
			Número de transacción: {{ $order->payment->nro_ref }}
		</p>
		<p class="h6">
			Banco: {{ ucwords($order->payment->banco) }}
		</p>
		<p class="h6">
			Transacción registrada el: #{{ $order->payment->created_at }}
		</p>
	@endif
	</div>
</body>
</html>