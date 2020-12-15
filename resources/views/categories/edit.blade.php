@extends('layouts.app')

@section('title')
    Edit Category
@endsection

@section('content')

<h3 class="mt-3">Edit Category</h3>
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
                                    @foreach($errors->all() as $error)
                                        <li>
                                            {{ $error }}
                                        </li>
                                    @endforeach
                                </ul>
                                <button type="button" class="close" style="color: black; outline: none"
                                    data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
                <form method="post"
                    action="{{ action('CategoryController@categoryUpdate',$category->id) }}">
                    @csrf
                    <div class="form-row">
                        <div class="col-sm-6 mx-auto">
                            <div>
                                <label for="parent_category">
                                    Parent Category
                                </label>
                                <select class="form-control select2" id="parent_category" name="parent_category">


                                        @foreach($categories as $category1)
                                        <option value="" selected>--Select Parent Category--</option>
                                            <option value="{{ $category1->id }}" >
                                                {{ $category1->name }}
                                            </option>
                                        @endforeach

                                        @if($category->parent_id)
                                    <option value="{{ $category->parent->id }}" selected >
                                                {{ $category->parent->name }}
                                            </option>

                                    @endif


                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row ">
                        <div class="col-sm-6 mx-auto">
                            <div class="form-group  invalid">
                                <label for="category_name">
                                    Category Name
                                    <sup class="text-danger">
                                        <strong>*</strong>
                                    </sup>
                                </label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Please Enter Name"
                                    name="name" value="{{ $category->name }}" required>
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
                        <div class="col-sm-6">
                            <button class="btn btn-primary mt-2 float-right">Submit</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
