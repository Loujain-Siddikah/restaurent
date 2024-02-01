@extends('layouts.master')
@section('title')
    Adreslerim
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')

<div class="container-xl px-4 mt-4">
    <hr class="mt-0 mb-4">
    <div class="row">
        @include('layouts.sidebar')
        <div class="col-xl-8">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between">
                    <h5>Adreslerim</h5>
                    <div class="justify-content-end">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addAddressModal">
                            <i class="fas fa-plus"></i> Adres Ekle
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @foreach ($user->addresses as $address)
                        <div class="col-6">
                            <div class="card mt-2">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $address->name }}</h5>
                                    <p class="card-text">{{ $address->city }}, {{ $address->district }}, {{ $address->street}}, {{ $address->floor }},{{ $address->details }}.</p>
                                </div>
                                <div class="text-end p-1">
                                    <a href="" class="card-link" data-bs-toggle="modal" data-bs-target="#editAddressModal" data-address_id="{{ $address->id }}" data-address_name="{{ $address->name }}" data-address_country="{{ $address->country }}" data-address_city="{{ $address->city }}" data-address_district="{{ $address->district }}" data-address_street="{{ $address->street }}" data-address_floor="{{ $address->floor }}" data-address_details="{{ $address->details }}">Düzenle
                                    </a>                                        
                                    <a href="" class="card-link link-danger" data-bs-toggle="modal" data-bs-target="#deleteAddressModal" data-address_id="{{ $address->id }}" data-address_name="{{ $address->name }}">Sil</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                </div>
            </div>
        </div>
    </div>
    
    <x-modal id="addAddressModal" title="Adres Ekle" formAction="{{ route('add.address') }}" formId="addAddressForm" formMethod="POST" methodName="post">
        <x-slot name="body">
            <div class="row gx-3 mb-3">
                <div class="row gx-3 mb-3">
                    <div class="col-md-6">
                        <label class="small mb-1" for="inputName">İsim</label>
                        <input class="form-control" id="inputName" type="text" name="name">
                    </div>
                    <div class="col-md-6">
                        <label class="small mb-1" for="inputCountry">Ülke</label>
                        <input class="form-control" id="inputCountry" type="text" name="country" value="Turkey" disabled readonly>
                    </div>
                </div>
                <div class="row gx-3 mb-3">
                    <div class="col-md-6">
                        <label class="small mb-1" for="inputCity">Şehir</label>
                        <input class="form-control" id="inputCity" type="text" name="city" value="Bursa" disabled readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="small mb-1" for="inputArea">Semt</label>
                        <input class="form-control" id="inputArea" type="text" name="area">
                    </div>
                </div>
                <div class="row gx-3 mb-3">
                    <div class="col-md-6">
                        <label class="small mb-1" for="inputStreet">Sokak</label>
                        <input class="form-control" id="inputStreet" type="text" name="street">
                    </div>
                    <div class="col-md-6">
                        <label class="small mb-1" for="inputFloor">Kat</label>
                        <input class="form-control" id="inputFloor" type="text" name="floor">
                    </div>
                </div>
                <div class="row gx-3 mb-3">
                    <label class="small mb-1" for="inputDetails">Detaylar</label>
                    <textarea class="form-control" id="inputDetails" type="text" name="details" rows="2"></textarea>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapalı</button>
            <button type="submit" class="btn btn-primary">Kaydet</button>
        </x-slot>
    </x-modal>

    <x-modal id="editAddressModal" title="Adresi düzelt" formAction="{{ route('update.address') }}" formId="updateAddressForm" formMethod="POST" methodName="post">
        <x-slot name="body">
            <div class="row gx-3 mb-3">
                <div class="col-md-6">
                    <label class="small mb-1" for="address_name">İsim</label>
                    <input type="hidden" class="form-control" id="address_id" name="address_id" value="" >
                    <input class="form-control" id="address_name" type="text" name="name" value="">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="small mb-1" for="inputCountry">Ülke</label>
                    <input class="form-control" id="inputCountry" type="text" name="country" value="Turkey" disabled readonly>
                </div>
            </div>
            <div class="row gx-3 mb-3">
                <div class="col-md-6">
                    <label class="small mb-1" for="inputCity">Şehir</label>
                    <input class="form-control" id="inputCity" type="text" name="city" value="Bursa" disabled readonly>
                </div>
                <div class="col-md-6">
                    <label class="small mb-1" for="address_district">Alan</label>
                    <input class="form-control" id="address_district" type="text" name="area" value="">
                    @error('area')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row gx-3 mb-3">
                <div class="col-md-6">
                    <label class="small mb-1" for="address_street">Sokak</label>
                    <input class="form-control" id="address_street" type="text" name="street" value="">  
                    @error('street')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="small mb-1" for="address_floor">Kat</label>
                    <input class="form-control" id="address_floor" type="text" name="floor" value="">
                    @error('floor')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row gx-3 mb-3">
                <label class="small mb-1" for="address_details">detaylar</label>
                <textarea class="form-control" id="address_details" type="text" name="details" rows="2" ></textarea>
                @error('details')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </x-slot>
        <x-slot name="footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapalı</button>
            <button type="submit" class="btn btn-primary">Kaydet</button>
        </x-slot>
    </x-modal>
     
    <x-modal id="deleteAddressModal" title="Adresi sil" formAction="{{ route('delete.address') }}" formId="deleteAddressForm" formMethod="POST" methodName="delete">
        <x-slot name="body">
            <div class="row gx-3 mb-3">
                <div class="col-md-6">
                    <p>Bu adresi silmek istediğinizden emin misiniz?</p><br>
                    <input name="address_id" id="address_id" value="" type="hidden">
                    <input class="" name="address_name" id="address_name" type="text" readonly>
                </div>
            </div>   
        </x-slot>
        <x-slot name="footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapalı</button>
            <button type="submit" class="btn btn-danger">Sil</button>
        </x-slot>
    </x-modal>
    <script src="{{ asset('js/editAddressModal.js') }}"></script>
    <script src="{{ asset('js/deleteAddressModal.js') }}"></script>

@endsection