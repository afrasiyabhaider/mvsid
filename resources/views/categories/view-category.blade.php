@extends('layouts.app')

@section('title')
    Categories
@endsection

@section('content')

<h3 class="mt-3">Add Category</h3>

<div class="row layout-top-spacing" id="cancel-row">


    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

        <div class="widget-content widget-content-area br-6">
            <div class="table-responsive mb-4 mt-4">
                <table id="category_table" class="table table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Category Name</th>
                            <th>Parent Category</th>
                            <th>Actions</th>
                            <th class="no-content"></th>
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
    $('#category_table').DataTable({
    processing: true,
    serverSide: true,
    url: '/view-employee',
    pageLength: 50, //default
    lengthMenu: [
        [50, 100, 300, 500, 1000, -1],
        [50, 100, 300, 500, 1000, 'All'],
    ],
    columns: [
            { data: 'name', name: 'name' }, //same name as db
            { data: 'parent_name', name: 'parent_name' }, //same name as db

            { data: 'actions', name: 'actions',orderable:false, searchable:false }, // name written in controller
        ],
    });
</script>
@endsection
