@extends('sales.parents.SalesCatalog')

@section('sidebar')
	@include('sales.chain.sidebar')
@endsection


@section('sales-material')
	@foreach($catalog as $c)
		<tr class="">
			<td>{{$c->WoodType}}</td>
			<td>{{$c->Thickness}} </td>
			<td>{{$c->Width}}</td>
			<td>{{$c->Length}}</td>
			<td>
				<input class="form-control" id="disabledInput" type="text" placeholder="{{$c->CurrentUnitPrice}}" disabled="">
			</td>
			<td>
				<a class="edit" href="javascript:;">Edit</a>
			</td>
			<td>
				<a class="delete" href="javascript:;">Delete</a>
			</td>
		</tr>
	@endforeach
@endsection

@section('editable')
	@include('sales.chain.editable-table-SC')
@endsection