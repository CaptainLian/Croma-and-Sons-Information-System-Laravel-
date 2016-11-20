<div class="col-lg-4 col-sm-4">
	<h4>DELIVERY RECEIPT INFORMATION</h4>
	<ul class="unstyled">

	@if($active == 'si')
		<li>Invoice Number :
			<strong>69626</strong>
		</li>
	@endif

		 
	@if($active == 'sdr')
		<li>Sales Order Number	 :
			<strong>{{$so[0]->SalesOrderID}}</strong>
		</li>

		<li>Order Date :
			<strong>{{$so[0]->DateCreated}}</strong>
		</li>

	@endif

		<li>Prepared By :
			<b>John Fisher</b>
		</li>
	</ul>
</div>