@extends('sales.parents.SalesDeliveryReceipt')

@section('sidebar')
	@include('sales.chain.sidebar')
@endsection

@section('billing-info')
	@include('sales.chain.billing-info',['so' => $so,'sdrID'=> $sdrID])
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
			<td class="pcs" width="30px">
				{{$items[$ctr]->Quantity}}




			</td>

			<td class="price" >{{  $items[$ctr]->CurrentUnitPrice }}</td>
			<td style="text-align:right" class="price2">{{$items[$ctr]->CurrentUnitPrice * $items[$ctr]->Quantity}}</td>

		</tr>
	@endfor
@endsection

@section('delivery-info')
@include('sales.chain.delivery-info',['so' => $so])
@endsection
