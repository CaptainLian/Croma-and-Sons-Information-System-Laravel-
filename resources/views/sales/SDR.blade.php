@extends('sales.parents.SalesDeliveryReceipt')

@section('sidebar')
@include('sales.chain.sidebar')
@endsection

@section('billing-info')
@include('sales.chain.billing-info',['so' => $so])
@endsection

@section('customer-info')
@include('sales.chain.customer-info',['customer' => $customer])
@endsection

@section('materials')

	@for($ctr = 0; $ctr < count($items); $ctr++)

		<tr>
			<td>{{$ctr+1}}</td>
			<td>{{$items[$ctr]->WoodType}}</td>
			<td class="hidden-phone">
			{{ $items[$ctr]->Thickness.'/'.
			   $items[$ctr]->Width. '/'.
			   $items[$ctr]->Length }}
			</td>
			<td class="">pcs</td>
			<td class="" width="30px">


				<input class="form-control m-bot15" value="{{$items[$ctr]->Quantity}}" type="text" >


			</td>
			 
			<td>{{  $items[$ctr]->CurrentUnitPrice }}</td>
			<td>?</td>
			<td></td>
		</tr>
	@endfor
@endsection

@section('delivery-info')
@include('sales.chain.delivery-info',['so' => $so])
@endsection