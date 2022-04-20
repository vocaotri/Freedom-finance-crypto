<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <!-- Core CSS - Include with every page -->
    <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- SB Admin CSS - Include with every page -->
    <link href="{{ asset('front/css/sb-admin.css') }}" rel="stylesheet">

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Register new account</h3>
                    </div>
                    <div class="panel-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form role="form" method="POST">
                            @csrf
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Name" name="name" autofocus required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email"
                                        required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password"
                                        value="" required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Re-password" name="password_confirmation"
                                        type="password" value="" required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Code Active" name="code_activate"
                                        type="text" required>
                                </div>
                                <div class="form-group text-center">
                                    <a href="{{ route('login') }}">I have an account</a>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button class="btn btn-lg btn-success btn-block">Register</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Core Scripts - Include with every page -->
    <script src="{{ asset('front/js/jquery-1.10.2.js') }}"></script>
    <script src="{{asset('front/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="{{ asset('front/js/sb-admin.js') }}"></script>

</body>

</html>
