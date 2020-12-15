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
@endsection

@section('title')
    Update Product
@endsection


@section('content')

<h3 class="mt-3">Update Product</h3>
<div class="row ">
    <div class="col-12">
        <div class="card component-card_6">
            @if(Session::has('info'))
            <div style="background-color: #727CF5"
                class="alert alert-primary alert-dismissible fade show  text-white font-weight-bold"
                role="alert">
                {{ Session::get('info') }}
                <button type="button" class="close" style="color: black; outline: none" data-dismiss="alert"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        @if($errors->any())
                            <div style="background-color: #FF4C4C"
                                class="alert alert-danger alert-dismissible fade show text-white font-weight-bold"
                                role="alert">
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
                    </div>
                </div>
                <form method="post" action="{{ action('ProductController@update',$product->id)}}">
                    @csrf
                    <div class="form-row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">
                                    Product Name
                                    <sup class="text-danger">
                                       <strong>*</strong>
                                    </sup>
                                </label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Add Product Name" name="product_name" value="{{ $product->product_name}}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Quantity</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Add Quantitiy" name="quantity" value="{{$product->quantity}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Retail Price</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Add Retail Price" name="retail_price" value="{{$product->retail_price}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Sale Price</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Add Sale Price" name="sale_price" value="{{$product->sell_price}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Bar Code</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Add Bar Code" value="{{$barcode}}" name="barcode" readonly>
                    </div>
                    <button class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="gcse-search"></div>

{{-- <div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">barcode scanner</h3>
            </div>
            <div class="panel body">
                <div class="barcode-scanner">

                </div>
            </div>

            </div>
        </div>
    </div>
</div> --}}


@endsection
@section('scripts')
    <script>
        function order_by_occurrence(arr) {
            var counts = {};
            arr.forEach(function(value){
            if(!counts[value]) {
                counts[value] = 0;
            }
            counts[value]++;
            });

            return Object.keys(counts).sort(function(curKey,nextKey) {
            return counts[curKey] < counts[nextKey];
            });
            }

            function load_quagga(){
            if ($('#barcode-scanner').length > 0 && navigator.mediaDevices && typeof navigator.mediaDevices.getUserMedia === 'function') {

            var last_result = [];
            if (Quagga.initialized == undefined) {
            Quagga.onDetected(function(result) {
                var last_code = result.codeResult.code;
                last_result.push(last_code);
                if (last_result.length > 20) {
                code = order_by_occurrence(last_result)[0];
                last_result = [];
                Quagga.stop();
                $.ajax({
                    type: "POST",
                    url: '/products/get_barcode',
                    data: { upc: code }
                });
                }
            });
            }

            Quagga.init({
            inputStream : {
                name : "Live",
                type : "LiveStream",
                numOfWorkers: navigator.hardwareConcurrency,
                target: document.querySelector('#barcode-scanner')
            },
            decoder: {
                readers : ['ean_reader','ean_8_reader','code_39_reader','code_39_vin_reader','codabar_reader','upc_reader','upc_e_reader']
            }
            },function(err) {
                if (err) { console.log(err); return }
                Quagga.initialized = true;
                Quagga.start();
            });

            }
            };

            $(document).on('turbolinks:load', load_quagga);


    </script>
@endsection









