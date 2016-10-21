@extends('sales.parents.SalesInvoice')

@section('sidebar')
	@include('sales.chain.sidebar')
@endsection	

@section('billing-info')
	@include('sales.chain.billing-info')
@endsection

@section('customer-info')
	@include('sales.chain.customer-info')
@endsection

@section('delivery-info')
	@include('sales.chain.delivery-info')
@endsection


@section('sales-item')

<tr>
	<td>1</td>
	<td>LCD Monitor</td>
	<td class="hidden-phone">22-12-10</td>
	<td class="">$ 1000</td>
	<td class="" width="30px">


		<input class="form-control m-bot15" type="text" >


	</td>
	<td>$ 2000</td>
	<td>$ 2000</td>
	<td>$ 2000</td>
	<td>$ 2000</td>
</tr>

@endsection
