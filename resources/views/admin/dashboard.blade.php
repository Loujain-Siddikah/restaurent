@extends('layouts.adminMaster')
@section('title')
    Dashboard
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection
@section('content')
    <div class="col m-4">
        <div class="row mb-4">
            <div class="col-3">
                <div class="card" style="width:100%; border-radius: 15px; background-image: linear-gradient(to right, rgba(174,176,177,1), rgba(146,157,166,1) , rgba(130,144,162,1) )">
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <div>
                            <span>Total Orders (Month)</span>
                            <h3 class="d-flex justify-content-center">{{ $ordersMonthlyCount }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card" style="width:100%; border-radius: 15px; background-image: linear-gradient(to right, rgba(174,176,177,1), rgba(146,157,166,1) , rgba(130,144,162,1) )">
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <div>
                            <span>New Users (Week)</span>
                            <h3 class="d-flex justify-content-center">{{ $newUsersWeeklyCount }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card" style="width:100%; border-radius: 15px; background-image: linear-gradient(to right, rgba(174,176,177,1), rgba(146,157,166,1) , rgba(130,144,162,1) )">
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <div>
                            <span>Total Revenue (Month)</span>
                            <h3 class="d-flex justify-content-center">{{ $totalRevenue }}<i class='fa fa-turkish-lira d-flex align-items-center' style="color:#f9a201; font-size:18px"></i></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card" style="width:100%; border-radius: 15px; background-image: linear-gradient(to right, rgba(174,176,177,1), rgba(146,157,166,1) , rgba(130,144,162,1) )">
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <div>
                            <span>Total Users</span>
                            <h3 class="d-flex justify-content-center">{{ $totalUsersCount }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-10">
                <canvas id="monthlyOrderChart" height="150" style="background: linear-gradient(to right, rgba(174,176,177,1), rgba(146,157,166,1) , rgba(130,144,162,1) ); "
                ></canvas>
            </div>
            <div class="col-2">
                <div class="card mb-4" style="width:100%; border-radius: 15px; background-image: linear-gradient(to right, rgba(174,176,177,1), rgba(146,157,166,1) , rgba(130,144,162,1) )">
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <div>
                            <span>Total Meals</span>
                            <h3 class="d-flex justify-content-center">{{ $totalMeals }}</h3>
                        </div>
                    </div>
                </div>              
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-10">
                <canvas id="mealOrderChart" height="150" style="background: linear-gradient(to right, rgba(174,176,177,1), rgba(146,157,166,1) , rgba(130,144,162,1) ); "></canvas>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const monthlyOrders = @json($monthlyOrders);
        // Extract months and total orders from the data
        const months = monthlyOrders.map(entry => entry.month);
        const totalOrders = monthlyOrders.map(entry => entry.total_orders);
        // Create a Chart.js chart
        const ctx = document.getElementById('monthlyOrderChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    label: 'Total Orders',
                    data: totalOrders,
                    backgroundColor: '#195bbb',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <script>
        var mealOrderData = @json($mealOrders);
        const meal = mealOrderData.map(entry => entry.item_name);
        const quantity = mealOrderData.map(entry => entry.total_quantity);

        var ctxy = document.getElementById('mealOrderChart').getContext('2d');
        var chart = new Chart(ctxy, {
            type: 'bar',
            data: {
                labels: meal,
                datasets: [{
                    label: 'Total Meal  Quantity Ordered this month',
                    data: quantity,
                    backgroundColor: '#195bbb',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>


@endsection