@extends('layouts.master')
@section('title')
    Profilim
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection
@section('content')
<div class="container-xl px-4 mt-4">
    <hr class="mt-0 mb-4">
    <div class="row">
        @include('layouts.sidebar')
        <div class="col-xl-8">
            <div class="card mb-4">
                <h5 class="card-title m-3">Profilim</h5>
                <div class="card-body">
                    <form action="{{ route('update.profile') }}" method="post">
                        @csrf
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">İlk adı</label>
                                <input class="form-control @error('first_name') is-invalid @enderror" id="inputFirstName" type="text" placeholder="İlk adınızı girin" name="first_name" value="{{ $user->first_name }}">
                                @error('first_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Soy adı</label>
                                <input class="form-control @error('last_name') is-invalid @enderror" id="inputLastName" type="text" placeholder="Soyadınızı girin"  name="last_name" value="{{ $user->last_name }}">
                                @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputEmail">E-posta</label>
                                <input class="form-control @error('email') is-invalid @enderror" id="inputEmail" type="email" name="email" placeholder="E-postanızı girin" value="{{ $user->email }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Telefon</label>
                                <input class="form-control @error('phone') is-invalid @enderror" id="inputPhone" name="phone" placeholder="Telefon numaranızı 10 haneli girin" value="{{ $user->phone }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Değişiklikleri Kaydet</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection