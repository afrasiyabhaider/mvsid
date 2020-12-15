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
    Add Product
@endsection


@section('content')

<h3 class="mt-3">Add Product</h3>
{{-- <div class="row ">
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
                <form method="post" action="{{ url('/product-store') }}">
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
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Add Product Name" name="product_name" value="{{old('product_name')}}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Quantity</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Add Quantitiy" name="quantity" value="{{old('quantity')}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Retail Price</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Add Sale Price">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Sale Price</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Add Retail Price">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <label for="search">Search Image</label>
                                        <input type="text" class="form-control" id="search" name="product_image" placeholder="Search Image">
                                        <input type="hidden" id="img_src_val" name="image_src">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <a class="btn btn-primary mt-4" id="search_image">Search</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Bar Code</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Add Bar Code" value="{{$barcode}}" name="barcode" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-sm-6">
                            <div class="form-row">
                                <div class=" img col-sm-3  ">
                                    <img id="p_image0"  src="{{asset('dashboard_assets/images/profile-17.jpg')}}" height="100px" width="100px">
                                </div>
                                <div class="img col-sm-3 ml-1">
                                    <img id="p_image1" src="{{asset('dashboard_assets/images/profile-17.jpg')}}" height="100px" width="100px">
                                </div>
                                <div class="img col-sm-3 ml-1">
                                    <img id="p_image2" src="{{asset('dashboard_assets/images/profile-17.jpg')}}" height="100px" width="100px">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row mt-2">
                        <div class="col-sm-6">
                            <div class="form-row">
                                <div class="col-sm-3 img">
                                    <img id="p_image3" src="{{asset('dashboard_assets/images/profile-17.jpg')}}" height="100px" width="100px">
                                </div>
                                <div class="col-sm-3 ml-1 img">
                                    <img id="p_image4" src="{{asset('dashboard_assets/images/profile-17.jpg')}}" height="100px" width="100px">
                                </div>
                                <div class="col-sm-3 ml-1 img">
                                    <img id="p_image5" src="{{asset('dashboard_assets/images/profile-17.jpg')}}" height="100px" width="100px">
                                </div>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary mt-2">Submit</button>

                </form>
            </div>
        </div>
    </div>
</div> --}}

<div class="col-lg-12 layout-spacing ">
    <div class="statbox widget box box-shadow card component-card_6">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>Default</h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area ">
            <div id="circle-basic" class="">
                <h3>Scanning</h3>
                <section>
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
                    <form method="post" action="{{ url('/product-store') }}">
                        @csrf



                </section>

                <h3>Image</h3>

                <section>
                    <div class="form-row">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <label for="search">Search Image</label>
                                        <input type="text" class="form-control" id="search" name="product_image" placeholder="Search Image">
                                        <input type="hidden" id="img_src_val" name="image_src">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <a class="btn btn-primary mt-4" id="search_image">Search</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Bar Code</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Add Bar Code" value="{{$barcode}}" name="barcode" >
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-sm-6">
                            <div class="form-row">
                                <div class=" img col-sm-3  ">
                                    <img id="p_image0"  src="{{asset('dashboard_assets/images/profile-17.jpg')}}" height="100px" width="100px">
                                </div>
                                <div class="img col-sm-3 ml-1">
                                    <img id="p_image1" src="{{asset('dashboard_assets/images/profile-17.jpg')}}" height="100px" width="100px">
                                </div>
                                <div class="img col-sm-3 ml-1">
                                    <img id="p_image2" src="{{asset('dashboard_assets/images/profile-17.jpg')}}" height="100px" width="100px">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row mt-2">
                        <div class="col-sm-6">
                            <div class="form-row">
                                <div class="col-sm-3 img">
                                    <img id="p_image3" src="{{asset('dashboard_assets/images/profile-17.jpg')}}" height="100px" width="100px">
                                </div>
                                <div class="col-sm-3 ml-1 img">
                                    <img id="p_image4" src="{{asset('dashboard_assets/images/profile-17.jpg')}}" height="100px" width="100px">
                                </div>
                                <div class="col-sm-3 ml-1 img">
                                    <img id="p_image5" src="{{asset('dashboard_assets/images/profile-17.jpg')}}" height="100px" width="100px">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-sm-6">
                            <label for="prod_image" class="mt-2">Image From Device</label>
                            <input type="file" class="form-control-file" id="prod_image" name="prod_image" placeholder="Search Image">

                        </div>

                    </div>

                </section>
                <h3>Details</h3>
                <section>
                    <div class="form-row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">
                                    Product Name
                                    <small class="text-danger mt-2">
                                       <strong>*</strong>
                                    </small>
                                </label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Add Product Name" name="product_name" value="{{old('product_name')}}" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Quantity
                                    <small class="text-danger mt-2">
                                        <strong>*</strong>
                                     </small>
                                </label>
                                <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="Add Quantitiy" name="quantity" value="{{old('quantity')}}"required >
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Retail Price'
                                    <small class="text-danger mt-2">
                                        <strong>*</strong>
                                     </small>
                                </label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Add Sale Price" required >
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Sale Price
                                    <small class="text-danger mt-2">
                                        <strong>*</strong>
                                     </small>
                                </label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Add Retail Price" required >
                            </div>
                        </div>
                    </div>
                </section>
            </div>



        </div>
    </div>
</div>


@endsection
@section('scripts')
<script>
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    $("#search_image").click(function(){
                    var search= $("#search").val();
                    $.ajax({
                    url: '/get-image/'+search,
                    type: 'GET',
                    success: function (data) {
                        if(data=="Failed"){
                            alert("No Image Found");
                        }else{
                            for (var i = 0; i < 6; i++) {
                              var img_src =  data[i]["link"];
                              $("#p_image"+i+"").attr('src',img_src);
                            }

                            $("div.img").click(function(){
                                var src = $(this).find('img').attr('src');

                                $.ajax({
                                    url: '/download-image',
                                    type: 'GET',
                                    data: { src: src },
                                    success: function (data) {
                                        $("#img_src_val").val(data);
                                        swal({
                                            title: 'Success!',
                                            text: "Image is Selected!",
                                            type: 'success',
                                            padding: '2em'
                                            });
                                     }
                                    });

                            });
                        }

                    }
                    });
                });


</script>
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









