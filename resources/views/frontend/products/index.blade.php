@extends('layouts.front')

@section('title')
{{ $category->name}}
@endsection

@section('content')

    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <a href="{{ url('category')}}">Collections</a>/
            <a href="{{ url('view-category/'.$category->slug)}}">
                {{ $category->name}}
            </a>    
        </div>
    </div>

    <div class="py-5">
        <div class="container">
            <div class="row">
                <h2>{{ $category->name}}</h2>   
                @foreach ($products as $prod)
                
                    <div class="col-md-3 mb-3">
                        <a href="{{ url('category/'. $category->slug.'/'.$prod->slug)}}">
                            <div class="card">
                                <img src="{{asset('assets/uploads/products/'.$prod->image)}}" alt="Product image" height="300px">
                                <div class="card-body">
                                    <h6>{{ $prod->name}}</h6>
                                    <span class="float-start"><s>{{ $prod->original_price}}</s> </span>
                                    <span class="float-end"> {{ $prod->selling_price}} </span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach 
            </div>
        </div>
    </div>

@endsection