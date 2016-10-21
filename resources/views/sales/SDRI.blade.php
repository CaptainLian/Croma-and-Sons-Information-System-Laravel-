@extends('sales.parents.SalesDeliveryReceiptInitial')

@section('sidebar')
	@include('sales.chain.sidebar')
@endsection

@section('sales-order')

	@foreach($pendingSalesOrder as $so)
		<tr class="gradeX">
			<td>{{$so->SalesOrderID}}</td>
			<td>{{$so->DateCreated}}</td>
			<td>{{$so->Name}}</td>
			<th>
				<a href="/sdr"><button type="button" class="btn btn-success">Create DR</button></a>
			</th>
		</tr>
	@endforeach
@endsection	