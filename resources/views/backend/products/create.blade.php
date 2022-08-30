@extends('backend.layouts.app')
@section('title', 'Add New Product')
@section('products', 'mm-active')
@section('products_expanded', 'mm-show')
@section('create_product', 'mm-active')
@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-keypad icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>
                    Add New Product
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <form action="{{ route('admin.products.store') }}" enctype="multipart/form-data" method="post" id="create">
            @include('backend.layouts.flash')
            @csrf
            <div class="row">
                <div class="col-md-9 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Edit Title</label>
                                <input type="text" class="form-control" name="name" id="title"
                                    aria-describedby="helpId" placeholder="Title">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" placeholder="Product Description" cols="30"
                                    rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3 products">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                        aria-orientation="vertical">
                                        <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill"
                                            href="#v-pills-general" role="tab" aria-controls="v-pills-home"
                                            aria-selected="true"><i class="pe-7s-tools"></i>&nbsp;General</a>
                                        <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill"
                                            href="#v-pills-inventory" role="tab" aria-controls="v-pills-profile"
                                            aria-selected="false"><i class="pe-7s-server"></i>&nbsp; Inventory</a>
                                        <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill"
                                            href="#v-pills-pepration-time" role="tab" aria-controls="v-pills-messages"
                                            aria-selected="false"><i class="pe-7s-tools"></i>&nbsp; Preparation Time</a>
                                        <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill"
                                            href="#v-pills-attribute" role="tab" aria-controls="v-pills-settings"
                                            aria-selected="false"><i class="pe-7s-display2"></i>&nbsp; Attribute</a>
                                        <a class="nav-link" id="v-pills-bulks-tab" data-toggle="pill" href="#v-pills-bulks"
                                            role="tab" aria-controls="v-pills-settings" aria-selected="false"><i
                                                class="pe-7s-display2"></i>&nbsp; Bulks</a>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        {{-- General --}}
                                        <div class="tab-pane fade show active" id="v-pills-general" role="tabpanel"
                                            aria-labelledby="v-pills-home-tab">
                                            <div class="form-group form-inline">
                                                <label for="price">Regular price (ks)</label>
                                                <input type="text" class="form-control form-control-sm" name="price"
                                                    id="price" aria-describedby="helpId">
                                            </div>
                                            <div class="form-group form-inline">
                                                <label for="sale-price">Sell price (ks)</label>
                                                <input type="text" class="form-control form-control-sm float-right"
                                                    name="sale_price" id="sale-price" aria-describedby="helpId">&nbsp;
                                                <a href="#" id="schedule">Schedule</a>
                                            </div>
                                            <div class="form-group form-inline schedule_time">
                                                <label></label>
                                                <input type="text" class="form-control form-control-sm float-right"
                                                        name="start_date" aria-describedby="helpId" placeholder="From ... YYYY/MM/DD">&nbsp;
                                                        <a href="#" id="cancel">Cancel</a>
                                                <label></label>
                                                <input type="text" class="form-control form-control-sm float-right mt-2"
                                                    name="end_date" aria-describedby="helpId" placeholder="To ... YYYY/MM/DD">
                                            </div>
                                            <hr>
                                            <div class="form-group form-inline">
                                                <label for="barcode">Barcode</label>
                                                <input type="text" class="form-control form-control-sm float-right"
                                                    name="barcode" id="barcode" aria-describedby="helpId">
                                            </div>
                                        </div>
                                        {{-- Inventory --}}
                                        <div class="tab-pane fade" id="v-pills-inventory" role="tabpanel"
                                            aria-labelledby="v-pills-profile-tab">
                                            <div class="form-group form-inline">
                                                <label for="sku" title="Stock Keeping Unit">SKU</label>
                                                <input type="text" class="form-control form-control-sm float-right"
                                                    name="sku" id="sku" aria-describedby="helpId">
                                            </div>
                                            <div class="form-group form-inline">
                                                <label for="manage-stock">Manage stock?</label>
                                                <input type="checkbox" class="form-control-sm float-right"
                                                    name="manage_stock" id="manage-stock" aria-describedby="helpId">
                                                &nbsp; Enable stock management at product level
                                            </div>
                                            <div id="stokManageCheck">
                                                <div class="form-group form-inline">
                                                    <label for="stock-quantity">Stock quantity</label>
                                                    <input type="number" class="form-control form-control-sm float-right"
                                                        step="1" min="0" value="0"
                                                        name="stock_quantity" id="stock-quantity"
                                                        aria-describedby="helpId">
                                                </div>
                                                <div class="form-group form-inline">
                                                    <label for="backorders">Allow backorders?</label>
                                                    <select class="form-control form-control-sm float-right"
                                                        name="backorders" id="backorders" aria-describedby="helpId">
                                                        <option value="Do not allow">Do not allow</option>
                                                        <option value="Allow, but notify customer">Allow, but notify
                                                            customer</option>
                                                        <option value="Allow">Allow</option>
                                                    </select>
                                                </div>
                                                <div class="form-group form-inline">
                                                    <label for="low-stock">Low stock threshold</label>
                                                    <input type="number" step="1" min="2"
                                                        class="form-control form-control-sm float-right" name="low_stock"
                                                        id="low-stock" aria-describedby="helpId"
                                                        placeholder="Store-wide threshold (2)">
                                                </div>
                                            </div>
                                            <div class="form-group form-inline" id="stockStatus">
                                                <label for="stock-status">Stock status</label>
                                                <select class="form-control form-control-sm float-right"
                                                    name="stock_status" id="stock-status" aria-describedby="helpId">
                                                    <option value="In stock">In stock</option>
                                                    <option value="Out of stock">Out of stock</option>
                                                    <option value="On backorder">On backorder</option>
                                                </select>
                                            </div>
                                            <hr>
                                            <div class="form-group form-inline">
                                                <label for="solid_individually">Sold individually</label>
                                                <input type="checkbox" class="form-control-sm float-right"
                                                    name="solid_individually" id="solid_individually"
                                                    aria-describedby="helpId"> &nbsp;<i class="pe-7s-help1"
                                                    title="Enable this to only allow one of this item to be bought in a single order"></i>
                                            </div>
                                        </div>
                                        {{-- Preparation Time --}}
                                        <div class="tab-pane fade" id="v-pills-pepration-time" role="tabpanel"
                                            aria-labelledby="v-pills-messages-tab">
                                            <div class="form-group form-inline">
                                                <label for="preparation-disable">Disable estimate for this product</label>
                                                <input type="checkbox" class="form-control-sm float-right"
                                                    name="preparation_disable" id="preparation-disable"
                                                    aria-describedby="helpId">&nbsp;<i class="pe-7s-help1"
                                                    title="Check this if you don't want to show estimate date for this particular product"></i>
                                            </div>
                                            <hr>
                                            <div id="preparationDisable">
                                                <div class="form-group form-inline">
                                                    <label for="preparation-days">Product preparation days</label>
                                                    <input type="number" class="form-control form-control-sm"
                                                        step="1" min="1" value="1" placeholder="0"
                                                        name="preparation_days" id="preparation-days"
                                                        aria-describedby="helpId">
                                                </div>
                                                <div class="form-group form-inline">
                                                    <label for="extra-time">Extra time added to preparation time (when
                                                        product goes out of stock)</label>
                                                    <input type="number" class="form-control form-control-sm float-right"
                                                        step="1" min="1" value="1" placeholder="0"
                                                        name="extra_time" id="extra-time" aria-describedby="helpId">
                                                </div>
                                                <div class="form-group form-inline">
                                                    <label for="availability-date">Exact Product availability date</label>
                                                    <input type="date" class="form-control form-control-sm float-right"
                                                        name="availability_date" id="availability-date"
                                                        aria-describedby="helpId">
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Attribute --}}
                                        <div class="tab-pane fade" id="v-pills-attribute" role="tabpanel"
                                            aria-labelledby="v-pills-settings-tab">
                                            <div class="form-group form-inline" id="attribute">
                                                <label for="attribute">Product Attribute</label>
                                            </div>
                                            <div id="msg">
                                                <div id="accordion">
                                                    @foreach ($attributes as $attribute)
                                                        <div class="card mt-3">
                                                            <div class="card-header" id="headingOne">
                                                                <h5 class="mb-0">
                                                                    <a href="#"
                                                                        class="btn btn-link optionBtn p-0 m-0"
                                                                        data-toggle="collapse"
                                                                        data-target="#collapse`+data.msg.id+`"
                                                                        aria-expanded="true" aria-controls="collapseOne">
                                                                        {{ $attribute->name }}
                                                                    </a>
                                                                </h5>
                                                            </div>

                                                            <div id="collapse`+data.datas.id+`" class="collapse show"
                                                                aria-labelledby="headingOne" data-parent="#accordion">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            @foreach ($datas as $key => $data)
                                                                                @if ($attribute->name == $data->name)
                                                                                    <input type="checkbox"
                                                                                        id="{{ $data->terms_name }}"
                                                                                        name="attribute[{{ $key }}]"
                                                                                        value="{{ $data->id }}" />
                                                                                    <label
                                                                                        for="{{ $data->terms_name }}">{{ $data->terms_name }}</label>
                                                                                    &nbsp;
                                                                                @endif
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Bulks Discount --}}
                                        <div class="tab-pane fade" id="v-pills-bulks" role="tabpanel"
                                            aria-labelledby="v-pills-bulks-tab">
                                            <div class="form-group form-inline">
                                                <label for="bulks-enable">Bulk Discount enabled</label>
                                                <input type="checkbox" class="form-control-sm float-right"
                                                    name="bulks_enable" id="bulks-enable" aria-describedby="helpId">
                                            </div>
                                            <div id="bulk-disable">
                                                <div class="form-group form-inline">
                                                    <label for="bulks-description">Bulk discount special offer text in
                                                        product description</label>
                                                    <textarea class="form-control form-control-sm float-right" name="bulks_description" id="bulks-description"
                                                        aria-describedby="helpId"></textarea>
                                                </div>
                                                <hr>
                                                <div class="default-bulk">
                                                    <div class="form-group form-inline">
                                                        <label for="min-quantity">Quantity (min.)</label>
                                                        <input type="number" class="form-control form-control-sm"
                                                            step="1" min="1" placeholder="0"
                                                            name="min_quantity[0][number]" id="min-quantity"
                                                            aria-describedby="helpId"> &nbsp;<i class="pe-7s-help1"
                                                            title="Enter the minimal quantity for which the discount applies."></i>
                                                    </div>
                                                    <div class="form-group form-inline">
                                                        <label for="discount">Discount (Ks)</label>
                                                        <input type="number" class="form-control form-control-sm"
                                                            step="1" min="1" placeholder="0"
                                                            name="discount[0][amount]" id="discount"
                                                            aria-describedby="helpId"> &nbsp;<i class="pe-7s-help1"
                                                            title="Enter the flat discount in Ks."></i>
                                                    </div>
                                                    <hr>
                                                </div>
                                                <div class="new-bulk-area"></div>
                                                <button type="submit"
                                                    class="btn btn-outline-primary add-new-discount">Add Discount</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <img id="show_image" width="190" class="img img-thumbnail"><br>
                                <label for="image" class="btn btn-sm btn-outline-primary"
                                    style="display: inline-block; width: 188px;">Add Image</label>
                                <input type="file" class="form-control d-none" name="product_image" id="image">
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-body">
                            <h5>
                                Category
                            </h5>
                            <div class="row">
                                <div class="col-12">
                                    @foreach ($categories as $key => $category)
                                        @if ($attribute->name == $data->name)
                                            <input type="checkbox" id="{{ $category->cat_name }}"
                                                name="category[{{ $key }}]" value="{{ $category->id }}" />
                                            <label for="{{ $category->cat_name }}">{{ $category->cat_name }}</label>
                                            &nbsp;
                                        @endif
                                        <br>
                                    @endforeach
                                </div>
                            </div>
                            <hr>
                            <div class="w-100 d-flex justify-content-between">
                                <button class="btn btn-outline-secondary btn-back w-50 m-1">Cancel</button>
                                <input type="submit" class="btn btn-primary w-100 m-1" value="Publish">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#stokManageCheck").hide();
            $("#manage-stock").change(function() {
                if ($(this).is(":checked")) {
                    $("#stokManageCheck").show(100);
                    $("#stockStatus").hide(100);
                } else {
                    $("#stokManageCheck").hide(100);
                    $("#stockStatus").show(100);
                }
            });

            $("#preparation-disable").change(function() {
                if ($(this).is(":checked")) {
                    $("#preparationDisable").hide(100);
                } else {
                    $("#preparationDisable").show(100);
                }
            });

            // Schedule Time
            $(".schedule_time").hide();
            $("#schedule").click(function(e){
                e.preventDefault();
                $(".schedule_time").show();
            });
            $("#cancel").click(function(e){
                e.preventDefault();
                $(".schedule_time").hide();
                $(".schedule_time input").val("NULL");
            });

            //Bulk Discount
            $("#bulk-disable").hide();
            $("#bulks-enable").change(function() {
                if ($(this).is(":checked")) {
                    $("#bulk-disable").show(100);
                } else {
                    $("#bulk-disable").hide(100);
                }
            });
            var i = 0;
            $(".add-new-discount").click(function(e) {
                e.preventDefault();
                ++i;
                $(".new-bulk-area").append(
                    `<div class="remove-bulk">
                                            <div class="form-group form-inline">
                                                <label for="min-quantity">Quantity (min.)</label>
                                                <input type="number"
                                                class="form-control form-control-sm" step="1" min="1" placeholder="0" name="min_quantity[` +
                    i +
                    `][number]" id="min-quantity" aria-describedby="helpId" > &nbsp;<i class="pe-7s-help1" title="Enter the minimal quantity for which the discount applies."></i>
                                            </div>
                                            <div class="form-group form-inline">
                                                <label for="discount">Discount (Ks)</label>
                                                <input type="number"
                                                class="form-control form-control-sm" step="1" min="1" placeholder="0" name="discount[` +
                    i + `][amount]" id="discount" aria-describedby="helpId" > &nbsp;<i class="pe-7s-help1" title="Enter the flat discount in Ks."></i>
                                            </div>
                                            <button type="submit" class="btn btn-outline-danger remove-bulk">Remove Discount</button>
                                            <hr>
                                        </div>`);
            });
            $(document).on('click', '.remove-bulk', function(e) {
                e.preventDefault();
                $(this).parents('.remove-bulk').remove();
            });
            $('.optionBtn').click(function(e) {
                e.preventDefault();
            });
        })
    </script>
@endsection