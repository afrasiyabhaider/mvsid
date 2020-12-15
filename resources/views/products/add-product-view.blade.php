@extends('layouts.app')
@section('title')
    Choose Type
@endsection
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
<div class="container-fluid">
    <div>
        <div class="row">
            <div class="col-12">
                <h3>
                    <span data-feather="codesandbox"></span>
                    Add Products
                </h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Upload CSV</h5>
                                <button class="btn btn-danger" data-dismiss="modal"><i class="flaticon-cancel-12"></i>
                                    Close</button>
                            </div>
                            <div class="modal-body">
                                <a href="{{asset('template/products.csv')}}" class="btn btn-info">Download
                                    Template</a>
                                <br>
                                <form action="{{action('ImportExportController@import') }}" method="POST"
                                    enctype="multipart/form-data" id="csv-form" name="csv-form">
                                    @csrf
                                    <div class="form-row">
                                        <div class="custom-file mb-4 mt-5">
                                            <input type="file"
                                                class="custom-file-input @if($errors->has('file')? 'is-invalid':'') @endif"
                                                id="customFile" name="file">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                        @if($errors->has('file'))
                                        <span class="text-danger">
                                            <small class="font-weight-bold">{{$errors->first('file')}}</small>
                                        </span>
                                        @endif
                                        <br>
                                        <button id="csv" type="button" class="btn btn-success float-right mt-3 ">
                                            Import Porduct Data
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="float-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Upload CSV
                            </button>
                        </div> --}}
            </div>
        </div>
        <div>
            <div class="row">
                <div class="modal fade" id="exampleModa33" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Barcode</h5>
                                <button class="btn btn-danger" data-dismiss="modal"><i class="flaticon-cancel-12"></i>
                                    Close</button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{ action('BarcodeScannerController@postBarcode') }}" id="postBarcode-form" name="postBarcode-form">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Enter Barcode</label>
                                                <input type="text"
                                                    class="form-control {{ $errors->has('barcode') ? 'is-invalid': '' }}"
                                                    id="exampleFormControlInput1" placeholder="Please Enter Barcode"
                                                    name="barcode" value="{{ old('barcode') }}">
                                                @if($errors->has('barcode'))
                                                    <span class="text-danger">
                                                        <small class="font-weight-bold">{{ $errors->first('barcode') }}
                                                        </small>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row mt-2 ">
                                        <div class="col-sm-6 ">
                                            <button id="postBarcode" type="button" class="btn btn-primary float-left">Submit</button>
                                        </div>
                                    </div>
                                <form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row mt-5 mx-auto justify-content-sm-center">
        <div class="col-sm-3">
            <div class="card component-card_3 shadow-lg">
                <a href="{{url('/scan-view')}}">
                    <div class="card-body text-center">
                        <div class="avatar avatar-xl">
                            <img alt="avatar" src="{{asset('dashboard_assets/images/camera.png')}}" class="rounded"/>
                            {{-- <img class="img img-responsive rounded" src="{{asset('dashboard_assets/images/camera.png')}}" alt="..." width="300px"> --}}
                        </div>

                        <h5 class="">Scan By Camera</h5>
                        <p class="">The user's camera</p>
                        <p class="text-primary">
                            Click Me
                        </p>
                        {{--
                        <p>If your platform supports the <strong>getUserMedia</strong> API call, you can try the real-time locating and decoding features. Simply allow the page to access your web-cam and point it to a barcode. You can switch between <strong>Code128</strong> and
                            <strong>EAN</strong> to test different scenarios. It works best if your camera has built-in auto-focus.
                        </p> --}}
                    </div>
                </a>
            </div>
        </div>
        <div class="col-sm-3 mt-4 mt-sm-0">
            <div class="card component-card_1 shadow-lg">
                <a href="{{url('/scan-file')}}">
                    <div class="card-body text-center">
                        <div class="avatar avatar-xl">
                            <img alt="avatar" src="{{asset('dashboard_assets/images/file-upload.png')}}" class="rounded"/>
                            {{-- <img src="{{asset('dashboard_assets/images/file-upload.png')}}" width="250px"> --}}
                        </div>

                        <h5 class="">Scan From File</h5>
                        <p class="">Working with Image .png</p>
                        <p class="text-primary">
                            Click Me
                        </p>
                        {{-- <p>This example let's you select an image from your local filesystem.
                        QuaggaJS then tries to decode the barcode using
                        the preferred method (<strong>Code128</strong> or <strong>EAN</strong>).
                        There is no server interaction needed as the
                        file is simply accessed through the <a href="http://www.w3.org/TR/file-upload/">File API</a>.</p> --}}
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="row mt-0 mt-sm-5 mx-auto justify-content-sm-center">
        <div class="col-sm-3 mt-4 mt-sm-0">
            <div class="card component-card_1 shadow-lg" data-toggle="modal" data-target="#exampleModa33">
                <a href="#">
                    <div class="card-body text-center">
                        <div class="avatar avatar-xl">
                            <img alt="avatar" src="{{asset('dashboard_assets/images/keyboard.png')}}" class="rounded"/>
                            {{-- <img src="{{asset('dashboard_assets/images/file-upload.png')}}" width="250px"> --}}
                        </div>

                        <h5 class="">Enter Barcode</h5>
                        <p class="">
                            Enter barcode in popup
                        </p>
                        <p class="text-primary">
                            Click Me
                        </p>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-sm-3 mt-4 mt-sm-0">
            <div class="card component-card_1 shadow-lg" data-toggle="modal" data-target="#exampleModal">
                <a href="#">
                    <div class="card-body text-center">
                        <div class="avatar avatar-xl">
                            <img alt="avatar" src="{{asset('dashboard_assets/images/excel.png')}}" class="rounded"/>
                            {{-- <img src="{{asset('dashboard_assets/images/file-upload.png')}}" width="250px"> --}}
                        </div>

                        <h5 class="">Upload CSV</h5>
                        <p class="">
                            Upload CSV file to save data
                        </p>
                        <p class="text-primary">
                            Click Me
                        </p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        $(function () {
            $("#postBarcode").click(function (e) {
                $("form[name=postBarcode-form]").submit();
            });
            $("#csv").click(function (e) {
                $("form[name=csv-form]").submit();
            });
        });
    </script>
@endsection
