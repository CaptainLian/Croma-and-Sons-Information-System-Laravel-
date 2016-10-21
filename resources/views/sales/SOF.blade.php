@extends('sales.parents.SalesOrderForm')

@section('sidebar')

	@include('sales.chain.sidebar',['active' => 'sof'])

@endsection



@section('csof')
	

{!! Form::open() !!}



<div class="row">

	<div class="form-group">
		<label class="control-label col-md-1">Set Delivery Date</label>
		<div class="col-md-3 col-xs-11">

			<div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="12-02-2012"  class="input-append date dpYears">
				 
				{!! Form::date('name',\Carbon\Carbon::now(),['class'=>'form-control','readonly' => '""']) !!}

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
 	 
 	{!! Form::label('payment-terms','Delivery Adress',['class' => 'col-sm-1 col-sm-2 control-label'])!!}
 	<div class="col-sm-3">
 		{!! Form::select('size',
 		['Option1' => 'Option11',
 		 'Option2' => 'Option22',
 		  'Option3' => 'Option33'],null,
 		  ['class' => 'form-control m-bot15']) !!}
 	 

 	</div>

 </div>


 <div class="row" id="newUserRow">
 	<div class="form-group" id="toHide1">
 		{!! Form::label('customer-name','Customer Name',['class' => 'col-sm-1 control-label col-lg-1'])!!}
 		 
 		<div class="col-lg-3">
 			<div class="input-group m-bot15">
 				<span class="input-group-btn">
 					<button class="btn btn-white" type="button" id="newUser">New User</button>
 				</span>
 				{!! Form::select('size',
			 		['Option1' => 'Abdul Kair',
			 		 'Option2' => 'Option22',
			 		  'Option3' => 'Option33'],null,
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
      <li>Sales Number :
        <strong>69626</strong>
      </li>
      <li>Order Date : <strong>2013-03-20 </strong></li>
      <li>Prepared By : <strong>John Fisher</strong></li>
    </ul>
  </div>

</div>

<section class="panel">
  <header class="panel-heading">
    Editable Table
  </header>
  <div class="panel-body">
    <div class="adv-table editable-table ">
      <div class="clearfix">
        <div class="btn-group">
          <button id="editable-sample_new" class="btn green">
            Add New <i class="fa fa-plus"></i>
          </button>
        </div>
        <div class="btn-group pull-right">
          <button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
          </button>
          <ul class="dropdown-menu pull-right">
            <li><a href="#">Print</a></li>
            <li><a href="#">Save as PDF</a></li>
            <li><a href="#">Export to Excel</a></li>
          </ul>
        </div>
      </div>
      <div class="space15"></div>

      <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered" id="editable-sample">
          <thead>
            <tr>
              <th>Material</th>
              <th>T</th>
              <th>W</th>
              <th>L</th>
              <th>Qty</th>
              <th>Unit</th>
              <th>B/F</th>
              <th>Unit Price</th>
              <th>Discount</th>
              <th>Amount</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            <tr class="">
              <td>
                {!! Form::text('material[]',null,['class' => 'form-control m-bot15',
                'placeholder' => 'Material']) !!}
              </td>
              <td>
                 {!! Form::text('thickness[]',null,['class' => 'form-control m-bot15',
                'placeholder' => 'T']) !!}

              </td>
              <td>
                  {!! Form::text('width[]',null,['class' => 'form-control m-bot15',
                'placeholder' => 'W']) !!}
                 
              </td>
              <td>
                   {!! Form::text('length[]',null,['class' => 'form-control m-bot15',
                'placeholder' => 'L']) !!}
                
              </td>
              <td>
                   {!! Form::text('qty[]',null,['class' => 'form-control m-bot15',
                'placeholder' => 'Qty']) !!}
              
              </td>
              <td>
                 {!! Form::text('unit[]',null,['class' => 'form-control m-bot15',
                'placeholder' => 'Input']) !!}

               
              </td>
              <td>
                 {!! Form::text('bf[]',null,['class' => 'form-control m-bot15',
                'placeholder' => 'B/F']) !!}
                
              </td>
              <td>
                 {!! Form::text('unitprice[]',null,['class' => 'form-control m-bot15',
                'placeholder' => 'Unit Price']) !!}
                 
              </td>
              <td>
                 {!! Form::text('discount[]',null,['class' => 'form-control m-bot15',
                'placeholder' => 'Discount']) !!}
               
              </td>
              <td>
               {!! Form::text('amount[]',null,['class' => 'form-control m-bot15',
                'placeholder' => 'Amount']) !!}
                
              </td>
              <td>
                <a class="edit" href="javascript:;">Edit</a>
              </td>
              <td>
                <a class="delete" href="javascript:;">Delete</a>
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
  <a class="btn btn-danger btn-lg"><i class="fa fa-check"></i> Submit Sales Form </a>

</div>


@include('sales.chain.editable-table-SOF')

{!! Form::close()!!}
@endsection

