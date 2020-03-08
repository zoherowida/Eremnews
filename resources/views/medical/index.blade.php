@extends('layouts.app')
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection
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
        <div>
            <table id="ProductTable" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th data-field="image">Image</th>
                        <th data-field="name">Product</th>
                        <th data-field="description">Description</th>
                        <th data-field="createdAt">Created At</th>
                        <th data-field="updated">Last Update</th>
                        <th data-field="action" style="width: 20% ;">Action</th>
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
                { 'field': 'createdAt' },
                { 'field': 'updated' },
                { 'field': 'action' },
            ]

        });
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on('click', 'a.jquery-postback', function (e) {
        e.preventDefault(); // does not go through with the link.

        var $this = $(this);

        $.post({
            type: $this.data('method'),
            url: $this.attr('href')
        }).done(function (data) {
            location.reload();
        });
    });

</script>
@endsection
