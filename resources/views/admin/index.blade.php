@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-body">
            <h1>Statistics</h1>
            <div class="row">
                <div class="col-md-3">
                    <div class="card bg-primary h-100">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h3>{{ $totalCategories }}</h3>
                                    <p>Total Categories</p>
                                </div>
                                <div class="col-6">
                                    <i class="fa fa-sitemap fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success h-100">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h3>{{ $totalProducts }}</h3>
                                    <p>Total Properties</p>
                                </div>
                                <div class="col-6">
                                    <i class="fa fa-cubes fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-danger h-100">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h3>{{ $totalUsers }}</h3>
                                    <p>Total Users</p>
                                </div>
                                <div class="col-6">
                                    <i class="fa fa-users fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning h-100">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h3>{{ $totalOrders }}</h3>
                                    <p>Total Inquiries</p>
                                </div>
                                <div class="col-6">
                                    <i class="fa fa-shopping-cart fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-4">
                    <div class="card bg-success h-100">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h3>{{ $completedOrders }}</h3>
                                    <p>Total Transactions</p>
                                </div>
                                <div class="col-6">
                                    <i class="fa fa-check fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-danger h-100">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h3>{{ $pendingOrders }}</h3>
                                    <p>Pending Transactions</p>
                                </div>
                                <div class="col-6">
                                    <i class="fa fa-clock-o fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
