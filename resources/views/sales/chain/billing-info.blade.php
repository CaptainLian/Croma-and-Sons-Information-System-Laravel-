
<div class="col-lg-4 col-sm-4">
	<h4>BILLING AND DELIVERY INFORMATION</h4>


	<p>Payment Terms :
		<strong> {{$so[0]->Terms}}</strong>

		@if($active == 'si')
			<br>Delivery Date :  <strong> {{$so[0]->DateDelivered}}</strong>  </br>

		@endif

	



		@if($active =='si')
			Delivery
		@else
			<br/>
		@endif


		Delivery Address:
		<b>

			{{$so[0]->DeliveryAddress}}


		</b>

			<br>
		</p>

</div>
