<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @include('layouts.head')
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
        <div class="">
            <nav class="navbar navbar-expand-lg" style="background-image: linear-gradient(to right, #6b6e72, #5a5f64, #485057, #37424a, #26343d)">
                <div class="d-flex justify-content-between align-items-center w-100 m-1 ">
                    <h3 class="">Maviş Döner</h3>
                    <div class="d-flex">
                        @role('customer')
                            <ul class="nav justify-content-end">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" style="color:rgb(226, 220, 220);">
                                        <i class="fas fa-user" style="font-size:25px"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('user.profile') }}"><h6>Kişisel detaylar</h6></a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('user.orders') }}"><h6>Siparişlerim</h6></a>
                                        </li>
                                        <li>
                                            <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <span class="d-none d-sm-inline"><h6>Çıkış Yap</h6></span>
                                            </a>
                                        </li>                            
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " style="color:rgb(226, 220, 220);" href="/cart"> <i class="fas fa-shopping-cart" style="font-size:25px"></i></a>
                                </li>
                                <li class="nav-item">
                                    <a href="\" class="nav-link" style="color:rgb(226, 220, 220);"><i class="fa fa-archive" style="font-size:25px"></i></a>
                                </li>
                            </ul>
                        @endrole
                        @if (! Auth::user())
                            <a class="nav-link m-1" style="color:rgb(255, 255, 255)" href="{{ route('login') }}">Giriş Yap | </a>
                            <a class="nav-link m-1" style="color:rgb(255, 255, 255)" href="{{ route('register') }}">kayıt ol</a>
                        @endif                       
                    </div>
                </div>
            </nav>
        </div>
        <div class=" container-fluid">
            <div class="row flex-nowrap">        
                @include('layouts.adminSidebar')
                @yield('content')
            </div>
        </div>
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
    </body>
</html>