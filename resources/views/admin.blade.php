<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/adminStyle.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="http://code.jquery.com/jquery-3.4.1.js"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@600&display=swap" rel="stylesheet">
        <title>yönetici</title>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    </head>

    <body style="background: url('/images/background.jpg');-webkit-background-size: 100%; 
                -moz-background-size: 100%; 
                -o-background-size: 100%; 
                background-size: 100%; 
                -webkit-background-size: cover; 
                -moz-background-size: cover; 
                -o-background-size: cover; 
                background-attachment: fixed;
                background-position: center center;
                background-repeat: no-repeat;">
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
            {{csrf_field()}}
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