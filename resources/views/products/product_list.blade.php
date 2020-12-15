@extends('layouts.app')
@section('css')
<style>
    #barcode-scanner canvas.drawingBuffer,
    #barcode-scanner video.drawingBuffer {
        display: none;
    }

    #barcode-scanner canvas,
    #barcode-scanner video {
        width: 100%;
        height: auto;
    }
</style>
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css">
@endsection

@section('title')
Products
@endsection


@section('content')
<h6 class="card-title">View / Edit Products</h6>
<div class="row justify-content-center">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            @if($errors->any())
            <div style="background-color: #FF4C4C"
                class="alert alert-danger alert-dismissible fade show text-white font-weight-bold" role="alert">
                <h4>
                    Please Remove Following Errors to Proceed
                </h4>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>
                        {{$error}}
                    </li>
                    @endforeach
                </ul>
                <button type="button" class="close" style="color: black; outline: none" data-dismiss="alert"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="card-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Upload CSV</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <a href="{{asset('template/products.csv')}}" class="btn btn-info">Download
                                            Template</a>
                                        <br>
                                        <form action="{{ route('import') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <div class="custom-file mb-4 mt-5">
                                                <input type="file"
                                                    class="custom-file-input @if($errors->has('file')? 'is-invalid':'') @endif"
                                                    id="customFile" name="file">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>

                                            {{-- <input type="file" name="file" class="custom-control @if($errors->has('file')? 'is-invalid':'') @endif"> --}}
                                            @if($errors->has('file'))
                                            <span class="text-danger">
                                                <small class="font-weight-bold">{{$errors->first('file')}}</small>
                                            </span>
                                            @endif
                                            <br>
                                            <div class="float-left">
                                                <button class="btn btn-success mt-3">Import Porduct Data</button>
                                            </div>
                                            {{-- <a class="btn btn-warning" href="{{ route('export') }}">Export User
                                            Data</a> --}}
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-danger" data-dismiss="modal"><i
                                                class="flaticon-cancel-12"></i> Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="float-right">
                            <a href="{{url('/scan-view')}}" type="button" class="btn btn-primary">
                                Scan Barcode
                            </a>
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModal">
                                Upload CSV
                            </button>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="product_table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Logo</th>
                                <th>Product Code</th>
                                <th>Barcode</th>
                                <th>Actions</th>
                                <th>Name</th>
                                <th>Cost</th>
                                <th>Retail Price</th>
                                <th>Sale Price</th>
                                <th>Category1 Code</th>
                                <th>Category1 Name</th>
                                <th>Category2 Code</th>
                                <th>Category2 Name</th>
                                <th>Category3 Code</th>
                                <th>Category3 Name</th>
                                <th>Vendor Id</th>
                                <th>Vendor Name</th>
                                <th>Buying Code</th>
                                <th>Manufecture Id</th>
                                <th>Manufecture Name</th>
                                <th>Size</th>
                                <th>Tax1</th>
                                <th>Tax2</th>
                                <th>Tax3</th>
                                <th>Qty</th>
                                <th>Product Name2</th>
                                <th>Minimum Stock</th>
                                <th>Box Cost</th>
                                <th>Item Cnt Per Box</th>
                                <th>Box Barcode</th>
                                <th>Deposit Amount</th>
                                <th>Food Stamp</th>
                                <th>Age Check</th>
                                <th>CheckScale Product</th>
                                <th>Description</th>
                                <th>Liquore Price</th>

                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#product_table').DataTable({
    responsive: true,
    processing: true,
    responsive: true,
    serverSide: true,
    "ajax": {
        url: '/view-products',
        "type": "POST"
    },
    lengthMenu: [
        [50, 100, 300, 500, 1000, -1],
        [50, 100, 300, 500, 1000, 'All'],
    ],
    "order": [[ 4, "asc" ]],
    columnDefs: [
        { responsivePriority: 1, targets: 0 },
        // { responsivePriority: 1, targets: 2 },
        { responsivePriority: 2, targets: 1 },
        { responsivePriority: 3, targets: 2}
    ],
    columns: [

            { data: 'logo', name: 'logo' , exportable:false}, //same name as db
            { data: 'pd_code', name: 'pd_code' , visible:false}, //same name as db
            { data: 'barcode', name: 'barcode' }, //same name as db
            { data: 'actions', name: 'actions',orderable:false, searchable:false, exportable:false },
            { data: 'product_name', name: 'product_name', "sortOrder": 'asc'}, //same name as
            { data: 'cost', name: 'cost' , visible:false}, //same name as db
            { data: 'retail_price', name: 'retail_price' }, //same name as db
            { data: 'sell_price', name: 'sell_price' }, //same name as db
            { data: 'category1_code', name: 'category1_code' , visible:false }, //same name as db
            { data: 'category1_name', name: 'category1_name' , visible:false }, //same name as db
            { data: 'category2_code', name: 'category2_code' , visible:false }, //same name as db
            { data: 'category2_name', name: 'category2_name' , visible:false }, //same name as db
            { data: 'category3_code', name: 'category3_code' , visible:false }, //same name as db
            { data: 'category3_name', name: 'category3_name' , visible:false }, //same name as db
            { data: 'vendor_id', name: 'vendor_id' , visible:false }, //same name as db
            { data: 'vendor_name', name: 'vendor_name' , visible:false }, //same name as db
            { data: 'buying_code', name: 'buying_code' , visible:false },
            { data: 'menuf_id', name: 'menuf_id' , visible:false }, //same name as db
            { data: 'menuf_name', name: 'menuf_name' , visible:false }, //same name as db
            { data: 'size', name: 'size' , visible:false }, //same name as db
            { data: 'tax1', name: 'tax1' , visible:false }, //same name as db
            { data: 'tax2', name: 'tax2' , visible:false }, //same name as db
            { data: 'tax3', name: 'tax3' , visible:false }, //same name as db
            { data: 'quantity', name: 'quantity' }, //same name as db
            { data: 'pd_name2', name: 'pd_name2' , visible:false }, //same name as db
            { data: 'minimum_stock', name: 'minimum_stock' , visible:false}, //same name as db
            { data: 'box_cost', name: 'box_cost' , visible:false }, //same name as db
            { data: 'item_cnt_per_box', name: 'item_cnt_per_box' , visible:false }, //same name as db
            { data: 'box_barcode', name: 'box_barcode' , visible:false }, //same name as db
            { data: 'deposit_amount', name: 'deposit_amount' , visible:false}, //same name as db
            { data: 'food_stamp', name: 'food_stamp' , visible:false}, //same name as db
            { data: 'age_check', name: 'age_check' , visible:false}, //same name as db
            { data: 'scale_product', name: 'scale_product' , visible:false}, //same name as db
            { data: 'description', name: 'description' , visible:false }, //same name as db
            { data: 'liquore_price', name: 'liquore_price' , visible:false}, //same name as db

            // { data: 'category_id', name: 'category_id' }, //same name as db
            // { data: 'category_name', name: 'category_name' , visible:false}, //same name as db
            // { data: 'store_name', name: 'store_name' , visible:false}, //same name as db
             // name written in controller
        ],
    });


</script>
@endsection
