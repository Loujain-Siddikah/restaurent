@extends('layouts.master')
@section('title')
    Adresler
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')
    <div class="container-xl px-4 mt-4">
        <hr class="mt-0 mb-4">
            <div class="row justify-content-center">
                <div class="col-7">
                    <div class="card">
                        <h5 class="card-title m-3">Siparişlerim</h5>
                        <div class="card-body">
                            @foreach ($orders as $order)
                                <div class="mb-8">
                                    <div class="border-bottom d-lg-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h5 class="ms-2">Sipariş tarihi: {{ $order->created_at->toFormattedDateString() }}</h5>
                                            <h5 class="ms-2"> Toplam: {{ $order->total_price }}<i class='fa fa-turkish-lira lira' style="color: #f9a201; font-size: 14px;"></i></h5>
                                            <h5 class="ms-2"> Sipariş durumu: {{ $order->order_status }}</h5>
                                        </div>
                                    </div>
                                </div>
                                @foreach ($order->items as $item)
                                    <div class="row justify-content-between align-items-center mb-3 mt-3">
                                        <div class="col-lg-4 col-4">
                                            <div class="ms-md-4 mt-2 mt-lg-0">
                                                <span style="font-size: 18px;">{{ $item->description }}</span>
                                                <div>
                                                    <span style="font-size: 18px;">fiyat: {{ $item->price }}<i class='fa fa-turkish-lira lira' style="color: #f9a201; font-size: 14px;"></i></span>
                                                </div>
                                                <span style="font-size: 18px;">miktar: {{ $item->pivot->quantity }}</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-4">
                                            <div class="card border-0 menuCard" style="border-radius: 10px; background-image: linear-gradient(to right, #6b6e72, #5a5f64, #485057, #37424a, #26334d); border-color: #35393f;">
                                                <div class="card-body">
                                                    @if ($item->img2)
                                                        <div class="d-flex justify-content-between align-items-center pt-2 pb-1">
                                                            <img src="{{ asset( $item->img1) }}" class="pl-2" style="width: 30%; height: 32%; object-fit: contain;">
                                                            
                                                                <i class='fa fa-plus pt-1' style='color: white); font-size: 24px;'></i>
                                                                @if ($item->img2 == 'Layer 41.png')
                                                                    <img src="{{ asset( $item->img2) }}" class="pl-2" style="width: 30%; height: 32%; object-fit: contain;">
                                                                @else 
                                                                    <img src="{{ asset( $item->img2) }}" class="pl-2" style="width: 25%; height: 27%; object-fit: contain;">
                                                                @endif
                                                                <i class='fa fa-plus pt-1' style='color: white); font-size: 24px;'></i>
                                                                @if ($item->img3 == 'kola.png')
                                                                    <img src="{{ asset($item->img3) }}" class="pl-2" style="width: 8%; height: 8%; object-fit: contain;">
                                                                @else
                                                                    <img src="{{ asset($item->img3) }}" class="pl-2" style="width: 10%; height: 14%; object-fit: contain;">
                                                                @endif
                                                        </div>
                                                    @else
                                                        <div class="d-flex justify-content-center align-items-center pt-2 pb-1">
                                                            <img src="{{ asset($item->img1) }}" class="pl-2" style="width: 30%; height: 32%; object-fit: contain;">
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
