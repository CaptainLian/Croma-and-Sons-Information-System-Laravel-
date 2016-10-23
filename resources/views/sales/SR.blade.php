@extends('sales.parents.SalesReport')

@section('sidebar')
	@include('sales.chain.sidebar')
@endsection


@section('weekly-sales')
	@foreach($weekly as $w)
		<tr class="gradeX">
			<td>{{$w->SalesInvoiceID}}</td>
			<td>{{$w->SalesInvoice.DateCreated}}</td>
			<td>{{$w->Name}}</td>
			<td>blank</td>
			<td>Win 95+</td>
			<td>Win 95+</td>
		</tr>
	@endforeach
@endsection

@section('monthly-sales')
	@foreach($monthly as $w)
		<tr class="gradeX">
			<td>{{$w->SalesInvoiceID}}</td>
			<td>{{$w->SalesInvoice.DateCreated}}</td>
			<td>{{$w->Name}}</td>
			<td>blank</td>
			<td>Win 95+</td>
			<td>Win 95+</td>
		</tr>
	@endforeach
@endsection


@section('yearly-sales')
	@foreach($yearly as $w)
		<tr class="gradeX">
			<td>{{$w->SalesInvoiceID}}</td>
			<td>{{$w->SalesInvoice.DateCreated}}</td>
			<td>{{$w->Name}}</td>
			<td>blank</td>
			<td>Win 95+</td>
			<td>Win 95+</td>	
		</tr>
	@endforeach
@endsection