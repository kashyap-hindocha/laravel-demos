@extends('layouts.app')
@section('content')
<div class="card w-100">
    <div class="card-body">
        <h5 class="card-title mb-3">Manage Products</h5>
        <a class="btn btn-success mb-3" href="javascript:void(0)" id="createNewProduct"> Create New Product</a>
        <label class="error"></label>
        <table class="table table-bordered data-table border">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Discount</th>
                    {{-- <th>Image</th> --}}
                    <th>Description</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        @include('products.product-modal')
    </div>
</div>
@endsection
@push('scripts')
<script>
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('products.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'price', name: 'price'},
            {data: 'discount', name: 'discount'},
            // {data: 'image', name: 'image'},
            {data: 'description', name: 'description'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('#createNewProduct').click(function () {
        $('#saveBtn').val("create-product");
        $('#product_id').val('');
        $('#productForm').trigger("reset");
        $('#modelHeading').html("Create New Product");
        $('#ajaxModel').modal('show');
    });

    $('body').on('click', '.editProduct', function () {
        var product_id = $(this).data('id');
        $.get("{{ route('products.index') }}" +'/' + product_id +'/edit', function (data) {
            $('#modelHeading').html("Edit Product");
            $('#saveBtn').val("edit-user");
            $('#ajaxModel').modal('show');
            $('#product_id').val(data.id);
            $('#name').val(data.name);
            $('#price').val(data.price);
            $('#discount').val(data.discount);
            // $('#image').val(data.image);
            $('#description').val(data.description);
        })
    });
</script>
@endpush
