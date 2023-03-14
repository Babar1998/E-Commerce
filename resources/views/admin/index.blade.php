
@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-body">
            <h1 class="mt-5">E-SHOP</h1>
            <hr>
            <div class="row mt-5">
                <div class="col-md-3 text-white m-4 bg-primary" >
                    <h4 class="font-weight-bold p-3 text-center ">
                        Total Categories : {{ $category }}</h4>
                </div>
                <div class="col-md-3 text-white m-4 bg-secondary">
                    <h4 class="font-weight-bold p-3 text-center ">
                        Total Product : {{ $product }}</h4>
                </div>
                <div class="col-md-3 m-4 bg-warning">
                    <h4 class="font-weight-bold p-3 text-center ">
                        Total user : {{ $user }}</h4>
                </div>
            </div>
            <div class="row mt-4 mb-5 orderdetails">
                <div class="col-md-3 text-white m-4 bg-info" >
                    <h4 class="font-weight-bold p-3 text-center ">
                        Total Orders : {{ $orders }}</h4>
                </div>
                <div class="col-md-3 text-white m-4 bg-success">
                    <h4 class="font-weight-bold p-3 text-center ">
                        Completed Orders : {{ $completedorder }}</h4>
                </div>
                <div class="col-md-3 text-white m-4 bg-danger">
                    <h4 class="font-weight-bold p-3 text-center ">
                        Pending Orders : {{ $pendingorder }}</h4>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('script')
    
@endsection
