@extends('AdminPanel.layouts.main')
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('product.index')}}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('product.index')}}">Product</a></li>
                    </ol>
                </div>
                <div class="col-sm-6">

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    @include('AdminPanel.layouts.messages')
    <div class="card">
        <div class="card-body">
            <h3 class="card-title float-right">
                <a class="btn btn-warning" href="{{route('product.create')}}">Create New Product</a>
            </h3>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
            @if(count($product) > 0)
                <table id="areasTable"  class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Control</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($product as $row)
                        <tr>
                            <td>{{$row->id}}</td>
                            <td>{{$row->title}}</td>
                            <td width="48%">{{$row->description}}</td>
                            <td><a href="{{url('images/product/'.$row->image)}}" target="_blank">
                                    <img src="{{url('images/product/'.$row->image)}}" width="100" height="100">
                                </a></td>
                          
                    <td>
                    <a class="btn btn-dark" href="{{route('product.edit',$row)}}">Edit</a>
                    <form action="{{route("product.destroy", $row)}}" method="post"
                          style="display:inline;">
                        @csrf
                        @method('delete')
                        <button type="button" id="btnDelete" class="btn btn-danger btn-delete">Delete
                        </button>
                    </form>
                    </td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Control</th>
                    </tr>
                    </tfoot>
                    </table>
                    <div class="pagination">

                    @if (isset($product) && $product->lastPage() > 1)
                    <ul class="pagination">
                    @php
                    $interval = isset($interval) ? abs(intval($interval)) : 3 ;
                    $from = $product->currentPage() - $interval;
                    if($from < 1){
                    $from = 1;
                    }

                    $to = $product->currentPage() + $interval;
                    if($to > $product->lastPage()){
                    $to = $product->lastPage();
                    }
                    @endphp
                    <!-- first/previous -->
                    @if($product->currentPage() > 1)
                    <li>
                        <a href="{{ $product->url(1)."&name=".app('request')->input('name')}}" aria-label="First">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ $product->url($product->currentPage() - 1)."&name=".app('request')->input('name') }}" aria-label="Previous">
                            <span aria-hidden="true">&lsaquo;</span>
                        </a>
                    </li>
                    @endif
                    <!-- links -->
                    @for($i = $from; $i <= $to; $i++)
                    @php
                        $isCurrentPage = $product->currentPage() == $i;
                    @endphp
                    <li class="{{ $isCurrentPage ? 'active' : '' }}" style="padding: 5px">
                        <a href="{{ !$isCurrentPage ? $product->url($i)."&name=".app('request')->input('name') : '' }}">
                            {{ $i }}
                        </a>
                    </li>
                    @endfor
                    <!-- next/last -->
                    @if($product->currentPage() < $product->lastPage())
                    <li>
                        <a href="{{ $product->url($product->currentPage() + 1)."&name=".app('request')->input('name') }}" aria-label="Next">
                            <span aria-hidden="true">&rsaquo;</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ $product->url($product->lastpage())."&name=".app('request')->input('name') }}" aria-label="Last">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                    @endif
                    </ul>
                    @endif
                    </div>

                    @else
                    <h1 class="text-center">NO DATA</h1>
                    @endif
                    </div>
                    <!-- /.card-body -->
                    </div>
                    @endsection
