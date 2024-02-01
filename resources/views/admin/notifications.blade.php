@extends('layouts.adminMaster')
@section('title')
    bildirimler
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('css/notification.css') }}">
@endsection
@section('content')
<div class="col-lg-8 col-md-7 col-sm-5 m-3">
    <div class="card">
        <h5 class="card-title m-3" >Bildirimler</h5>
        <div class="card-body p-0">
            <div id="card"></div>
            @foreach ($transformedNotifications as $notification)
                <div class="p-4 d-flex align-items-center border-bottom justify-content-between" style="background-color: {{ $notification['read'] ? 'rgb(244, 246, 247)' : 'rgb(168, 196, 248)' }}" >
                    <a href="{{ route('admin.orderDetailsNotification',['order' => $notification->data['order']['id'], $notification['id'] ]) }}" class="atag">
                        <div>
                            <span class="fw-bold" style="color: rgb(50, 120, 201)">{{ $notification->data['order']['user']['first_name'] }} {{ $notification->data['order']['user']['last_name'] }}</span>
                            <span>'{{ $notification->data['title'] }}</span>
                        </div>
                    </a>
                    <span >
                        <div class="text-muted">{{ $notification['formattedDate'] }}</div>
                    </span>
                </div>  
            @endforeach
        </div>
    </div>  
    <script>
        // nitializing an array to store notifications.
        let listOfObjects = [];
        @foreach ($adminUsers as $adminUser)
            window.Echo.private('App.Models.User.' + {{ $adminUser->id }})
            // notification callback is triggered when a notification is received on the subscribed channel.
                .notification((notification) => {
                    console.log(notification.order);
                    listOfObjects.push(notification);
                    showNotifications();
                });
        @endforeach   
        function showNotifications() {
            const mainBody = document.getElementById('card');
            
            // Iterate over the array of notifications
            listOfObjects.forEach(element => {
            // The showNotification function iterates over the array of notifications (listOfObjects).
                const notificationsContainer = document.createElement('div');
                notificationsContainer.className = 'p-4 d-flex align-items-center border-bottom justify-content-between';
                notificationsContainer.style.backgroundColor = 'rgb(168, 196, 248)';   
                // Create a new notification element
                const aNotificationElement = document.createElement('a');
                aNotificationElement.href = '{{ route("admin.orederDetails", ["order" => ":orderId"]) }}'.replace(':orderId', element.order.id);
                aNotificationElement.style.textDecoration = 'none';
                aNotificationElement.style.color='inherit';
                aNotificationElement.innerHTML = `<span style='color:rgb(50, 120, 201); font-weight:bold'> ${element.userFirstName} ${element.userLastName}</span>'${element.title} `;
                const newElement2 = document.createElement('span');
                spanElement.innerHTML = `<span>now</span>`
                // Add the new notification to the container
                notificationsContainer.appendChild(aNotificationElement);
                notificationsContainer.appendChild(newElement2);
                // Add the new notification container to the main container
                mainBody.appendChild(notificationsContainer);
            });
    
            // Show the main container if there are notifications
            if (listOfObjects.length > 0) {
                mainBody.style.display = 'block';
            }   
            // Clear the array after processing notifications
            listOfObjects = [];
        }
    </script>
@endsection

