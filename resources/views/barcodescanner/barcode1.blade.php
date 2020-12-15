@extends('layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('barcode/css/styles.css')}}" />
@endsection

@section('title')
    Upload Barcode
@endsection

@section('content')
    <div class=" statbox widget box box-shadow card component-card_6">
        <section id="container" class="container">
            <h3>Working with file-input</h3>

            <p>This example let's you select an image from your local filesystem.
                QuaggaJS then tries to decode the barcode using
                the preferred method (<strong>Code128</strong> or <strong>EAN</strong>).
                There is no server interaction needed as the
                file is simply accessed through the <a href="http://www.w3.org/TR/file-upload/">File API</a>.</p>

            <p>This also works great on a wide range of mobile-phones where the camera
                access through <code>getUserMedia</code> is still very limited.</p>

            <div class="row">
                <div class="col-12">
                    <div class="controls">
                        <fieldset class="input-group">
                            <input type="file" accept="image/*" capture="camera" class="form-container" />
                            <button class="btn btn-primary">Rerun</button>
                        </fieldset>
                        <fieldset class="reader-config-group">
                            <label>
                                <span>Barcode-Type</span>
                                <select name="decoder_readers" class="form-control">
                                    <option value="ean" selected="selected">EAN</option>
                                    <option value="code_128" >Code 128</option>
                                    <option value="code_39">Code 39</option>
                                    <option value="code_39_vin">Code 39 VIN</option>
                                    <option value="ean_extended">EAN-extended</option>
                                    <option value="ean_8">EAN-8</option>
                                    <option value="upc">UPC</option>
                                    <option value="upc_e">UPC-E</option>
                                    <option value="codabar">Codabar</option>
                                    <option value="i2of5">Interleaved 2 of 5</option>
                                    <option value="2of5">Standard 2 of 5</option>
                                    <option value="code_93">Code 93</option>
                                </select>
                            </label>
                            <label>
                                <span>Resolution (long side)</span>
                                <select name="input-stream_size" class="form-control">
                                    <option value="320">320px</option>
                                    <option value="640">640px</option>
                                    <option selected="selected" value="800">800px</option>
                                    <option value="1280">1280px</option>
                                    <option value="1600">1600px</option>
                                    <option value="1920">1920px</option>
                                </select>
                            </label>
                            <label>
                                <span>Patch-Size</span>
                                <select name="locator_patch-size" class="form-control">
                                    <option value="x-small">x-small</option>
                                    <option value="small">small</option>
                                    <option value="medium">medium</option>
                                    <option selected="selected" value="large">large</option>
                                    <option value="x-large">x-large</option>
                                </select>
                            </label>
                            <label>
                                <span>Half-Sample</span>
                                <input type="checkbox" name="locator_half-sample" />
                            </label>
                            <label>
                                <span>Single Channel</span>
                                <input type="checkbox" name="input-stream_single-channel" />
                            </label>
                            <label>
                                <span>Workers</span>
                                <select name="numOfWorkers" class="form-control">
                                    <option value="0">0</option>
                                    <option selected="selected" value="1">1</option>
                                </select>
                            </label>
                        </fieldset>
                    </div>
                </div>
            </div>
            <div id="result_strip">
                <ul class="thumbnails"></ul>
            </div>
            <div id="interactive" class="viewport"></div>
            <div id="debug" class="detection"></div>
        </section>
    </div>
@endsection

@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/7.3.0/adapter.min.js">
    </script>
    <script src="https://webrtc.github.io/adapter/adapter-latest.js" type="text/javascript"></script>
    <script src="{{asset('barcode/quagga.js')}}" type="text/javascript"></script>
    {{-- <script src="{{asset('barcode/live_w_locator.js')}}" type="text/javascript"></script> --}}
    <script src="{{asset('barcode/file_input.js')}}" type="text/javascript"></script>
    {{-- <script>
        function changeMode(){
            // alert('value');
        }
    </script> --}}
@endsection
