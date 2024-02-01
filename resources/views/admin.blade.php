@extends('layouts.master')
@section('title')
    change-price
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')
        @if(Session::get('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
        @endif
        @if(Session::get('fail'))
            <div class="alert alert-danger">
                {{Session::get('fail')}}
            </div>
        @endif
        <form method="POST" action="{{url('/update_price')}}">
            @csrf
            <div class="container-fluid">
                @foreach ($items as $item)
                    <div class="form-group row pt-2 justify-content-center itemName">
                            <label for="menu" class="col-8 col-form-label" style=" color:white; font-family: 'Roboto Slab', serif;">{{ $item->name }}</label>
                        <div class="col-3">
                            <input type="text" class="form-control text-center" name="item_price[{{ $item->id }}]" value="{{ $item->price }}" style="">
                        </div>
                    </div>
                @endforeach
                @foreach ($sections as $section)
                    @foreach ($section->items as $section_item)
                        <div class="form-group row pt-2 justify-content-center itemName">
                                <label for="sectionItem" class="col-8 col-form-label" style=" color:white; font-family: 'Roboto Slab', serif;">{{ $section_item->description }}</label>
                            <div class="col-3">
                                <input type="text" class="form-control text-center" id="section_item_id" name="section_item_price[{{ $section_item->id }}]" value="{{ $section_item->price }}">
                            </div>
                        </div>
                    @endforeach
                @endforeach
                <div class="row justify-content-end">
                    <div class="col-3 col-md-3 pt-3 pb-2">
                         <input type="submit" value="save" class="col-10 col-md-9 pt-1 pb-1 font-weight-bold" style="font-size: 1.3em"> 
                    </div>
                    
                </div>
                
            </div>
        </form>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">
                {{ __('Logout') }}
            </button>
        </form>

        <script>
            window.addEventListener('beforeunload', function (e) {
                e.preventDefault();
                $.ajax({
                    url: '/logout',
                    type: 'POST',
                    async: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            });
        </script>
    </body>
</html>