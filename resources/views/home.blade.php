@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card ">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
							<tr>
								<th>Firstname</th>
								<th>Lastname</th>
								<th>Email</th>
								<th>Phone Number</th>
							</tr>
                        </thead>
                        <tbody>
                        	@foreach($usuarios as $usuario)
								<tr>
									<td>{{ $usuario->name}}</td>
									<td>{{ $usuario->last_name}}</td>
									<td>{{ $usuario->email}}</td>
									<td>{{ $usuario->phone_number}}</td>
								</tr>
							@endforeach
                        </tbody>
                    </table>
                    {{ $usuarios->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
