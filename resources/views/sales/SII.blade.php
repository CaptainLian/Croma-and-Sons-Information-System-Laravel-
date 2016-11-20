@extends('sales.parents.SalesInvoiceInitial')

@section('sidebar')
	@include('sales.chain.sidebar')
@endsection	


@section('pending')

 
	@foreach($pending as $p)
		<tr class="gradeC">
			<td>{{$p->SalesDeliveryReceiptID}}</td>
			<td>{{$p->DateCreated}}</td>
			<td>{{$p->Name}}</td>
			<th>
				<a href="/sales/invoice/{{$p->SalesInvoiceID}}"
				 <button id='asd' type="button" class="btn btn-success">Create Invoice</button>
				 </a>
			</th>
		</tr>
	@endforeach
@endsection

@section('customjs')
<!-- 
<script>
	console.log('asd');
	$('table tbody tr th').click(function({
		console.log($(this).attr('id'));
	}));
</script> -->


@endsection