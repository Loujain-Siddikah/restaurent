@role('customer')
<div class="col-xl-4">
    <div class="card mb-4 mb-xl-0">
        <h5 class="card-title m-3">Hesabım</h5>
        <div class="card-body">
            <li class="list-group-item">
                <a href={{ route('user.profile') }} style="text-decoration: none !importent; color:black">
                    <i class="fas fa-user" style="font-size:15px; margin-right:5px"></i>
                    Profilim
                </a>
            </li>
            <li class="list-group-item">
                <a href={{ route('user.addresses') }} style="text-decoration: none !importent; color: black">
                    <i class="fa fa-map-marker" style="font-size:20px; margin-right:5px;"></i>
                    Adreslerim
                </a>
            </li>
        </div>
    </div>
</div>
@endrole

