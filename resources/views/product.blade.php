@extends('layouts.app')
@section('content')
@include('components.menu')
<div class="bg-light py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-0"><a href="{{ route('web.index') }}">Home</a> <span class="mx-2 mb-0">/</span>
                <strong class="text-black">Product</strong></div>
        </div>
    </div>
</div>
<div class="container">
    @if($product->count() == 0 )
    <div class="title-section text-center col-12" style="padding-top:100px">
        <h4>No Products</h4>
    </div>

    @endif

    <div class="row" id="product">
        @foreach($product as $key=>$value)
        <div class="col-sm-6 col-lg-4 text-center item mb-4">
            <a href="{{route('web.singleProduct',$value->id)}}"> <img src="{{URL::to('storage/'.$value->image)}}"
                    alt="Image"></a>
            <h3 class="text-dark"><a href="{{route('web.singleProduct',$value->id)}}">{{$value->name}}</a></h3>
        </div>
        @endforeach
    </div>

    <div class="row mt-5">
        <div class="col-md-12 text-center">
            {!! $product->render() !!}
        </div>
    </div>
</div>
@include('components.footer')
@endsection
