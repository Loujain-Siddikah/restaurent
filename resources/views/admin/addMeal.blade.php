@extends('layouts.adminMaster')
@section('title')
    yemek ekle
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection
@section('content')
    <div class="col-9 mt-3">
        <div class="card border-0">
            <h5 class="card-title m-3">yemek ekle</h5>
            @if ($errors->any())
            <div class="alert alert-danger col-6 m-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{ route('admin.addMeal') }}" method="POST" class="m-3" enctype="multipart/form-data" >
                @csrf
                <div class="row">
                    <div class="col">
                        <label class="form-label" for="mealName">İsim</label>
                        <input class="form-control @error('mealName') is-invalid @enderror" id="mealName" name="name" placeholder="Yemek Adı">
                        @error('mealName')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label class="form-label" for="mealPrice">Fiyat</label>
                        <input class="form-control @error('mealPrice') is-invalid @enderror" id="mealPrice" name="price" placeholder="Yemek Fiyatı">
                        @error('mealPrice')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>                    
                </div>
                <div class="row">
                    <div class="col-8">
                        <label for="mealDescription" class="mt-3">Tanım
                            <span class="text-muted">(isteğe bağlı)</span>
                        </label>
                        <textarea class="form-control" id="mealDescription" rows="3" name="description"></textarea>
                    </div>     
                </div>  
                <div class="row mt-3">
                    <div class="col-8">
                        <select class="form-control" id="mealSection" name="section_id">
                            @foreach($sections as $section)
                                <option value="{{ $section->id }}">{{ $section->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div>
                    <label for="images" class="mt-3">yemek görselleri yükleyin (en fazla 3)</label>
                    <input class="@error('avatar') is-invalid @enderror" type="file" name="images[]" id="images" multiple >
                    @error('avatar')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror                                        
                </div>
                <button type="submit" class="mt-3">güncelleme</button>
            </form>
        </div>
    </div>
@endsection