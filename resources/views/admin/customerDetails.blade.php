@extends('layouts.adminMaster')
@section('title')
    Müşteri detayları
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection
@section('content')
    <div class="col-lg-4 mt-4 ml-4">
        <div class="card mb-4">
        <div class="card-body">
            <div class="row">
            <div class="col-sm-3">
                <p class="mb-0">adı</p>
            </div>
            <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $customer->first_name }} {{ $customer->last_name }}</p>
            </div>
            </div>
            <hr>
            <div class="row">
            <div class="col-sm-3">
                <p class="mb-0">E-posta</p>
            </div>
            <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $customer->email }}</p>
            </div>
            </div>
            <hr>
            <div class="row">
            <div class="col-sm-3">
                <p class="mb-0">Telefon</p>
            </div>
            <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $customer->phone }}</p>
            </div>
            </div>
            <hr>
            @foreach ($customer->addresses as $address)
                <div class="row">
                    <div class="col-sm-3">
                    <p class="mb-0">adres {{ $address->name }}</p>
                    </div>
                    <div class="col-sm-9">
                    <p class="text-muted mb-0">{{ $address->city }}, {{ $address->district }}, {{ $address->street}}, {{ $address->floor }},{{ $address->details }}</p>
                    </div>
                </div>
            @endforeach
            
        </div>
        </div>
    </div>
    <div class="col-md-6 mt-4 ml-4">
        <div class="card mb-4 mb-md-0">
            <div class="card-body">
                <h5 class="mb-4">verilmedi siparişler</h5>
                @if ($customer->orders->isEmpty())
                    <h6>herhangi bir sipariş verilmedi</h6>                       
                @else
                    <div class="table-responsive active-projects style-1 ItemsCheckboxSec shorting ">
                        <div id="empoloyees-tbl_wrapper" class="dataTables_wrapper no-footer">
                            <table id="empoloyees-tbl" class="table dataTable no-footer" role="grid" aria-describedby="empoloyees-tbl_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1"  >Sipariş numarası
                                        </th>
                                        <th class="sorting" tabindex="0"  rowspan="1" colspan="1">Tarih
                                        </th>
                                        <th class="sorting" tabindex="0"  rowspan="1" colspan="1">Durum</th>
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1">Toplam fiyat</th>
                                    </tr>
                                </thead>
                                <tbody>  
                                    @foreach ($customer->orders as $order)
                                        <tr role="row" class="odd">
                                            <td><a href="{{ route('admin.orederDetails',$order->id) }}" style="text-decoration: none; color: inherit;"><span>{{ $order->order_number }}</span></a></td>
                                            <td><span>{{ $order->created_at }}</span></td>
                                            <td><span>{{ $order->order_status }}</span></td>                                    
                                            <td><span>{{ $order->total_price }}</span></td>
                                            <td>                                                     
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection