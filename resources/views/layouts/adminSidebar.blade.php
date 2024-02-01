@role('admin')
    <div class="col-lg-2 col-1 px-sm-1 px-0 bg-dark">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-start" id="menu">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link align-middle px-0">
                            <i class="fa fa-home" style="color: rgb(181, 186, 202)"></i></i><span class="ms-1 d-none d-lg-inline">Ev</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.oredersList') }}" class="nav-link px-0 align-middle">
                            <i class="fa fa-list" style="color: rgb(181, 186, 202)"></i> <span class="ms-1 d-none d-lg-inline">Siparişler</span></a>
                    </li>
                    <li>
                        <a href="#submenu" class="nav-link px-0  align-middle"  data-bs-toggle="collapse" id="menu">
                            <i class="fa fa-archive" style="color: rgb(181, 186, 202)"></i> <span class="ms-1 d-none d-lg-inline">Menüler</span>
                        </a>
                        <ul class="collapse nav flex-column ms-1" id="submenu" data-bs-parent="#menu">
                            <li class="">
                                <a href="{{ route('menu') }}" class="nav-link px-2"> <span class="d-none d-lg-inline">Menü kılavuzu</span></a>
                            </li>
                            <li class="">
                                <a href="{{ route('admin.addMealPage') }}" class="nav-link px-2"> <span class="d-none d-lg-inline">Yemek Ekle</span></a>
                            </li>
                            <li>
                                <a href="{{ route('admin.sections') }}" class="nav-link px-2"> <span class="d-none d-lg-inline">bölümler</span></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('admin.customers') }}" class="nav-link px-0 align-middle">
                            <i class="fa fa-users" style="color: rgb(181, 186, 202)"></i> <span class="ms-1 d-none d-lg-inline">Müşteriler</span> </a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}" class="nav-link px-0 align-middle" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out" style="color: rgb(181, 186, 202)"></i><span class="ms-1 d-none d-lg-inline">Çıkış Yap</span>
                        </a>
                    </li>                   
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>                   
                </ul>
                <hr>
            </div>
        </div>       
@endrole