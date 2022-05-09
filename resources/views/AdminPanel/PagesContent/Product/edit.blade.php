@extends('AdminPanel.layouts.main')
@section('content')


    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('product.index')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('product.index')}}">Product</a></li>
                        <li class="breadcrumb-item active">{{isset($product)?'Edit / '.$product->title :'ADD'}}</li>
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
                        <form  action="{{(isset($product))?route('product.update',$product):route('product.store')}}" method="post" enctype="multipart/form-data">
                            @include('AdminPanel.layouts.messages')
                            @csrf
                            {{isset($product)?method_field('PUT'):''}}

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title_en">Title</label>
                                    <input type="text" name="title" class="form-control"
                                           placeholder="Enter Title" value="@if(old('title')){{old('title')}}@elseif(isset($product->title)){{$product->title}}@endif" required>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" class="form-control"
                                           placeholder="Enter Description"  required>@if(old('description')){{old('description')}}@elseif(isset($product->description)){{$product->description}}@endif</textarea> 
                                </div>
                                
                              
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" class="form-control" name="image" @if(!isset($product))required @endif>
                                    <br>
                                    @if(isset($product->image))
                                        <img src="{{url('images/product/'.$product->image)}}" width="250" height="250">
                                    @endif
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
