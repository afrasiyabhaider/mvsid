@extends('layouts.app')
@section('title')
    Add Category
@endsection
@section('content')
<h3 class="mt-3">Add Category</h3>
<div class="row ">
    <div class="col-12">
        <div class="card component-card_6">
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
                <form method="post" action="{{ url('/store-category') }}">
                    @csrf
                    <div class="form-row">
                        <div class="col-sm-6 mx-auto">
                            <div>
                                <label for="parent_category">
                                   Parent Category
                                    <small class="form-text text-muted">
                                        (Leave Parent Category empty to add a new Parent Category)
                                    </small>
                                </label>
                                <select  class="select2 form-control" id="parent_category" name="parent_category" >
                                    <option value=""  selected>--Select Parent Category--</option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}">
                                        {{$category->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="col-sm-6 mx-auto">
                            <div class="form-group invalid">
                                <label for="category_name">
                                   Category Name
                                     <sup class="text-danger">
                                        <strong>*</strong>
                                     </sup>
                                 </label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="category_name" placeholder="Please Enter Name" name="name" value="{{old('name')}}" required>
                                @error('name')
                                <p class="error-field-msg">
                                    <strong class="text-danger">
                                        {{ $message }}
                                    </strong>
                                </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-6 ">
                            <button class="btn btn-primary mt-2  float-right">Submit</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
