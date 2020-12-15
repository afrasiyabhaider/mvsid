@extends('layouts.app')
@section('title')
    Home
@endsection
@section('content')
{{-- <h1>Working Fine</h1> --}}
<h1>
    Dashboard
</h1>
<div class="row ">
    <div class="col-12">
        <div class="card component-card_6">
            <div class="card-body">
                <a href="{{url('add-product-view')}}" class="btn btn-lg btn-success">
                    <span data-feather="codesandbox"></span>
                    Add Product
                </a>
                <a href="{{url('add-category')}}" class="btn btn-lg btn-info">
                    <span data-feather="copy"></span>
                    Add Category
                </a>
                <a href="{{url('add-vendor')}}" class="btn btn-lg btn-orange">
                    <span data-feather="shopping-cart"></span>
                    Add Vendor
                </a>
                <a href="{{url('store-index')}}" class="btn btn-lg btn-primary">
                    <span data-feather="shopping-bag"></span>
                    Add Store
                </a>
                <a href="{{url('add-manufacturer')}}" class="btn btn-lg btn-secondary">
                    <span data-feather="airplay"></span>
                    Add Manufacturer
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
