@extends('layouts.master')
@section('title')
    Çıkış yapmak
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')

<div class="container-xl px-4 mt-4">
    <hr class="mt-0 mb-4">
    <div class="row justify-content-center">
        <div class="col-7">
            <div class="card mb-4">
                <h5 class="card-title m-3">Siparişinizi doğrula</h5>
                <div class="card-body mx-n5 px-5">
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
                        <form action="{{ route('placeOrder') }}" method="post" id="payment-form">
                            @csrf
                            <h6 class="mt-3">Adresinizi Seçin:</h6>
                            @if ($user_addresses->isEmpty())
                            <div class="justify-content-end">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addAddressModal">
                                    <i class="fas fa-plus"></i> Adres Ekle
                                </button>
                            </div>
                            @else
                                @foreach ($user_addresses as $address)
                                    <input class="" type="radio" name="address" id="address">
                                    <label class="col-5" for="address">
                                        <div class="card mt-2">
                                            <div class="card-body">
                                                <input type="hidden" name="address" value="{{ $address->id }}">
                                                    <h5 class="card-title">{{ $address->name }}</h5>
                                                    <p class="card-text">{{ $address->city }}, {{ $address->district }}, {{ $address->street}}, {{ $address->floor }},{{ $address->details }}.</p>
                                                </div>
                                                <div class="text-end p-1">
                                                    <a href="" class="card-link" data-bs-toggle="modal" data-bs-target="#editAddressModal" data-address_id="{{ $address->id }}" data-address_name="{{ $address->name }}" data-address_country="{{ $address->country }}" data-address_city="{{ $address->city }}" data-address_district="{{ $address->district }}" data-address_street="{{ $address->street }}" data-address_floor="{{ $address->floor }}" data-address_details="{{ $address->details }}">Düzenle</a>
                                                </div>
                                            </div>
                                        </label>
                                @endforeach
                            @endif
                            <h6 class="mt-3">Ödeme yöntemini seçin:</h6>
                            <div class="mx-n5 px-5">
                                <label>
                                    <input type="radio" name="payment_method" value="pay_when_delivery" required>
                                    Teslimatta ödeme
                                </label><br>
                                <label>
                                    <input type="radio" name="payment_method" value="stripe" required>
                                    Stripe ile ödeme
                                </label><br>
                            </div>
                            <!--  START: Stripe Card Details Form  -->
                            <div class="row gateway-details py-3" id="stripe-payment-form" style="display: none;">
                                <div class="col-12">
                                    <div class="form-group mb-2">
                                        <label for="card-number">kart bilgisi</label>
                                        <div id="card-number" class="stripe-input"></div>
                                        <input type="hidden" name="stripe_payment_method" id="stripe_payment_method" />
                                    </div>
                                </div>
                            </div>
                            <!-- END: Stripe Card Details Form -->
                            <h6 class="mt-3">sipariş özeti:</h6>
                            <div class="mx-n5 px-5" style="background-color: #f2f2f2;">
                                <div class="row">
                                  <div class="col-md-7 col-lg-7">
                                    <p>Teslimat ücreti</p>
                                  </div>
                                  <div class="col-md-5 col-lg-5">
                                    <p class="mb-0"> {{ $delivery_fee }}<i class='fa fa-turkish-lira lira' style="color: #f9a201; font-size: 12px;"></i></p>
                                  </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-7 col-lg-7">
                                      <p>ara toplam</p>
                                    </div>
                                    <div class="col-md-5 col-lg-5">
                                      <p>{{ $subTotal }}<i class='fa fa-turkish-lira lira' style="color: #f9a201; font-size: 12px;"></i></p>
                                    </div>
                                  </div>
                                <div class="row">
                                  <div class="col-md-7 col-lg-7">
                                    <p>Toplam fiyat</p>
                                  </div>
                                  <div class="col-md-5 col-lg-5">
                                    <p>{{ $total_price }}<i class='fa fa-turkish-lira lira' style="color: #f9a201; font-size: 12px;"></i></p>
                                  </div>
                                </div>
                            </div>
                            <button type="submit" id="submit-payment">Siparişi doğrula</button>
                        </form>
                    </div>
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
                    <label class="small mb-1" for="inputArea">Alan</label>
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
                <label class="small mb-1" for="inputDetails">detaylar</label>
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

<script src="https://js.stripe.com/v3/"></script>
<script src="{{ asset('js/editAddressModal.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const stripeForm = document.getElementById('stripe-payment-form');
        const payWhenDeliveryRadio = document.querySelector('input[name="payment_method"][value="pay_when_delivery"]');
        const stripeRadio = document.querySelector('input[name="payment_method"][value="stripe"]');
        var stripe = Stripe('{{ config('services.stripe.publishable_key') }}');
        const elements = stripe.elements();
        const card = elements.create('card');
        card.mount('#card-number');
        // Add event listener to create a PaymentMethod when the form is submitted
        document.getElementById('submit-payment').addEventListener('click', function (event) {
            if (stripeRadio.checked) {
                event.preventDefault();
                stripe.createPaymentMethod({
                    type: 'card',
                    card: card,
                }).then(function (result) {
                    if (result.error) {
                        console.error(result.error.message);
                    } else {
                        // Insert the PaymentMethod ID into the form
                        document.getElementById('stripe_payment_method').value = result.paymentMethod.id;
                        // Submit the form
                        document.getElementById('payment-form').submit();
                    }
                });
            }
        });

        function toggleStripeForm() {
            stripeForm.style.display = stripeRadio.checked ? 'block' : 'none';
        }

        toggleStripeForm();

        payWhenDeliveryRadio.addEventListener('change', toggleStripeForm);
        stripeRadio.addEventListener('change', toggleStripeForm);
    });
</script>

@endsection