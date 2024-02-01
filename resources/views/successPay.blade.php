@extends('layouts.master')
@section('title')
    Başarı Siparişinizi
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')
<div class="row justify-content-center align-items-center">
    <div class="col-lg-8 col-md-7 col-sm-5 m-3">
        <div class="card justify-content-center align-items-center"">
            <div class="card-body">
                <p class="text-center"><i class="fa fa-check" style="font-size:48px;color:rgb(45, 87, 143)"></i></p>
                <p class="text-center">siparişiniz alınmıştır</p>
                <a href="{{ route('user.orders') }}" type="button" class="btn btn-primary">siparişlerim sayfasina</a>                  
            </div>
        </div>
    </div>
</div>
@endsection