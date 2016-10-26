@extends('sales.parents.SalesReport')

@section('sidebar')
	@include('sales.chain.sidebar')
@endsection


@section('weekly-sales')

<tr class="gradeX">
			<td>1</td>
			<td>2016-10-10</td>
			<td>Neil Capistrano</td>
			<td>10000</td>
			<td>200	</td>
			<td>100</td>
</tr>

<tr class="gradeX">
			<td>2</td>
			<td>2016-10-09</td>
			<td>Lian Lagiuo</td>
			<td>10000</td>
			<td>200	</td>
			<td>100</td>
</tr>

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


<tr class="gradeX">
			<td>1</td>
			<td>2016-10-10</td>
			<td>Neil Capistrano</td>
			<td>10000</td>
			<td>200	</td>
			<td>100</td>
</tr>

<tr class="gradeX">
			<td>2</td>
			<td>2016-10-09</td>
			<td>Lian Lagiuo</td>
			<td>10000</td>
			<td>200	</td>
			<td>100</td>
</tr>
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


<tr class="gradeX">
			<td>1</td>
			<td>2016-10-10</td>
			<td>Neil Capistrano</td>
			<td>10000</td>
			<td>200	</td>
			<td>100</td>
</tr>

<tr class="gradeX">
			<td>2</td>
			<td>2016-10-09</td>
			<td>Lian Lagiuo</td>
			<td>10000</td>
			<td>200	</td>
			<td>100</td>
</tr>		
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