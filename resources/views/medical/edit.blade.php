@extends('layouts.app')
@section('content')
@include('components.menu')
<div class="bg-light py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-0"><a href="{{ route('web.index') }}">Home</a> <span class="mx-2 mb-0">/</span>
                <strong class="text-black">Update</strong> <strong class="text-black"> <span class="mx-2 mb-0">/</span>
                    {{ $product->name }}</strong></div>
        </div>
    </div>
</div>
<div class="container" style="padding-top: 71px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="h3 mb-3 text-black">{{ __('Update medicel') }}</h2>

            <div class="p-3 p-lg-5 border">
                @if(Session::has('message'))
                <div class="alert alert-success">
                    {{ Session::get('message') }}
                </div>
                @endif
                @foreach($errors->all() as $error)
                <div class="alert alert-danger ">
                    {{ $error }}
                </div>
                @endforeach

                <form method="POST" action="{{ route('web.medicel.update',$product->id) }}"
                    enctype="multipart/form-data">
                    {{method_field('PUT')}}
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="email" class="col-md-4 col-form-label text-md-left">{{ __('Name') }}</label>
                            <input id="name" type="text" name="name" class="form-control" value="{{ $product->name }}"
                                required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-left">{{ __('Description') }}</label>
                            <input id="description" type="text" class="form-control" name="description"
                                value="{{ $product->description }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="image" class="col-md-4 col-form-label text-md-left">{{ __('Image') }}</label>
                            <input id="image" type="file" class="form-control" name="image">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">{{ __('Update') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('components.footer')
@endsection
