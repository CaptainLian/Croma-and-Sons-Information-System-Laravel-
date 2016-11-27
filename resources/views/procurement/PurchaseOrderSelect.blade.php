@extends('procurement.main')

@section('title')

@endsection

@section('sidebar')
	@include('procurement.sidebar', ['active' => 'PurchaseOrder'])
@endsection

@push('css')

@endpush

@section('main-content')
	<!-- page start-->
	@if(isset($success))
	<div class="row">
		<div class="alert alert-success alert-dismissible fade in">
			<strong>Success!</strong> {!!$success!!}
		</div>
	</div>
	@endif

	@foreach($errors->all() as $message)
		<div class="row">
			<div class="alert alert-danger alert-dismissible fade in">
				<strong>Warning!</strong> {!!$message!!}
			</div>
		</div>
	@endforeach
	<div class="row">
	    <div class="col-sm-12">
	        <section class="panel">
	            <header class="panel-heading">
	                <h1>Purchase Requests</h1>
	            </header>

							{!!Form::open(['action' => 'BusinessControllers\ProcurementPageController@viewFormPurchaseOrder', 'method' => 'GET'])!!}
	            <div class="panel-body">

	                <div class="adv-table">
	                    <table class="display table table-bordered table-striped" id="dynamic-table">
	                        <thead>
	                            <tr>
	                                <th class="col-md-3">Material</th>
	                                <th class="col-md-2">Size</th>
	                                <th class="col-md-1">Quantity</th>
	                                <th class="col-md-2">Recommended Supplier (least reject)</th>
	                                <th class="col-md-2">Select Product</th>
	                            </tr>
	                        </thead>
	                        <tbody>
															<?php $value = 0; ?>
															@foreach ($leastReject as $request)
																<tr>
																	<td>{!!$request->WoodType!!}</td>
																	<td>{!!$request->Size!!}</td>
																	<td>{!!$request->RequestedQuantity!!}</td>
																	@if($request->Name === NULL)
																		<td>None</td>
																	@else
																		<td>{!!$request->Name!!}</td>
																	@endif

																	<td>{!!Form::checkbox('products[]', $request->WoodTypeID.','.$request->Size.','.$request->RequestedQuantity.','.$request->SupplierID)!!}</td>
																</tr>
																<?php $value++; ?>

															@endforeach
	                        </tbody>
	                    </table>
	                </div>
	            </div>

	            <div class="text-center invoice-btn">
	                <!-- <a class="btn btn-info btn-lg" href="ProcurementCreatePurchaseOrder.html"><i class="fa fa-check"></i> Make Purchase Order </a> -->
									{!!Form::submit('Proceed to Purchase Order', ['class' => 'btn btn-success btn-lg'])!!}
	            </div>
							{!!Form::close()!!}
	        </section>
	    </div>
	</div>
	<!-- page end-->
@endsection

@push('javascript')

@endpush
