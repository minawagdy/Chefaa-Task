@extends('AdminPanel.layouts.main')
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('pharmacyProduct.index')}}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('pharmacyProduct.index')}}">Pharmacy Product</a></li>
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
                <a class="btn btn-warning" href="{{route('pharmacyProduct.create')}}">Create New Pharmacy Product</a>
            </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @if(count($pharmacyProduct) > 0)
                <table id="pharmacyProductTable"  class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Pharmacy</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Control</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pharmacyProduct as $row)
                        <tr>
                            <td>{{$row->id}}</td>
                            <td width="150">{{$row->pharmacy->name}}</td>
                            
                            <td width="150">{{$row->product->title}}</td>

                            <td width="150">{{$row->price}}</td>

                            <td colspan="1">{{$row->quantity}}</td>
                            <td>
                                <a class="btn btn-dark" href="{{route('pharmacyProduct.edit',$row)}}">Edit</a>
                                <form action="{{route("pharmacyProduct.destroy", $row)}}" method="post"
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
                        <th>Pharmacy</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Control</th>
                    </tr>
                    </tfoot>
                </table>
                <div class="pagination">

                    @if (isset($pharmacyProduct) && $pharmacyProduct->lastPage() > 1)
                        <ul class="pagination">
                        @php
                            $interval = isset($interval) ? abs(intval($interval)) : 3 ;
                            $from = $pharmacyProduct->currentPage() - $interval;
                            if($from < 1){
                              $from = 1;
                            }

                            $to = $pharmacyProduct->currentPage() + $interval;
                            if($to > $pharmacyProduct->lastPage()){
                              $to = $pharmacyProduct->lastPage();
                            }
                        @endphp
                        <!-- first/previous -->
                            @if($pharmacyProduct->currentPage() > 1)
                                <li>
                                    <a href="{{ $pharmacyProduct->url(1)."&name=".app('request')->input('name')}}" aria-label="First">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ $pharmacyProduct->url($pharmacyProduct->currentPage() - 1)."&name=".app('request')->input('name') }}" aria-label="Previous">
                                        <span aria-hidden="true">&lsaquo;</span>
                                    </a>
                                </li>
                            @endif
                        <!-- links -->
                            @for($i = $from; $i <= $to; $i++)
                                @php
                                    $isCurrentPage = $pharmacyProduct->currentPage() == $i;
                                @endphp
                                <li class="{{ $isCurrentPage ? 'active' : '' }}" style="padding: 5px">
                                    <a href="{{ !$isCurrentPage ? $pharmacyProduct->url($i)."&name=".app('request')->input('name') : '' }}">
                                        {{ $i }}
                                    </a>
                                </li>
                            @endfor
                        <!-- next/last -->
                            @if($pharmacyProduct->currentPage() < $pharmacyProduct->lastPage())
                                <li>
                                    <a href="{{ $pharmacyProduct->url($pharmacyProduct->currentPage() + 1)."&name=".app('request')->input('name') }}" aria-label="Next">
                                        <span aria-hidden="true">&rsaquo;</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ $pharmacyProduct->url($pharmacyProduct->lastpage())."&name=".app('request')->input('name') }}" aria-label="Last">
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
