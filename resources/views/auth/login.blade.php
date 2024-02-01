
@extends('layouts.master')
@section('title')
    giriş yapmak
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
@endsection
@section('content')
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
                                    <input type="email" class="input100 @error('email') is-invalid @enderror"  placeholder="E-posta" id="email" required autofocus name="email">
                                </div>
                            </div>
                        </div>                        
                        <div class="wrap-input100  m-b-23">
                            <div class="form-group">
                                <div class="d-flex align-items-center justify-content-center">
                                    <i class="fa fa-lock" style="font-size: 26px; padding-left:14px"></i>
                                    <input type="password" id="password" class="input100 @error('password') is-invalid @enderror" placeholder="Şifre" name="password" required>
                                </div>
                            </div>
                        </div>                        
                        <div class="pt-3 pb-0 mb-0">
                            <button type="submit" class="login100-form-btn" style="background-image: linear-gradient(to right, #6b6e72, #5a5f64, #485057, #37424a, #26343d);border-color:rgb(181, 183, 185);border-width:1px; border-radius: 20px;">
                            giriş yapmak
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endsection