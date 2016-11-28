@extends('sales.parents.SalesOrderForm')

@section('sidebar')

@include('sales.chain.sidebar',['active' => 'sof'])

@endsection



@section('csof')

@if(isset($outcome) )
   @if($outcome == 1)
    <div class="alert alert-success alert-block fade in">
  @elseif($outcome == 0)
    <div class="alert alert-danger alert-block fade in">
  @endif

    <button data-dismiss="alert" class="close close-sm" type="button">
      <i class="fa fa-times"></i>
    </button>
    <h4>
      <i class="fa fa-ok-sign"></i>
        @if($outcome == 1)
          Success!
        @elseif($outcome == 0)
          Failed!
        @endif

    </h4>


        <p>
        @if($outcome == 1)
          Sales order has been sent to inventory for approval.
        @else
          {!!$outcomeMessage !!}
        @endif
      </p>

  </div>
@endif

{!! Form::open(['url' => 'sales/salesOrder/create']) !!}



<div class="row">

	<div class="form-group">
		<label class="control-label col-md-1">Set Expected Delivery Date</label>
		<div class="col-md-4 col-xs-11">

			<div data-date-viewmode="years" data-date-format="yyyy-mm-dd" data-date="{{\Carbon\Carbon::now()}}"  class="input-append date dpYears">

				{!! Form::date('date',\Carbon\Carbon::now(),['class'=>'form-control','readonly' => '""','size'=>'16']) !!}

				<span class="input-group-btn add-on">
        {!! Form::button('<i class="fa fa-calendar"></i>',
        ['class' => 'btn ',
         'style' => 'padding:6px 9px 6px 9px;background-color:#ff6c60;color:white'])!!}

        </span>
      </div>



      <br>
    </div>

  </div>
</div>

<div class="row" id="newUserRow">
  <div class="form-group" id="toHide1">
    {!! Form::label('customerName','Customer Name',
    ['class' => 'col-sm-1 control-label col-lg-1'])!!}

    <div class="col-lg-4 col-md-4 ">
      <div class="input-group m-bot15">
       <span class="input-group-btn">
        <button class="btn btn-white" type="button" id="newUser">New Customer</button>
      </span>
      {!! Form::select('customerName', $customers,null,
      ['class' => 'form-control m-bot15',

       'id' => 'customer-select']) !!}

      </div>
    </div>
  </div>

  <div class="form-group" id="toHide">

    {!! Form::label('customerName1','Customer Name',['class' => 'col-sm-1 control-label col-lg-1'])!!}
    <div class="col-lg-4">
      <div class="input-group m-bot15">
        <span class="input-group-btn">
          <button class="btn btn-white" type="button" id="cancelButton">Cancel</button>
        </span>
        {!! Form::text('customerName1',null,['class' => 'form-control',
        'id' => 'customer-text'])!!}
      </div>
    </div>
  </div>




</div>


<div class="row">

  {!! Form::label('terms','Payment Terms',['class' => 'col-sm-1 col-sm-2 control-label'])!!}
  <div class="col-sm-4">
   {!! Form::select('terms',$terms,null,
   ['class' => 'form-control m-bot15']) !!}


 </div>

</div>



<!--
<div class="row">
  <div class="form-group">

   {!! Form::label('address','Address',['class' => 'col-sm-1 col-sm-2 control-label'])!!}

   <div class="col-sm-3">

    {!! Form::text('address',null,['class' => 'form-control'])!!}

  </div>
</div>

</div> -->


<div class="row">
  <div class="form-group">

   {!! Form::label('delivery-address','Delivery Address',['class' => 'col-sm-1 col-sm-2 control-label'])!!}
   <div class="col-sm-4">
    {!! Form::text('delivery-address',null,['class' => 'form-control'])!!}
  </div>
</div>

</div>

<div class="row">
  <div class="form-group" id='customer-address-new'>

   {!! Form::label('customer-address','Customer Address',['class' => 'col-sm-1 col-sm-2 control-label'])!!}
   <div class="col-sm-4">
    {!! Form::text('customer-delivery-address',null,['class' => 'form-control',
    'id' =>'customer-address'])!!}
  </div>
</div>

<br>











<div class="row invoice-list">
  <div class="text-center corporate-id">
    <img src="img/vector-lab.jpg" alt="">
    <h1> Sales Order </h1>
  </div>
  <div class="col-lg-4 col-sm-4">
    <h4>SALES ORDER INFORMATION</h4>
    <ul class="unstyled">

    </li>
    <li>Order Date : <strong>{{$now}} </strong></li>
    <li>Prepared By : <strong>John Fisher</strong></li>
  </ul>
</div>

</div>

<section class="panel">
  <header class="panel-heading">
   Orders
 </header>
 <div class="panel-body">
  <div class="adv-table editable-table ">
    <div class="clearfix">
      <div class="btn-group">
        <button id="editable-sample_new" class="btn green">
          Add New <i class="fa fa-plus"></i>
        </button>
      </div>

      <div class="space15"></div>

      <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered" id="editable-sample">
          <thead>
            <tr>
              <th>Material</th>
              <th>Thickness(in)</th>
              <th>Width (in)</th>
              <th>Length (ft)</th>
              <th>Qty</th>
              <th>Unit</th>

              <th>Unit Price</th>
              <th>Total</th>
              <th></th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>



<div class="row">
  <div class="col-lg-4 invoice-block pull-right">
    <ul class="unstyled amounts">
      <li><strong>Subtotal  :</strong> <a id='sub'></a></li>
      <li><strong>{!! Form::label('discount','Discount : ')!!}</strong>{!! Form::text('discount',0,['style'=>'width:40px', 'id' => 'dis']) !!}%</li>

      <li ><strong> Total : </strong><a id="tot"></a></li>
    </ul>
  </div>
</div>

<div class="text-center invoice-btn">
 
 {!! Form::button('<i class="fa fa-check"></i>Submit Form',[
 "class" => 'btn btn-success btn-lg ',
 'type' => 'submit',
 'style' => 'font-weight:100;font-size:16px;font-family:Open Sans']) !!}
 <a class="btn btn-info btn-lg" onclick="javascript:window.print();"><i class="fa fa-print"></i> Print </a>


</div>


@include('sales.chain.editable-table-SOF')

{!! Form::close()!!}
@endsection
