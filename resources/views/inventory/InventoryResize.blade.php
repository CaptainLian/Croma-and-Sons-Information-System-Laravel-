@extends('inventory.main',['active' => 'InventoryResize'])

@section('title')
Product Resizing
@endsection

@push('css')
	<link rel="stylesheet" type="text/css" href="/css/jquery.steps.css" />
@endpush

@section('main-content')

@endsection

@push('javascript')
<!--Form Validation-->
          <script src="js/bootstrap-validator.min.js" type="text/javascript"></script>

          <!--Form Wizard-->
          <script src="js/jquery.steps.min.js" type="text/javascript"></script>
          <script src="js/jquery.validate.min.js" type="text/javascript"></script>
<!--script for this page-->
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