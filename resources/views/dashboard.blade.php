@extends('layouts.master')

@section('content')

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{$total_users}}</h3>
                 
                  <p>Total Users</p>
                </div>
                <div class="icon">
                  <i class="fas fa-users"></i>
                </div>
                <a href="{{route('user.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>{{$total_products}}</h3>
  
                  <p>Total Products</p>
                </div>
                <div class="icon">
                  <i class="fas fa-list-alt"></i>
                </div>
                <a href="{{route('products.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>{{$total_stocks_in}}</h3>
            
                  <p>Total Stocks In</p>
                </div>
                <div class="icon">
                  <i class="fas fa-cart-plus"></i>
                </div>
                <a href="{{route('stockHistory')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>{{$total_return_product}}</h3>
  
                  <p>Total Return Products</p>
                </div>
                <div class="icon">
                  <i class="fas fa-list-alt"></i>
                </div>
                <a href="{{route('returnProductHistory')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
          <div class="card card-primary card-outline">
            <div class="card-body">
                <table class="table table-bordered table-hover table-sm" style="width:100%">
                  <thead>
                      <tr>
                          <th>#Sn</th>
                          <th class="text-center">Image</th>
                          <th class="text-center">Name</th>
                          <th class="text-center">SKU</th>
                          <th class="text-center">Category</th>
                          <th class="text-center">Brand</th>
                          <th class="text-center">Action</th>
                      </tr>
                  </thead>
                  <tbody>
      
                    @if ($recent_products)
                    @foreach($recent_products as $key=>$product)
      
                        <tr> 
                        <td>{{++$key}}</td>
                        <td class="text-center"><img height="60" width="60" src="{{ asset('storage/product_images/'. $product->image)}}" alt=""></td>
                        <td class="text-center">{{$product->name ?? ''}}</td>
                        <td class="text-center">{{$product->sku ?? ''}}</td>
                        <td class="text-center">{{$product->category->name ?? ''}}</td>
                        <td class="text-center">{{$product->brand->name ?? ''}}</td>
                        <td class="text-center">
                          <a href="{{ route('products.show', $product->id)}}" class="btn btn-info btn-sm"><i class="fa fa-desktop"></i></a>
                          <a href="{{ route('products.edit', $product->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                        
                          <a href="javascript:;" class="btn btn-sm btn-warning delete_btn_cls" data-form-id="product-delete-{{$product->id}}">
                            <i class="fas fa-trash-alt"></i></a>
      
                            <form action="{{route('products.destroy', $product->id)}}" id="product-delete-{{$product->id}}" method="POST">
                            @csrf
                            @method('DELETE')
                            </form>
      
                        </td>
                        </tr>
                    @endforeach
                @endif
          
                 
                  </tbody>
      
              </table>
      
                
      
      
            </div>
          </div>
    </div>
</section>

  @endsection