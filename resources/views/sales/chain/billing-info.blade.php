	
<div class="col-lg-4 col-sm-4">
	<h4>BILLING AND DELIVERY INFORMATION</h4>


	<p>Payment Terms :
		<strong> {{$so[0]->Terms}}</strong>
		@if($active == 'si')
			<br>Delivery Date :  <strong> 2013-03-17</strong>  </br>

		@endif
		@if($active =='si')
			Delivery
		@else
			<br/>
		@endif


		 Address:
		<b>Need column address in DB</b>

			<br>
		</p>

</div>
