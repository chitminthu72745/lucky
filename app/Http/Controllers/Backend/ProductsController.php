<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Bulk;
use App\Models\Term;
use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\Inventory;
use App\Models\Preparation;
use App\Models\StockStatus;
use App\Models\BackOrder;
use Illuminate\Http\Request;
use App\Models\product_category;
use Yajra\Datatables\Datatables;
use App\Models\product_attribute;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductStore;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductUpdate;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.products.index');
    }

    public function ssd()
    {
        $data = Product::leftJoin('inventories', 'inventories.product_id', '=', 'products.id')
            ->select('products.*', 'inventories.stock_status', 'inventories.stock_quantity', 'inventories.low_stock')
            ->get();
        return Datatables::of($data)
            ->editColumn('stock_status', function ($each) {
                if ($each->manage_stock == 0) {
                    if ($each->stock_status == 'In stock') {
                        return '<span class="text-success">' . $each->stock_status . '</span>';
                    } elseif ($each->stock_status == 'Out of stock') {
                        return '<span class="text-danger">' . $each->stock_status . '</span>';
                    } else {
                        return '<span class="text-warning">' . $each->stock_status . '</span>';
                    }
                } elseif ($each->stock_quantity >= 0) {
                    return 'In stock';
                } elseif ($each->stock_quantity == $each->low_stock) {
                    return 'Low stock';
                }
            })
            ->addColumn('cat_name', function ($each) {
                $cat_product_name = product_category::where('product_categories.product_id', '=', $each->id)
                    ->leftJoin('categories', 'categories.id', '=', 'product_categories.category_id')
                    ->select('categories.cat_name')
                    ->get();
                $cat_product = '';
                foreach ($cat_product_name as $cat_products) {
                    $cat_product .= $cat_products['cat_name'] . ' , ';
                }
                return $cat_product;
            })
            ->editColumn('image', function ($each) {
                $img = '<img src="' . asset('/uploads/products/' . $each->image) . '" width="60" alt="">';
                return $img;
            })
            ->editColumn('created_at', function ($each) {
                return Carbon::parse($each->created_at)->format('Y-m-d H:i:s');
            })
            ->editColumn('updated_at', function ($each) {
                return Carbon::parse($each->updated_at)->format('Y-m-d H:i:s');
            })
            ->addColumn('action', function ($each) {
                $edit_icon = '<a href="' . route('admin.products.edit', $each->id) . '" class="btn btn-sm btn-outline-secondary" data-toggle="tooltip" title="Edit"><i class="pe-7s-edit"></i></a>';
                $delete_icon = '<a href="#" class="btn btn-sm btn-outline-danger delete" data-id="' . $each->id . '"><i class="pe-7s-delete-user"></i></a>';
                return $edit_icon . '&nbsp;' . $delete_icon;
            })
            ->rawColumns(['image', 'action', 'stock_status'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attributes = Attribute::all();
        $datas = Attribute::leftJoin('terms', 'attributes.id', '=', 'terms.attribute_id')
            ->select('terms.*', 'attributes.name', 'attributes.slug', 'attributes.type')
            ->get();
        $categories = Category::all();
        return view('backend.products.create', compact('datas', 'attributes', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStore $request)
    {
        $request->validate([
            'name' => 'required',
            'product_image' => 'required',
            'price' => 'required',
            'sale_price' => 'required',
            'barcode' => 'required',
        ]);
        if ($request->price < $request->sale_price) {
            return back()->withErrors('Sale price must be equal amount or less than regular price.');
        }

        $user = auth()->user();
        $date = Carbon::now();
        $product = new Product();
        $product_attribute = new product_attribute();
        $inventory = new Inventory();
        $preparation = new Preparation();

        $file = $request->file('product_image');
        $filename = uniqid() . '_' . $file->getClientOriginalName();
        $file->move(public_path() . '/uploads/products', $filename);

        $product->name = $request->name;
        $product->image = $filename;
        $product->users_id = $user->id;
        $product->regular_price = $request->price;
        $product->sale_price = $request->sale_price;
        $product->start_date = $request->start_date;
        $product->end_date = $request->end_date;
        $product->barcode = $request->barcode;
        $product->description = $request->description;
        $product->save();

        //Inventory Isert
        $inventory->product_id = $product->id;
        if ($request->sku !== null) {
            $inventory->sku = $request->sku;
        } else {
            $inventory->sku = 'No SKU';
        }
        if ($request->has('manage_stock')) {
            $inventory->manage_stock = 1;
            $inventory->stock_quantity = $request->stock_quantity;
            $inventory->backorders = $request->backorders;
            $inventory->low_stock = $request->low_stock;
            $inventory->stock_status = $request->stock_status;
        } else {
            $inventory->manage_stock = 0;
            $inventory->low_stock = 'instock';
            $inventory->stock_status = $request->stock_status;
        }

        if ($request->has('solid_individually')) {
            $inventory->solid_individually = 1;
        } else {
            $inventory->solid_individually = 0;
        }
        $inventory->save();

        //Pepration
        if ($request->has('preparation_disable')) {
            $preparation->product_id = $product->id;
            $preparation->enable = 1;
            $preparation->preparation_days = 0;
            $preparation->extra_time = 0;
            $preparation->availability_date = 'To enable preparation';
        } else {
            $preparation->product_id = $product->id;
            $preparation->enable = 0;
            $preparation->preparation_days = $request->preparation_days;
            $preparation->extra_time = $request->extra_time;
            $preparation->availability_date = $date->toDateString();
        }
        $preparation->save();

        //Attribute insert
        if ($request->attribute) {
            foreach ($request->attribute as $key => $attribute) {
                product_attribute::create(['product_id' => $product->id, 'term_id' => $attribute]);
            }
        }

        //Bulk insert
        if ($request->min_quantity && $request->bulks_enable == 'on') {
            foreach ($request->min_quantity as $key => $quantity) {
                Bulk::create(['product_id' => $product->id, 'enable' => 'on', 'discount' => $request->discount[$key]['amount'], 'min_quantity' => $quantity['number'], 'description' => $request->bulks_description]);
            }
        }

        //Category insert
        if ($request->category) {
            foreach ($request->category as $key => $category) {
                product_category::create(['product_id' => $product->id, 'category_id' => $category]);
            }
        }

        return redirect()
            ->route('admin.products.index')
            ->with('create', 'Successfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $attributes = Attribute::all();
        $attributes_datas = Attribute::leftJoin('terms', 'attributes.id', '=', 'terms.attribute_id')
            ->select('terms.*', 'attributes.name', 'attributes.slug', 'attributes.type')
            ->get();
        $stock_status = StockStatus::all();
        $back_orders = BackOrder::all();
        $all_category = Category::all();
        $edit_products = Product::findOrFail($id);
        $edit_attribute = Term::join('product_attributes', 'terms.id', '=', 'product_attributes.term_id')
            ->leftJoin('products', 'product_attributes.product_id', '=', 'products.id')
            ->where('products.id', '=', $id)
            ->get();
        $edit_inventory = Inventory::leftJoin('products', 'products.id', '=', 'inventories.product_id')
            ->where('products.id', '=', $id)
            ->get();
        $edit_preparation = Preparation::leftJoin('products', 'products.id', '=', 'preparations.product_id')
            ->where('products.id', '=', $id)
            ->get();
        $edit_bulk = Bulk::join('products', 'products.id', '=', 'bulks.product_id')
            ->where('products.id', '=', $id)
            ->get();
        $edit_category = Category::join('product_categories', 'categories.id', '=', 'product_categories.category_id')
            ->leftJoin('products', 'product_categories.product_id', '=', 'products.id')
            ->where('products.id', '=', $id)
            ->get();
        return view('backend.products.edit', compact('attributes_datas', 'attributes', 'stock_status','back_orders', 'edit_products', 'edit_inventory', 'edit_attribute', 'edit_preparation', 'edit_bulk', 'edit_category', 'all_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdate $request, $id)
    {
        $product = Product::findOrFail($id);
        $inventory = Inventory::join('products', 'inventories.product_id', '=', 'products.id')
            ->where('products.id', '=', $id)
            ->first();

        $preparation = Preparation::join('products', 'preparations.product_id', '=', 'products.id')
            ->where('products.id', '=', $id)
            ->first();

        $product_name = $request->name;
        $product_description = $request->description;
        $product_price = $request->price;
        $product_sale_price = $request->sale_price;
        $product_start_date = $request->start_date;
        $product_end_date = $request->end_date;
        $product_barcode = $request->barcode;

        if (!empty($request->file('product_image'))) {
            $file = $request->file('product_image');
            $filename = uniqid() . '_' . $file->getClientOriginalName();
            $file->move(public_path() . '/uploads/products', $filename);
            $product->image = $filename;
        } else {
            $product->image = $product->image;
        }
        $product->name = $product_name;
        $product->description = $product_description;
        $product->regular_price = $product_price;
        $product->sale_price = $product_sale_price;
        $product->barcode = $product_barcode;
        if($product_start_date){
            $product->start_date = $product_start_date;
            $product->end_date = $product_end_date;
        }else{
            $product->start_date = NULL;
            $product->end_date = NULL;
        }
        $product->update();

        // Inventor Update
        $inventory->sku = $request->sku;
        if ($request->manage_stock) {
            $inventory->manage_stock = 1;
            $inventory->stock_quantity = $request->stock_quantity;
            $inventory->backorders = $request->backorders;
            $inventory->low_stock = $request->low_stock;
            $inventory->stock_status = 'In stock';
        } else {
            $inventory->manage_stock = 0;
            $inventory->stock_quantity = 0;
            $inventory->backorders = null;
            $inventory->low_stock = 'instock';
            $inventory->stock_status = $request->stock_status;
        }
        if (!empty($inventory->solid_individually)) {
            $inventory->solid_individually = 1;
        } else {
            $inventory->solid_individually = 0;
        }
        $inventory->update();

        // Preparation
        if (empty($request->preparation_disable)) {
            $preparation->enable = 0;
            $preparation->preparation_days = $request->preparation_days;
            $preparation->extra_time = $request->extra_time;
            $preparation->availability_date = $request->availability_date;
        } else {
            $preparation->enable = 1;
            $preparation->preparation_days = 0;
            $preparation->extra_time = 0;
            $preparation->availability_date = 'To enable preparation';
        }
        $preparation->update();


        // Attribute
        $attr_del = product_attribute::where('product_attributes.product_id', '=', $id)
                    ->delete();
        if($attr_del){
            DB::statement('ALTER TABLE product_attributes AUTO_INCREMENT = '.(count(product_attribute::all())+1).';');
        }
        if ($request->attribute) {
            foreach ($request->attribute as $key => $attribute) {
                product_attribute::create(['product_id' => $product->id, 'term_id' => $attribute]);
            }
        }

        //Bulk insert
        $bulk_del = Bulk::where('bulks.product_id', '=', $id)
                    ->delete();
        if($bulk_del){
            DB::statement('ALTER TABLE bulks AUTO_INCREMENT = '.(count(Bulk::all())+1).';');
        }
        if ($request->min_quantity && $request->bulks_enable == 'on') {
            foreach ($request->min_quantity as $key => $quantity) {
                Bulk::create(['product_id' => $product->id, 'enable' => 'on', 'discount' => $request->discount[$key]['amount'], 'min_quantity' => $quantity['number'], 'description' => $request->bulks_description]);
            }
        }

        //Category insert
        $category_del = product_category::where('product_categories.product_id', '=', $id)
                    ->delete();
        if($category_del){
            DB::statement('ALTER TABLE product_categories AUTO_INCREMENT = '.(count(product_category::all())+1).';');
        }
        if ($request->category) {
            foreach ($request->category as $key => $category) {
                product_category::create(['product_id' => $product->id, 'category_id' => $category]);
            }
            dd($request->category);
        }

        // dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product_del = Product::find($id);
        $product_del->inventory()->delete();
        $product_del->product_category()->delete();
        $product_del->product_attribute()->delete();
        $product_del->bulk()->delete();
        $product_del->tag()->delete();
        $product_del->delete();

        return 'success';
    }
}
