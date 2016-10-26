@extends('sales.parents.SalesOrderForm')

@section('sidebar')

@include('sales.chain.sidebar',['active' => 'sof'])

@endsection



@section('csof')


{!! Form::open(['url' => 'sales/salesOrder/create']) !!}



<div class="row">

	<div class="form-group">
		<label class="control-label col-md-1">Set Delivery Date</label>
		<div class="col-md-3 col-xs-11">

			<div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="12-02-2012"  class="input-append date dpYears">

				{!! Form::date('date',\Carbon\Carbon::now(),['class'=>'form-control','readonly' => '""']) !!}

				<span class="input-group-btn add-on">
					<button class="btn btn-danger" type="button"><i class="fa fa-calendar"></i></button>
				</span>
			</div>



			<br>
		</div>

	</div>
</div>

<div class="row">
  <div class="form-group">

   {!! Form::label('address','Address',['class' => 'col-sm-1 col-sm-2 control-label'])!!}

   <div class="col-sm-3">

    {!! Form::text('address',null,['class' => 'form-control'])!!}

  </div>
</div>

</div>
<br>


<div class="row">
  <div class="form-group">

   {!! Form::label('delivery-address','Delivery Adress',['class' => 'col-sm-1 col-sm-2 control-label'])!!}
   <div class="col-sm-3">
    {!! Form::text('delivery-address',null,['class' => 'form-control'])!!}
  </div>
</div>

</div>


<br>

<div class="row">

  {!! Form::label('terms','Terms',['class' => 'col-sm-1 col-sm-2 control-label'])!!}
  <div class="col-sm-3">
   {!! Form::select('terms',$terms,null,
   ['class' => 'form-control m-bot15']) !!}


 </div>

</div>


<div class="row" id="newUserRow">
  <div class="form-group" id="toHide1">
   {!! Form::label('customerName','Customer Name',['class' => 'col-sm-1 control-label col-lg-1'])!!}

   <div class="col-lg-3">
    <div class="input-group m-bot15">
     <span class="input-group-btn">
      <button class="btn btn-white" type="button" id="newUser">New User</button>
    </span>
    {!! Form::select('customerName',$customers,null,
    ['class' => 'form-control m-bot15']) !!}

  </div>
</div>
</div>
</div>



<div class="form-group" id="toHide">

	<label class="col-sm-1 control-label col-lg-1" >Customer Name</label>
	<div class="col-lg-3">
		<div class="input-group m-bot15">
			<span class="input-group-btn">
				<button class="btn btn-white" type="button" id="cancelButton">Cancel</button>
			</span>
			<input type="text" class="form-control">
		</div>
	</div>
</div>




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
              <th>Discount</th>
              <th>Amount</th>              
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr class="">
              <td>
                
              </td>
              <td>
              

             </td>
             <td>
             

            </td>
            <td>
             

           </td>
           <td>
            

           </td>
           <td>
             


           </td>

           <td>
             
           </td>
           <td>
            
           </td>
           <td>
            
           </td>

           <td>

           </td>
         </tr>
       </tbody>
     </table>
   </div>
 </div>
</div>
</section>



<div class="row">
  <div class="col-lg-4 invoice-block pull-right">
    <ul class="unstyled amounts">
      <li><strong>Sub - Total amount :</strong> $6820</li>
      <li><strong>Discount :</strong> 10%</li>
      <li><strong>VAT :</strong> -----</li>
      <li><strong>Grand Total :</strong> $6138</li>
    </ul>
  </div>
</div>

<div class="text-center invoice-btn">
  {!! Form::button('Submit Sales Form',[
  "class" => 'btn btn-danger btn-lg fa fa-check',
  'type' => 'submit']) !!}  


</div>


@include('sales.chain.editable-table-SOF')

{!! Form::close()!!}
@endsection

