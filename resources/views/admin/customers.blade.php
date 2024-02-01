@extends('layouts.adminMaster')
@section('title')
    müşteri listesi
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection
@section('content')
    <div class="col">
        <div class="row m-4">
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCustomerModal">
                <i class="fas fa-plus"></i> Müşteri Ekle
            </div>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row m-3">
            <div class="card mt-2">
                <div class="card-body p-0">
                    <div class="table-responsive active-projects style-1 ItemsCheckboxSec shorting ">
                        <div id="empoloyees-tbl_wrapper" class="dataTables_wrapper no-footer">
                            <table id="empoloyees-tbl" class="table dataTable no-footer" role="grid" aria-describedby="empoloyees-tbl_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1" >müşteri adı
                                        </th>
                                        <th class="sorting" tabindex="0"rowspan="1" colspan="1">Katılma Tarihi
                                        </th>
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1"  >Sipariş numarası</th>
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1" >Toplam harcama
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>  
                                    @foreach ($customers as $customer)
                                        <tr>
                                            <td><span><a href="{{ route('admin.customerDetails', $customer->id) }}" style="text-decoration: none;
                                                color: inherit;">{{ $customer->first_name }} {{ $customer->last_name }}</a></span></td>
                                            <td><span>{{ $customer->created_at->toFormattedDateString() }}</span></td>
                                            <td><span>{{ $customer->completed_orders_count }}</span></td>
                                            <td><span>{{ $customer->completed_total_price }}
                                                @if ($customer->completed_total_price)
                                                    <i class='fa fa-turkish-lira' style="color:#f9a201; font-size:13px"></i> 
                                                @endif
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-modal id="addCustomerModal" title="Müşteri Ekle" formAction="{{ route('admin.addCustomer') }}" formId="addCustomerForm" formMethod="POST" methodName="post">
        <x-slot name="body">
            <div class="row gx-3 mb-3">
                <div class="col-md-6">
                    <label class="small mb-1" for="inputfirstname">ilk adı</label>
                    <input class="form-control" id="inputfirstname" type="text" name="first_name">
                </div>
                <div class="col-md-6">
                    <label class="small mb-1" for="inputlastname">soy adı</label>
                    <input class="form-control" id="inputlastname" type="text" name="last_name">
                </div>
            </div>
            <div class="row gx-3 mb-3">
                <div class="col-md-6">
                    <label class="small mb-1" for="inputEmail">E-posta</label>
                    <input class="form-control" id="inputEmail" type="email" name="email">
                </div>
                <div class="col-md-6">
                    <label class="small mb-1" for="inputPassword">Şifre</label>
                    <input class="form-control" id="inputPassword" type="password" name="password">
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapalı</button>
            <button type="submit" class="btn btn-primary">Kaydet</button>
        </x-slot>
    </x-modal>
@endsection