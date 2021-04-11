@extends('layouts.master')
@section('content')

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Products Page</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Products List</li>
          </ol>
        </div>
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
<div class="row">
  <div class="col-lg-6">
    <div class="card card-primary card-outline">
      <div class="card-header"  style="justify-content:space-between; display:flex">
        <h5 class="m-0">Products List </h5><a href="{{route('products.create')}}" class="btn btn-primary btn-sm "><i class="fa fa-plus"></i></a>
      </div>
      @include('flash::message')
      <div class="card-body">

          <table id="example" class="table table-bordered table-hover dataTable dtr-inline" style="width:100%">

              @if ($products)
              <tr>
                <td>Name</td>
                <td>{{$products->name ?? ''}}</td>
            </tr>


                <tr>
                    <td>SKU</td>
                    <td>{{$products->sku ?? ''}}</td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td>{{$products->category->name ?? ''}}</td>
                </tr>
                <tr>
                    <td>Brand</td>
                    <td>{{$products->brand->name ?? ''}}</td>
                </tr>
                <tr>
                    <td>Cost Price</td>
                    <td>{{$products->cost_price?? ''}}</td>
                </tr>
      
                <tr>
                    <td>Retail Price</td>
                    <td>{{$products->retail_price?? ''}}</td>
                </tr>

                <tr>
                    <td>Description</td>
                    <td>{{$products->description?? ''}}</td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>{{$products->status? 'Active': 'Inactive'}}</td>
                </tr>
              
          @endif
    
           
            </tbody>

        </table>

      </div>
      <div class="card-footer">
        <a class="btn btn-primary btn-sm" href="{{route('products.index')}}"> <i class="fa fa-arrow-left"></i> Back</a>
      </div>
    </div>
  </div>
  <div class="col-md-6">
      <div class="card card-primary card-outline">
        <div class="card-header"  style="justify-content:space-between; display:flex">
            <h5 class="m-0">Products Image </h5></a>
          </div>
          <div class="card-body">
            
            <img height="300" src="{{ asset('storage/product_images/'. $products->image)}}" alt="">
           
          </div>
      </div>
    <div class="card card-primary card-outline">
        <div class="card-header"  style="justify-content:space-between; display:flex">
          <h5 class="m-0">Products List </h5></a>
        </div>
        @include('flash::message')
        <div class="card-body">
  
            <table class="table table-bordered table-hover dataTable dtr-inline" style="width:100%">
                <thead>

                    <tr>
                        <td>Size Name</td>
                        <td>Location</td>
                        <td>Quantity</td>
                    </tr>

                </thead>
              <tbody>
                @if ($products->product_size_stock)
              
                @foreach ($products->product_size_stock as $p_stock)
                    <tr>
                        <td>{{ $p_stock->size->size}}</td>
                        <td>{{ $p_stock->location}}</td>
                        <td>{{ $p_stock->quantity}}</td>
                    </tr>
                @endforeach

                @endif

      
             
              </tbody>
  
          </table>
  
            
  
  
        </div>
      </div>
  </div>
  </div>

@endsection