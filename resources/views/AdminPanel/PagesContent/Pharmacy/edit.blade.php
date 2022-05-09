@extends('AdminPanel.layouts.main')
@section('content')


    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('pharmacy.index')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('pharmacy.index')}}">Pharmacy</a></li>
                        <li class="breadcrumb-item active">{{isset($pharmacy)?'Edit / '.$pharmacy->name :'ADD'}}</li>
                    </ol>
                </div>
                <div class="col-sm-6">

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">

                        <!-- /.card-header -->
                        <!-- form start -->
                        <form  action="{{(isset($pharmacy))?route('pharmacy.update',$pharmacy):route('pharmacy.store')}}" method="post" enctype="multipart/form-data">
                            @include('AdminPanel.layouts.messages')
                            @csrf
                            {{isset($pharmacy)?method_field('PUT'):''}}

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title_en">Name</label>
                                    <input type="text" name="name" class="form-control"
                                           placeholder="Enter  Name" value="@if(old('name')){{old('name')}}@elseif(isset($pharmacy->name)){{$pharmacy->name}}@endif" required>
                                </div>

                                <div class="form-group">
                                    <label for="title_ar">Address</label>
                                    <input type="text" name="address" class="form-control"
                                           placeholder="Enter Address" value="@if(old('address')){{old('address')}}@elseif(isset($pharmacy->address)){{$pharmacy->address}}@endif" required>
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
