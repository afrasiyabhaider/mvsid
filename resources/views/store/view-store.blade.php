@extends('layouts.app')

@section('title')
    Stores
@endsection

@section('content')

<h3 class="mt-3">Stores</h3>

<div class="row layout-top-spacing" id="cancel-row">


    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

        <div class="widget-content widget-content-area br-6">
            <div class="table-responsive mb-4 mt-4">
                <table id="store_table" class="table table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Store Name</th>
                            <th>Contact</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>

{{-- <div class="card-body">

    <div class="table-responsive">
        <table id="category_table" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Name</th>
                <th>Parent Category</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div> --}}

@endsection
@section('scripts')
<script>
    $('#store_table').DataTable({
    processing: true,
    serverSide: true,
    url: '/view-employee',
    pageLength: 50, //default
    lengthMenu: [
        [50, 100, 300, 500, 1000, -1],
        [50, 100, 300, 500, 1000, 'All'],
    ],
    columns: [
            { data: 'store_name', name: 'store_name' }, //same name as db
            { data: 'contact', name: 'contact'},
            { data: 'address', name: 'address'},
            { data: 'actions', name: 'actions',orderable:false, searchable:false }, // name written in controller
        ],
    });
</script>
@endsection
