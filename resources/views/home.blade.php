@extends('layouts.app')

@section('content')
@include('components.menu')
@include('components.header')
<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="title-section text-center col-12">
                <h2 class="text-uppercase">Products</h2>
            </div>
        </div>
        @if($product->count() == 0 )
        <div class="title-section text-center col-12">
                <h4>No Products</h4>
            </div>

        @endif
        <div class="row">
            @foreach($product as $key=>$value)
            <div class="col-sm-6 col-lg-4 text-center item mb-4">
                <a href="{{route('web.singleProduct',$value->id)}}"> <img src="{{URL::to('storage/'.$value->image)}}"
                        alt="Image" style="width:270px;height:270px"></a>
                <h3 class="text-dark"><a href="{{route('web.singleProduct',$value->id)}}">{{$value->name}}</a></h3>
            </div>
            @endforeach
        </div>
        <div class="row mt-5">
            <div class="col-12 text-center">
                <a href="{{route('web.allproduct')}}" class="btn btn-primary px-4 py-3">View All Products</a>
            </div>
        </div>
    </div>
</div>

@include('components.footer')

@endsection
