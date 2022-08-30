@extends('backend.layouts.app')
@section('title', 'Edit Product')
@section('products', 'mm-active')
@section('products_expanded', 'mm-show')
@section('all_product', 'mm-active')
@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-keypad icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>
                    Edit Product
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <form action="{{ route('admin.products.update',$edit_products->id) }}" enctype="multipart/form-data" method="post" id="create">
            @include('backend.layouts.flash')
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-9 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Add New Title</label>
                                <input type="text" class="form-control" name="name" id="title"
                                    aria-describedby="helpId" placeholder="Title" value="{{ $edit_products->name }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" placeholder="Product Description" cols="30"
                                    rows="5">{{ $edit_products->description }}</textarea>
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
                                                    id="price" aria-describedby="helpId"
                                                    value="{{ $edit_products->regular_price }}">
                                            </div>
                                            <div class="form-group form-inline">
                                                <label for="sale-price">Sell price (ks)</label>
                                                <input type="text" class="form-control form-control-sm float-right"
                                                    name="sale_price" id="sale-price" aria-describedby="helpId"
                                                    value="{{ $edit_products->sale_price }}">&nbsp;
                                                <a href="#" id="schedule">Schedule</a>
                                            </div>
                                            @if ($edit_products->start_date !== NULL)
                                            <div class="form-group form-inline schedule_time">
                                                <label></label>
                                                <input type="text" class="form-control form-control-sm float-right"
                                                        name="start_date" aria-describedby="helpId" value="{{$edit_products->start_date}}" placeholder="From ... YYYY/MM/DD">&nbsp;
                                                        <a href="#" id="cancel">Cancel</a>
                                                <label></label>
                                                <input type="text" class="form-control form-control-sm float-right mt-2"
                                                    name="end_date" value="{{$edit_products->end_date}}" aria-describedby="helpId" placeholder="To ... YYYY/MM/DD">
                                            </div>
                                            @else
                                            <div class="form-group form-inline schedule_time_two">
                                                <label></label>
                                                <input type="text" class="form-control form-control-sm float-right"
                                                        name="start_date" aria-describedby="helpId" placeholder="From ... YYYY/MM/DD">&nbsp;
                                                        <a href="#" id="cancel">Cancel</a>
                                                <label></label>
                                                <input type="text" class="form-control form-control-sm float-right mt-2"
                                                    name="end_date" aria-describedby="helpId" placeholder="To ... YYYY/MM/DD">
                                            </div>
                                            @endif
                                            <hr>
                                            <div class="form-group form-inline">
                                                <label for="barcode">Barcode</label>
                                                <input type="text" class="form-control form-control-sm float-right"
                                                    name="barcode" id="barcode" aria-describedby="helpId"
                                                    value="{{ $edit_products->barcode }}">
                                            </div>
                                        </div>
                                        {{-- Inventory --}}
                                        @foreach ($edit_inventory as $key => $inventory)
                                            <div class="tab-pane fade" id="v-pills-inventory" role="tabpanel"
                                                aria-labelledby="v-pills-profile-tab">
                                                <div class="form-group form-inline">
                                                    <label for="sku" title="Stock Keeping Unit">SKU</label>
                                                    <input type="text" class="form-control form-control-sm float-right"
                                                        name="sku" id="sku" aria-describedby="helpId"
                                                        value="{{ $inventory->sku }}">
                                                </div>
                                                <div class="form-group form-inline">
                                                    <label for="manage-stock">Manage stock?</label>
                                                    <input type="checkbox" class="form-control-sm float-right"
                                                        @if ($inventory->manage_stock != 0) checked="checked" @endif
                                                        name="manage_stock" id="manage-stock" aria-describedby="helpId">
                                                    &nbsp; Enable stock management at product level
                                                </div>
                                                <div id="stokManageCheck">
                                                    <div class="form-group form-inline">
                                                        <label for="stock-quantity">Stock quantity</label>
                                                        <input type="number"
                                                            class="form-control form-control-sm float-right"
                                                            step="1" min="0"
                                                            value="{{ $inventory->stock_quantity }}" name="stock_quantity"
                                                            id="stock-quantity" aria-describedby="helpId" placeholder="0">
                                                    </div>
                                                    <div class="form-group form-inline">
                                                        <label for="backorders">Allow backorders?</label>
                                                        <select class="form-control form-control-sm float-right"
                                                            name="backorders" id="backorders" aria-describedby="helpId">
                                                            @foreach ($back_orders as $b_orders)
                                                                <option value="{{ $b_orders->backorders_title }}" @if ($b_orders->backorders_title == $inventory->backorders)
                                                                    selected
                                                                @endif>{{$b_orders->backorders_title}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group form-inline">
                                                        <label for="low-stock">Low stock threshold</label>
                                                        <input type="number" step="1" min="2"
                                                            class="form-control form-control-sm float-right"
                                                            name="low_stock" id="low-stock" aria-describedby="helpId"
                                                            value="{{ $inventory->low_stock }}"
                                                            placeholder="Store-wide threshold (2)">
                                                    </div>
                                                </div>
                                                <div class="form-group form-inline" id="stockStatus">
                                                    <label for="stock-status">Stock status</label>
                                                    <select class="form-control form-control-sm float-right"
                                                        name="stock_status" id="stock-status" aria-describedby="helpId">

                                                        @foreach ($stock_status as $stock)
                                                            <option value="{{ $stock->stock_name }}" @if ($stock->stock_name == $inventory->stock_status)
                                                                selected
                                                            @endif>{{$stock->stock_name}}</option>
                                                        @endforeach
                                                        
                                                    </select>
                                                </div>
                                                <hr>
                                                <div class="form-group form-inline">
                                                    <label for="solid_individually">Sold individually</label>
                                                    <input type="checkbox" class="form-control-sm float-right"
                                                        @if ($inventory->solid_individually != 0)  @endif name="solid_individually"
                                                        id="solid_individually" aria-describedby="helpId"> &nbsp;<i
                                                        class="pe-7s-help1"
                                                        title="Enable this to only allow one of this item to be bought in a single order"></i>
                                                </div>
                                            </div>
                                        @endforeach
                                        {{-- Preparation Time --}}
                                        @foreach ($edit_preparation as $preparation)
                                            <div class="tab-pane fade" id="v-pills-pepration-time" role="tabpanel"
                                                aria-labelledby="v-pills-messages-tab">
                                                <div class="form-group form-inline">
                                                    <label for="preparation-disable">Disable estimate for this
                                                        product</label>
                                                    <input type="checkbox" class="form-control-sm float-right"
                                                        @if ($preparation->enable == 1) checked="checked" @endif
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
                                                        <input type="number"
                                                            class="form-control form-control-sm float-right"
                                                            step="1" min="1" value="1" placeholder="0"
                                                            name="extra_time" id="extra-time" aria-describedby="helpId">
                                                    </div>
                                                    <div class="form-group form-inline">
                                                        <label for="availability-date">Exact Product availability
                                                            date</label>
                                                        <input type="date"
                                                            class="form-control form-control-sm float-right"
                                                            name="availability_date" id="availability-date"
                                                            aria-describedby="helpId">
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
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
                                                                            @foreach ($attributes_datas as $key => $data)
                                                                                @if ($attribute->name == $data->name)
                                                                                    <input type="checkbox"
                                                                                        id="{{ $data->terms_name }}"
                                                                                        name="attribute[{{ $key }}]"
                                                                                        value="{{ $data->id }}"
                                                                                        @foreach ($edit_attribute as $check_attribute) @if ($check_attribute->terms_name == $data->terms_name)
                                                                                            checked @endif
                                                                                        @endforeach
                                                                                    />
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
                                                    name="bulks_enable" id="bulks-enable"
                                                @if ($edit_bulk !== []) @foreach ($edit_bulk as $bulk_data)
                                                @if ($bulk_data->enable == 'on') checked @endif
                                                @endforeach
                                                @endif
                                                aria-describedby="helpId">
                                            </div>
                                            <div id="bulk-disable">
                                                <div class="form-group form-inline">
                                                    <label for="bulks-description">Bulk discount special offer text in
                                                        product description</label>
                                                    <textarea class="form-control form-control-sm float-right" name="bulks_description" id="bulks-description"
                                                        aria-describedby="helpId"></textarea>
                                                </div>
                                                <hr>
                                                @if ($edit_bulk !== []) @foreach ($edit_bulk as $bulk_data)
                                                @if ($bulk_data->enable == 'on') 
                                                <div class="default-bulk">
                                                    <div class="form-group form-inline">
                                                        <label for="min-quantity">Quantity (min.)</label>
                                                        <input type="number" class="form-control form-control-sm"
                                                            value="{{$bulk_data->min_quantity}}"
                                                            step="1" min="1" placeholder="0"
                                                            name="min_quantity[0][number]" id="min-quantity"
                                                            aria-describedby="helpId"> &nbsp;<i class="pe-7s-help1"
                                                            title="Enter the minimal quantity for which the discount applies."></i>
                                                    </div>
                                                    <div class="form-group form-inline">
                                                        <label for="discount">Discount (Ks)</label>
                                                        <input type="number" class="form-control form-control-sm"
                                                            value="{{$bulk_data->discount}}"
                                                            step="1" min="1" placeholder="0"
                                                            name="discount[0][amount]" id="discount"
                                                            aria-describedby="helpId"> &nbsp;<i class="pe-7s-help1"
                                                            title="Enter the flat discount in Ks."></i>
                                                    </div>
                                                    <hr>
                                                </div>
                                                @endif
                                                @endforeach
                                                @endif
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
                                @if ($edit_products->image)
                                    <img src="{{ asset('/uploads/products') . '/' . $edit_products->image }}"
                                        width="190" class="img img-thumbnail" id="edit_image"><br>
                                @else
                                    <img id="show_image" width="190" class="img img-thumbnail"><br>
                                @endif
                                <label for="image" class="btn btn-sm btn-outline-primary"
                                    style="display: inline-block; width: 188px;">Upload Image</label>
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
                                @if ($edit_category !== [])
                                    @foreach ($all_category as $key => $category)
                                    <div class="col-12">
                                        <input type="checkbox" id="{{ $category->id }}" name="category[{{ $key }}]" value="{{ $category->id }}"
                                        @foreach ($edit_category as $check_category)
                                        @if ($category->cat_name == $check_category->cat_name)
                                            checked
                                        @endif    
                                        @endforeach
                                        />
                                        <label for="{{ $category->id }}">{{$category->cat_name}}</label> &nbsp;
                                    </div>
                                    @endforeach
                                @endif
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
            $("#manage-stock").change(function() { //Is change event!
                if ($(this).is(":checked")) {
                    $("#stokManageCheck").show(100);
                    $("#stockStatus").hide(100);
                } else {
                    $("#stokManageCheck").hide(100);
                    $("#stockStatus").show(100);
                }
            });
            if ($("#manage-stock").is(":checked")) { // Is DB checked event!
                $("#stokManageCheck").show(100);
                $("#stockStatus").hide(100);
            } else {
                $("#stokManageCheck").hide(100);
                $("#stockStatus").show(100);
            }

            $("#preparation-disable").change(function() {
                if ($("#preparation-disable").is(":checked")) {
                    $("#preparationDisable").hide(100);
                } else {
                    $("#preparationDisable").show(100);
                }
            });
            if ($("#preparation-disable").is(":checked")) {
                $("#preparationDisable").hide(100);
            } else {
                $("#preparationDisable").show(100);
            }

            // Schedule Time
            $(".schedule_time_two").hide();
            $("#schedule").click(function(e){
                e.preventDefault();
                $(".schedule_time").show();
                $(".schedule_time_two").show();
            });
            $("#cancel").click(function(e){
                e.preventDefault();
                $(".schedule_time").hide();
                $(".schedule_time_two").hide();
                $(".schedule_time input").val("");
                $(".schedule_time_two input").val("");
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
            if ($("#bulks-enable").is(":checked")) {
                $("#bulk-disable").show(100);
            } else {
                $("#bulk-disable").hide(100);
            }
            
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
