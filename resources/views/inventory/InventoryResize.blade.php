@extends('inventory.main', ['active' => 'InventoryResize'])

@section('title')

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
          <form class="form-horizontal" id="default">
            <fieldset title="Step1" class="step" id="default-step-0">
              <legend> </legend>


              <table class="table table-striped table-hover">

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
                  <tr>
                    <td>LCD Monitor</td>
                    <td class="hidden-phone">22-12-10</td>
                    <td></td>
                    <td>

                      <input class="form-control" type="text"> </input>

                    </td>

                  </div>



                </td>

              </tr>


            </tbody>
          </table>

        </fieldset>
        <fieldset title="Step 2" class="step" id="default-step-1" >
          <legend> </legend>
          <table class="table table-striped table-hover">

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
              <tr>
                <td>LCD Monitor</td>
                <td class="hidden-phone">22-12-10</td>
                <td> 5 </td>
                <td><input type="text" class="form-control"> </input></td>

              </tr>


            </tbody>
          </table>


        </fieldset>
        <fieldset title="Step 3" class="step" id="default-step-2" >
          <legend> </legend>


          <table class="table table-striped table-hover">

            <header class="panel-heading">
              <h3>Outcome</h3>
            </header>
            <thead>
              <tr>

                <th class="col-md-3">Material</th>
                <th class="col-md-2">Thickness</th>
                <th class="col-md-2">Width</th>
                <th class="col-md-2">Length</th>
                <th class="col-md-2">Qty</th>


              </tr>
            </thead>
            <tbody>
              <tr>
                <td>        <select class="form-control m-bot15">
                  <option>Option 1</option>
                  <option>Option 2</option>
                  <option>Option 3</option>
                </select> </td>
                <td><input type="text" class="form-control"> </input></td>
                <td><input type="text" class="form-control"> </input></td>
                <td><input type="text" class="form-control"> </input></td>
                <td><input type="text" class="form-control"> </input></td>

              </tr>


            </tbody>
          </table>

        </fieldset>
        <input type="submit" class="finish btn btn-success" value="Finish"/>
      </form>
    </div>
  </section>
  </div>
  </div>

  <!-- page end-->
@endsection

@push('javascript')
   <script src="/js/jquery.stepy.js"></script>
    <script>

      //step wizard

      $(function() {
        $('#default').stepy({
          backLabel: 'Previous',
          block: true,
          nextLabel: 'Next',
          titleClick: true,
          titleTarget: '.stepy-tab'
        });
      });
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
