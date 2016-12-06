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
			<td>
			@if($w->TOTALREJECT > 0)
				{{$w->TOTALREJECT}}
			@else
				0.00 
			@endif
			</td>
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
		<td>@if($w->TOTALREJECT > 0)
				{{$w->TOTALREJECT}}
			@else
				0.00 
			@endif</td>
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
		<td>@if($w->TOTALREJECT > 0)
				{{$w->TOTALREJECT}}
			@else
				0.00 
			@endif</td>
	</tr>
	@endforeach
@endsection
