@extends('layouts.master')
@section('title')
    Menü
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection
@section('content')
    <div class="col">
        @foreach ($sections as $section)
            <div class="row pt-3 ">
                <div class="sectionNmae col-12 col-md-12">
                    <div style="background-color: #5a5f64;height: 32px; display:flex; justify-content:center; align-items:center; color:white; font-family: 'Roboto Slab', serif;font-size: 0.9em; ">{{ $section->name }}</div>
                </div>
            </div>        
            <div class="row pt-3 justify-content-center" style="row-gap: 18px; column-gap:20px">
                @foreach ($section->items as $section_item)
                    @if ($section->name == 'İÇECEKLER')
                        <div class=" col-md-4 col-lg-2 col-sm-4 ">
                    @elseif ($section->name == 'TAM YEMEK')
                        <div class="col-5 d-flex align-items-stretch">
                    @else
                        <div class="col-md-3 col-lg-3 col-sm-4 d-flex align-items-stretch">
                    @endif
                    <div class="card" style=" border-radius: 15px; background-image: linear-gradient(to right, #6b6e72, #5a5f64, #485057, #37424a, #26343d); border-color:#35393f; ">
                        <div class="row justify-content-center">
                            <div class="col-11">
                                @if ($section_item->img2)
                                    <div class="d-flex justify-content-between align-items-center pt-2">
                                        <div class="col-3" style="">
                                            <img src="{{ asset( $section_item->img1) }}" class="pl-2 card-img-top" alt="" style="">
                                        </div>
                                        <i class='fa fa-plus ' style='color: white; font-size: 24px;'></i>
                                        @if ($section_item->img2 == 'Layer 41.png')
                                            <div class="col-3" style="">
                                                <img src="{{ asset($section_item->img2) }}" class="pl-2 card-img-top" alt="" style=" object-fit: cover;">
                                            </div>
                                        @else 
                                            <div class="col-2" style="">
                                                <img src="{{ asset( $section_item->img2) }}" class="pl-2 card-img-top" alt="" style="object-fit: cover;">
                                            </div>
                                        @endif
                                        <i class='fa fa-plus' style='color: white; font-size: 24px;'></i>
                                        <div class="col-1" style="">
                                            <img src="{{ asset( $section_item->img3) }}" class="pl-2 card-img-top" alt="" style=" object-fit: cover;">
                                        </div>
                                    </div>
                                @else    
                                    <div class="d-flex justify-content-center align-items-center pt-2" style="">
                                        @if ($section->name == 'İÇECEKLER')
                                            <div class="col-4">
                                                <img src="{{asset( $section_item->img1) }}" class="card-img-top" alt="" style="object-fit: contain; height:60px">
                                            </div>
                                        @else
                                            <div class="col-7">
                                                <img src="{{ $section_item->img1 }}" class="card-img-top" alt="" style="object-fit: contain; ">
                                            </div>  
                                        @endif 
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row justify-content-center pt-2">    
                            @if ($section->name == 'İÇECEKLER')
                                <div class="col-8  sectionMenu justify-content-center">
                                    <span class="" style="font-size: 0.6em; color:#f9a201;">{{ $section_item->price }}<i class='fa fa-turkish-lira' style="color:#f9a201; font-size:11px"></i>
                                    </span> 
                                </div>
                            @else
                                <div class="col-10  sectionMenu">
                                    <span class="" style="color:rgb(255, 255, 255);font-size: 0.39em;">{{ $section_item->name }}</span>
                                    <span class="" style="font-size: 0.5em;  color:#f9a201; ">{{ $section_item->price }}<i class='fa fa-turkish-lira' style="color:#f9a201; font-size:8px"></i></span> 
                                </div>
                            @endif
                        </div>
                        <div class="row p-1">
                            <p style="font-size:12px; color:rgb(218, 207, 207)">{{$section_item->description}}</p> 
                        </div>
                        @role('customer')
                            <div class="row justify-content-center pt-1">
                                <div class="item col-10 d-flex justify-content-center">
                                    <form action="{{ route('addToCart') }}" method="POST" class="add-to-cart-form">
                                        @csrf
                                        <input type="hidden" name="item_id" value="{{ $section_item->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn btn-light add-to-cart-button btn-sm">Sepete ekle</button>
                                    </form>
                                </div>
                            </div>
                        @endrole
                        @role('admin')
                            <div class="row">
                                <div class="d-flex justify-content-center align-items-center">
                                    <a class="btn btn-light btn-sm m-2" href="{{ route('admin.editMeal', $section_item->id) }}" role="button">Düzenle</a>
                                    {{-- <a class="btn btn-danger btn-sm m-2" href="{{ route('admin.deleteMeal', $section_item->id) }}" role="button">Delete</a> --}}
                                    <form action="{{ route('admin.deleteMeal', $section_item->id) }}" method="POST" class="m-2">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm " title="Delete">Sil</button>
                                    </form>
                                </div>
                            </div>
                        @endrole
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
</div>

@endsection
@auth

    <script>
        const itemContainers = document.querySelectorAll(".item");
        itemContainers.forEach((item) => {
            const addToCartButton = item.querySelector(".add-to-cart-button");
            const form = item.querySelector(".add-to-cart-form");

            addToCartButton.addEventListener("click", function () {
                // Change the button color to green with a checkmark icon
                addToCartButton.classList.remove("btn-light");
                addToCartButton.classList.add("btn-success");
                addToCartButton.innerHTML = '<i class="fas fa-check"></i> Added';
                // Simulate a delay (2 seconds) and then revert to the original style
                setTimeout(() => {
                    addToCartButton.classList.remove("btn-success");
                    addToCartButton.classList.add("btn-light");
                    addToCartButton.innerHTML = 'Add to cart';
                }, 2000);
                // Submit the form to add the item to the cart
                form.submit();
            });
        });
    </script>
@endauth


    
    
    





