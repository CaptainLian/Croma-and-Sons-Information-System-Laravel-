@extends('sales.parents.SalesCatalog')

@section('sidebar')
	@include('sales.chain.sidebar')
@endsection


@section('sales-material')
<tr class="">
	<td>Jondi Rose</td>
	<td>Alfred Jondi Rose</td>
	<td>1234</td>
	<td class="center">super user</td>
	<td>
		<input class="form-control" id="disabledInput" type="text" placeholder="Disabled input here..." disabled="">
	</td>
	<td>
		<a class="edit" href="javascript:;">Edit</a>
	</td>
	<td>
		<a class="delete" href="javascript:;">Delete</a>
	</td>
</tr>
@endsection