@extends('layouts.adminMaster')
@section('title')
    edit-meal
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection
@section('content')
    <div class="col-9 mt-3">
        <div class="card border-0">
            <h5 class="card-title m-3">Edit meal</h5>
            @if ($errors->any())
            <div class="alert alert-danger col-6 m-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{ route('admin.updateMeal',$item->id) }}" method="POST" class="m-3" enctype="multipart/form-data" >
                @csrf
                <div class="row">
                    <div class="col">
                        <label class="form-label" for="mealName">Name</label>
                        <input class="form-control @error('mealName') is-invalid @enderror" id="mealName" name="name" placeholder="Meal Name" value="{{ $item->name }}">
                        @error('mealName')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label class="form-label" for="mealPrice">Price</label>
                        <input class="form-control @error('mealPrice') is-invalid @enderror" id="mealPrice" name="price" placeholder="Meal Price " value="{{ $item->price }}">
                        @error('mealPrice')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>                    
                </div>
                <div class="row">
                    <div class="col-8">
                        <label for="mealDescription" class="mt-3">Description
                            <span class="text-muted">(optional)</span>
                        </label>
                        <textarea class="form-control" id="mealDescription" rows="3" name="description"></textarea>
                    </div>     
                </div>  
                <div class="row mt-3">
                    <div class="col-8">
                        <label class="form-label mb-1 d-flex justify-content-between align-items-center" for="category-org">
                            <span>Section</span><a href="javascript:void(0);" class="fw-medium">Add new section</a>
                        </label>
                        <select class="form-control" name="section_id" id="mealSection">
                            @foreach($sections as $section)
                                <option value="{{ $section->id }}" {{ $item->section->id == $section->id ? 'selected' : '' }}>{{ $section->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{-- <div>
                    <label for="images" class="mt-3">upload meal images (maximum 3)</label>
                    <input class="@error('avatar') is-invalid @enderror" type="file" name="images[]" id="images" multiple >
                    @error('avatar')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror                                        
                </div> --}}
                <div class="row mt-4">
                    <div class="col-3">
                        <img src="{{ asset($item->img1) }}" style="" class="col-8">
                        <label for="image1" class="mt-3">update meal image</label>
                        <input class="@error('avatar') is-invalid @enderror" type="file" name="image1" id="image1" >
                        @error('avatar')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div> 
                    @if ($item->img2)
                    <div class="col-3">
                        <img src="{{ asset($item->img2) }}" class="col-8">
                        <label for="image2" class="mt-3">update meal image</label>
                        <input class="@error('avatar') is-invalid @enderror" type="file" name="image2" id="image2" >
                        @error('avatar')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                        <div class="col-3"> 
                            <img src="{{ asset($item->img3) }}" class="col-8">
                            <label for="image3" class="mt-3">update meal image</label>
                            <input class="@error('avatar') is-invalid @enderror" type="file" name="image3" id="image3" >
                            @error('avatar')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    @endif
                </div>
                <button type="submit" class="mt-3">update</button>
            </form>
        </div>
    </div>



@endsection