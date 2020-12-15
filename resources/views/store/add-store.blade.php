@extends('layouts.app')

@section('title')
    Add Store
@endsection

@section('content')

<h3 class="mt-3">Add Store</h3>
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
                <form method="post" action="{{ url('/add-store') }}">
                    @csrf
                    <div class="form-row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="parent_category">
                                  Name
                                  <sup class="text-danger">
                                    <strong>*</strong>
                                 </sup>
                                </label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Please Enter Name" name="name" value="{{old('name')}}" required>
                                @error('name')
                                    <p class="error-field-msg">
                                        <strong class="text-danger">
                                            {{ $message }}
                                        </strong>
                                    </p>
                                @enderror
                            </div>
                        </div>



                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="phone_number">
                                 Phone Number
                                     <sup class="text-danger">
                                        <strong>*</strong>
                                     </sup>
                                 </label>
                                <input type="text" class="form-control @error('phone_number') is-invalid @enderror " id="phone_number" placeholder="Please Enter Phone Number" name="phone_number" value="{{old('phone_number')}}" required>
                                @error('phone_number')
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
                            <div class="form-group">
                                <label for="address">
                                  Address
                                  <sup class="text-danger">
                                    <strong>*</strong>
                                 </sup>
                                </label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror " id="address" placeholder="Please Enter Address" name="address" value="{{old('address')}}" required>
                                @error('address')
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
