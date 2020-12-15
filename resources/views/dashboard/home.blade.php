@extends('layouts.app')
@section('title')
Dashboard
@endsection
@section('css')
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
<link href="{{asset('dashboard_assets/plugins/apex/apexcharts.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('dashboard_assets/css/dashboard/dash_2.css')}}" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
@endsection
@section('content')
<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div class="col-12  mt-3">
            <div class="card component-card_6">
                <div class="card-body">
                    <a href="{{url('add-product-view')}}" class="btn btn-lg btn-success mt-3">
                        <span data-feather="codesandbox"></span>
                        Add Product
                    </a>
                    <a href="{{url('add-category')}}" class="btn btn-lg btn-info mt-3">
                        <span data-feather="copy"></span>
                        Add Category
                    </a>
                    <a href="{{url('add-vendor')}}" class="btn btn-lg btn-orange mt-3">
                        <span data-feather="shopping-cart"></span>
                        Add Vendor
                    </a>
                    {{-- <a href="{{url('store-index')}}" class="btn btn-lg btn-primary">
                    <span data-feather="shopping-bag"></span>
                    Add Store
                    </a> --}}
                    <a href="{{url('add-manufacturer')}}" class="btn btn-lg btn-secondary mt-3">
                        <span data-feather="airplay"></span>
                        Add Manufacturer
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row layout-top-spacing card-body">
        <div class="col-sm-4 col-12  mt-3">
            <div class="widget widget-one_hybrid widget-followers">
                <div class="widget-heading">
                    <h5>
                        <div class="w-icon">
                            <span data-feather="codesandbox"></span>
                        </div>
                        <span>
                            Total Products
                        </span>
                    </h5>
                    <h1>
                        {{$products}}
                    </h1>
                    <h5>Products</h5>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-12  mt-3">
            <div class="widget widget-one_hybrid widget-referral">
                <div class="widget-heading">
                    <h5>
                        <div class="w-icon">
                            <span data-feather="image"></span>
                        </div>
                       <span>
                           Products With Image
                       </span>
                    </h5>
                    <h1>
                        {{$with_images}}
                    </h1>
                    <h5>Products</h5>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-12  mt-3">
            <div class="widget widget-one_hybrid widget-engagement">
                <div class="widget-heading">
                    <h5>
                        <div class="w-icon">
                            <span data-feather="image"></span>
                        </div>
                        <span>
                            Products Without Image
                        </span>
                    </h5>
                    <h1>
                        {{$without_images}}
                    </h1>
                    <h5>Products</h5>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-12  mt-3">
            <div class="widget widget-one_hybrid widget-followers five">
                <div class="widget-heading">
                    <h5>
                        <div class="w-icon">
                            <span data-feather="airplay"></span>
                        </div>
                        <span>
                            Total Manufacturer
                        </span>
                    </h5>
                    <h1>
                        {{$manufacturer}}
                    </h1>
                    <h5>Manufacturer</h5>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-12  mt-3">
            <div class="widget widget-one_hybrid widget-followers four">
                <div class="widget-heading">
                    <h5>
                        <div class="w-icon">
                            <span data-feather="shopping-cart"></span>
                        </div>
                        <span>
                            Total Vendors
                        </span>
                    </h5>
                    <h1>
                        {{$vendors}}
                    </h1>
                    <h5>Vendors</h5>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@section('scripts')
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<script src="{{asset('dashboard_assets/plugins/apex/apexcharts.min.js')}}"></script>
<script src="{{asset('dashboard_assets/js/dashboard/dash_2.js')}}"></script>
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
@endsection
