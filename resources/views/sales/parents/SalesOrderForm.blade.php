<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from thevectorlab.net/flatlab/invoice.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 Aug 2016 03:22:31 GMT -->
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Mosaddek">
  <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <link rel="shortcut icon" href="{{URL::asset('img/favicon.html')}}">

  <title>Croma and Sons</title>

  <!-- Bootstrap core CSS -->
  <link href="{{URL::asset('css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{URL::asset('css/bootstrap-reset.css')}}" rel="stylesheet">
  <!--external css-->
  <link href="{{URL::asset('assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
  <!--right slidebar-->
  <link href="{{URL::asset('css/slidebars.css')}}" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="{{URL::asset('css/style.css')}}" rel="stylesheet">
  <link href="{{URL::asset('css/style-responsive.css')}}" rel="stylesheet" />
  <link href="{{URL::asset('css/invoice-print.css')}}" rel="stylesheet" media="print">
  <link rel="stylesheet" href="{{URL::asset('assets/data-tables/DT_bootstrap.css')}}" />

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
      <![endif]-->
    </head>

    <body>

      <section id="container" class="">
        <!--header start-->
        <header class="header white-bg">
          <div class="sidebar-toggle-box">
            <i class="fa fa-bars"></i>
          </div>
          <!--logo start-->
          <a href="SalesDashboard.html" class="logo">Croma<span id="AND">and</span><span id="SONS">Sons</span></a>
          <!--logo end-->

          <div class="top-nav ">
            <ul class="nav pull-right top-menu">

              <!-- user login dropdown start-->
              <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                  <span class="username">Jhon Doue</span>
                  <b class="caret"></b>
                </a>
                <ul class="dropdown-menu extended logout">
                  <div class="log-arrow-up"></div>
                  <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                  <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                  <li><a href="#"><i class="fa fa-bell-o"></i> Notification</a></li>
                  <li><a href="\logout"><i class="fa fa-key"></i> Log Out</a></li>
                </ul>
              </li>
              <!-- user login dropdown end -->
              
            </ul>
          </div>
        </header>
        <!--header end-->
        <!--sidebar start-->







        <aside>
          @section('sidebar')
          @show
        </aside>

        <img src="img/vector-lab.jpg" alt="">
        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
          <section class="wrapper">
            <!-- invoice start-->
            <section>
              <div class="panel panel-primary">
                <!--<div class="panel-heading navyblue"> INVOICE</div>-->
                <div class="panel-body">

                  @yield('csof')

                  <!-- // Start of Editable  -->


                </div>
              </div>
            </section>
            <!-- invoice end-->
          </section>
        </section>
        <!--main content end-->
        <!-- Right Slidebar start -->

        <!-- Right Slidebar end -->
        <!--footer start-->
        <footer class="site-footer">
          <div class="text-center">
            2013 &copy; FlatLab by VectorLab.
            <a href="#" class="go-top">
              <i class="fa fa-angle-up"></i>
            </a>
          </div>
        </footer>
        <!--footer end-->
      </section>

      <!-- js placed at the end of the document so the pages load faster -->
      <script src="{{URL::asset('js/jquery.js')}}"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
      <script >

      quantity = [];
      price = [];
      stock = [];
      token = $('meta[name="csrf-token"]').attr('content');

      $('#customer-select').change(function(){
        var id = $(this).val();
        $.ajax({
          type:'POST',
          url:'/sales/salesOrder/check2',
          data:{'_token':token,'id':id},
          success:function(data){
            $('#delivery-address').val(data);
          }

        })
      });

     /* var subtotal = array();
      var quan = array();*/
/*      $('#editable-sample').on('change','.disc',function(){

            console.log('asddasd');
            $('#editable-sample').on('val','.amt',1);


      });*/
      //
      function check(error, prices){

        ctrErr = 0;
        $('#editable-sample tr').each(function(){
        if(ctrErr > -1){
          if(error[ctrErr] == 'X'){

            ctrVal = 0
            $(this).find('td').each(function(){
              if(ctrVal > -1 && ctrVal < 4){
               if($(this).hasClass('has-error')){
                   $(this).removeClass('has-error').addClass('has-success');
                }else{
                  $(this).addClass('has-success');
                }
              }else if(ctrVal == 5){

              }else if(ctrVal == 6){

                $(this).find('input').val(prices[ctrErr][0]['CurrentUnitPrice']);
              }
              ctrVal++;
            });
            /*ctrVal = 0;
            $('.material')each(function{

              ctrVal++;
            });*/
          }else{

            ctrVal = 0;
            $(this).find('td').each(function(){
              if(ctrVal > -1 && ctrVal < 4){
                if($(this).hasClass('has-success')){
                   $(this).removeClass('has-success').addClass('has-error');
                }else{
                  $(this).addClass('has-error');
                }

              }
              ctrVal++;
            });
          }
        }
        ctrErr++;
       });
      }


       /* console.log('asd');*/
       /* setTimeout(check,3000);*/
      // Check if Quantity is enough and change color
      //  QUANTITY CHECKIN
      // $('#editable-sample').on('change','.quan',function(){
      //         ctrVal = 0;
      //         console.log('Quantity event');
      //         console.log(stock);


      //         $('.quan').each(function(){

      //           /*console.log(stock);
      //           console.log(stock.length);
      //           console.log(stock[0]);*/
      //           /*console.log(stock[ctrVal][0]['StockQuantity']);*/
      //           console.log($(this).val());
      //           if(stock[ctrVal + 1] instanceof Array ){
      //               console.log('pagkatapos ng number')
      //              if($(this).val() > parseInt(stock[ctrVal +1][0]['StockQuantity'])){
      //               if($(this).parent().hasClass('has-success')){

      //                  $(this).parent().removeClass('has-success').addClass('has-error');
      //               }else{
      //                 $(this).parent().addClass('has-error');
      //             }
      //             }else{

      //               if($(this).parent().hasClass('has-error')){
      //                  $(this).parent().removeClass('has-error').addClass('has-success');
      //               }else{
      //                 $(this).parent().addClass('has-success');
      //               }



      //             }

      //           }

      //           ctrVal++;
      //       });
      //      console.log('HAHHAHA');

      //   });
      // END QUANTITY CHECKIN


      //if there's a new input in orders
       $('#editable-sample').on('change','.len, .thick, .wid, .material',function(){
          lg = [];
          width = [];
          thickness = [];
          quantity = [];
          material = []
          console.log(lg.lenth);
          $('.len').each(function(){

            console.log('len');
            console.log($(this).val());
            lg.push($(this).val());
          });
          $('.wid').each(function(){

            width.push($(this).val());
          });
          $('.thick').each(function(){

            thickness.push($(this).val());
          });

          $('.quan').each(function(){

            quantity.push($(this).val());
          });
          $('.material').each(function(){

            material.push($(this).val());
          });
          console.log(thickness);
          console.log(width);
          console.log(lg);
          /*for(ctr=0;ctr<lg.length;ctr++){
            console.log('start');
            console.log(thickness[ctr]);
            console.log(lg[ctr]);
            console.log(width[ctr]);
             console.log('end');
          }
*/

          $.ajax({
            type: "POST",
            url : '/sales/salesOrder/check',
            data : {'_token' : token , 'width':width,
            'length' : lg, 'thickness': thickness,
            'quantity': quantity, 'material' : material},
            success:function(response){
              console.log('json');
              console.log((response));
              check(response['error'],response['prices']);
              stock = response['stock'];
              console.log(stock);

            }
          })/*
           .done(function() {
            alert( "second success" );
          })
          .fail(function(xhr, status, error) {
            console.log(xhr);
            console.log(status);
            alert(error);
            alert( "error" );
          })*/




      });

      $('#editable-sample_new').click(function(){
        console.log($('#editable-sample').dataTable().fnGetData());


      });

      $('#editable-sample').on('change','.quan, .len, .wid, .thick',function(){
          quantity = [];
          console.log('quan');
          $('.quan').each(function(){
            // console.log($(this).val());
            quantity.push($(this).val());
            // console.log(quantity.length);


          });
          price = [];
          $('.price').each(function(){
            // console.log('price');
            // console.log($(this).val());
            price.push($(this).val());
            // console.log(price.length);


          });

          var tr = $(this).closest('tr');


          var x = 0;
          $("tr").find('.total2').each(function(){
            // val( $(this).val() * parseInt(price)  
            $(this).val(quantity[x] * price[x] );
            x++;
          });
          
          console.log("price NEILASD");
          console.log(price);


           compute();
      });




      $('#dis').change(function(){
      /*  console.log($(this).val());     */
          compute();
      })



      function compute(){
          if(quantity.length > -1 && price.length > -1){
            total = 0;

            $('.total2').each(function(){
              total += parseInt($(this).val());
            });

            // for( ctr = 0; ctr < quantity.length; ctr++){
            //     total += quantity[ctr]*price[ctr];
            // }
            console.log(total);
            $("#sub").html(total);
            total = total - (total * ($('#dis').val()/100) );
            $('#tot').html(total);


        }
      }

      </script>

      <script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
            <script src="{{URL::asset('js/jquery-migrate-1.2.1.min.js')}}"></script>
     <!--  <script src="{{URL::asset('js/bootstrap-wysihtml5p.min.js')}}"></script> -->
      <script class="include" type="text/javascript" src="{{URL::asset('js/jquery.dcjqaccordion.2.7.js')}}"></script>
      <script src="{{URL::asset('js/jquery.scrollTo.min.js')}}"></script>
      <script src="{{URL::asset('js/jquery.nicescroll.js')}}" type="text/javascript"></script>
      <script src="{{URL::asset('js/respond.min.js')}}" ></script>



      <script type="text/javascript" src="{{URL::asset('assets/fuelux/js/spinner.min.js')}}"></script>
      <!-- <script type="text/javascript" src="{{URL::asset('assets/bootstrap-fileupload/bootstrap-fileupload.js')}}"></script>
      <script type="text/javascript" src="{{URL::asset('assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js')}}"></script>
      <script type="text/javascript" src="{{URL::asset('assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js')}}"></script>
      <script type="text/javascript" src="{{URL::asset('assets/bootstrap-datepicker/js/bootstrap-datepicker.js')}}></script>
      <script type="text/javascript" src="{{URL::asset('assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js')}}"></script> -->
      <script type="text/javascript" src="{{URL::asset('assets/bootstrap-daterangepicker/moment.min.js')}}"></script>
      <script type="text/javascript" src="{{URL::asset('assets/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

      <script type="text/javascript" src="{{URL::asset('assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js')}}"></script>
      <script type="text/javascript" src="{{URL::asset('assets/bootstrap-timepicker/js/bootstrap-timepicker.js')}}"></script>
      <script type="text/javascript" src="{{URL::asset('assets/jquery-multi-select/js/jquery.multi-select.js')}}"></script>
      <script type="text/javascript" src="{{URL::asset('assets/jquery-multi-select/js/jquery.quicksearch.js')}}"></script>
      <script type="text/javascript" src="{{URL::asset('assets/data-tables/jquery.dataTables.js')}}"></script>
      <script type="text/javascript" src="{{URL::asset('assets/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
      <script type="text/javascript" src="{{URL::asset('assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js')}}"></script>

      <script type="text/javascript" src="{{URL::asset('assets/data-tables/DT_bootstrap.js')}}"></script>




      <!--script for this page only-->



      <!--this page  script only-->

            <!--this page script only-->


      <!--right slidebar-->

      <script src="{{URL::asset('js/slidebars.min.js')}}"></script>

      <!--common script for all pages-->
      <script src="{{URL::asset('js/common-scripts.js')}}"></script>

      <script src="{{URL::asset('js/advanced-form-components.js')}}"></script>
      <script>
         EditableTable.init();


        $('#customer-address-new').hide();
        $("#cancelButton").click(function(){
          $('#customer-address-new').hide();
          $('#customer-text').attr('value','');
          $('#customer-address').attr('value','');
        });
         $("#newUser").click(function(){
          $('#customer-address-new').show();
          $('#customer-select').attr('value','null');
        });


       $(document).ready(function() {

         $("#newUser").click(function (){




         $("#toHide").show();
         $("#toHide1").hide();

	 /*	$("#newUserRow").html(" <div class=\"form-group\">" +
                                      "<label class=\"col-sm-1 col-sm-2 control-label\">Customer Name</label>" +
                                      "<div class=\"col-sm-3\">" +
                                          "<input type=\"text\" class=\"form-control\">" +
                                    "  </div> " +
                                "  </div> ");


                                */

                              });



        $("#cancelButton").click(function(){


          $("#toHide").hide();
          $("#toHide1").show();

        });



      });

    </script>

  </body>

  <!-- Mirrored from thevectorlab.net/flatlab/invoice.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 Aug 2016 03:22:32 GMT -->
  </html>
