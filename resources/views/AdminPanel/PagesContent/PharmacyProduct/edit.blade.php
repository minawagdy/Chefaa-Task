@extends('AdminPanel.layouts.main')
@section('content')


    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('pharmacyProduct.index')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('pharmacyProduct.index')}}">Pharmacy Products</a></li>
                        <li class="breadcrumb-item active">{{isset($pharmacyProduct)?'Edit / '.$pharmacyProduct->pharmacy->name .' - '. $pharmacyProduct->product->title:'ADD'}}</li>
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
                        <form  action="{{(isset($pharmacyProduct))?route('pharmacyProduct.update',$pharmacyProduct):route('pharmacyProduct.store')}}" method="post" enctype="multipart/form-data">
                            @include('AdminPanel.layouts.messages')
                            @csrf
                            {{isset($pharmacyProduct)?method_field('PUT'):''}}

                            <div class="card-body">
                                 <div class="form-group">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="name">
                                        Pharmacy
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <select  id="mySelect" name="pharmacy_id" class="form-control col-md-12 col-xs-12" required>

                                            @foreach($pharmacy as $pharmacies)
                                                <option value="{{$pharmacies->id}}"
                                                        @if(isset($pharmacyProduct->pharmacies->id)&& $pharmacyProduct->pharmacies->id==$pharmacies->id)selected @endif>{{$pharmacies->name}}
                                                    <br>{{$pharmacies->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="name">
                                        Product
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <select id="mySelect2" name="product_id" class="form-control col-md-12 col-xs-12" required>


                                            @foreach($product as $products)
                                                <option value="{{$products->id}}"
                                                        @if(isset($pharmacyProduct->products->id)&& $pharmacyProduct->products->id==$products->id)selected @endif>{{$products->title}}
                                                    <br>{{$products->title}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="price">price</label>
                                    <input type="number" name="price" class="form-control"
                                           placeholder="Enter Price" value="@if(old('price')){{old('price')}}@elseif(isset($pharmacyProduct->price)){{$pharmacyProduct->price}}@endif" min="0" required>
                                </div>

                                 <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" name="quantity" class="form-control"
                                           placeholder="Enter Quantity" value="@if(old('quantity')){{old('quantity')}}@elseif(isset($pharmacyProduct->quantity)){{$pharmacyProduct->quantity}}@endif" min="0" required>
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Save Info</button>
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

    <style type="text/css">
        .select2-container .select2-selection--single {
            height: auto!important;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $('#mySelect2').select2({
  selectOnClose: true
});
    </script>    
 <script type="text/javascript">
        $('#mySelect').select2({
  selectOnClose: true
});
    </script> 

@endsection
