@extends('layouts.master')
@section('title')
    cart
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/cartStyle.css') }}">
@endsection

@section('content')
    @if (!$cart)
        <div class="row justify-content-center">
            <div class="col-8 text-center mt-5">
                <p class="cartEmpty text-warning">Sepetiniz boş.</p>
            </div>
        </div>
    @else
        <div class="pt-4">
            @foreach ($cart->items as $item)  
                <div class="row justify-content-center pt-3">
                    <div class=" col-lg-6 col-md-8 col-sm-8 col-xs-6">
                        <div class="card" style=" border-radius: 15px; background-image: linear-gradient(to right, #6b6e72, #5a5f64, #485057, #37424a, #26343d); border-color:#35393f; ">
                            <div class="row justify-content-center">
                                <div class="col-11">
                                    @if ($item->img2)
                                        <div class="d-flex justify-content-between align-items-center pt-2">
                                            <div class="col-3">
                                                <img src="{{ asset( $item->img1) }}" class="pl-2 card-img-top">
                                            </div>
                                            <i class='fa fa-plus' style='color: white; font-size: 24px;'></i>
                                            @if ($item->img2 == 'Layer 41.png')
                                                <div class="col-3">
                                                    <img src="{{ asset($item->img2) }}" class="pl-2 card-img-top" style=" object-fit: cover;">
                                                </div>
                                            @else 
                                                <div class="col-2">
                                                    <img src="{{ asset( $item->img2) }}" class="pl-2 card-img-top" style="object-fit: cover;">
                                                </div>
                                            @endif
                                            <i class='fa fa-plus' style='color: white; font-size: 24px;'></i>
                                            <div class="col-1">
                                                <img src="{{ asset( $item->img3) }}" class="pl-2 card-img-top" style=" object-fit: cover;">
                                            </div>
                                        </div>
                                    @else    
                                        <div class="d-flex justify-content-center align-items-center pt-2" >
                                            <div class="col-3">
                                                <img src="{{ $item->img1 }}" class="card-img-top" alt="" style="object-fit: contain; ">
                                            </div>   
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row justify-content-center pt-2">
                                <div class="col-5" style="color: white">
                                    <p>{{ $item->name }}</p>
                                </div>
                                <div class="col-2">
                                    <form id="updateQuantityForm" action="{{ route('cart.updateQuantity', $item->id) }}" method="post" >
                                        @csrf
                                        <input type="number" onclick="submit()" name="quantity" id="quantity" value="{{ $item->pivot->quantity }}" min="1" class="form-control form-control-sm ">
                                    </form>
                                </div>
                                <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                    <h5 class="mb-0">{{ $item->price * $item->pivot->quantity }}<i class='fa fa-turkish-lira lira' style="color: #f9a201; font-size: 9px;"></i></h5>
                                </div>
                                <div class="col-md-1 col-lg-1 col-xl-1 ">
                                    <form action="{{ route('cart.delete', ['item' => $item->id]) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash fa-sm"></i>
                                        </button>
                                    </form>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="row justify-content-center mt-4">
                <div class="col-6 ">
                    <div class="card mb-4">
                        <div class="card-body p-4 d-flex flex-row">
                            <div class="form-outline flex-fill">
                                <span class="text-muted me-2">toplam fiyat:</span>
                                <span class="lead fw-normal">{{ $total_price }}</span>
                            </div>
                            <a href="{{ route('checkout') }}" type="button" class="btn btn-outline-secondary btn-md ms-3">Sepeti onayla</a>
                        </div>
                    </div>
                </div>
            </div>       
        </div>
  @endif
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        var numberInput = document.getElementById('quantity');
        
        numberInput.addEventListener('change', function () {
            document.getElementById('updateQuantityForm').submit();
        });
    });
    </script>
@endsection