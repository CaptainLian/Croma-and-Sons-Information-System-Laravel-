@extends('sales.parents.SalesReport')

@section('sidebar')
	@include('sales.chain.sidebar')
@endsection


@section('weekly-sales')


	@foreach($weekly as $w)
		<tr class="gradeX">
			<td>{{$w->SalesInvoiceID}}</td>
			<td>{{$w->DateCreated}}</td>
			<td>{{$w->Name}}</td>
			<td>{{$w->TOTALAMOUNT}}</td>
			<td>{{$w->TOTALDISCOUNT}}</td>
			<td>{{$w->TOTALREJECT}}</td>
		</tr>
	@endforeach
@endsection

@section('monthly-sales')



	@foreach($monthly as $w)
	<tr class="gradeX">

		<td>{{$w->SalesInvoiceID}}</td>
		<td>{{$w->DateCreated}}</td>
		<td>{{$w->Name}}</td>
		<td>{{$w->TOTALAMOUNT}}</td>
		<td>{{$w->TOTALDISCOUNT}}</td>
		<td>{{$w->TOTALREJECT}}</td>
	</tr>
	@endforeach
@endsection


@section('yearly-sales')



	@foreach($yearly as $w)
	<tr class="gradeX">
		<td>{{$w->SalesInvoiceID}}</td>
		<td>{{$w->DateCreated}}</td>
		<td>{{$w->Name}}</td>
		<td>{{$w->TOTALAMOUNT}}</td>
		<td>{{$w->TOTALDISCOUNT}}</td>
		<td>{{$w->TOTALREJECT}}</td>
	</tr>
	@endforeach
@endsection
