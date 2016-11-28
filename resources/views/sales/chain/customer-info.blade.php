
<div class="col-lg-4 col-sm-4">
	<h4>CUSTOMER INFORMATION</h4>
	<p>Customer Name :
		@if(isset($customer))
		<strong>{{$customer[0]->Name}}</strong>
		<br>Customer Address:
		<b>{{$customer[0]->Address}}</b>
			<br>Contact Number:
			<b>{{$customer[0]->MobileNumber}}</b>
			<br>
			<b>{{$customer[0]->Landline}}</b>
		</p>
		@elseif(isset($so))
		<strong>{{$so[0]->Name}}</strong>
		<br>Customer Address:
		<b>{{$so[0]->Address}}</b>
			<br>Contact Number:
			<b>{{$so[0]->MobileNumber}}</b>
			<br>
			<b>{{$so[0]->Landline}}</b>
		</p>
		@endif
	</p>


</div>