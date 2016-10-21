@extends('sales.parents.SalesCustomerList')

@section('sidebar')
	@include('sales.chain.sidebar')
@endsection


@section('customer-list')
<tr class="">
	<td>Jondi Rose</td>
	<td>Alfred Jondi Rose</td>
	<td>1234</td>
	<td class="center">super user</td>
	<td>2/12/16</td>
	<td>58888</td>
	<td>
		<a class="edit" href="javascript:;">Edit</a>
	</td>
	<td>
		<a class="delete" href="javascript:;">Delete</a>
	</td>
</tr>
@endsection