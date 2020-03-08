@extends('layouts.app')
@section('content')
@include('components.menu')

<div class="bg-light py-3">

    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-0"><a href="{{ route('web.index') }}">Home</a> <span class="mx-2 mb-0">/</span> <a
                    href="{{ route('web.allproduct') }}">Product</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">
                        {{$id->name}}
                    </strong></div>
        </div>
    </div>
</div>
<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-md-5 mr-auto">
                <div class="border text-center">
                    <img src="{{URL::to('storage/'.$id->image)}}" alt="Image" class="img-fluid p-5">
                </div>
            </div>
            <div class="col-md-6">
                <h2 class="text-black">{{$id->name}}</h2>
                <p>{{$id->description}}</p>
            </div>
        </div>
    </div>
</div>
@include('components.footer')

@endsection
