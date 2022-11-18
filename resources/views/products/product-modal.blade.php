@push('css')
    {{-- <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" /> --}}
@endpush
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="productForm" action="{{ route('products.store') }}" name="productForm" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" id="product_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                            <label id="name-error" for="" class="error"></label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="price" class="col-sm-2 control-label">Price</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="price" name="price" placeholder="Enter Price" value="" maxlength="50" required="">
                            <label id="price-error" for="" class="error"></label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Discount</label>
                        <div class="col-sm-12">
                            <input id="discount" name="discount" required="" placeholder="Enter Discount" class="form-control"/>
                            <label id="discount-error" for="" class="error"></label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Images</label>
                        <div class="col-sm-12">
                            <input type="file" id="image" name="image" required placeholder="Upload Product Image" class="form-control"/>
                            <label id="image-error" for="" class="error"></label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-12">
                            <textarea id="description" name="description" required="" placeholder="Enter Description" class="form-control"></textarea>
                            <label id="desc-error" for="" class="error"></label>
                        </div>
                    </div>

                    <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                    </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
{{-- <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script> --}}

<script type="text/javascript">
    $(function () {
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
        let formData = new FormData($('#productForm')[0]);
        $.ajax({
            url: "{{ route('products.store') }}",
            type: "POST",
            dataType: 'json',
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                $('#productForm').trigger("reset");
                $('#ajaxModel').modal('hide');
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
                $('#saveBtn').html('Save Changes');
            }
        });
    });


    $('body').on('click', '.deleteProduct', function () {

        var product_id = $(this).data("id");
        confirm("Are You sure want to delete !");

        $.ajax({
            type: "DELETE",
            url: "{{ route('products.store') }}"+'/'+product_id,
            success: function (data) {
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    });
</script>
@endpush
