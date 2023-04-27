<!DOCTYPE html>
<html lang="en">
<head>
	<title>giriş yapmak</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">

</head>
    <body style="background: url('/images/background.jpg');-webkit-background-size: 100%; 
                -moz-background-size: 100%; 
                -o-background-size: 100%; 
                background-size: 100%; 
                -webkit-background-size: cover; 
                -moz-background-size: cover; 
                -o-background-size: cover; 
                background-attachment: fixed;
                background-position: center center;
                background-repeat: no-repeat;">
        <div class="limiter">
            <div class="container-login100">
                <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
                        <span class="login100-form-title p-b-49">
                            Maviş Döner
                        </span>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul style="list-style-type: none; ">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    <form method="POST" action="{{ route('login') }}" class="login-form">
                        @csrf
                        <div class="wrap-input100  m-b-23">
                            <div class="form-group">
                                <div class=" d-flex align-items-center justify-content-center">
                                    <i class="fa fa-user" style="font-size: 26px; padding-left:14px" ></i>
                                    <input type="text" class="input100 @error('username') is-invalid @enderror"  placeholder="Username" id="username" required autofocus name="username">
                                </div>
                            </div>
                        </div>                        
                        <div class="wrap-input100  m-b-23">
                            <div class="form-group">
                                <div class="d-flex align-items-center justify-content-center">
                                    <i class="fa fa-lock" style="font-size: 26px; padding-left:14px"></i>
                                    <input type="password" id="password" class="input100 @error('password') is-invalid @enderror" placeholder="Password" name="password" required>
                                </div>
                            </div>
                        </div>                        
                        <div class="pt-3 pb-0 mb-0">
                            <button class="login100-form-btn" style="background-image: linear-gradient(to right, #6b6e72, #5a5f64, #485057, #37424a, #26343d);border-color:rgb(181, 183, 185);border-width:1px; border-radius: 20px;">
                            giriş yapmak
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>