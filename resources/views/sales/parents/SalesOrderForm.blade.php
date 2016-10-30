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
                  <li><a href="login.html"><i class="fa fa-key"></i> Log Out</a></li>
                </ul>
              </li>
              <!-- user login dropdown end -->
              <li class="sb-toggle-right">
                <i class="fa  fa-align-right"></i>
              </li>
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
      <script >
      token = $('meta[name="csrf-token"]').attr('content');

       price = [],quantity = [];
     /* var subtotal = array();
      var quan = array();*/
/*      $('#editable-sample').on('change','.disc',function(){
          
            console.log('asddasd');
            $('#editable-sample').on('val','.amt',1);
            
          
      });*/
      /*function check(){
        if({{{ isset($temp) or 'false'}}}){
            console.log('asdasdasd');


        }
        console.log('asd');
        setTimeout(check,3000);
      }
      setTimeout(check,3000);*/



     

       $('#editable-sample').on('change','.length, .thickness, .width',function(){   
          lg = [];
          width = [];
          thickness = [];
          quantity = [];
          $('.length').each(function(){
             
            lg.push($(this).val());                  
          });      
          $('.width').each(function(){
             
            width.push($(this).val());                  
          });
          $('.thickness').each(function(){
             
            thickness.push($(this).val());                  
          });

          $('.quan').each(function(){
             
            quantity.push($(this).val());                  
          });


           $.ajax({
            type: "POST",
            url : '/sales/salesOrder/check',
            data : {'_token' : token , 'width':width,
            'length' : lg, 'thickness': thickness,
            'quantity': quantity}
          })
           /*.done(function() {
            alert( "second success" );
          })
          .fail(function(xhr, status, error) {
            console.log(xhr);
            console.log(status);
            alert(error);
            alert( "error" );
          })
          .always(function() {
            alert( "finished" );
          });*/



      });

      $('#editable-sample_new').click(function(){
        console.log($('#editable-sample').dataTable().fnGetData());


      });
      $('#editable-sample').on('change','.price',function(){   
          price = [];           
          $('.price').each(function(){
            console.log($(this).val());
            price.push($(this).val());
            compute();
           
          });          
      });
       $('#editable-sample').on('change','.quan',function(){              
          quantity = [];
          $('.quan').each(function(){
            console.log($(this).val());
            quantity.push($(this).val());
            console.log(quantity.length);
            compute();
           
          });          
      });

      $('#editable-sample').on('keydown','.price, .quanx',function(){
      /*  console.log($(this).val());
        $("#GT").html($(this).val()*$('.quan').val());
*/

      });
      $('#dis').change(function(){
      /*  console.log($(this).val());     */   
          compute();
      })
      function compute(){
          if(quantity.length > 0 && price.length >0){
            total = 0;
            for( ctr = 0; ctr < quantity.length; ctr++){
                total += quantity[ctr]*price[ctr];
            }
            console.log(total);                  
            $("#sub").html(total);
            total = total - (total * ($('#dis').val()/100) );
            $('#tot').html(total);


        }
      }
        
      </script>
      <script src="{{URL::asset('js/jquery-ui-1.9.2.custom.min.js')}}"></script>
            <script src="{{URL::asset('js/jquery-migrate-1.2.1.min.js')}}"></script>
      <script src="{{URL::asset('js/bootstrap-wysihtml5p.min.js')}}"></script>
      <script class="include" type="text/javascript" src="{{URL::asset('js/jquery.dcjqaccordion.2.7.js')}}"></script>
      <script src="{{URL::asset('js/jquery.scrollTo.min.js')}}"></script>
      <script src="{{URL::asset('js/jquery.nicescroll.js')}}" type="text/javascript"></script>
      <script src="{{URL::asset('js/respond.min.js')}}" ></script>



      <script type="text/javascript" src="{{URL::asset('assets/fuelux/js/spinner.min.js')}}"></script>
      <script type="text/javascript" src="{{URL::asset('assets/bootstrap-fileupload/bootstrap-fileupload.js')}}"></script>
      <script type="text/javascript" src="{{URL::asset('assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js')}}"></script>
      <script type="text/javascript" src="{{URL::asset('assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js')}}"></script>
      <script type="text/javascript" src="{{URL::asset('assets/bootstrap-datepicker/js/bootstrap-datepicker.js')}}></script>
      <script type="text/javascript" src="{{URL::asset('assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js')}}"></script>
      <script type="text/javascript" src="{{URL::asset('assets/bootstrap-daterangepicker/moment.min.js')}}"></script>
      <script type="text/javascript" src="{{URL::asset('assets/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
      <script type="text/javascript" src="{{URL::asset('assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js')}}"></script>
      <script type="text/javascript" src="{{URL::asset('assets/bootstrap-timepicker/js/bootstrap-timepicker.js')}}"></script>
      <script type="text/javascript" src="{{URL::asset('assets/jquery-mult  i-select/js/jquery.multi-select.js')}}"></script>
      <script type="text/javascript" src="{{URL::asset('assets/jquery-multi-select/js/jquery.quicksearch.js')}}"></script>	
      <script type="text/javascript" src="{{URL::asset('assets/data-tables/jquery.dataTables.js')}}"></script>
      <script type="text/javascript" src="{{URL::asset('assets/data-tables/DT_bootstrap.js')}}"></script>




      <!--script for this page only-->
      
      

      <!--this page  script only-->
       


      <!--right slidebar-->
      <script src="{{URL::asset('js/slidebars.min.js')}}"></script>

      <!--common script for all pages-->
      <script src="{{URL::asset('js/common-scripts.js')}}"></script>

      <script>




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
        
        EditableTable.init();

      });

    </script>


  </body>

  <!-- Mirrored from thevectorlab.net/flatlab/invoice.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 Aug 2016 03:22:32 GMT -->
  </html>
