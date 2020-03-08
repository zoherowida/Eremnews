@extends('layouts.app')
@section('content')
@include('components.menu')
<div class="bg-light py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-0"><a href="{{ route('web.index') }}">Home</a> <span class="mx-2 mb-0">/</span>
                <strong class="text-black">My medicel</strong></div>
        </div>
    </div>
</div>
<div class="site-section">
    <div class="container">
        <div class="row mb-5">
            <table id="ProductTable" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th data-field="image">Image</th>
                        <th data-field="name">Product</th>
                        <th data-field="description">Description</th>
                        <th data-field="action">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@include('components.footer')
@endsection
@section('js')
<script src="https://unpkg.com/bootstrap-table@1.14.2/dist/bootstrap-table.min.js"></script>

<script type="text/javascript">
    $(function () {
        "use strict";

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {},

        });

        $('#ProductTable').bootstrapTable({
            pagination: true,
            sidePagination: 'server',
            searchTimeOut: 500,
            showRefresh: false,
            url: '{{ route('web.allProduct.ajax') }}',
            columns: [
                { 'field': 'image' },
                { 'field': 'name' },
                { 'field': 'description' },
                { 'field': 'action' },
            ]

        });


    });
</script>
@endsection
