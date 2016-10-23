@extends('sales.parents.SalesCustomerList')

@section('sidebar')
	@include('sales.chain.sidebar')
@endsection


@section('customer-list')
	@foreach($customer as $c)
		<tr class="">
			<td>{{$c->Name}}</td>
			<td>{{$c->Address}}</td>
			<td>{{$c->MobileNumber}}</td>
			<td>{{$c->ContactPerson}}</td>
			<td>{{$c->DateCreated}}</td>
			<td>
				@foreach($total as $t)
					@if($c->CustomerID == $t-> CustomerID)
						{{$t->TOTAL}}
					@endif
				@endforeach 
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