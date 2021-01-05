<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\Store;
use App\Models\Vendor;
use Illuminate\Http\Request;
use odannyc\GoogleImageSearch\ImageSearch;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use File;
use Intervention\Image\ImageManagerStatic as Image;

class ProductController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function productList(){
        $products = Product::withTrashed()->whereNotNull('barcode')
        ->groupBy('barcode');
        if (request()->ajax()) {

            return DataTables::of($products)
                /* ->addColumn('family', function ($row) {
                    return Product::withTrashed()->find($row->id)->family->name;
                }) */
                ->editColumn('pd_name2', function ($row) {
                    $data = '-';
                        if($row->pd_name2){
                            $data=$row->pd_name2;
                        }
                    return $data;
                })
                ->editColumn('cost', function ($row) {
                    $data = '-';
                        if($row->cost){
                            $data=$row->cost;
                        }
                    return $data;
                })
                ->editColumn('box_cost', function ($row) {
                    $data = '-';
                        if($row->box_cost){
                            $data=$row->box_cost;
                        }
                    return $data;
                })
                ->editColumn('item_cnt_per_box', function ($row) {
                    $data = '-';
                        if($row->item_cnt_per_box){
                            $data=$row->item_cnt_per_box;
                        }
                    return $data;
                })
                ->editColumn('deposit_amount', function ($row) {
                    $data = '-';
                        if($row->deposit_amount){
                            $data=$row->deposit_amount;
                        }
                    return $data;
                })
                ->editColumn('minimum_stock', function ($row) {
                    $data = '-';
                        if($row->minimum_stock){
                            $data=$row->minimum_stock;
                        }
                    return $data;
                })
                ->editColumn('size', function ($row) {
                    $data = '-';
                        if($row->size){
                            $data=$row->size;
                        }
                    return $data;
                })
                ->editColumn('pd_code', function ($row) {
                    $data = '-';
                        if($row->pd_code){
                            $data=$row->pd_code;
                        }
                    return $data;
                })
                ->editColumn('box_barcode', function ($row) {
                    $data = '-';
                        if($row->box_barcode){
                            $data=$row->box_barcode;
                        }
                    return $data;
                })
                ->editColumn('liquore_price', function ($row) {
                    $data = '-';
                        if($row->liquore_price){
                            $data=$row->liquore_price;
                        }
                    return $data;
                })
                ->editColumn('age_check', function ($row) {
                    $data = 0;
                    if ($row->age_check) {
                        $data = 1;
                    }
                    return $data;
                })
                ->editColumn('food_stamp', function ($row) {
                    $data = 0;
                    if ($row->food_stamp) {
                        $data = 1;
                    }
                    return $data;
                })
                ->editColumn('scale_product', function ($row) {
                    $data = 0;
                        if($row->scale_product){
                            $data = 1;
                        }
                    return $data;
                })
                ->editColumn('description', function ($row) {
                    $data = '-';
                    if ($row->description) {
                        $data = $row->description;
                    }
                    return $data;
                })
                ->editColumn('vendor_id', function ($row) {
                    $data = '-';
                    if ($row->vendor_id) {
                        $data = $row->vendor_id;
                    }
                    return $data;
                })
                ->editColumn('menuf_id', function ($row) {
                    $data = '-';
                    if ($row->menuf_id) {
                        $data = $row->menuf_id;
                    }
                    return $data;
                })
                ->editColumn('category_id', function ($row) {
                    $data = '-';
                    if ($row->category_id) {
                        $data = $row->category_id;
                    }
                    return $data;
                })
                ->addColumn('org_vendor_name', function ($row) {
                    $data = '-';
                    if ($row->vendor_id) {
                        $data = Vendor::withTrashed()->find($row->vendor_id)->name;
                    }
                    return $data;
                })
                ->addColumn('store_name',function($row){
                    $data = '-';
                        if($row->store_id){
                            $data = Store::withTrashed()->find($row->store_id)->store_name;
                        }
                    return $data;
                })
                ->addColumn('menuf_name', function ($row) {
                    $data = '-';
                    if ($row->menuf_id) {
                        $data = Manufacturer::withTrashed()->find($row->menuf_id)->manufacturer_name;;
                    }
                    return $data;
                })
                ->addColumn('org_category_name', function ($row) {
                    $data = '-';
                    if ($row->category_id) {
                        $data = Product::withTrashed()->find($row->id)->category->name;
                    }
                    return $data;
                })
                ->addColumn('logo', function ($row) {
                    // $url ="https://via.placeholder.com/30x30";
                    $url = asset("product_images/images/30x30.png");
                    if ($row->image) {
                        $url = asset("product_images/$row->image");
                    }

                    return '<img  class="img img-thumbnail" style="height:60px" src="' . $url . '"></img>';
                })
                ->addColumn('actions', function ($row) {
                    $data = '<a class="text-primary fa-2x"
                                style="cursor: pointer;" href="' . url("/edit-product/" .$row->id) . '">
                                <i class="fa fa-edit"></i>
                            </a>';

                    if ($row->deleted_at == null) {
                        $data .= '<a class="text-danger fa-2x"
                                    style="cursor: pointer;" href="' . url("/product-destroy/" .$row->id) . '">
                                    <span class="fa fa-trash"></span>
                                </a>';
                    } else {
                        $data .=    '<a class="text-success fa-2x"
                                        style="cursor: pointer;" href="' . url("/product-restore/" .$row->id) . '">
                                        <i class="fa fa-recycle"></i>
                                    </a>';
                    }
                    return $data;
                })
                ->rawColumns(['actions', 'logo'])
                ->make(true);
        }

        return view('products.product_list');
     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function scanAndCreateProduct($barcode)
    {

        $vendors = Vendor::all();
        $stores = Store::all();
        $categories = Category::whereNull('parent_id')->get();
        $manuf = Manufacturer::all();
        return view('products.add-product-form', compact('vendors', 'categories', 'manuf', 'barcode','stores'));
        // return view('products.add-product',compact('barcode'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function scanAndUpdateProduct($barcode)
    {
        $barcode = decrypt($barcode);
        $product = Product::withTrashed()->firstWhere('barcode',$barcode);
        $vendors = Vendor::all();
        $stores = Store::all();
        $maincat = Category::whereNull('parent_id')->get();
        if ($product->category_id) {
            $categories = Category::where('parent_id', Category::find($product->category_id)->parent->id)->get();
            $parent_cat = Category::find($product->category_id)->parent->id;
        } else {
            $parent_cat = Category::whereNull('parent_id')->get();
            $categories = [];
        }
/*         $categories = Category::where('parent_id', Category::find($product->category_id)->parent->id)->get();
        $parent_cat = Category::find($product->category_id)->parent->id; */
        $cats = Category::all();
        $manuf = Manufacturer::all();
        $barcode = encrypt($barcode);

        return view('products.update-product-form',compact('vendors', 'maincat', 'categories', 'manuf', 'barcode','product','parent_cat','stores'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products.add-product');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        /* $this->validate($request,[
            'product_name' => 'required',
            'quantity' => 'required | numeric',
            'retail_price' => 'required | numeric',
            'sale_price' => 'required | numeric',
            'barcode' => 'required',
            'food_stamp' => [Rule::in(0,1)],
            'age_check' => [Rule::in(0,1)],
            'scale_product' => [Rule::in(0,1)],
            'vendor_id' => [Rule::notIn(0)],
            'manuf_id' => [Rule::notIn(0)],
            'sub_cat_id' => [Rule::notIn(0)],
            'store_id' => [Rule::notIn(0)],
        ]); */

        $validator = Validator::make($request->all(), [
            'product_name' => 'required',
            'quantity' => 'required | numeric',
            'retail_price' => 'required | numeric',
            'sale_price' => 'required | numeric',
            'barcode' => 'required',
            'food_stamp' => [Rule::in(0, 1)],
            'age_check' => [Rule::in(0, 1)],
            'scale_product' => [Rule::in(0, 1)],
            'vendor_id' => [Rule::notIn(0)],
            'manuf_id' => [Rule::notIn(0)],
            'sub_cat_id' => [Rule::notIn(0)],
            'store_id' => [Rule::notIn(0)],
        ]);


        if ($validator->fails()) {
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)
                    ->withInput();
            }
        }

        // dd($request);


            $save_prod = [
            'product_name'=>$request->product_name,
            'pd_code' => $request->product_code,
            'retail_price'=>$request->retail_price,
            'sell_price'=>$request->sale_price,
            'quantity'=>$request->quantity,
            'barcode'=>$request->barcode,
            'pd_name2'=>$request->product_name2,
            'cost'=>$request->cost,
            'box_cost'=>$request->box_cost,
            'item_cnt_per_box'=>$request->item_cnt_per_cost,
            'deposit_amount'=>$request->deposit_amount,
            'minimum_stock'=>$request->minimum_stock,
            'size'=>$request->size,
            'box_barcode'=>$request->box_barcode,
            'food_stamp'=>$request->food_stamp,
            'age_check'=>$request->age_check,
            'scale_product'=>$request->scale_product,
            'description'=>$request->description,
            'liquore_price'=>$request->liquore_price,
            'vendor_id'=>$request->vendor_id,
            'menuf_id'=>$request->manuf_id,
            'category_id'=>$request->sub_cat_id,
            'store_id' => $request->store_id,

        ];

        if ($request->hasFile('device_image')) {
            // $imageName = time() . '.' . $request->image->extension();
            $name = $request->file('device_image')->getClientOriginalName();
            // $path = Storage::put('images',$request->file('device_image')->get());
            $path = Storage::put('images/prducts', $request->file('device_image'));
            // $path = $request->file('device_image')->store('images/prducts');
            $save_prod['image'] = $path;
        } else {
            // dd($request->input());
            $save_prod['image'] = $request->image_name;
            // $save_prod['image'] = 'https://via.placeholder.com/30x30';
        }

            /* if ($request->hasFile('device_image')) {
                // $imageName = time() . '.' . $request->image->extension();
                $name = $request->file('device_image')->getClientOriginalName();
                // $path = Storage::put('images',$request->file('device_image')->get());
                $path = $request->file('device_image')->store('images/products');
                $save_prod['image'] = $path;
            }else{
                $save_prod['image'] = $request->image_name;
            } */

        $product = Product::create($save_prod);

        toast()->success('Product added successfully')->timerProgressBar();
        return redirect()->route('/product_lists');
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
        // $id = decrypt($id);
        $product = Product::withTrashed()->find($id);
        $vendors = Vendor::all();
        $stores = Store::all();
        $maincat = Category::whereNull('parent_id')->get();
        if($product->category_id){
            $categories = Category::where('parent_id', Category::find($product->category_id)->parent->id)->get();
            $parent_cat = Category::find($product->category_id)->parent->id;
        }else{
            $parent_cat = Category::whereNull('parent_id')->get();
            $categories = [];
        }
        $cats = Category::all();
        $manuf = Manufacturer::all();
        $barcode = encrypt($product->barcode);
        return view('products.update-product-form', compact('vendors', 'maincat', 'categories', 'manuf', 'barcode', 'product', 'parent_cat','stores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // dd($request->all());
        $this->validate($request, [
            'product_name' => 'required',
            'quantity' => 'required | numeric',
            'retail_price' => 'required | numeric',
            'sale_price' => 'required | numeric',
            'barcode' => 'required',
            'food_stamp' => [Rule::in(0, 1)],
            'age_check' => [Rule::in(0, 1)],
            'scale_product' => [Rule::in(0, 1)],
            'vendor_id' => [Rule::notIn(0)],
            'manuf_id' => [Rule::notIn(0)],
            'sub_cat_id' => [Rule::notIn(0)],
            'store_id' => [Rule::notIn(0)],
        ]);

        if($request->new_quantity >=1){
            $request->quantity = $request->quantity + $request->new_quantity;
        }

        $update_prod = [
            'product_name' => $request->product_name,
            'pd_code' => $request->product_code,
            'retail_price' => $request->retail_price,
            'sell_price' => $request->sale_price,
            'quantity' => $request->quantity,
            'barcode' => $request->barcode,
            'pd_name2' => $request->product_name2,
            'cost' => $request->cost,
            'box_cost' => $request->box_cost,
            'item_cnt_per_box' => $request->item_cnt_per_box,
            'deposit_amount' => $request->deposit_amount,
            'minimum_stock' => $request->minimum_stock,
            'size' => $request->size,
            'box_barcode' => $request->box_barcode,
            'food_stamp' => $request->food_stamp,
            'age_check' => $request->age_check,
            'scale_product' => $request->scale_product,
            'description' => $request->description,
            'liquore_price' => $request->liquore_price,
            'vendor_id' => $request->vendor_id,
            'menuf_id' => $request->manuf_id,
            'category_id' => $request->sub_cat_id,
            'store_id' => $request->store_id,
       ];

        if ($request->hasFile('device_image')) {
            // $imageName = time() . '.' . $request->image->extension();
            // $name = $request->file('device_image')->getClientOriginalName();
            // $path = Storage::put('images',$request->file('device_image')->get());
            $path =Storage::put('images/prducts', $request->file('device_image'));
            // $path = $request->file('device_image')->store('images/prducts');
            $update_prod['image'] = $path;
        }elseif($request->image_name){
            $update_prod['image'] = $request->image_name;
        }
        // dd("Hey");
        // dd($update_prod,$request->file('device_image'));

       /* if ($request->hasFile('device_image')) {
                // $imageName = time() . '.' . $request->image->extension();
                $name = $request->file('device_image')->getClientOriginalName();
                $path = Storage::put('images/product/',$request->file('device_image')->get());

                $update_prod['image'] = $path;
            }else{
                $update_prod['image'] = $request->image_name;
            } */

        $product = Product::withTrashed()->find($id)->update($update_prod);
        toast()->success('Product Updated Successfully')->timerProgressBar();
        // return redirect()->back();
        return redirect()->route('/product_lists');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $id = decrypt($id);
        Product::find($id)->delete();
        toast()->success('Product Deleted Successfully')->timerProgressBar();
        return redirect()->back();
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        // $id = decrypt($id);
        Product::withTrashed()->find($id)->restore();
        toast()->success('Product Restored Successfully')->timerProgressBar();
        return redirect()->back();
    }


    public function testSearch(){
        ImageSearch::config()->apiKey(env('GOOGLE_CUSTOM_SEARCH_KEY'));
        ImageSearch::config()->cx(env('GOOGLE_SEARCH_CX'));

        // $image =ImageSearch::search("banana",['start' => 11]);

        // if(array_key_exists("items", $image)){
        //     $product_image= $image["items"];
        //     dd($product_image);

        // }
        $search = "banana";

        $image =ImageSearch::search($search,);
        $image1 =ImageSearch::search($search,["start"=>11]);
        $image2 =ImageSearch::search($search,["start"=>21]);



            $product_image1= $image["items"];
            return $product_image1;


            $product_image2= $image1["items"];
            return $product_image2;


            $product_image3= $image2["items"];
            return $product_image3;


        $product_image = array_merge($product_image1, $product_image2, $product_image3);
        dd($product_image);


        return "not working";
    }
    public function getImage($search){

        ImageSearch::config()->apiKey(env('GOOGLE_CUSTOM_SEARCH_KEY'));
        ImageSearch::config()->cx(env('GOOGLE_SEARCH_CX'));

        $image =ImageSearch::search($search,);
        $image1 =ImageSearch::search($search,["start"=>11]);
        $image2 =ImageSearch::search($search,["start"=>21]);



            $product_image1= $image["items"];



            $product_image2= $image1["items"];


            $product_image3= $image2["items"];


        $product_image = array_merge($product_image1, $product_image2, $product_image3);

        return $product_image;

    }
    public function downloadImage(Request $request){
        $url = $request->src;

        $contents = file_get_contents($url);
        $name = substr($url, strrpos($url, '/') + 1);
        Storage::put($name, $contents);
        // $oldImage = get_file(storage_path("app/{$name}"));
        //    $oldImage =  Storage::get($name);


        return $name;
    }

    public function storeImage(Request $request){
        $img = $request->message;
        $folderPath = "public/";

        $image_parts = explode(";base64,", $img);

        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.png';

        $file = $folderPath . $fileName;
        $storage = Storage::put($fileName,$image_base64);
        return $fileName;
        // file_put_contents($file, $image_base64);
    }
}
