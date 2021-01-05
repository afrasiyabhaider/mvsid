
<script src="{{asset('dashboard_assets/js/libs/jquery-3.1.1.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
<script src="{{asset('dashboard_assets/js/app.js')}}"></script>
<script src="{{asset('dashboard_assets/js/popper.min.js')}}"></script>
<script src="{{asset('dashboard_assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('dashboard_assets/js/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('dashboard_assets/js/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('dashboard_assets/plugins/font-icons/feather/feather.min.js')}}"></script>
{{-- <script src="https://unpkg.com/feather-icons"></script> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script> --}}
<script src="{{asset('dashboard_assets/plugins/font-icons/fontawesome/js/all.min.js')}}"></script>




{{-- <script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script> --}}
<script src="{{asset('dashboard_assets/plugins/table/datatable/datatables.js')}}"></script>
<!-- NOTE TO Use Copy CSV Excel PDF Print Options You Must Include These Files  -->
<script src="{{asset('dashboard_assets/plugins/table/datatable/button-ext/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('dashboard_assets/plugins/table/datatable/button-ext/jszip.min.js')}}"></script>
<script src="{{asset('dashboard_assets/plugins/table/datatable/button-ext/buttons.html5.min.js')}}"></script>
<script src="{{asset('dashboard_assets/plugins/table/datatable/button-ext/buttons.print.min.js')}}"></script>
<script>
    $(document).ready(function() {
        App.init();
    });
</script>
<script src="{{asset('dashboard_assets/js/scrollspyNav.js')}}"></script>
<script src="{{asset('/dashboard_assets/plugins/flatpickr/flatpickr.js')}}"></script>

<script src="{{asset('dashboard_assets/plugins/select2/select2.min.js')}}"></script>

<script src="{{asset('dashboard_assets/plugins/file-upload/file-upload-with-preview.min.js')}}"></script>


<script src="{{asset('dashboard_assets/plugins/blockui/jquery.blockUI.min.js
')}}"></script>



@include('sweetalert::alert')
<script src="{{asset('dashboard_assets/js/sweetalert2.min.js')}}"></script>
<script src="{{asset('dashboard_assets/plugins/jquery-step/jquery.steps.min.js')}}"></script>
<script src="{{asset('dashboard_assets/plugins/jquery-step/custom-jquery.steps.js')}}"></script>

<script src="{{asset('dashboard_assets/js/custom.js')}}"></script>

@yield('scripts')






