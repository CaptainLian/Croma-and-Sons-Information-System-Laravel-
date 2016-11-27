<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from thevectorlab.net/flatlab/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 Aug 2016 03:18:36 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">

    <link rel="shortcut icon" href="/image/favicon.ico" />

    <title>Croma and Sons</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/css/bootstrap-reset.css" rel="stylesheet" />
    <!--external css-->
    <link href="/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

  <body class="login-body">
    <div class="container">
  		<div id="logoPosition">
  			<img src="/image/Chroma600.png" id="chromalogo" />
  		</div> <!--logoPosition -->

        {!! Form::open(['method' => 'POST', 'class' => 'form-signin']) !!}
            <h2 class="form-signin-heading">Croma and Sons</h2>
            <div class="login-wrap @if($errors->any()) has-error @endif ">

                <input name="username" type="text" class="form-control" placeholder="Username" autofocus value="{!! Form::old('username') !!}"  required="required" />
                @if($errors->has('username'))
                  <p class="help-block">{{ $errors->first('username') }}</p>
                @endif

                <input name="password" type="password" class="form-control" placeholder="Password" required="required" />
                @if($errors->has('password'))
                  <p class="help-block">{{ $errors->first('password') }}</p>
                @endif

                <!--
                <label class="checkbox">
                <input type="checkbox" value="remember-me" /> Remember me
                </label>
                -->
                <button class="btn btn-lg btn-login btn-block" type="submit">Sign in</button>
            </div> <!-- login-wrap -->

          {!! Form::close() !!}

            <!-- Modal -->
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-body">
                            <p>Enter your e-mail address below to reset your password.</p>
                            <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
                        </div><!-- modal-body -->

                        <div class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                            <button class="btn btn-success" type="button">Submit</button>
                        </div><!-- modal-footer -->
                    </div><!-- modal-content -->
                </div><!-- modal-dialog -->
            </div><!-- modal fade-->
            <!-- modal -->
    </div><!-- Container -->

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="/js/jquery.js"></script>
    <script src="/js/bootstrap.min.js"></script>

  </body>

<!-- Mirrored from thevectorlab.net/flatlab/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 Aug 2016 03:18:36 GMT -->
</html>
