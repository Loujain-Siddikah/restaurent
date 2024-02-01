<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.11.3/dist/echo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="..." crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js" integrity="..." crossorigin="anonymous"></script>
        <script src="{{ mix('js/app.js') }}"></script>
        @include('layouts.head')
    <link rel="stylesheet" href="{{ asset('css/notification.css') }}">
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
                        @role('admin')
                        <ul class="nav justify-content-end">
                            <li class="nav-item">
                                <a class="nav-link buttun" href="{{ route('admin.notifications') }}" role="button" style="color: rgb(226, 220, 220);">
                                    <i class="fas fa-bell" style="font-size:25px"></i>
                                </a>
                                <span class="button__badge" id="notification-counter" style="display: none"></span>
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
                window.Echo.private('App.Models.User.' + {{ $adminUser->id }})
                    .notification((notification) => {
                        incrementNotificationCounter();
                    });
            function incrementNotificationCounter() {
                // Increment the notification counter in the DOM
                document.getElementById('notification-counter').style.display='block';
                const notificationCounter = document.getElementById('notification-counter');
                const currentCount = parseInt(notificationCounter.textContent) || 0;
                notificationCounter.textContent = currentCount + 1;
            }
        </script>
    </body>
</html>