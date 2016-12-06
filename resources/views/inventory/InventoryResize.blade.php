@extends('inventory.main', ['active' => 'InventoryResize'])

@section('title')
Inventory Resize
@endsection

@push('css')

@endpush

@section('main-content')
<!-- page start-->
<div class="row">
  <div class="col-lg-12">
    <section class="panel">
      <header class="panel-heading">
        <h1> Resize </h1>
      </header>
      <div class="panel-body">
        <div class="stepy-tab">
          <ul id="default-titles" class="stepy-titles clearfix">
            <li id="default-title-0" class="current-step">
              <div>Resize</div>
            </li>
            <li id="default-title-1" class="">
              <div>Step 2</div>
            </li>
            <li id="default-title-2" class="">
              <div>Step 3</div>
            </li>
          </ul>
        </div>
        {!!Form::open(['class' => '$form-horizontal', 'id'=>'default', 'action' => 'BusinessControllers\InventoryFormController@inputResize', 'method' => 'GET'])!!}
          <fieldset title="Step1" class="step" id="default-step-0">
            <legend> </legend>
            <table class="table table-striped table-hover" id="approveTable">
              <header class="panel-heading">
                <h3>Sales Order</h3>
              </header>
              <thead>
                <tr>
                  <th class="col-md-3">Material</th>
                  <th class="col-md-3">Size</th>
                  <th class="col-md-3">Qty Requested</th>
                  <th class="col-md-3">Qty Approved</th>
                </tr>
              </thead>
              <tbody>
                @foreach($orderItems as $item)
                <tr>
                  <input type="hidden" name="ApprovedWoodTypeID[]"  value="{!!$item->WoodTypeID!!}"/>
                  <input type="hidden" name="ApprovedThickness[]"  value="{!!$item->Thickness!!}"/>
                  <input type="hidden" name="ApprovedWidth[]"  value="{!!$item->Width!!}"/>
                  <input type="hidden" name="ApprovedLength[]"  value="{!!$item->Length!!}"/>

                  <td>{!!$item->WoodType!!}</td>
                  <td>{!!$item->Size!!}</td>
                  <td>{!!$item->Quantity!!}</td>
                  <td> <input name="ApprovedQuantity[]" class="form-control" type="number" min="0" max="{!!$item->Quantity!!}" step="1"  /> </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </fieldset>

          <fieldset title="Step 2" class="step" id="default-step-1" >
            <legend> </legend>
            <table class="table table-striped table-hover" id="inputTable">
              <header class="panel-heading">
                <h3>Inventory List</h3>
              </header>
              <thead>
                <tr>
                  <th>Material</th>
                  <th class="">Size</th>
                  <th class="">Current Qty</th>
                  <th class="col-md-2">Qty to Cut</th>
                </tr>
              </thead>
              <tbody>
                @foreach($inventory as $product)
                  <tr>
                    <input type="hidden" name="WoodType[]" value="{!!$product->Material!!}" />
                    <input type="hidden" name="WoodTypeID[]" value="{!!$product->WoodTypeID!!}" />

                    <input type="hidden" name="Size[]" value="{!!$product->Size!!}" />
                    <input type="hidden" name="Thickness[]" value="{!!$product->Thickness!!}" />
                    <input type="hidden" name="Width[]" value="{!!$product->Width!!}" />
                    <input type="hidden" name="Length[]" value="{!!$product->Length!!}" />


                    <td>{!!$product->Material!!}</td>
                    <td>{!!$product->Size!!}</td>
                    <td>{!!$product->StockQuantity!!}</td>
                    <td><input name="InputQuantity[]" type="number" value="0" min="0" step="1" max="{!!$product->StockQuantity!!}" /></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </fieldset>

          <fieldset title="Step 3" class="step" id="default-step-2" >
            <legend> </legend>
            <table class="table table-striped table-hover" id="outputTable">
              <header class="panel-heading">
                <h3>Outcome</h3>
              </header>
              <thead>
                <tr>
                  <th class="col-md-3">Material</th>
                  <th class="col-md-1">Input Size</th>
                  <th class="col-md-1">Input Quantity</th>
                  <th class="col-md-2">Output Thickness</th>
                  <th class="col-md-2">Output Width</th>
                  <th class="col-md-2">Output Length</th>
                  <th class="col-md-2">Output Quantity</th>
                </tr>
              </thead>
              <tbody>
                
              </tbody>
            </table>
            <div>
              <input type="hidden" name="salesOrderID" value="{!!$salesOrderID!!}" />
            </div>
            <div id="i">
              
            </div>
          </fieldset>
          <input type="submit" class="finish btn btn-success" value="Finish"/>
        {!!Form::close()!!}
      </div>
    </section>
  </div>
</div>
<!-- page end-->
@endsection

@push('javascript')
  <!--Form Validation-->
  <script src="/js/bootstrap-validator.min.js" type="text/javascript"></script>

  <!--Form Wizard-->
  <script src="/js/jquery.steps.min.js" type="text/javascript"></script>
  <script src="/js/jquery.validate.min.js" type="text/javascript"></script>
  <script src="/js/jquery.stepy.js"></script>
  <script>
      $(document).ready(function(){
        $('#default').stepy({
          backLabel: 'Previous',
          block: true,
          nextLabel: 'Next',
          titleClick: false,
          transition: 'slide',
          titleTarget: '.stepy-tab',
          next: function(newIndex){
             let currentIndex = newIndex - 1;

             let goNext = true;

             if(currentIndex == 1){
                $('input[name="ApprovedQuantity[]"]').each(function (index, element){
                  let currentElement = $(this);
                  if(parseInt(currentElement.val()) > parseInt(currentElement.attr('max'))){
                    goNext = false;
                    alert('Error! One of the approved quantities is larger than the requested quantity.');
                    return false;
                  } 
                  else if(isNaN(parseInt(currentElement.val()))){
                    goNext = false;
                    alert('Error! One of the approve quantities is invalid.');

                    return false;
                  }
                });
             }else if(currentIndex == 2){

                $('input[name="InputQuantity[]"]').each(function(index, element){
                  let currentElement = $(this);

                  let currentValue = currentElement.val();

                  if(parseInt(currentValue) != parseFloat(currentValue)){
                    goNext = false;
                    alert('Error! Please input integers only.');
                    return false;
                  }
                });

                if(goNext){
                  $('#outputTable tbody > tr').remove();

                  let hiddenArea = $('#i');
                  hiddenArea.empty();

                  let approvedProducts = new Array();

                  $('#approveTable tbody > tr').each(function(index, element){
                    let currentRow = $(this);

                    let approvedWoodTypeID = currentRow.find('input[name="ApprovedWoodTypeID[]"]').val();
                    let approvedThickness = currentRow.find('input[name="ApprovedThickness[]"]').val();
                    let approvedWidth = currentRow.find('input[name="ApprovedWidth[]"]').val();
                    let approvedLength = currentRow.find('input[name="ApprovedLength[]"]').val();
                    let approvedQuantity = currentRow.find('input[name="ApprovedQuantity[]"]').val();

                      let hidden = '';
                    
                      hidden += '<input type="hidden" name="ApprovedWoodTypeID[]" value="' + approvedWoodTypeID + '" />';
                      hidden += '<input type="hidden" name="ApprovedThickness[]" value="' + approvedThickness + '" />';
                      hidden += '<input type="hidden" name="ApprovedWidth[]" value="' + approvedWidth + '" />';
                      hidden += '<input type="hidden" name="ApprovedLength[]" value="' + approvedLength + '" />';
                      hidden += '<input type="hidden" name="ApprovedQuantity[]" value="' + approvedQuantity + '" />';

                      hiddenArea.append(hidden);

                  });

                  let outputTableBody = $('#outputTable tbody');
                  
                  
                  $('#inputTable tbody > tr').each(function(index, element){
                    let currentRow = $(this);

                    let material = currentRow.find('input[name="WoodType[]"]').val();
                    let woodTypeID = currentRow.find('input[name="WoodTypeID[]"]').val();
                    let size = currentRow.find('input[name="Size[]"]').val();
                    let thickness = currentRow.find('input[name="Thickness[]"]').val();
                    let width = currentRow.find('input[name="Width[]"]').val();
                    let length = currentRow.find('input[name="Length[]"]').val();

                    let inputQuantity = currentRow.find('input[name="InputQuantity[]"]').val();

                    if(inputQuantity > 0 ){

                      let hidden = '';
                      

                      hidden += '<input type="hidden" name="InputWoodTypeID[]" value="' + woodTypeID + '" />';
                      hidden += '<input type="hidden" name="InputThickness[]" value="' + thickness + '" />';
                      hidden += '<input type="hidden" name="InputWidth[]" value="' + width + '" />';
                      hidden += '<input type="hidden" name="InputLength[]" value="' + length + '" />';
                      hidden += '<input type="hidden" name="InputQuantity[]" value="' + inputQuantity + '" />';

                      let row = '';

                      row = '<tr>';
                      row += '<td>' + material + '</td>';
                      row += '<td>' + size + '</td>';
                      row += '<td>' + inputQuantity + '</td>';
                      row += '<td>' + '<input type="number" name="OutputThickness[]" step="any" min=0 required="required" />'+ '</td>';
                      row += '<td>' + '<input type="number" name="OutputWidth[]" step="any" min=0 required="required" />'+ '</td>';
                      row += '<td>' + '<input type="number" name="OutputLength[]" step="any" min=0 required="required" />'+ '</td>';
                      row += '<td>' + '<input type="number" name="OutputQuantity[]" step="1" min=1 required="required" />'+ '</td>';
                      row += '</tr>';

                      outputTableBody.append(row);
                      hiddenArea.append(hidden);

                    }
                  });
                  
                }

             }
             return goNext;
          }
        });
      });

      function isInteger(num){
        return !isNaN(num) && parseInt(num) == parseFloat(num);
      }
  </script>

  <script type="text/javascript">
    $(document).ready(function () {
      var form = $("#wizard-validation-form");
      form.validate({
        errorPlacement: function errorPlacement(error, element) {
          element.after(error);
        }
      });
      form.children("div").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        onStepChanging: function (event, currentIndex, newIndex) {
          form.validate().settings.ignore = ":disabled,:hidden";
          console.log(currentIndex)
          console.log('aguy');
          return form.valid();
        },
        onFinishing: function (event, currentIndex) {
          form.validate().settings.ignore = ":disabled";
          return form.valid();
        },
        onFinished: function (event, currentIndex) {
          alert("Submitted!");
        }
      });
    });
  </script>
@endpush
