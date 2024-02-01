@extends('layouts.adminMaster')
@section('title')
    sipariş detayları
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection
@section('content')
    <div class="col-7 mt-3">
        <div class="card  border-0">
            <h5 class="card-title m-3">Sipariş Detayları</h5>
            <div class="card-datatable table-responsive m-2">
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                    <table class="datatables-order-details table dataTable no-footer dtr-column" id="DataTables_Table_0" >
                        <thead>
                            <tr>
                                <th class="sorting_disabled" rowspan="1" colspan="1"aria-label="products">yemekler</th>
                                <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="price">fiyat</th>
                                <th class="sorting_disabled" rowspan="1" colspan="1"  aria-label="qty">miktar</th>
                                <th class="sorting_disabled" rowspan="1" colspan="1"  aria-label="total">toplam</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderDetails->items as $item)
                                <tr class="odd">
                                    <td class="sorting_1">
                                        <div class="d-flex justify-content-start align-items-center text-nowrap">
                                            <div class="avatar-wrapper">
                                                @if ($item->img2)
                                                    <div class="d-flex justify-content-between align-items-center pt-2">
                                                        <div class="avatar me-2 ">
                                                            <img src="{{ asset($item->img1) }}"  style="width: 70px; height: auto;">
                                                        </div>
                                                        <i class='fa fa-plus ' style='color: rgb(136, 130, 130); font-size: 15px;'></i>
                                                        <div class="avatar me-2">
                                                            <img src="{{ asset( $item->img2) }}" style="width: 70px; height: auto;">
                                                        </div>
                                                        <i class='fa fa-plus ' style='color: rgb(136, 130, 130); font-size: 15px;'></i>
                                                        <div class="avatar me-2">
                                                            <img src="{{ asset($item->img3) }}" style="width: 30px; height: auto;">
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="avatar me-2">
                                                        <img src="{{ asset($item->img1) }}" style="width: 80px; height: auto;">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h6 class="text-body mb-0 mt-1">{{ $item->name }}</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <span>{{ $item->price }}<i class='fa fa-turkish-lira' style="color:#f9a201; font-size:13px"></i></span>
                                    </td>
                                    <td>
                                        <span class="text-body">{{ $item->pivot->quantity }}</span>
                                    </td>
                                    <td>
                                        <h6 class="mb-0">{{ $item->price * $item->pivot->quantity }}<i class='fa fa-turkish-lira' style="color:#f9a201; font-size:13px"></i></h6>
                                    </td>
                                </tr>
                            @endforeach                 
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex justify-content-end align-items-center m-3 mb-2 p-1">
                <div class="order-calculations">
                    <div class="d-flex justify-content-between">
                        <h6 class="w-px-100 mb-0">Teslimat ücreti:</h6>
                        <h6 class="mb-0">{{ $delivery_fee }}<i class='fa fa-turkish-lira' style="color:#f9a201; font-size:13px"></i></h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="w-px-100 mb-0">Toplam fiyat:</h6>
                        <h6 class="mb-0">{{ $orderDetails->total_price }}<i class='fa fa-turkish-lira' style="color:#f9a201; font-size:13px"></i></h6>
                    </div>
                </div>
            </div>
            <div class="m-3">
                <div>
                    <h6 style="display: inline">Sipariş durumu:</h6>
                    <span>{{ $orderDetails->order_status }}</span>
                </div>
                <div>
                    <h6 style="display: inline">Ödeme durumu: </h6>
                    <span>{{ $orderDetails->payment_status }}</span>
                </div>
                <div >
                    <h6 style="display: inline">Sipariş şu tarihte verildi:: </h6>
                    <span> {{ $orderDetails->created_at }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <form action="{{ route('admin.updateStatus', $orderDetails->id) }}" method="POST">
                        @csrf
                        <h6 style="display:inline"><label for="status">Sipariş durumunu güncelle</label></h6>
                        <select name="status" id="status">
                            @foreach(['beklemede', 'işleniyor', 'teslimatta', 'tamamlandı'] as $status)
                                <option value="{{ $status }}" {{ $orderDetails->order_status == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                            @endforeach
                        </select>
                        <button type="submit" style="background-color: #50596b; ">Güncelleme durumu</button>
                    </form>
                </div>
            </div>  
        </div>
    </div>
    <div class="col-3 mt-3">
        <div class="card mb-4" >
            <h5 class="card-title m-3">Müşteri detayları</h5>
            <div class="card-body">
                <div class="d-flex justify-content-start align-items-center mb-4">
                    <div class="d-flex flex-column">
                        <h6 class="mb-0">{{ $orderDetails->user->first_name }} {{ $orderDetails->user->last_name }}</h6>
                    </div>
                </div>
                <h6>İletişim bilgileri</h6>
                <div>
                    <div class="d-flex justify-content-between mb-1">
                        <p >E-posta: </p>
                        <p >{{ $orderDetails->user->email }}</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="">Telefon: </p>
                        <p class=" ">{{ $orderDetails->user->phone }}</p>
                    </div>
                </div> 
                <h6>Teslimat adresi</h6>
                <div class="d-flex justify-content-between mb-1">
                    <span>Semt: </span>
                    <span>{{ $orderDetails->address->district }}</span>
                </div>
                <div class="d-flex justify-content-between mb-1">
                    <span>Kat: </span>
                    <span>{{ $orderDetails->address->floor }}</span>
                </div>
                <div class="d-flex justify-content-between mb-1">
                    <span>Detaylars: </span>
                    <span>{{ $orderDetails->address->details }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection