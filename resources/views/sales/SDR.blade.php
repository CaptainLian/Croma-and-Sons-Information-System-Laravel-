@extends('sales.parents.SalesDeliveryReceipt')

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
	@include('sales.chain.delivery-info')
@endsection