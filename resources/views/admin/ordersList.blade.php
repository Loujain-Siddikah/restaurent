@extends('layouts.adminMaster')
@section('title')
    sipariş listesi
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection
@section('content')
    <div class="col m-4">
        <div class="d-flex justify-content-between mb-4 flex-wrap">
            <ul class="revnue-tab nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="status-tab" aria-selected="true" data-status-filter="all">Tüm Durumlar</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="delivery-tab"   aria-selected="false" tabindex="-1" data-status-filter="processing" >İşleme</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="delivered-tab"aria-selected="false" tabindex="-1" data-status-filter="onDelivery">Teslimatta</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="canceled-tab" aria-selected="false" tabindex="-1" data-status-filter="completed">tamamlandı</button>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="status-tab-pane" role="tabpanel" aria-labelledby="status-tab" tabindex="0">
                        <div class="card mt-2"  >
                            <div class="card-body p-0">
                                <div class="table-responsive active-projects style-1 ItemsCheckboxSec shorting ">
                                    <div id="empoloyees-tbl_wrapper" class="dataTables_wrapper no-footer">
                                        <table id="empoloyees-tbl" class="table dataTable no-footer" role="grid" aria-describedby="empoloyees-tbl_info">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1"  style="width: 91px;">sipariş numarası
                                                    </th>
                                                    <th class="sorting" tabindex="0"  rowspan="1" colspan="1" style="width: 161.531px;">Tarih
                                                    </th>
                                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 118.828px;">Müşteri</th>
                                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 108.875px;">Konum</th>
                                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 86px;">Miktar</th>
                                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1"  style="width: 103.656px;">Durum</th>
                                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1"  style="width: 102.156px;">Aksiyon</th>
                                                </tr>
                                            </thead>
                                            <tbody>  
                                                @foreach ($orders as $order)
                                                    <tr role="row" class="odd" data-status="{{ $order->order_status }}">
                                                        <td><span>{{ $order->order_number }}</span></td>
                                                        <td><span>{{ $order->created_at }}</span></td>
                                                        <td><span>{{ $order->user->first_name }}</span></td>
                                                        <td><span>{{ $order->address->district }}<br>{{ $order->address->floor }} </span></td>
                                                        <td><span>{{ $order->total_price }}</span></td>
                                                        <td><span >{{ $order->order_status }}</span></td>
                                                        <td>
                                                            <div>
                                                                <a href="{{ route('admin.orederDetails',['order' => $order]) }}" class="btn-link me-1">Göster</a>
                                                            </div>
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
            </div>
        </div>
                                    
                                    
                    
    </div>
<script>
    $(document).ready(function() {
        // Event listener for status buttons
        $(".nav-link").on("click", function() {
            var statusFilter = $(this).data("status-filter");
            showRowsByStatus(statusFilter);
        });
        // Function to show/hide rows based on status
        function showRowsByStatus(status) {
            // Hide all rows initially
            $("tr[data-status]").hide();
            // Show rows with the selected status
            if (status !== "all") {
                $("tr[data-status='" + status + "']").show();
            } else {
                // Show all rows if "All" is selected
                $("tr[data-status]").show();
            }
        }
    });
</script>



@endsection