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
	@include('sales.chain.delivery-info',['so'=>$so])
@endsection


@section('sales-item')

	@foreach($so as $key=>$item)
		<tr>

			<td>{{$key+1}}</td>
			<td>{{$item->WoodType}}</td>
			{{ Form::hidden('wood[]',$item->WoodType)}}
			<td class="hidden-phone">
			{{Form::hidden('thick[]',$item->Thickness)}}
			{{Form::hidden('wid[]',$item->Width)}}
			{{Form::hidden('len[]',$item->Length)}}
			{{$item->Thickness}}/
			{{$item->Width}}/
			{{$item->Length}}

			</td>
			<td class='quan'>{{$item->Quantity}}</>
			<td class="">pcs</td>

			<td    width="100px">


					<!-- <input class="form-control m-bot15" type="text" > -->
				{!! Form::number('quan[]',0,['class'=>'form-control m-bot15','min'=> '0','max'=>$item->Quantity])!!}


			</td>

			<td class="price">{{$item->CurrentUnitPrice}}</td>

			<td class='total'>$ 2000</td>
		</tr>
	@endforeach
@endsection
